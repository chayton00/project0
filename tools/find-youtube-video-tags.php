<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 
   //Site Setttings
   $pageId = 7;
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
                            <h3>YT Find Video Tags</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Video URL</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" required type="url" name="video_tags" placeholder="Please enter video url here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" name="submit" type="submit">View Tags</button>
                                </div>
                            </div>
                            <span class="notes">Example : https://www.youtube.com/watch?v=7k_EW3skxzM</span>
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
                if(isset($_POST['submit']))
                {
                    $search = trim($_POST['video_tags']);
                    $result = getVideoTags($search);
                    $tagcount = count($result);
            ?>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">Generated Tags for <b><?php echo $search; ?></b></h3>
                <!-- Listings Container -->
                <div class="listings-container">
                    <!-- Tag Listing -->
                    <div class="yt-station-listing">
                        <!-- Tag Listing Details -->
                        <div class="yt-station-listing-details" id="hero-demo">
                            <div class="keywords-list" id="keywords-list" style="height: auto;">
                                <?php
                                    
                                    $List = implode(', ', $result); 
                                    
                                    for ($x = 0; $x < $tagcount; $x++) {
                                        if(trim($result[$x]) != '')
                                            echo '<span class="keyword"><span class="keyword-remove"></span><span class="keyword-text">'.$result[$x].'</span></span>';
                                    }
                                    echo '<input type="text" id="tagss" class="d-none" name="tagss" value="'.$List.'">';
                                ?>
            				</div>
                        </div>

                        <!-- Tag Listing Footer -->
                        <div class="yt-station-listing-footer">
                            <div class="copy-url">
                                <button class="copy-url-button button dark ripple-effect button-sliding-icon" id="copybtn" data-clipboard-target="#tagss">Copy Tags <i class="icon-material-outline-file-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Listings Container / End -->
            </div>
            <?php } ?>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Video Tags Finder Tool</h3>
                <?php echo $pcontent; ?>
            </div>
        </div>
        <!-- ./ card [main form] -->
        <!-- Sidebar -->

<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>