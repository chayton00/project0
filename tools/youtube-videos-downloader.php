<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 
   //Site Setttings
   $pageId = 2;
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
<?php 
if(isset($_POST['getvideo']))
{
    $url = trim($_POST['newlink']);

    $file = base64_decode($url);
	header("Content-disposition: attachment; filename="."ytseotools.mp4");
	header("Content-type: application/mp4");
	return readfile($file);
}
?>
<?php include dirname(__FILE__)."/../inc/header.php"?>
 <!-- Titlebar
================================================== -->
<div class="single-page-header" data-background-image="<?php echo $root; ?>/assets/frontend/images/single-job.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST">
                    <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>YT Video Downloader</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete hiddenifr">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Video Link</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" type="url" required name="video_link" placeholder="Please enter video link here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" id="viewiframejs" name="submit" type="submit">Download Video</button>
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
<!-- ./ card [main form] -->
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
                $url = trim($_POST['video_link']);
                if($url !== false)
                {
                    $results = getVideoFormatList(trim($_POST['video_link']));
                    $videoId = getVideoId(trim($_POST['video_link']));
                    $videoTitle = $results[0]['title'];
                    $id = $videoId;
            
                    //set cookie
                    echo  "<script>if(Cookies.get('recentVideos') == undefined){Cookies.set('recentVideos', '$videoId', { expires: 7 });}else{ var recentvid = Cookies.get('recentVideos');console.log(recentvid);console.log(recentvid);
                    Cookies.set('recentVideos', recentvid+',$videoId', { expires: 30 });}</script>";
                }
        ?>
        <div class="single-page-section" id="mp4-result">
            <h3 class="margin-bottom-25">Download Video</h3>
            <!-- Listings Container -->
            <div class="listings-container">
                <div class="yt-station-listing">
                    <div class="yt-station-listing-details">
						<!-- Logo -->
						<div class="" id="dimg" data-url="<?php echo $url; ?>">
							<img src="https://i.ytimg.com/vi/<?php echo trim($videoId); ?>/mqdefault.jpg" alt="thumbnail">
						</div>

						<!-- Details -->
						<div class="dashboard-box-list margin-top-10">
							<h4 class="yt-station-listing-company vTitle" id="<?php echo $id; ?>"><?php echo $videoTitle; ?></h4>


<?php if (!(strpos($videoTitle, 'Error') !== false)) { ?>

                            <div class="buttons-to-right always-visible margin-top-5 margin-bottom-5">
                                <a class="button gray ripple-effect ico"><i class="icon-brand-youtube"></i> 1080p (.mp4)</a>
                                <a class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-material-outline-attach-file"></i>Best </a>
                                <a href="javascript:void(0)" class="button gray ripple-effect ico openmodale downloadVideo" data-quality="best" data-tippy-placement="top" data-tippy="" data-original-title="#"><i class="icon-feather-download"></i></a>
                            </div>


                            <div class="buttons-to-right always-visible margin-top-5 margin-bottom-5">
                                <a class="button gray ripple-effect ico"><i class="icon-brand-youtube"></i> 360p (.mp4)</a>
                                <a class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-material-outline-attach-file"></i>Low </a>
                                <a href="javascript:void(0)" class="button gray ripple-effect ico openmodale downloadVideo" data-quality="low" data-tippy-placement="top" data-tippy="" data-original-title="#"><i class="icon-feather-download"></i></a>
                            </div>


<?php } ?>





                    			<a href="#small-dialog" class="popup-with-zoom-anim button dark ripple-effect d-none" id="modale"></a>
						</div>
					</div>
				</div>
            </div>
            <!-- Listings Container / End -->
        </div>
        <?php } ?>
        <div class="single-page-section">
            <h3 class="margin-bottom-25">About YT Video Downloader</h3>
            <?php echo $pcontent; ?>
        </div>
        
        <div class="single-page-section recent-slider" id="myRecentVideos">
			<h3 class="margin-bottom-25">Your Recently videos:</h3>
			<!--<div class="container">-->
			    <div class="ag-container-shops">
			        <div class="js-flickity-slider responsive">
			    
        		    </div>
        		    <a href="#small-dialog-1" class="popup-with-zoom-anim button dark ripple-effect d-none" id="modale1"></a>
			    </div>
		    <!--</div>-->
	    </div>	    
    </div>
        <!-- ./ card [main form] -->
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>