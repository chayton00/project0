<?php
$file = "install";

if(is_dir($file))
{		
	// $pathInPieces = explode('/', realpath('./'));
	// $directorypath = '/'.end($pathInPieces).'/install/';
	$directorypath = '/install/';
	echo "<script> location.href='".$directorypath."'; </script>";
	exit;
}
else 
{
	include_once "admin/inc/config.php";
	include_once "inc/header.php";
?>

<!-- Intro Banner ================================================== -->
<!-- add class "disable-gradient" to enable consistent background overlay -->
<div class="intro-banner" data-background-image="<?php echo $root; ?>/assets/frontend/images/home-background.jpg">
    <div class="container">
        <!-- Intro Headline -->
        <div class="row">
            <div class="col-md-12">
                <div class="banner-headline">
                    <h3>
                        <strong>YT Tags Generator</strong>
                        <br>
                        <span>Thousands of <strong class="color">Vidos</strong> to turn their tags.</span>
                    </h3>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row">
            <div class="col-md-12">
                <form action="youtube-tags-generator.php" method="post">
                    <div class="intro-banner-search-form margin-top-95 mb-5">
                        <!-- Search Field -->
                        <div class="intro-search-field with-autocomplete">
                            <label for="autocomplete-input" class="field-title ripple-effect">Tags Name</label>
                            <div class="input-with-icon">
                                <input id="autocomplete-input" required type="text" name="tags" placeholder="Please enter video title here">
                                <i class="icon-brand-youtube"></i>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="intro-search-button">
                            <button class="button ripple-effect" name="submit" type="submit">Generate Tags</button>
                        </div>
                    </div>
                    <span class="notes">Example : How to rank youtube videos on google</span>
                </form>    
            </div>
        </div>

        <!-- Stats -->
        <div class="row">
            <div class="col-md-12">
                <ul class="intro-stats margin-top-45 hide-under-992px">
                    <li>
                        <strong class="counter">1,586</strong>
                        <span>Videos Searched</span>
                    </li>
                    <li>
                        <strong class="counter">3,543</strong>
                        <span>Tags Generated</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

<div class="ad-space-768">
   <?php echo $bannerTop; ?>
</div>

<!-- Content
================================================== -->
<!-- Category Boxes -->
<div class="section margin-top-65 margin-bottom-65">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">

                <div class="section-headline centered margin-bottom-15">
                    <h3>Our Tools</h3>
                </div>
                
                <!-- Category Boxes Container -->
                <div class="categories-container margin-bottom-15">
                	<?php  
                	if(checkstatusoftool("youtube-videos-downloader.php")){ 
                	?>
	                  	<a href="<?php echo $root; ?>/tools/youtube-videos-downloader.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-feather-video"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Video Downloader</h3>
	                    	  	<p>Download high definition (HD) video</p>
		                    </div>
	                  	</a>
	                <?php 
	            	}
	                if(checkstatusoftool("youtube-to-mp3-converter.php")){
	                ?>
	                  	<a href="<?php echo $root; ?>/tools/youtube-to-mp3-converter.php" class="category-box">
	                    	<div class="category-box-icon">
	                      		<i class="icon-line-awesome-file-audio-o"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Mp3 Converter</h3>
		                      	<p>Convert to mp3 format with multiple qualities</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("youtube-mp3-player.php")){
	                ?>
	                  	<a href="<?php echo $root; ?>/tools/youtube-mp3-player.php" class="category-box">
	                    	<div class="category-box-icon">
	                      		<i class="icon-feather-headphones"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Mp3 Player</h3>
		                      	<p>Listen to Youtube videos</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("youtube-channel-analytics.php")){ 
                	?>
                  		<a href="<?php echo $root; ?>/tools/youtube-channel-analytics.php" class="category-box">
                    		<div class="category-box-icon">
                      			<i class="icon-material-outline-assessment"></i>
                    		</div>
                    		<div class="category-box-content">
                      			<h3>Channel Analytics</h3>
                      			<p>Monitor the performance of your channel</p>
                    		</div>
                  		</a>
                	<?php } 
                	if(checkstatusoftool("youtube-tags-generator.php")){ 
                	?>
	                  	<a href="<?php echo $root; ?>/tools/youtube-tags-generator.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-line-awesome-tags"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Tags Generator</h3>
		                      	<p>Boost your YouTube views</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("youtube-thumbnails-generator.php")){ 
            		?>
                  		<a href="<?php echo $root; ?>/tools/youtube-thumbnails-generator.php" class="category-box">
                    		<div class="category-box-icon">
                      			<i class="icon-line-awesome-image"></i>
                    		</div>
                    		<div class="category-box-content">
	                      		<h3>Thumbnail Generator</h3>
		                      	<p>Boost views with professional professional</p>
                    		</div>
                  		</a>
                	<?php } 
                	if(checkstatusoftool("youtube-titles-generator.php")){ ?>    
                  		<a href="<?php echo $root; ?>/tools/youtube-titles-generator.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-material-outline-rate-review"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Title Generator</h3>
		                      	<p>Quickly generate titles for your videos</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("find-youtube-video-thumbnails.php")){ 
                	?>
	                   	<a href="<?php echo $root; ?>/tools/find-youtube-video-thumbnails.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-feather-search"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Download Video Thumbnail</h3>
		                      	<p>Download thumbnail image of videos</p>
		                    </div>
	                  	</a>
                	<?php } 
                	if(checkstatusoftool("find-youtube-video-tags.php")){ 
                	?>
                  		<a href="<?php echo $root; ?>/tools/find-youtube-video-tags.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-feather-search"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Extract Video Tags</h3>
		                      	<p>Extract hidden Youtube tags of videos</p>
		                    </div>
	                  </a>
	                <?php } 
	                if(checkstatusoftool("find-youtube-animated-thumbnails.php")){ 
	                ?>
	                   	<a href="<?php echo $root; ?>/tools/find-youtube-animated-thumbnails.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-line-awesome-file-photo-o"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Extract Animated Thumbnail</h3>
		                      	<p>Extract animated thumbnails of pages</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("find-channel-keywords.php")){ 
	                ?>
	                  	<a href="<?php echo $root; ?>/tools/find-channel-keywords.php" class="category-box">
	                    	<div class="category-box-icon">
	                      		<i class="icon-brand-korvue"></i>
	                    	</div>
                    		<div class="category-box-content">
	                      		<h3>Extract Channel Keywords</h3>
	                      		<p>Extract keywords of a channel</p>
                    		</div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("youtube-username-checker.php")){ 
	                ?>
                  		<a href="<?php echo $root; ?>/tools/youtube-username-checker.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-feather-user-check"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Username Checker</h3>
		                      	<p>Check username availability in YouTube</p>
		                    </div>
	                  	</a>
	                <?php } 
					if(checkstatusoftool("youtube-embed-generator.php")){ 
					?>
                  		<a href="<?php echo $root; ?>/tools/youtube-embed-generator.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-line-awesome-link"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Custom Embed Codes</h3>
		                      	<p>Generate custom embedded codes</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("youtube-revenue-calculator.php")){ 
	                ?>
	                  	<a href="<?php echo $root; ?>/tools/youtube-revenue-calculator.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-material-outline-local-atm"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Earnings Calculator</h3>
		                      	<p>Calculate the income for any YouTube channel</p>
		                    </div>
	                  	</a>
	                <?php }
	                if(checkstatusoftool("youtube-live-subscribers-counter.php")){ 
                	?>
	                  	<a href="<?php echo $root; ?>/tools/youtube-live-subscribers-counter.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-line-awesome-thumbs-o-up"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Live Subscribers Counter</h3>
		                      	<p>Real time subscriber count</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("youtube-trending-videos.php")){ 
	                ?>
	                  	<a href="<?php echo $root; ?>/tools/youtube-trending-videos.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-feather-video"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Find Trending Videos</h3>
		                      	<p>View list of trending videos by country</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("find-channel-banner.php")){ 
	                	?>
	                  	<a href="<?php echo $root; ?>/tools/find-channel-banner.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-material-outline-assessment"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Download Channel Art</h3>
		                      	<p>Download channel art of any Youtube Channel</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("find-youtube-channel-id.php")){ 
	                ?>
	                  	<a href="<?php echo $root; ?>/tools/find-youtube-channel-id.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-material-outline-find-in-page"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Extract Channel ID</h3>
		                      	<p>Extract any Youtube Channel ID</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("watch-age-restricted-videos.php")){ 
	                ?>
	                  	<a href="<?php echo $root; ?>/tools/watch-age-restricted-videos.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-feather-eye-off"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Watch Age Restricted Videos</h3>
		                      	<p>Watch 18+ Youtube videos without sign</p>
		                    </div>
	                  	</a>
	                <?php } 
	                if(checkstatusoftool("top-youtube-channels.php")){ 
                	?>
	                   	<a href="<?php echo $root; ?>/tools/top-youtube-channels.php" class="category-box">
		                    <div class="category-box-icon">
		                      	<i class="icon-feather-award"></i>
		                    </div>
		                    <div class="category-box-content">
		                      	<h3>Top 100 YouTubers</h3>
		                      	<p>See top 100 youtubers by country</p>
		                    </div>
	                  	</a>
	                <?php } ?>
                </div>
                <div class="text-center">
                    <a href="#" id="seeMore" class="button dark ripple-effect button-sliding-icon">Show More <i class="icon-feather-check"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php } include_once "inc/footer.php"; ?>