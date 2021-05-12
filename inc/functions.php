<?php
function sslValidater($url)
{
    $content = @file_get_contents($url);
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    if ($content === false) {
        die("file_open_failed!");
    }
    return ($content);
}

function getToken()
{
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $decryption_iv = '1234567891011121';
    $decryption_key = getKey();
    $decryption = openssl_decrypt("Msu1VZOLGDoZvO50VV3jJ4cEMUpA1x1cOcXBS+2uW56d6cZVrBJ9iw==", $ciphering, $decryption_key, $options, $decryption_iv);
    return $decryption;
}

function getKey()
{
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $decryption_iv = '1234567891011121';
    $decryption_key = "masterKey";
    $decryption = openssl_decrypt("i85bUyjkkOBP", $ciphering, $decryption_key, $options, $decryption_iv);
    return $decryption;
}

function getTags($q)
{
    $content = file_get_contents(getToken() . "tag-generator&input=" . urlencode($q));
    $json_data = json_decode($content, true);
    return $json_data;
}

function parse_channel_username(string $url): ?string
{
    $parsed = parse_url(rtrim($url, '/'));
    if (isset($parsed['path']) && preg_match('/^\/user\/(([^\/])+?)$/', $parsed['path'], $matches)) {
        return $matches[1];
    }
    return null;
}

function parse_channel_id(string $url): ?string
{
    $parsed = parse_url(rtrim($url, '/'));
    if (isset($parsed['path']) && preg_match('/^\/channel\/(([^\/])+?)$/', $parsed['path'], $matches)) {
        return $matches[1];
    }
    return null;
}

function extractNumbers($str)
{
    $int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
    return $int;
}

function isValidImg($url)
{
    if (@getimagesize($url)) {
        return true;
    } else {
        return false;
    }
}

function dataImg($url)
{
    $path = $url;
    $type = 'jpg';
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}

function searchThumb($s, $page = '')
{
    $url = 'https://www.youtube.com/results?search_query=' . urlencode($s) . '&' . $page;
    $content = sslValidater($url);

    //Create dom object
    $dom = new domdocument();
    $dom->loadhtml($content);
    $nodes = $dom->getElementsByTagName('a');
    $videoIdList = array();

    //Result limit (Counter)
    $i = 1;

    //Get video data one by one
    foreach ($nodes as $node) {
        //create 2 varibale for get video URL and Title
        $nodehref = $node->getAttribute('href');
        $nodeTitle = $node->getAttribute('title');

        //check video URL is validater
        //Skip googleadservices videos and video playlists
        if (strpos($nodehref, '/watch?v=') !== false && strpos($nodehref, 'googleadservices') === false && strpos($nodehref, '&list') === false && $nodeTitle != '') {
            //store video data to varibales
            $videoUrl = "https://www.youtube.com" . $nodehref; //Video URL
            $videoId = getVideoId($videoUrl); //Video id
            $i++;
            //Store video data to ARRAY
            array_push($videoIdList, $videoId);
        }

        //Chect counter value to exit loop
        //To get nore results change this variable
        if ($i > 14) {
            break;
        }
    }
    return $videoIdList;
}

function getVideoId($url)
{
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    return $match[1];
}

function getVideoTitle($url)
{
     $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";
     $curl = curl_init($youtube);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     $return = curl_exec($curl);
     curl_close($curl);
     $vData =  json_decode($return, true);
     $vTitle = $vData['title'];
     return $vTitle;
}

function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) {
        return '';
    }

    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function get_animated_thumb_url($str, $startDelimiter, $endDelimiter)
{
    $contents = array();
    $startDelimiterLength = strlen($startDelimiter);
    $endDelimiterLength = strlen($endDelimiter);
    $startFrom = $contentStart = $contentEnd = 0;
    while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
        $contentStart += $startDelimiterLength;
        $contentEnd = strpos($str, $endDelimiter, $contentStart);
        if (false === $contentEnd) {
            break;
        }
        $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
        $startFrom = $contentEnd + $endDelimiterLength;
    }

    return $contents;
}

function getVideoTags($url)
{
    //header('content-type: text/plain');

    $content = sslValidater($url);

    $parsed = get_string_between($content, '"keywords\":[', '"]');

    $str = str_replace(str_split('\\/:*?"<>|'), '', $parsed);

    $tags = explode(',', $str);
    return $tags;

}

