<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 
   //Site Setttings
   $pageId = 8;
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
   
    if (isset($_POST['t'])) 
    {
    	$file = $_POST['t'];
    
    	header('Content-Description: File Transfer');
    	header('Content-Type: application/octet-stream');
    	header('Content-Disposition: attachment; filename=YT Thumbnail'.basename($file));
    	header('Content-Transfer-Encoding: binary');
    	header('Expires: 0');
    	header('Cache-Control: public'); //for i.e.
    	header('Pragma: public');
    
    	ob_clean();
    	flush();
    	readfile($file);
    // 	exit;
    }
   
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
                            <h3>YT Thumbnails Downloader</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Video Link</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" required type="url" name="video_link" placeholder="Please enter video link here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" name="submit" type="submit">Generate Thumbnails</button>
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
                if(isset($_POST['submit']) || isset($_GET['q']))
                {
                    if (isset($_GET['q'])) 
                    {
                        $search = parse_url(trim($_GET['q']));
                        
                        if($search !== false)
                        {
                            $videoId = $search['path'];
                        }
                    }
                    else
                    {
                        $search = trim($_POST['video_link']);
                        if($search !== false)
                        {
                            $videoId = getVideoId($search);
                        }
                    }
           
                   $default = "https://i.ytimg.com/vi/{$videoId}/default.jpg";
                   $mqdefault = "https://i.ytimg.com/vi/{$videoId}/mqdefault.jpg";
                   $hqdefault = "https://i.ytimg.com/vi/{$videoId}/hqdefault.jpg";
                   $sddefault = "https://i.ytimg.com/vi/{$videoId}/sddefault.jpg";
                   $maxresdefault = "https://i.ytimg.com/vi/{$videoId}/maxresdefault.jpg";
                   $previewImg = $hqdefault;    
                   
                   if(isValidImg($maxresdefault))
                   {
                       $previewImg = $maxresdefault;
                   }
                   elseif(isValidImg($sddefault))
                   {
                       $previewImg = $sddefault;
                   }
           
                   //set cookie
                   echo  "<script>if(Cookies.get('recentThumbs') == undefined){Cookies.set('recentThumbs', '$videoId', { expires: 7 });}else{ var getcook= Cookies.get('recentThumbs');
                   Cookies.set('recentThumbs', getcook+',$videoId', { expires: 30 });}</script>";
           ?>
           <div class="single-page-section">
                <h3 class="margin-bottom-25">Thumbnails Generate</h3>
                <!-- Listings Container -->
                
                <div class="listings-container">
                    <div class="yt-station-listing">
                        <div class="yt-station-listing-details" id="hero-demo">
                            <img src="<?php echo $previewImg; ?>" alt="thumbnail">
                        </div>

                        <!-- Tag Listing Footer -->
                        <div class="yt-station-listing-footer">
                            <div class="copy-url">
                                <h4 class="">Available Formats</h4>
        						<ul>
        							<li><a href="#" class="downloadimg" data-link="<?php echo $default; ?>"><i class="icon-feather-download"></i>&nbsp; 120 * 90 </a></li>
        							<li><a href="#" class="downloadimg" data-link="<?php echo $mqdefault; ?>"><i class="icon-feather-download"></i>&nbsp; 320 * 180 </a></li>
        							<li><a href="#" class="downloadimg" data-link="<?php echo $hqdefault; ?>"><i class="icon-feather-download"></i>&nbsp; 480 * 360 </a></li>
        							<?php  if(isValidImg($sddefault)){ ?>
        							    <li><a href="#" class="downloadimg" data-link="<?php echo $sddefault; ?>"><i class="icon-feather-download"></i>&nbsp; 640 * 480 </a></li>
        							<?php } if(isValidImg($maxresdefault)){ ?>
        							    <li><a href="#" class="downloadimg" data-link="<?php echo $maxresdefault; ?>"><i class="icon-feather-download"></i>&nbsp; 1280 * 720 </a></li>
        							<?php } ?>
        						</ul>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" action="" id="downloadimagesubmit">
                    <input type="hidden" name="t" class="d-none" value="">
                    <button type="submit" name="submit" class="downloadimagesubmit d-none"></button>
                </form>
                <!-- Listings Container / End -->
            </div>
            <?php } ?>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Thumbnails Generator</h3>
                <?php echo $pcontent; ?>
            </div>
            
            <div class="single-page-section recent-slider" id="myRecentThumbs">
    			<h3 class="margin-bottom-25">Your Recently Thumbs:</h3>
    			<div class="container">
            		<div class="row">
            			<div class="col-xl-12 row responsive">
    			        </div>
    			    </div>
    		    </div>
    	    </div>
        </div>
        <!-- ./ card [main form] -->
           
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>