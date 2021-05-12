<?php

function getupdate($cversion){
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://admin.mwtlakshan.com/yt-tool-station/request.php?cversion='.$cversion,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ]);
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);
    return $resp;
}

/* 
* =================================================
*        function for format numbers
* =================================================
*/
function custom_number_format($n, $precision = 3) {
    if ($n < 1000000) {
        // Anything less than a million
        $n_format = number_format($n);
    }else if ($n < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000000, $precision) . 'M';
    }else if ($n < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000000, $precision) . 'M';
    } else {
        // At least a billion
        $n_format = number_format($n / 1000000000, $precision) . 'B';
    }

    return $n_format;
}

/* 
* =================================================
*        function for count tags in all times
* =================================================
*/
function alltimeTags(){
    global $dbh;
    $sql ="SELECT sum(num_of_tags) as num_of_tags, date from tags_status";             
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
        return $results;
    }

}

/* 
* =================================================
*        function for count tags in today
* =================================================
*/
function todayTags(){
    global $dbh;
    $todaysDate = date('Y-m-d');
    $sql ="SELECT sum(num_of_tags) as num_of_tags, date from tags_status WHERE date LIKE '%$todaysDate%' ";             
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    return $results;
}

/* 
* =================================================
*        function for count tags in last 7 days
* =================================================
*/
function last7DaysTags(){
    global $dbh;
    $sql ="SELECT sum(num_of_tags) as num_of_tags, date from tags_status WHERE date BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 7 DAY ) AND CURDATE( )";             
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    return $results;
}


/* 
* =================================================
*        function for get tags in this month
* =================================================
*/
function thisMonthTags(){
    global $dbh;
    $sql ="SELECT sum(num_of_tags) as num_of_tags, date from tags_status WHERE date between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()";             
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    return $results;
}


/* 
* =================================================
*        function for update admin profile
* =================================================
*/
function updateAdminProfile(){

    global $dbh;

    $sql = "SELECT * from admin;";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $result_profile=$query->fetch(PDO::FETCH_OBJ);
    $img =  htmlentities($result_profile->image);     


    $file = $_FILES['image']['name'];
    $file_loc = $_FILES['image']['tmp_name'];
    $folder="uploads/"; 
    $new_file_name = strtolower($file);
    $final_file=str_replace(' ','-',$new_file_name);

    if (empty($file)){
        $image = $img;

    }elseif(move_uploaded_file($file_loc,$folder.$final_file)){
        $image=$final_file;
    }

    $name=xss_clean(stripslashes(trim($_POST['name'])));
    $email=xss_clean(stripslashes(trim($_POST['email'])));

    if($name != "" || $email != "" ){
        $sql="UPDATE admin SET username=(:name), email=(:email), image=(:image)";
        $query = $dbh->prepare($sql);
        $query-> bindParam(':name', $name, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':image', $image, PDO::PARAM_STR);
        $query->execute();

        return true;

    }else{

        return false;
    }

}


/* 
* =================================================
*        function for update admin password
* =================================================
*/function updateAdminPassword(){

    global $dbh;

    $password=md5($_POST['password']);
    $newpassword=md5($_POST['newpassword']);
    $username=$_SESSION['alogin'];

    if(!empty(trim($password)) || !empty(trim($newpassword))){
        $sql ="SELECT Password FROM admin WHERE UserName=:username and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':username', $username, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        if($query -> rowCount() > 0)
        {
            $con="update admin set Password=:newpassword where UserName=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $status = $chngpwd1->execute();
            if ($status) {
                return true;
            }else{
                return false;
            }


        }
        else {
            return false;
        }        
    }else{
        return false;
    }    

}


