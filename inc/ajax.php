<?php include "functions.php";?>

<?php
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
$root = $protocol.$_SERVER['HTTP_HOST'];
			
if (isset($_REQUEST["subs"])) 
{
    $channelUrl = xss_clean(trim($_REQUEST["subs"]));
    $parsed = getSubscribers('https://'.$channelUrl);
    echo $parsed;
}

if (isset($_REQUEST["liveVideoStatus"])) 
{
    $videoUrl = trim($_REQUEST["liveVideoStatus"]);
    $videoInfo = getVideoInfo($videoUrl);
    $likes = $videoInfo['likes'];
    $dislikes = $videoInfo['dislikes'];
    $result = array($likes, $dislikes);
    echo json_encode($result);
}

if (isset($_REQUEST["q"])) 
{
    $vid = xss_clean(getVideoId($_REQUEST["q"]));
    $html = htmlentities(file_get_contents('https://www.youtube.com/embed/' . $vid));
    $url = getAnimatedThumbFromUrl($html);
    $encodedUrl = urlencode($url);
    $result = array($url, $encodedUrl);
    echo json_encode($result);
}

if (isset($_REQUEST["username"])) 
{
    $username = xss_clean($_REQUEST["username"]);
    $status = "";
    $uname_status = checkUsername($username);
    $curl_status = checkCustomUrl($username);

    if ($uname_status == false) {
        $status .= "unu";
    }
    if ($curl_status == false) {
        $status .= ", cuu";
    }

    echo $status;
}

if (isset($_GET["vurl"])) 
{
    $vurl = trim($_GET["vurl"]);
    $quality = trim($_GET["quality"]);
    $id = trim($_GET["id"]);
    $vid = trim($_GET["vid"]);
    $dlink = convertVideoToMp4($vurl, $quality, $id, $vid);

    if (strpos($dlink, 'youtubeconverter') !== false) {
        echo base64_encode($dlink);
    } else {
        echo 0;
    }
}


if (isset($_GET["getchann"])) 
{
    $channelUrlss = trim($_GET["url"]);
    $curl_status = getChannelName($channelUrlss);
    
    $data = '<div class="companies-list"><a href="#" class="company"><div class="company-inner-alignment"><span class="company-logo"><img src="'.$curl_status['avatar'].'" alt=""></span><h4 class="namech">'.$curl_status['title'].'</h4></div></a></div><a href="'.$root.'/tools/analytics-view.php?cid='.$curl_status['channelId'].'" id="mp3Download" class="button dark ripple-effect button-sliding-icon downloadFile"> Analytics</a>';
    echo $data;
}

if (isset($_GET["mvurl"])) 
{
    $vurl = trim($_GET["mvurl"]);
    $sId = session_id();
    $title = getVideoTitle($vurl);
    $id = getVideoId($vurl);
    $quality = trim($_GET["quality"]);
    
    $content = file_get_contents('http://1c94f38.online-server.cloud/?vid='.$id.'&vq='.$quality.'&sid='.$sId.'&type=mp3');
    $response = json_decode($content);
 
    if ($response->status == '1')
    {
    	$file = "http://1c94f38.online-server.cloud/d?file=$sId&vid=$id&title=$title";
    	echo $file;
    }
    else
    {
    	echo 0;
    }
    
}

if (isset($_GET["getcomm"])) 
{
    $mvurls = trim($_GET["getcomm"]);
    $mqualitys = trim($_GET["url"]);
    $tokens = trim($_GET["token"]);
    $dlinks = getcomment($mqualitys, $tokens);

    echo json_encode($dlinks);

}
?>
<?php 



if (isset($_GET['mpurl'])) {
    $vurl =$_GET['mpurl'];
    $listId = 'null';


    if (isset($_GET['list'])) {
        $listId = $_GET['list'] ;
        $type = 'playlist';
    }else{
        $type = 'video';
    }


 $data =  mp3Info($vurl,$listId,$type);

    $response = json_decode($data);

$response = json_encode($data);
echo $response;


}




if (isset($_GET['vInfo'])) {
    $url = $_GET['vInfo'] ;

    $vId = getVideoId($url) ;
    $vTitle = getVideoTitle($url);

    $vInfo = array('id'=>$vId,'title'=>$vTitle);
    $vInfo = json_encode($vInfo);

    echo $vInfo;


}







 ?>

