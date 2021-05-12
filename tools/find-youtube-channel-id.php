<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 
   //Site Setttings
   $pageId = 20;
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
                            <h3>YT Channel ID Finder</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Channel Link</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" type="url" required name="video_link" placeholder="Please enter channel link here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" name="submit" type="submit">Get Channel Id</button>
                                </div>
                            </div>
                            <span class="notes">Example : https://www.youtube.com/user/tseries</span>
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
        <?php 
           if (isset($_POST['video_link'])) {
             
           $url = parse_url(trim($_POST['video_link']));
           if($url !== false)
            {
                $result = getChannelName(trim($_POST['video_link']));
            }
           ?>
           
            <div class="single-page-section">
                <h3 class="margin-bottom-25">Channel Details</h3>
                <!-- Listings Container -->
                
                <div class="listings-container">
                    <div class="yt-station-listing">
                        <div class="yt-station-listing-details" id="hero-demo">
                        <h4 class=""><?php echo $result['title'] ?></h4>
                            <img src="<?php echo $result['avatar'] ?>" alt="thumbnail">
                        </div>
                        

                        <!-- Tag Listing Footer -->
                        <div class="yt-station-listing-footer">
                            <div class="copy-url">
                                
        						<ul>
        							<li><?php echo $result['channelId'] ?></li>
        						</ul>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <!-- Listings Container / End -->
            </div>
            <?php } ?>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Channel Id Finder Tool</h3>
                <?php echo $pcontent; ?>
            </div>
</div>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>