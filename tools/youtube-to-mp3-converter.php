<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 

//Site Setttings
$pageId = 4;
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
if(isset($_POST['getmp3']))
{
    $url = trim($_POST['newlink']);

   // $file = base64_decode($url);
  $file = $url;
	header("Content-disposition: attachment; filename="."ytseotools.mp3");
	header("Content-type: application/mp3");
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
                <form>
                    <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>YT mp3 Converter</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Vidoe Link</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" required type="url" name="video_link" placeholder="Please enter video link here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" id="convert-to-mp3" name="submit" type="button"><span>Convert to mp3</span></button>
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

        <div class="single-page-section d-none" id="mp3-result">
            <h3 class="margin-bottom-25">Mp3 Download</h3>
            <!-- Listings Container -->
            <div class="listings-container">
                <div class="yt-station-listing">
                    <div class="yt-station-listing-details">
						<!-- Logo -->
						<div class="col-md-7" id="dimg" data-url="#" data-id="#">
							<img src="#" alt="thumbnail">
                            <h4 class="yt-station-listing-company vTitle">#</h4>
						</div>

						<!-- Details -->
						<div class="yt-station-listing-description  dashboard-box-list col-md-5">
							
							<div class=" always-visible margin-top-5 margin-bottom-5">
								<a class="button gray ripple-effect ico"><i class="icon-brand-youtube"></i> 256 kbps</a>
								<a href="javascript:void(0)" class="button gray ripple-effect ico openmodale downloadMp3" data-quality="1" data-tippy-placement="top" data-tippy="" data-original-title="Download 256 kbps mp3 "><i class="icon-feather-download"></i></a>
							</div>
							<div class=" always-visible margin-top-5 margin-bottom-5">
								<a class="button gray ripple-effect ico"><i class="icon-brand-youtube"></i> 182 kbps</a>
								<a href="javascript:void(0)" class="button gray ripple-effect ico openmodale downloadMp3" data-quality="3" data-tippy-placement="top" data-tippy="" data-original-title="Download 182 kbps mp3 "><i class="icon-feather-download"></i></a>
							</div>
							<div class=" always-visible margin-top-5 margin-bottom-5">
								<a class="button gray ripple-effect ico"><i class="icon-brand-youtube"></i> 128 kbps</a>
								<a href="javascript:void(0)" class="button gray ripple-effect ico openmodale downloadMp3" data-quality="6" data-tippy-placement="top" data-tippy="" data-original-title="Download 128 kbps mp3 "><i class="icon-feather-download"></i></a>
							</div>
							<div class=" always-visible margin-top-5 margin-bottom-5">
								<a class="button gray ripple-effect ico"><i class="icon-brand-youtube"></i> 82 kbps</a>
								<a href="javascript:void(0)" class="button gray ripple-effect ico openmodale downloadMp3" data-quality="9" data-tippy-placement="top" data-tippy="" data-original-title="Download 82 kbps mp3 "><i class="icon-feather-download"></i></a>
							</div>
                    		<a href="#small-dialog" class="popup-with-zoom-anim button dark ripple-effect d-none" id="modale"></a>
						</div>
					</div>
				</div>
            </div>
            <!-- Listings Container / End -->
        </div>
      



        <div class="single-page-section">
            <h3 class="margin-bottom-25">About YT Mp3 Downloader</h3>
            <?php echo $pcontent; ?>
        </div>
    </div>    
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>