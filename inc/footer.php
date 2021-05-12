<?php 

$filename = basename($_SERVER['PHP_SELF']);
if($filename != 'index.php' && (!preg_match ('#^/blog/#', $_SERVER['REQUEST_URI']))  && (!preg_match ('#^/blog/post/#', $_SERVER['REQUEST_URI'])) && $_SERVER['REQUEST_URI'] != '/blog/index.php' && $filename != 'post.php' && strpos($_SERVER['REQUEST_URI'], '/blog/post/') !== true && $filename != "" && $filename != 'install.php' && $filename != 'about-us.php' && $filename != 'privacy-policy.php' && $filename != 'terms-and-conditions.php')
{
    include "side_bar.php";    
}

$pathInPieces = explode('/', $_SERVER['REQUEST_URI']);
$file= end($pathInPieces)."/".$filename;
if(strpos($_SERVER['REQUEST_URI'], 'blog') !== false || $_SERVER['REQUEST_URI'] == "/blog/" || $file == 'blog/index.php' || $filename == 'post.php' || (preg_match ('#^/blog/#', $_SERVER['REQUEST_URI']) == 1) || (preg_match ('#^/blog/#', $_SERVER['REQUEST_URI'])) || (preg_match ('#^/blog/post/#', $_SERVER['REQUEST_URI']) == 1) || $_SERVER['REQUEST_URI'] == '/blog/index.php' || $_SERVER['REQUEST_URI'] == '/blog/' || $_SERVER['REQUEST_URI'] == 'blog/')
{
    include "blog_side_bar.php";
}
?>

