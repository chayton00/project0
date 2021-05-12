<?php include "functions.php";
session_start();

?>

<?php

if (isset($_GET["vurl"])) 
{
    $vurl = trim($_GET["vurl"]);
    $quality = trim($_GET["quality"]);
    $title = getVideoTitle($vurl);
    $id = getVideoId($vurl);
    $sId = session_id();
    
    $url = 'http://1c94f38.online-server.cloud/?vid='.$id.'&vq='.$quality.'&sid='.$sId.'&type=mp4&username='.uername.'&purchasecode='.purchasecode.'&domain='.domain.'&ip='.ip;
    
    $content = file_get_contents($url);
    $response = json_decode($content);

    if ($response->status == '1')
    {
        $sId = $response->sId;
        $file = "http://1c94f38.online-server.cloud/d?file=$sId&vid=$id&title=$title&type=mp4";
        $response = array('status'=>1,'file'=>$file);
        $response = json_encode($response);
    	echo $response;
    }
    else if($response->status == '0')
    {
        $response = array('status'=>'0','file'=>$response->msg);
        $response = json_encode($response);
    	echo $response;
    }
    

}

if (isset($_GET["mvurl"])) 
{
    $vurl = trim($_GET["mvurl"]);
    $sId = session_id();
    $title = getVideoTitle($vurl);
    $id = getVideoId($vurl);
    $quality = trim($_GET["quality"]);
    
    $url = 'http://1c94f38.online-server.cloud/?vid='.$id.'&vq='.$quality.'&sid='.$sId.'&type=mp3&username='.uername.'&purchasecode='.purchasecode.'&domain='.domain.'&ip='.ip;
    
    $content = file_get_contents($url);
    $response = json_decode($content);
    
    if ($response->status == '1')
    {
        //get new session id (unique id for file name)
        $sId = $response->sId;
        $file = "http://1c94f38.online-server.cloud/d?file=$sId&vid=$id&title=$title&type=mp3";
        $response_new = array('status'=>'1','file'=>$file);
        $responsenew = json_encode($response_new);
    	echo $responsenew;
    }
    else if($response->status == '0')
    {
        $response_new = array('status'=>'0','file'=>$response->msg);
        $responsenew = json_encode($response_new);
    	echo $responsenew;
    }

}

?>