function generateTitles($s)
{
    $url = 'https://www.youtube.com/results?search_query=' . urlencode($s) . '&gl=';
    $content = sslValidater($url);
    
    //Youtube search result page content
    //Create dom object
    $dom = new domdocument();
    $dom->loadhtml($content);
    $nodes = $dom->getElementsByTagName('a');
    $titleLists = array();
    
    //Result limit (Counter)
    $i = 1;
    //Get video data one by one
    foreach ($nodes as $node) {
        //create 2 varibale for get video URL and Title
        $nodehref = $node->getAttribute('href');
        $nodeTitle = $node->getAttribute('title');
        //check video URL is validater
        //Skip googleadservices videos and video playlists
        if (strpos($nodehref, '/watch?v=') !== false && strpos($nodehref, 'googleadservices') === false && strpos($nodehref, '&list') === false && $nodeTitle != '') {

            $videoTitle = $nodeTitle; //Video Title
            $i++;
            //Store video data to ARRAY
            array_push($titleLists, $videoTitle);
        }

        //Chect counter value to exit loop
        //To get nore results change this variable
        if ($i > 15) {
            break;
        }
    }
    return $titleLists;
}

function getTrendingVideo($country, $counter)
{
    $url = 'https://www.youtube.com/feed/trending?gl=' . $country;

    $content = sslValidater($url);

    $dom = new domdocument();
    libxml_use_internal_errors(true);
    $dom->loadhtml($content);

    $nodes = $dom->getElementsByTagName('a');

    $newArray = array();

    //Result limit (Counter)
    $i = 1;

//Get video data one by one
    foreach ($nodes as $node) {

        //create 2 varibale for get video URL and Title
        $nodehref = $node->getAttribute('href');
        $nodeTitle = $node->getAttribute('title');

        //check video URL is validater
        //Skip googleadservices videos and video playlists
        if (strpos($nodehref, '/watch?v=') !== false && strpos($nodehref, 'googleadservices') === false && strpos($nodehref, '&list') === false && $nodeTitle != '') {

            //store video data to varibales
            $videoUrl = "https://www.youtube.com" . $nodehref; //Video URL
            $videoId = getVideoId($videoUrl); //Video id
            $videoTitle = $nodeTitle; //Video Title
            $channelName = $node->parentNode->nextSibling->textContent; //channel name
            $views = $node->parentNode->nextSibling->nextSibling->lastChild->lastChild->textContent; //views
            $views = (int) filter_var($views, FILTER_SANITIZE_NUMBER_INT);
            $views = thousandsCurrencyFormat($views) . " views";
            //  $cahnnelUrl =  "https://www.youtube.com".$node->parentNode->nextSibling->firstChild->getAttribute('href'); //channel url
            $thumb = "https://i.ytimg.com/vi/" . $videoId . "/mqdefault.jpg";
//        $channelAvatar = getChannelAvatar($videoId);
            //increment our counter value
            $i++;
            //Store video data to ARRAY
            $array = array(0 => array("videoId" => $videoId, "thumb" => $thumb, "videoTitle" => $videoTitle, "videoUrl" => $videoUrl, "views" => $views, "channelName" => $channelName));
            $newArray[] = $array; // video data added to main array
        }

        //Chect counter value to exit loop
        //To get nore results change this variable
        if ($i > $counter) {
            break;
        }
    }

//Finally store all arrays in RESULTS array
    $result = array();
    foreach ($newArray as $value) {
        $result = array_merge($result, $value);
    }

    return $result;

}