/* 
* =================================================
*        function for update site settings
* =================================================
*/
function updateSettings(){

    global $dbh;
    
    $sql = "SELECT * from settings where id =".$_POST['id']." ;";    
    $query = $dbh -> prepare($sql);
    
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);

    $img =  htmlentities($result->logoImg);     
    
    $file = $_FILES['logoImg']['name'];
    $file_loc = $_FILES['logoImg']['tmp_name'];
    $folder="uploads/"; 
    $new_file_name = strtolower($file);
    $final_file=str_replace(' ','-',$new_file_name);

    updateSettingsfortheme($_POST['logoTxttheame'],$_POST['thid']);

    if (empty($file)){
        if($_POST['imgStatus'] == 'true'){
            $logoImg = $img;
        }else{
            $logoImg = "";
        }
    
    }elseif(move_uploaded_file($file_loc,$folder.$final_file)){
        $logoImg=$final_file;
    }
    $siteTitle=xss_clean(trim($_POST['siteTitle']));
    $metaKeywords=xss_clean(trim($_POST['metaKeywords']));
    $metaDescription=xss_clean(trim($_POST['metaDescription']));
    $logoTxt=xss_clean(trim($_POST['logoTxt']));
    $footer=base64_encode(trim($_POST['footer']));       
    
    $sql="UPDATE settings SET siteTitle=(:siteTitle), metaKeywords=(:metaKeywords),metaDescription=(:metaDescription), logoTxt=(:logoTxt), logoImg=(:logoImg), footer=(:footer)  where id =".$_POST['id']."";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':siteTitle', $siteTitle, PDO::PARAM_STR);
    $query-> bindParam(':metaKeywords', $metaKeywords, PDO::PARAM_STR);
    $query-> bindParam(':metaDescription', $metaDescription, PDO::PARAM_STR);
    $query-> bindParam(':logoTxt', $logoTxt, PDO::PARAM_STR);
    $query-> bindParam(':logoImg', $logoImg, PDO::PARAM_STR);
    $query-> bindParam(':footer', $footer, PDO::PARAM_STR);         
    $status = $query->execute();
    
    if ($status) {
        return true;
    }else{
        return false;
    }
}

function updateSettingsfortheme($thid,$id){

    global $dbh;
    
    $sql="UPDATE settings SET logoTxt=(:logoTxt) where id =".$id."";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':logoTxt', $thid, PDO::PARAM_STR);      
    $status = $query->execute();
    
    if ($status) {
        return true;
    }else{
        return false;
    }
}


/* 
* =================================================
*        function for update page details
* =================================================
*/
function updatePage(){

    global $dbh;
    $pageId = $_GET['edit'];
    $content=base64_encode($_POST['textediter']);
    $title=xss_clean(trim($_POST['title']));
    $statuss=$_POST['status'];
    $metakeywords=xss_clean(trim($_POST['metaKeywords']));
    $metadescription=xss_clean(trim($_POST['metaDescription']));

    $sql="UPDATE pages SET title=(:title), content=(:content), meta_keywords=(:metakeywords), meta_description=(:metadescription), status=(:status) WHERE id=(:pageId)";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':title', $title, PDO::PARAM_STR);
    $query-> bindParam(':content', $content, PDO::PARAM_STR);
    $query-> bindParam(':metakeywords', $metakeywords, PDO::PARAM_STR);
    $query-> bindParam(':metadescription', $metadescription, PDO::PARAM_STR);
    $query-> bindParam(':status', $statuss, PDO::PARAM_STR);
    $query-> bindParam(':pageId', $pageId, PDO::PARAM_STR);
    $status = $query->execute();
    if ($status) {
        return true;
    }else{
        return false;
    }
}

function updatePageStatua(){

    global $dbh;
    $pageId = $_POST['id'];
    $status = $_POST['status'];

    $sql="UPDATE pages SET status=(:status) WHERE id=(:pageId)";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query-> bindParam(':pageId', $pageId, PDO::PARAM_STR);
    $status = $query->execute();
    if ($status) {
        return true;
    }else{
        return false;
    }
}

/* 
* =================================================
*        function for update admin profile
* =================================================
*/
function updateSocialMedia(){

    global $dbh;




    $fb=urlencode(stripslashes(trim($_POST['fb'])));
    $tw=urlencode(stripslashes(trim($_POST['tw'])));
    $you=urlencode(stripslashes(trim($_POST['you'])));

        $sql="UPDATE admin SET social_fb=(:social_fb), social_tw=(:social_tw), social_you=(:social_you)";
        $query = $dbh->prepare($sql);
        $query-> bindParam(':social_fb', $fb, PDO::PARAM_STR);
        $query-> bindParam(':social_tw', $tw, PDO::PARAM_STR);
        $query-> bindParam(':social_you', $you, PDO::PARAM_STR);
               $status = $query->execute();
        if ($status) {
            return true;
        }else{
            return false;
        }
}

