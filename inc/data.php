<?php 

function checkstatusoftools($id)
{   global $dbh;
    $sql = "SELECT * from pages where id=".$id.";";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);
    $status = $result->status;
    if($status == 0){return true;}else{return false;};
}

//Site Setttings
$sql = "SELECT * from settings where id = 1;";
$query = $dbh -> prepare($sql);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);

$title = htmlentities($result->siteTitle);
$logoTxt = htmlentities($result->logoTxt);
$logoImg =  htmlentities($result->logoImg);
$keywords = htmlentities($result->metaKeywords);
$description =  htmlentities($result->metaDescription);
$footer =  base64_decode(htmlentities($result->footer));

$sql1 = "SELECT * from settings where id = 2;";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$result1=$query1->fetch(PDO::FETCH_OBJ);
$color = $result1->logoTxt;

//Site admin
$sql = "SELECT * from admin;";
$query = $dbh -> prepare($sql);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);

$social_facebook = urldecode(htmlentities($result->social_fb));
$social_twitter = urldecode(htmlentities($result->social_tw));
$social_youtube = urldecode(htmlentities($result->social_you));

//Advertisement/
$sql = "SELECT * from  ads ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
    foreach($results as $result)
    {
        $adType =  htmlentities($result->ad_type);
        if(strpos($adType, 'banner-content') !== false)
        {
            $bannerContent = base64_decode(htmlentities($result->ad_code));
        }
        elseif(strpos($adType, 'banner-sidebar') !== false)
        {
            $bannerSidebar = base64_decode(htmlentities($result->ad_code));
        }
        elseif(strpos($adType, 'banner-top') !== false)
        {
            $bannerTop = base64_decode(htmlentities($result->ad_code));
        }
        else
        {
            $popAds = base64_decode(htmlentities($result->ad_code));
        }
    }
}

//custom codes

$sql = "SELECT * from  custom_codes ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
    foreach($results as $result)
    {
        $codeType =  htmlentities($result->id);

        if(strpos($codeType, 'header') !== false)
        {
            $headerCode = base64_decode(htmlentities($result->content));
        }
        else
        {
            $footerCode = base64_decode(htmlentities($result->content));
        }  
    }
}

function checkstatusoftool($id)
{
    global $dbh;    
    $sql = "SELECT * from pages where url='".$id."';";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);
	$status = isset($result->status)?$result->status:1;
    if($status == 0){return true;}else{return false;};
}
?>