function getVisIpAddr()
{

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function getCountryCode()
{
    $ip = getVisIPAddr();
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

//echo 'Country Name: ' . $ipdat->geoplugin_countryName . "\n" ."<br>";
    return $ipdat->geoplugin_countryCode;

}

function thousandsCurrencyFormat($num)
{

    if ($num > 1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('K', 'M', 'B', 'T');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;

    }

    return $num;
}

function getChannelKeyWord($url)
{

    $title = '';
    $description = '';
    $keywords = '';

    $img = '';

    $content = file_get_contents($url);
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");

    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    $nodes = $doc->getElementsByTagName('title');

//get and display what you need:
    $title = $nodes->item(0)->nodeValue;
    $img = $doc->getElementsByTagName('img')->item(0);
    $img = $img->attributes->getNamedItem("src")->value;
    $metas = $doc->getElementsByTagName('meta');

    for ($i = 0; $i < $metas->length; $i++) {
        $meta = $metas->item($i);
        if ($meta->getAttribute('name') == 'description') {
            $description = $meta->getAttribute('content');
        }

        if ($meta->getAttribute('name') == 'keywords') {
            $keywords = $meta->getAttribute('content');
        }

    }

//Create dom object
    //$dom = new domdocument();
    //$dom->loadhtml($content);

    $text = $keywords;
    preg_match_all('/"(?:\\\\.|[^\\\\"])*"|\S+/', $text, $matches);
    $tags = $matches;

    return array("title" => $title, "description" => $description, "keywords" => $tags, "avatar" => $img);

}

function getRedirectUrl($url)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.30 Safari/537.36'));
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $a = curl_exec($ch);
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

    return $url;

}

function getVideoUrl($url)
{

    $content = file_get_contents("https://ytoffline.net/en/download/?url=" . $url);

// create new DOMDocument
    $dom = new \DOMDocument('1.0', 'UTF-8');

// set error level
    $internalErrors = libxml_use_internal_errors(true);

// load HTML
    $dom->loadHTML($content);

// Restore error level
    libxml_use_internal_errors($internalErrors);

    $nodes = $dom->getElementsByTagName('tr');

    $i = 0;
    $position = 0;
    $type = "video with Audio";

    $videoWithAudio = array();
    $videoOnly = array();
    $audioOnly = array();

    foreach ($nodes as $node) {

        $breaker = $node->firstChild->nodeValue;

        if ($breaker == "Resolution") {

            $position++;

            if ($position == 2) {
                $type = "Audio Only";
            } elseif ($position == 3) {
                $type = "Video Without Audio";
            }

        }

        if ($i != 0 && $breaker != "Resolution") {

            $resolution = $node->firstChild->textContent;
            $fileSize = $node->firstChild->nextSibling->nextSibling->nodeValue;

            $downloadLink = $node->firstChild->nextSibling->nextSibling->nextSibling->nextSibling->lastChild->attributes[1]->value;

            $array = array(0 => array("resolution" => $resolution, "fileSize" => $fileSize, "downloadLink" => $downloadLink));

            switch ($position) {
                case '1':
                    $videoWithAudio[] = $array;
                    break;
                case '2':
                    $videoOnly[] = $array;
                    break;
                case '3':
                    $audioOnly[] = $array;
                    break;
                default:
                    # code...
                    break;
            }

        }

        $i++;

        if ($i > 30) {
            break;
        }

    }

    $result = array();
    $resultvideoOnly = array();
    $resultaudioOnly = array();

    foreach ($videoWithAudio as $value) {
        $result = array_merge($result, $value);
    }
    foreach ($videoOnly as $value) {
        $resultvideoOnly = array_merge($resultvideoOnly, $value);
    }
    foreach ($audioOnly as $value) {
        $resultaudioOnly = array_merge($resultaudioOnly, $value);
    }

    $finalresult = array($result, $resultvideoOnly, $resultaudioOnly);

    return $finalresult;

}

function getAudio($url)
{

    $content = file_get_contents("https://ytoffline.net/en/download/?url=" . $url);

// create new DOMDocument
    $dom = new \DOMDocument('1.0', 'UTF-8');

// set error level
    $internalErrors = libxml_use_internal_errors(true);

// load HTML
    $dom->loadHTML($content);

// Restore error level
    libxml_use_internal_errors($internalErrors);

    $nodes = $dom->getElementsByTagName('tr');

    $i = 0;
    $position = 0;
    $type = "video with Audio";

    $audioOnly = array();

    foreach ($nodes as $node) {

        $breaker = $node->firstChild->nodeValue;

        if ($breaker == "Resolution") {

            $position++;

            if ($position == 2) {
                $type = "Audio Only";
            } elseif ($position == 3) {
                $type = "Video Without Audio";
            }

        }

        if ($i != 0 && $breaker != "Resolution") {

            $resolution = $node->firstChild->textContent;
            $fileSize = $node->firstChild->nextSibling->nextSibling->nodeValue;

            $downloadLink = $node->firstChild->nextSibling->nextSibling->nextSibling->nextSibling->lastChild->attributes[1]->value;

            $array = array(0 => array($downloadLink));

            switch ($position) {
                case '2':
                    $audioOnly[] = $array;
                    break;
                default:
                    # code...
                    break;
            }

        }

        $i++;

        if ($i > 30) {
            break;
        }

    }

    $resultaudioOnly = array();

    foreach ($audioOnly as $value) {
        $resultaudioOnly = array_merge($resultaudioOnly, $value);
    }

    return $resultaudioOnly;

}