function slug($text)
{ 
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  // trim
  $text = trim($text, '-');
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // lowercase
  $text = strtolower($text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text))
  {
    return 'n-a';
  }
  return $text.time();
}


/* 
* =================================================
*        function for update page details
* =================================================
*/
function addBlog()
{
    global $dbh;
    
    
    $file = $_FILES['post_image']['name'];

    if (empty($file))
    {
        $post_image = "blog-img-1.jpg";
    }
    else
    {
        
        $file_loc = $_FILES['post_image']['tmp_name'];
        $folder="uploads/blog_images/"; 
        $new_file_name = strtolower($file);
        $final_file=str_replace(' ','-',$new_file_name);
        if(move_uploaded_file($file_loc,$folder.$final_file))
            $post_image=$final_file;
    }
    
    $cat_id = $_POST['cat_id'];
    $title=xss_clean(trim($_POST['title']));
    $contents=base64_encode($_POST['textediter']);
    $tags = $_POST['tags'];
    $pstatus = $_POST['pstatus'];
    $post_img = $post_image;
    $postSlug = slug($title);
    $date_posted; 
    
    if($_POST['post_on'] != null || $_POST['post_on'] != "")
    {
        $date_posted = $_POST['post_on'];
    }
    else
    {
        $date_posted = new DateTime();
        $date_posted = $date_posted->format('Y-m-d H:i:s'); 
    }
    
    $sql="INSERT INTO posts (cat_id,title,contents,post_image,postSlug,tags,pstatus,date_posted) VALUES(:cat_id,:title,:contents,:post_image,:postSlug,:tags,:pstatus,:date_posted)";
    $query = $dbh->prepare($sql);
    $status = $query->execute(['cat_id' => $cat_id,'title' => $title,'contents' => $contents,'post_image' => $post_img,'postSlug' => $postSlug,'tags'=> $tags,'pstatus'=> $pstatus, 'date_posted' => $date_posted]);
    
    if ($status) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function updateBlog()
{
    global $dbh;
   
    $file = $_FILES['post_image']['name'];
    
    if (empty($file))
    {   
        if($_POST['oldimag'] != "" || $_POST['oldimag'] != null)
        {
            $post_image = $_POST['oldimag'];    
        }
        else
        {
            $post_image = "blog-img-1.jpg";
        }    
    }
    else
    {
        $file_loc = $_FILES['post_image']['tmp_name'];
        $folder="uploads/blog_images/"; 
        $new_file_name = strtolower($file);
        $final_file=str_replace(' ','-',$new_file_name);
        if(move_uploaded_file($file_loc,$folder.$final_file))
            $post_image=$final_file;
    }
    
    $cat_id = $_POST['cat_id'];
    $title=xss_clean(trim($_POST['title']));
    $contents=base64_encode($_POST['textediter']);
    $tags = $_POST['tags'];
    $pstatus = $_POST['pstatus'];
    $post_img = $post_image;
    $postSlug = slug($title);
    $date_posted;
    
    if($_POST['post_on'] != null || $_POST['post_on'] != "")
    {
        $date_posted = $_POST['post_on'];
    }
    else
    {
        $date_posted = new DateTime();
        $date_posted = $date_posted->format('Y-m-d H:i:s'); 
    }
        
    $sql="UPDATE posts SET cat_id=(:cat_id), title=(:title), tags=(:tags), pstatus=(:pstatus), contents=(:contents), post_image=(:post_image), date_posted=(:date_posted) WHERE id = ".$_POST['blogid']."";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':cat_id', $cat_id, PDO::PARAM_STR);
    $query-> bindParam(':tags', $tags, PDO::PARAM_STR);
    $query-> bindParam(':pstatus', $pstatus, PDO::PARAM_STR);
    $query-> bindParam(':title', $title, PDO::PARAM_STR);
    $query-> bindParam(':contents', $contents, PDO::PARAM_STR);
    $query-> bindParam(':post_image', $post_img, PDO::PARAM_STR);
    $query-> bindParam(':date_posted', $date_posted, PDO::PARAM_STR);
    $status = $query->execute();
    
    if ($status) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function updateBlogStatua(){

    global $dbh;
    $pageId = $_POST['id'];
    $status = $_POST['status'];

    $sql="UPDATE posts SET status=(:status) WHERE id=(:pageId)";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query-> bindParam(':pageId', $pageId, PDO::PARAM_STR);
    $status = $query->execute();
    if ($status) {
        return true;
    }else{
        return false;
    }
}

function addCategory()
{
    global $dbh;
    
    $title=xss_clean(trim($_POST['name']));
    
    $sql="INSERT INTO categories (name) VALUES(:name)";
    $query = $dbh->prepare($sql);
    $status = $query->execute(['name' => $title]);
    
    if ($status) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function updateCategory()
{
    global $dbh;

    $title=trim($_POST['name']);
    
    $sql="UPDATE categories SET name=(:name) WHERE id = ".$_POST['id']."";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':name', $title, PDO::PARAM_STR);
    $status = $query->execute();
    
    if ($status) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function updateBlogCategoryStatua($id=null,$status=null)
{
    global $dbh;
    
    $pageId = $id;    
    $status = $status;
    
    $sql="UPDATE categories SET status=(:status) WHERE id=(:pageId)";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query-> bindParam(':pageId', $pageId, PDO::PARAM_STR);
    $status = $query->execute();
    if ($status) {
        return true;
    }else{
        return false;
    }
}

function updateBlogCategoryStatus()
{
    global $dbh;
    $pageId = $_POST['id'];
    $status = $_POST['status'];

    $sql="UPDATE categories SET status=(:status) WHERE id=(:pageId)";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query-> bindParam(':pageId', $pageId, PDO::PARAM_STR);
    $status = $query->execute();
    if ($status) {
        return true;
    }else{
        return false;
    }
}

function downloadupdate($url,$newversion)
{   
    $directory = dirname(__FILE__);
    
    $newdirectory = realpath(__DIR__ . '/../..');
    
    $zip_file = $newdirectory."/downloadfile.zip";

    $zip_resource = fopen($zip_file, "w");
    
    $ch_start = curl_init();
    curl_setopt($ch_start, CURLOPT_URL, $url);
    curl_setopt($ch_start, CURLOPT_FAILONERROR, true);
    curl_setopt($ch_start, CURLOPT_HEADER, 0);
    curl_setopt($ch_start, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch_start, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch_start, CURLOPT_BINARYTRANSFER,true);
    curl_setopt($ch_start, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch_start, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch_start, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($ch_start, CURLOPT_FILE, $zip_resource);
    $page = curl_exec($ch_start);
    if(!$page)
    {
        echo "Error :- ".curl_error($ch_start);
    }
    curl_close($ch_start);
    
    $zip = new ZipArchive;
    // $extractPath = $newdirectory;
    // if($zip->open($zip_file) != "true")
    // {
    //     echo "Error :- Unable to open the Zip File";
    // } 
    
    // $zip->extractTo($extractPath);
    // $zip->close();
    
    // unlink($zip_file);
    
    // //Something to write to txt log
    // $log  = date("F j, Y, g:i a")." - Local Directory: ".$directory.PHP_EOL.
    //         date("F j, Y, g:i a")." - New Root Directory: ".$newdirectory.PHP_EOL.
    //         date("F j, Y, g:i a")." - Zip file directory: ".$zip_file.PHP_EOL.
    //         date("F j, Y, g:i a")." - Curl response: ".$page.PHP_EOL.
    //         date("F j, Y, g:i a")." - File Extract Path: ".$extractPath.PHP_EOL.
    //         date("F j, Y, g:i a")." - Zip File is openable: ".$zip->open($zip_file).PHP_EOL.
    //         "-------------------------".PHP_EOL;
    // //Save string to log, use FILE_APPEND to append.
    // file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
    
    if($zip->open($zip_file) == true)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
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

do
{
    // Remove really unwanted tags
    $old_data = $data;
    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}
?>