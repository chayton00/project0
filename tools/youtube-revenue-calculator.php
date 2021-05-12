<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 

//Site Setttings
$pageId = 3;
if (is_numeric($pageId) == true) {
$sql = "SELECT * from pages WHERE id = :pageId";
$query = $dbh -> prepare($sql);
$query->bindParam(':pageId',$pageId,PDO::PARAM_INT);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);
}
$ptitle = htmlentities($result->title);
$pcontent = base64_decode(htmlentities($result->content));
$pkeywords = htmlentities($result->meta_keywords);
$pdescription = htmlentities($result->meta_description);

?>
<?php include dirname(__FILE__)."/../inc/header.php"?>
<!-- Titlebar
================================================== -->
<div class="single-page-header" data-background-image="<?php echo $root; ?>/assets/frontend/images/single-job.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-details">
                    <h3>YT Revenue Calculator</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ad-space-768">
   <?php echo $bannerTop; ?>
</div>
<!-- Page Content ================================================== -->
<div class="container">
    <div class="row">
        <!-- Content -->
        <div class="col-xl-8 col-lg-8 content-right-offset">
            <div class="single-page-section">
                <iframe src="<?php echo $root; ?>/inc/plugins/youtube-revenue/iframe.html?channel=0&desc=1&link=0&rpm=1&highlight=0&note=1&detail=0" class="border-0 w-100 " frameborder="0" scrolling="no"  id="ytrevenue"></iframe> 
            </div>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Revenue Calculator</h3>
                <?php echo $pcontent; ?>
            </div>
        </div>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>