function getAnimatedThumbFromUrl($q){
    $new        =  htmlspecialchars($q, ENT_QUOTES);
    $content    =  htmlspecialchars($new);
    $parsed = get_animated_thumb_url($content, '//i.ytimg.com/an_webp/', ',');
    $searchReplaceArray = array(
        '\/' => '/', 
        '//' => '/', 
        '\u0026' => '&' 

    );
    $result = str_replace(
        array_keys($searchReplaceArray), 
        array_values($searchReplaceArray), 
        html_entity_decode($parsed)
    );

    $aUrl = 'https://i.ytimg.com/an_webp/'.$result ; 
    $aUrl = html_entity_decode(str_replace('\&', '&', $aUrl)); 
    $aUrl = str_replace('&quot;', '', $aUrl);
    return $aUrl ;

}

function getAnimatedThumb($q,$counter){
    
    $new        =  htmlspecialchars($q, ENT_QUOTES);
    $content    =  htmlspecialchars($new);

    $parsed = get_animated_thumb_url($content, '//i.ytimg.com/an_webp/', ',');
    $thumbList = array();
    $i = 1;
if (is_array($parsed) || is_object($parsed))
{
   
    foreach($parsed as $key){

        $searchReplaceArray = array(
            '\u0026' => '&', 
            '&quot;' => ''
        );
        $result = str_replace(
            array_keys($searchReplaceArray), 
            array_values($searchReplaceArray), 
            html_entity_decode($key)
        );

        $aUrl = 'https://i.ytimg.com/an_webp/'.$result ; 
        array_push($thumbList,$aUrl);
        
        $i++;
        
        if($i > $counter ){
            break;
        }

    }


}



    return  $thumbList;
    
}


