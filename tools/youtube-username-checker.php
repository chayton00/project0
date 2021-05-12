<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 

//Site Setttings
$pageId = 14;
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
                <form method="post">
                    <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>YT Username Checker</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Username</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" required type="text" name="Channel_URL" placeholder="Please enter username here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" name="submit" id="checkUserName" type="button">Check Username</button>
                                </div>
                            </div>
                            <span class="notes">Example : MyChannel</span>
                        </div>
                    </div>
                </div>
                </form>
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
            <div class="listings-container compact-list-layout username_results d-none mb-5">
				<div class="yt-station-listing with-apply-button">
					<div class="yt-station-listing-details">
                    	<!-- Details -->
						<div class="yt-station-listing-description">
							<h3 class="yt-station-listing-title card-title"></h3>
							<h5 class="yt-station-listing-title ustatus"></h5>
                            <div class="yt-station-listing-footer">
								<a href="https://www.youtube.com/user/admin" class="ytuser" target="_blank">https://www.youtube.com/user/<b></b></a>
							</div>
						</div>
					</div>
				</div>	
            </div>
            <div class="listings-container compact-list-layout customurl_results d-none mb-5">
				<div class="yt-station-listing with-apply-button">
					<div class="yt-station-listing-details">
                    	<!-- Details -->
						<div class="yt-station-listing-description">
							<h3 class="yt-station-listing-title card-title"></h3>
							<h5 class="yt-station-listing-title ustatus"></h5>
                            <div class="yt-station-listing-footer">
								<a href="https://www.youtube.com/user/admin" class="ytuser" target="_blank">https://www.youtube.com/<b></b></a>
							</div>
						</div>
					</div>
				</div>	
            </div>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Live Subscribers</h3>
                <?php echo $pcontent; ?>
            </div>
        </div>    
    
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>