<?php if($filename == 'youtube-to-mp3-converter.php' || $filename == 'youtube-videos-downloader.php'){ ?>
    <div id="small-dialog" class="zoom-anim-dialog dialog-with-tabs mfp-hide mp3Result">
        <!--Tabs -->
        <div class="sign-in-form">
            <ul class="popup-tabs-nav" style="pointer-events: none;">
                <li class="active"></li>
            </ul>
    
            <div class="popup-tabs-container ">
                <!-- Tab -->
                <div class="popup-tab-content" id="tab" style="">
                    <!-- Welcome Text -->
                    <div class="welcome-text vTitle">
                        <h3 ></h3>
                    </div>

                    <div id="popup-result">

                    <a id="mp3Download" class="button dark ripple-effect button-sliding-icon downloadFile" style="display:none;">
                        <span class="icon-feather-download"></span> Download Now
                    </a>
                       <div class="loader">
                        <svg width="48" height="48" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg" version="1.1">
                        <path d="M 150,0 a 150,150 0 0,1 106.066,256.066 l -35.355,-35.355 a -100,-100 0 0,0 -70.711,-170.711 z" fill="#76f19a">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 150 150" to="360 150 150" begin="0s" dur=".5s" fill="freeze" repeatCount="indefinite"></animateTransform>
                        </path>
                        </svg>
                        </div>
                    </div>                    
                    <ul class="list-3 color message">
						<li class="message">Please wait while we ready mp3 for download. Thanks for your paisensions</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if($filename == 'top-youtube-channels.php'){ ?>
    <div id="small-dialog" class="zoom-anim-dialog dialog-with-tabs mfp-hide">
        <!--Tabs -->
        <div class="sign-in-form">
            <ul class="popup-tabs-nav" style="pointer-events: none;">
                <li class="active"></li>
            </ul>
    
            <div class="popup-tabs-container">
                <!-- Tab -->
                <div class="text-center popup-tab-content companydet" id="tab" style="">
                    <div class="text-center">
                        <div class="loader-20"></div>
                        <p>Please wait while loading data...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Footer ================================================== -->
    <div id="footer">
        <!-- Footer Top Section -->
        <div class="footer-top-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Footer Rows Container -->
                        <div class="footer-rows-container">
                            <!-- Left Side -->
                            <div class="footer-rows-left">
                                <div class="footer-row">
                                    <div class="footer-row-inner footer-logo">
                                    <?php
                                        if($logoImg == ""){
                                            echo $logoTxt;
                                        }else{
                                            echo "<img src='".$root."/admin/uploads/{$logoImg}'  alt='logo'>";
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side -->
                            <div class="footer-rows-right">
                                <!-- Social Icons -->
                                <div class="footer-row">
                                    <div class="footer-row-inner">
                                        <ul class="footer-social-links">
                                            <li>
                                                <a href="<?php echo $social_facebook; ?>" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light">
                                                    <i class="icon-brand-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $social_twitter; ?>" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light">
                                                    <i class="icon-brand-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" title="Google Plus" data-tippy-placement="bottom" data-tippy-theme="light">
                                                    <i class="icon-brand-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" title="LinkedIn" data-tippy-placement="bottom" data-tippy-theme="light">
                                                    <i class="icon-brand-linkedin-in"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Footer Rows Container / End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Top Section / End -->

        <!-- Footer Middle Section -->
        <div class="footer-middle-section">
            <div class="container">
                <div class="row">
                    <!-- Links -->
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="footer-links">
                            <h3>Userfull Links</h3>
                            <ul>
                                <?php  if(checkstatusoftool("privacy-policy.php")){ ?>
                                <li><a href="<?php echo $root; ?>/pages/privacy-policy.php">Privacy Policy</a></li>
                                <?php } ?>
                                <?php  if(checkstatusoftool("terms-and-conditions.php")){ ?>
                                <li><a href="<?php echo $root; ?>/pages/terms-and-conditions.php">Terms & Conditions</a></li>
                                <?php } ?>
                                <?php  if(checkstatusoftool("about-us.php")){ ?>
                                <li><a href="<?php echo $root; ?>/pages/about-us.php">About US</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    
                    <?php 
                        if($filename == 'blog-details.php' || $filename == 'blog-details')
                        {
                            $sqlw = "SELECT * from posts WHERE postSlug <> '$pagelink' AND status = 0 AND pstatus = 0 ORDER BY RAND() LIMIT 3";
                        }
                        else
                        {
                            $sqlw = "SELECT * from posts WHERE status = 0 AND pstatus = 0 ORDER BY RAND() LIMIT 3";
                        }
                        $queryw = $dbh -> prepare($sqlw);
                        $queryw->execute();
                        $resultsw=$queryw->fetchAll(PDO::FETCH_OBJ);
                        if($queryw->rowCount() > 0)
                    { ?>     
                    <!-- Links -->
                    <div class="col-xl-5 col-lg-5 col-md-5">
                        <div class="footer-links">
                            <h3>Blog posts</h3>
                            <ul>
                                <?php 
                                    foreach($resultsw as $resultw)
                                    { 
                                ?>
                               		<li class="foot-li">
            							<a href="<?php echo $root; ?>/blog/post/<?php echo $resultw->postSlug; ?>" class="widget-content-blog active">
            								<img src="<?php echo $root."/admin/uploads/blog_images/".$resultw->post_image; ?>" alt="">
            								<div class="widget-text-blog">
            									<h5><?php echo $resultw->title; ?></h5>
            									<span><?php echo date("d M Y", strtotime($resultw->date_posted)); ?></span>
            								</div>
            							</a>
            						</li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <!-- Links -->
                    <!-- Newsletter -->
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <h3><i class="icon-line-awesome-dollar"></i> Donate Us</h3>
                        <p>donate us whatever youfeel</p>
                        <ul class="footer-social-links">
                            <li>
                                <a href="#" title="visa" data-tippy-placement="bottom" data-tippy-theme="light">
                                    <i class="icon-brand-cc-visa"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Mater Card" data-tippy-placement="bottom" data-tippy-theme="light">
                                    <i class="icon-brand-cc-mastercard"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="JCB Card" data-tippy-placement="bottom" data-tippy-theme="light">
                                    <i class="icon-brand-cc-jcb"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Discover" data-tippy-placement="bottom" data-tippy-theme="light">
                                    <i class="icon-brand-cc-discover"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Paypal" data-tippy-placement="bottom" data-tippy-theme="light">
                                    <i class="icon-brand-cc-paypal"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Bit conin" data-tippy-placement="bottom" data-tippy-theme="light">
                                    <i class="icon-line-awesome-bitcoin"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Middle Section / End -->

        <!-- Footer Copyrights -->
        <div class="footer-bottom-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        © 2020 <strong>YT Station</strong>. All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Copyrights / End -->

    </div>
    <!-- Footer / End -->

</div>
<!-- Wrapper / End -->

<?php if($filename == 'youtube-videos-downlxoader.php'){ ?>
    <div id="small-dialog" class="zoom-anim-dialog dialog-with-tabs mfp-hide">
        <!--Tabs -->
        <div class="sign-in-form">
            <ul class="popup-tabs-nav" style="pointer-events: none;">
                <li class="active"></li>
            </ul>
    
            <div class="popup-tabs-container">
                <!-- Tab -->
                <div class="popup-tab-content" id="tab" style="">
                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3 class="vtitle"></h3>
                    </div>
                    
                    <ul class="list-3 color message">
						<li class="message">Please wait while we ready video for download. Thanks for your paisensions</li>
					</ul>
				   
    			
                    <a id="videoDownload" class="button dark ripple-effect button-sliding-icon downloadFile">
     				    <span class="icon-feather-download"></span> Download Now
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if($filename == 'youtube-videos-downloader.php' || $filename == 'youtube-trending-videos.php'){ ?>
<div id="small-dialog-1" class="zoom-anim-dialog dialog-with-tabs mfp-hide">
	<!--Tabs -->
	<div class="sign-in-form">
		<ul class="popup-tabs-nav" style="pointer-events: none;">
			<li class="active"></li>
		</ul>

		<div class="popup-tabs-container">
			<!-- Tab -->
			<div class="popup-tab-content" id="tab" style="">
				
			</div>
		</div>
	</div>
</div>
<?php } ?>
    <!-- Scripts ================================================== -->
    <script src="<?php echo $root; ?>/assets/frontend/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.1.0/jquery-migrate.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/mmenu.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/tippy.all.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/simplebar.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/bootstrap-slider.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/bootstrap-select.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/snackbar.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/clipboard.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/counterup.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/magnific-popup.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/slick.min.js"></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/custom.js?<?php echo time(); ?>"></script>
    <?php include "script.php" ?>
</body>

</html>