function checkUsername($username)
{

    $opts = array('http' => array(
        'method' => 'GET',
        'header' => array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*\/*;q=0.8',
        ),
    ),
    );
    $context = stream_context_create($opts);
    $result = file_get_contents("https://www.youtube.com/user/" . $username, false, $context);

    if ($result != "") {
        return false;
    } else {
        return true;
    }

}

function checkCustomUrl($username)
{

    $opts = array('http' => array(
        'method' => 'GET',
        'header' => array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*\/*;q=0.8',
        ),
    ),
    );
    $context = stream_context_create($opts);
    $result = file_get_contents("https://www.youtube.com/" . $username, false, $context);

    if ($result != "") {
        return false;
    } else {
        return true;
    }

}

function getChannelBanner($url)
{
    $content = file_get_contents($url);
    $q = htmlentities($content);
    $new = htmlspecialchars($q, ENT_QUOTES);
    $content = htmlspecialchars($new);
    $parsed = get_animated_thumb_url($content, 'background-image: url(//yt3.ggpht.com', ');');
    return '//yt3.ggpht.com' . isset($parsed[2])?$parsed[2]:'';
}

function getChannelName($url)
{

    $title = '';
    $description = '';
    $keywords = '';

    $img = '';

    $content = file_get_contents($url);
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    
    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    $nodes = $doc->getElementsByTagName('title');
    //get and display what you need:
    $title = $nodes->item(0)->nodeValue;
    $title = str_replace('- YouTube', '', $title);
    $img = $doc->getElementsByTagName('img')->item(0);
    $img = $img->attributes->getNamedItem("src")->value;

    $metas = $doc->getElementsByTagName('meta');
    $channelUrl = '';
    for ($i = 0; $i < $metas->length; $i++) {
        $meta = $metas->item($i);
        if ($meta->getAttribute('property') == 'og:url') {
            $channelUrl = $meta->getAttribute('content');
        }

        $channelId = parse_channel_id(strval($channelUrl));

    }

    $text = $keywords;
    preg_match_all('/"(?:\\\\.|[^\\\\"])*"|\S+/', $text, $matches);
    $tags = $matches;

    

    return array("title" => $title, "avatar" => $img, "channelId" => $channelId);

}

function getChannelNames($url)
{

    $title = '';
    $description = '';
    $keywords = '';

    $img = '';
    $data = [];
    $content = file_get_contents($url);
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    
    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    $nodes = $doc->getElementsByTagName('title');
    //get and display what you need:
    $title = $nodes->item(0)->nodeValue;
    $title = str_replace('- YouTube', '', $title);
    $img = $doc->getElementsByTagName('img')->item(0);
    $img = $img->attributes->getNamedItem("src")->value;
    array_push($data,array("title" => $title));
    
    $metas = $doc->getElementsByTagName('meta');
    $channelUrl = '';
    for ($i = 0; $i < $metas->length; $i++) {
        $meta = $metas->item($i);
        if ($meta->getAttribute('property') == 'og:url') {
            $channelUrl = $meta->getAttribute('content');
        }

        $channelId = parse_channel_id(strval($channelUrl));

    }
    array_push($data,array("channelId" => $channelId));
    $text = $keywords;
    preg_match_all('/"(?:\\\\.|[^\\\\"])*"|\S+/', $text, $matches);
    $tags = $matches;
    
    return $data;

}


function numFormat($num)
{

    $map = array("K" => 1000, "M" => 1000000, "B" => 1000000000);
    $money = $num;
    list($value, $suffix) = sscanf($money, "%f%s");
    $final = $value * $map[$suffix];
    return $final;

}

function getSubscribers($url)
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept-Language: en']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    curl_close($curl);

    $content = $data;

    $parsed = get_string_between($content, 'subscribers">', '</span>');
    if (ctype_digit($parsed)) {
        return $parsed;
    } else {
        return numFormat($parsed);
    }

}

function getVideoInfo($url)
{

    $title = '';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept-Language: en']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    curl_close($curl);
//echo $data;
    $content = $data;
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");

    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    $nodes = $doc->getElementsByTagName('title');

//get and display what you need:
    $title = $nodes->item(0)->nodeValue;
    $metas = $doc->getElementsByTagName('meta');

    for ($i = 0; $i < $metas->length; $i++) {
        $meta = $metas->item($i);
        if ($meta->getAttribute('itemprop') == 'interactionCount') {
            $views = $meta->getAttribute('content');
        }

    }

    $likes = get_string_between($content, '\"likeCount\":', ',\"likeCountText\"');
    $dislikes = get_string_between($content, '\"dislikeCount\":', ',\"dislikeCountText\"');

    return array("title" => $title, "likes" => $likes, "dislikes" => $dislikes);

}

function getUserInfo($content, $dataType)
{

    $id = 'youtube-stats-header-' . $dataType;
    $data = get_string_between($content, $id, '</span>');
    $data = str_replace('" style = "display: none;">', " ", $data);
    return $data;
}

function getChannleAnalyticsData($url)
{

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://socialblade.com/youtube/' . $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.30 Safari/537.36'));
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    $content = curl_exec($ch);
    curl_close($ch);

    $uploads = getUserInfo($content, 'uploads');
    $subscribers = getUserInfo($content, 'subs');
    $views = getUserInfo($content, 'views');
    $country = getUserInfo($content, 'country');
    $channelType = getUserInfo($content, 'channeltype');

    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");

    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    $metas = $doc->getElementsByTagName('div');
    $imgs = $doc->getElementsByTagName('img');
    for ($i = 0; $i < $metas->length; $i++) {
        $meta = $metas->item($i);
        if ($meta->getAttribute('id') == 'socialblade-user-content') {

            $sbRank = $meta->firstChild->nextSibling->childNodes[3]->childNodes[1]->textContent;
            $subsRank = $meta->firstChild->nextSibling->childNodes[3]->childNodes[3]->textContent;
            $videoViewsRank = $meta->firstChild->nextSibling->childNodes[3]->childNodes[5]->textContent;
            $countryRank = $meta->firstChild->nextSibling->childNodes[3]->childNodes[7]->textContent;
            $catRank = $meta->firstChild->nextSibling->childNodes[3]->childNodes[9]->textContent;
            $grade = $meta->firstChild->nextSibling->childNodes[1]->textContent;
            $subsForLast30Days = $meta->firstChild->nextSibling->nextSibling->nextSibling->nextSibling->childNodes[1]->childNodes[1]->firstChild->textContent;
            $monthlyEarnings = $meta->firstChild->nextSibling->nextSibling->nextSibling->nextSibling->childNodes[3]->childNodes[1]->textContent;
            $viewsForLast30Days = $meta->firstChild->nextSibling->nextSibling->nextSibling->nextSibling->childNodes[5]->childNodes[1]->firstChild->textContent;
            $yearlyEarnings = $meta->firstChild->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->childNodes[1]->textContent;

        }
        if ($meta->getAttribute('id') == 'YouTubeUserTopHeaderBackground') {
            $banner = $meta->getAttribute('style');
        }

        if ($meta->getAttribute('id') == 'averagedailyviews') {
            $dailyEarnings = $meta->nextSibling->nextSibling->nodeValue;
        }

    }
    for ($i = 0; $i < $imgs->length; $i++) {
        $meta = $imgs->item($i);
        if ($meta->getAttribute('id') == 'YouTubeUserTopInfoAvatar') {
            $avatar = $meta->getAttribute('src');
            $channelName = $meta->getAttribute('title');
        }

    }

    $grade = trim(str_replace('Total Grade', ' ', $grade));
    $sbRank = extractNumbers(trim(str_replace('Social Blade Rank', ' ', $sbRank)));
    $subsRank = extractNumbers(trim(str_replace('Subscriber Rank', ' ', $subsRank)));
    $videoViewsRank = extractNumbers(trim(str_replace('Video Views Rank', ' ', $videoViewsRank)));
    $countryRank = extractNumbers(trim(str_replace('Country Rank', ' ', $countryRank)));
    $catRank = extractNumbers(trim(str_replace('$channelType Rank', ' ', $catRank)));
    $subsForLast30Days = trim($subsForLast30Days);
    $monthlyEarnings = trim($monthlyEarnings);
    $viewsForLast30Days = trim($viewsForLast30Days);
    $yearlyEarnings = trim(str_replace('Estimated Yearly Earnings', ' ', $yearlyEarnings));
    $banner = get_string_between($banner, "url('", "');");
    $channelId = get_string_between($content, 'https://youtube.com/channel/', '"');
    $dailyEarnings = trim($dailyEarnings);
    $result = array("channelName" => $channelName, "uploads" => $uploads, "subscribers" => $subscribers, "views" => $views, "country" => $country, "channelType" => $channelType, 'grade' => $grade, "sbRank" => $sbRank, "subsRank" => $subsRank, "videoViewsRank" => $videoViewsRank, "countryRank" => $countryRank, "catRank" => $catRank, "subsForLast30Days" => $subsForLast30Days, "monthlyEarnings" => $monthlyEarnings, "viewsForLast30Days" => $viewsForLast30Days, "yearlyEarnings" => $yearlyEarnings, "dailyEarnings" => $dailyEarnings, "banner" => $banner, "avatar" => $avatar, "channelId" => $channelId);

    return $result;

}

function mp3Info($vurl,$listId,$type){

    $content = file_get_contents('http://1c94f38.online-server.cloud/mp3.php?url='.$vurl.'&listId='.$listId.'&type='.$type);

return $content;

}

function topChannels($url)
{
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, 'https://socialblade.com/youtube/'.$url); 
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.30 Safari/537.36'));
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    $content = curl_exec($ch);
    curl_close($ch);

    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    //echo $content;
    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    $metas = $doc->getElementsByTagName('div');
    $item = 1;
    $top100youtubers = array();
    for ($i = 0; $i < $metas->length; $i++)
    {
        $meta = $metas->item($i);
        if ($meta->getAttribute(base64_decode('c3R5bGU='))==base64_decode('d2lkdGg6IDg2MHB4OyBiYWNrZ3JvdW5kOiAjZmFmYWZhOyBwYWRkaW5nOiAxMHB4IDIwcHg7IGNvbG9yOiM0NDQ7IGZvbnQtc2l6ZTogMTBwdDsgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlZWU7IGxpbmUtaGVpZ2h0OiA0MHB4Ow==')||$meta->getAttribute(base64_decode('c3R5bGU='))==base64_decode('d2lkdGg6IDg2MHB4OyBiYWNrZ3JvdW5kOiAjZjhmOGY4OzsgcGFkZGluZzogMTBweCAyMHB4OyBjb2xvcjojNDQ0OyBmb250LXNpemU6IDEwcHQ7IGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZWVlOyBsaW5lLWhlaWdodDogNDBweDs=')||$meta->getAttribute(base64_decode('c3R5bGU='))==base64_decode('d2lkdGg6IDg2MHB4OyBiYWNrZ3JvdW5kOiAjZmFmYWZhOyBwYWRkaW5nOiAwcHggMjBweDsgY29sb3I6IzQ0NDsgZm9udC1zaXplOiAxMHB0OyBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2VlZTsgbGluZS1oZWlnaHQ6IDMwcHg7')||$meta->getAttribute(base64_decode('c3R5bGU='))==base64_decode('d2lkdGg6IDg2MHB4OyBiYWNrZ3JvdW5kOiAjZjhmOGY4OzsgcGFkZGluZzogMHB4IDIwcHg7IGNvbG9yOiM0NDQ7IGZvbnQtc2l6ZTogMTBwdDsgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlZWU7IGxpbmUtaGVpZ2h0OiAzMHB4Ow==') ) 
        {
            $channelName = trim($meta->childNodes['5']->nodeValue);
            $catergory = str_replace('Category: ', '', trim($meta->childNodes['5']->lastChild->firstChild->getAttribute('title')));
            $uploads = trim($meta->childNodes['7']->nodeValue) ;
            $subs = trim($meta->childNodes['9']->nodeValue);

            $totalViews = thousandsCurrencyFormat(str_replace(',', '', (trim($meta->childNodes['11']->nodeValue))));
            $url = trim($meta->childNodes['5']->lastChild->previousSibling->previousSibling->getAttribute('href'));
            $url = str_replace('/youtube', 'https://www.youtube.com', $url);
            array_push($top100youtubers, array('rank'=>$item,'channelName'=>$channelName,'channelType'=>$catergory,'uploads'=>$uploads,'subscribers'=>$subs,'views'=>$totalViews,'channelId'=>$url));
            $item++;
        }
    }
    return $top100youtubers;    
}


function convertVideo($url, $fquality)
{

    $postdata = http_build_query(
        array(
            'url' => $url,
            'ajax' => '1',
        )
    );

    $opts = array('http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $postdata,
    ),
    );

    $context = stream_context_create($opts);

    $result = file_get_contents('https://mate03.y2mate.com/analyze/ajax', false, $context);
    $json_data = json_decode($result, true);
    $id = get_string_between($json_data['result'], "_id: '", "',");

    $postdata = http_build_query(
        array(
            'type' => "youtube",
            '_id' => $id,
            'v_id' => getVideoId($url),
            'ajax' => 1,
            'token' => 'g_token',
            'ftype' => 'mp4',
            'fquality' => $fquality,
        )
    );

    $opts = array('http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $postdata,
    ),
    );

    $context = stream_context_create($opts);

    $result = file_get_contents('https://www.youtubeconverter.io/convert/index?hl=en1', false, $context);
    $json_data = json_decode($result, true);

    $downloadLink = get_string_between($json_data['result'], 'href="', '"');

    return $downloadLink;

}

function convertVideoToMp3($url,$fquality,$id,$vid)
{
    $postdata = http_build_query(
        array(
            'type' => "youtube",
            '_id' => $id,
            'v_id' => $vid,
            'ajax' => 1,
            'token' => 'g_token',
            'ftype' => 'mp3',
            'fquality' => $fquality,
        )
    );

    $opts = array('http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $postdata,
    ),
    );

    $context = stream_context_create($opts);

    $result = file_get_contents('https://www.youtubeconverter.io/convert/index?hl=en1', false, $context);
    $json_data = json_decode($result, true);

    $downloadLink = get_string_between($json_data['result'], 'href="', '"');

    return $downloadLink;

}

function getVideoFormatList($urls)
{
    $url = 'https://www.youtubeconverter.io/en1/convert-mp4?query=' . $urls;

    $postdata = http_build_query(
        array(
            'url' => $url,
            'ajax' => '1'
        )
    );
    
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    
    $context  = stream_context_create($opts);
    
    $result = file_get_contents('https://mate10.y2mate.com/analyze/ajax', false, $context);
    $json_data = json_decode($result, true);
    
    $doc = new DOMDocument();
    @$doc->loadHTML($json_data['result']);
    $nodes = $doc->getElementsByTagName('div');
    
    $linkList = array();
    
    for ($i = 0; $i < $nodes->length; $i++)
    {
        $node = $nodes->item($i);
        
        if ($node->getAttribute('class') == 'caption text-left') {
            $title = $node->nodeValue;
            array_push($linkList, array('title' => $title));
        }
        
        if($node->getAttribute('id') == 'mp4'){
            
            $rows = $node->childNodes[1]->childNodes[1]->childNodes;
    
            for ($i_ = 0; $i_ < ($rows->length)-1; $i_++) 
            {
                $row = $rows->item($i_);
        
                $size =  $row->childNodes[1]->nextSibling->nodeValue;
                $format =  $row->childNodes[0]->firstChild->nextSibling->firstChild->nodeValue;
        
                $qulity = str_replace('(.mp4)', '', $format);
        
                if (strpos($qulity, '3gp')) {
                    $qulity = str_replace('(.3gp)', '', $format);
                }
        
                if (strpos($qulity, '1080') || strpos($qulity, '360')) {
                    $qulity = str_replace('p (.mp4)', '', $format);
                }
        
                $item = array('size'=>$size,'format'=>trim($format),'qulity'=>trim($qulity));
                array_push($linkList, $item);
            }
        }
    }
   return $linkList;
}

function getcomment($url, $pageToken)
{

    if ($pageToken == "" || $pageToken == null) {
        $url = "https://www.googleapis.com/youtube/v3/commentThreads?key=AIzaSyBohGMMjYGfhVqtIALRgsr--FsZ5aRiiow&textFormat=plaintext&part=snippet&videoId=" . $url . "&maxResults=100";
    } else {
        $url = "https://www.googleapis.com/youtube/v3/commentThreads?key=AIzaSyBohGMMjYGfhVqtIALRgsr--FsZ5aRiiow&textFormat=plaintext&part=snippet&videoId=" . $url . "&pageToken=" . $pageToken . "&maxResults=100";
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept-Language: en']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    $resp = $data;
    $hashTags = array();
    if ($resp) {
        $json = json_decode($resp);

        if ($json) {
            //echo("JSON decoded<br>");
            $items = $json->items;

            $nextPageToken = $json->nextPageToken;
            $totalResults = $json->pageInfo->totalResults;
            $resultsPerPage = $json->pageInfo->resultsPerPage;
            array_push($hashTags, $nextPageToken, $totalResults, $resultsPerPage);

            foreach ($items as $item) {
                $id = $item->id;
                $author = $item->snippet->topLevelComment->snippet->authorDisplayName;
                $authorPic = $item->snippet->topLevelComment->snippet->authorProfileImageUrl;
                $authorChannelUrl = $item->snippet->topLevelComment->snippet->authorChannelUrl;
                $textDisplay = $item->snippet->topLevelComment->snippet->textDisplay;

                array_push($hashTags, array($author, $authorPic, $authorChannelUrl, $textDisplay));
            }

        } else {
            exit("Error. could not parse JSON." . json_last_error_msg());
        }

    } // if resp

    // print_r($hashTags);
    return $hashTags;
}

function convertVideoToMp4($url,$fquality,$id,$vid)
{
    $postdata = http_build_query(
        array(
            'type' => "youtube",
            '_id' => $id,
            'v_id' => $vid,
            'ajax' => 1 ,
            'token' => 'g_token',
            'ftype' => 'mp4',
            'fquality' => $fquality
        )
    );

    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );

    $context  = stream_context_create($opts);

    $result = file_get_contents('https://www.youtubeconverter.io/convert/index?hl=en1', false, $context);
    $json_data = json_decode($result, true);
    $downloadLink =  get_string_between($json_data['result'],'href="','"');
    return $downloadLink;
}

function xss_clean($data)
{
    // Fix &entity\n;
    $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    } while ($old_data !== $data);

    // we are done...
    return $data;
}
