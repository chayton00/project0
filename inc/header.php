<?php ob_start(); ?>

<?php include_once "data.php"; ?>
<?php require_once "functions.php";  ?>

<!doctype html>
<html lang="en">
    <head>
        <?php 
            $result = array(); 
            $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
            $root = $protocol.$_SERVER['HTTP_HOST'];
            
            if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') !== false)
            {
                $page_title = $title;
                $site_meta_keywords = $keywords;
                $site_meta_description = $description;
            }
            else
            {
                $page_title = isset($ptitle)?$ptitle :'';
                $site_meta_keywords = isset($pkeywords)?$pkeywords :'';
                $site_meta_description = isset($pdescription)?$pdescription :'';
            }
            
            header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        ?>
    
        <!-- Basic Page Needs ================================================== -->
        <title><?php echo $page_title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <meta name="keywords" content="<?php echo $site_meta_keywords; ?>">
        <meta name="description" content="<?php echo $site_meta_description; ?>">
    
        <!-- CSS
    ================================================== -->
        <link rel="stylesheet" href="<?php echo $root; ?>/assets/frontend/css/style.css?<?php echo time() ?>">
        
        <?php if($color == 1) { ?>
            <link rel="stylesheet" href="<?php echo $root; ?>/assets/frontend/css/colors/blue.css?<?php echo time() ?>">
        <?php } ?>
        
        <?php if($color == 2) { ?>
            <link rel="stylesheet" href="<?php echo $root; ?>/assets/frontend/css/colors/red.css?<?php echo time() ?>">
        <?php } ?>
        
        <?php if($color == 3) { ?>
            <link rel="stylesheet" href="<?php echo $root; ?>/assets/frontend/css/colors/green.css?<?php echo time() ?>">
        <?php } ?>
        
        <?php if($color == 4) { ?>
            <link rel="stylesheet" href="<?php echo $root; ?>/assets/frontend/css/colors/purple.css?<?php echo time() ?>">
        <?php } ?>
        
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        
        <!-- Pop ads code -->
        <?php echo $popAds; ?>
    
        <!-- Custom Codes -->
        <?php echo $headerCode; ?>
   
    </head>
    <body>
    <div id="wrapper">
        <!-- Header Container ================================================== -->
        <header id="header-container" class="fullwidth">
            <!-- Header -->
            <div id="header">
                <div class="container">
                    <!-- Left Side Content -->
                    <div class="left-side">
                        <!-- Logo -->
                        <div id="logo">
                            <a href="<?php echo $root; ?>">
                                <?php
                                    if($logoImg == ""){
                                        echo $logoTxt;
                                    }else{
                                        echo "<img src='$root/admin/uploads/{$logoImg}'  alt='logo'>";
                                    }
                                ?>
                            </a>
                        </div>
                        <!-- Main Navigation -->
                        <nav id="navigation">
                            <ul id="responsive">
                                <li><a href="<?php echo $root; ?>">Home</a></li>
                                <li>
                                    <a href="#">Tools</a>
                                    <ul class="dropdown-nav">
                                        <li>
                                            <a href="#">Video Serivces</a>
                                            <ul class="dropdown-nav">
                                                <?php 
                                                if(checkstatusoftool("youtube-videos-downloader.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-videos-downloader.php">Video Downloader</a></li>
                                                <?php } 
                                                if(checkstatusoftool("youtube-to-mp3-converter.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-to-mp3-converter.php">Mp3 Converter</a></li>
                                                <?php } 
                                                    if(checkstatusoftool("youtube-tags-generator.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-tags-generator.php">Tags Generator</a></li>
                                                <?php } if(checkstatusoftool("youtube-thumbnails-generator.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-thumbnails-generator.php">Thumbnail Generator</a></li>
                                                <?php } if(checkstatusoftool("youtube-titles-generator.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-titles-generator.php">Title Generator</a></li>
                                                <?php } if(checkstatusoftool("find-youtube-video-tags.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/find-youtube-video-tags.php">Extract Video Tags</a></li>
                                                <?php } if(checkstatusoftool("find-youtube-video-thumbnails.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/find-youtube-video-thumbnails.php">Download Video Thumbnail</a></li>
                                                <?php } if(checkstatusoftool("find-youtube-animated-thumbnails.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/find-youtube-animated-thumbnails.php">Extract Animated Thumbnail</a></li>
                                                <?php } if(checkstatusoftool("youtube-embed-generator.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-embed-generator.php">Custom Embed Codes</a></li>
                                                <?php } if(checkstatusoftool("watch-age-restricted-videos.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/watch-age-restricted-videos.php">Watch Age Restricted Videos</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li><a href="#">Channel Serivces</a>
                                            <ul class="dropdown-nav">
                                                <?php  if(checkstatusoftool("youtube-channel-analytics.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-channel-analytics.php">Channel Analytics</a></li>
                                                <?php } if(checkstatusoftool("find-channel-keywords.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/find-channel-keywords.php">Extract Channel Keywords</a></li>
                                                <?php } if(checkstatusoftool("youtube-username-checker.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-username-checker.php">Username Checker</a></li>
                                                <?php } if(checkstatusoftool("find-channel-banner.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/find-channel-banner.php">Download Channel Art</a></li>
                                                <?php } if(checkstatusoftool("youtube-live-subscribers-counter.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/youtube-live-subscribers-counter.php">Live Subscribers Counter</a></li>
                                                <?php } if(checkstatusoftool("find-youtube-channel-id.php")){ ?>
                                                <li><a href="<?php echo $root; ?>/tools/find-youtube-channel-id.php">Extract Channel ID</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php if(checkstatusoftool("top-youtube-channels.php")){ ?>
                                        <li><a href="<?php echo $root; ?>/tools/top-youtube-channels.php">Top 100 YouTubers</a></li>
                                        <?php } if(checkstatusoftool("youtube-trending-videos.php")){ ?>
                                        <li><a href="<?php echo $root; ?>/tools/youtube-trending-videos.php">Find Trending Videos</a></li>
                                        <?php } if(checkstatusoftool("youtube-revenue-calculator.php")){ ?>
                                        <li><a href="<?php echo $root; ?>/tools/youtube-revenue-calculator.php">Earnings Calculator</a></li>
                                        <?php } if(checkstatusoftool("youtube-mp3-player.php")){ ?>
                                        <li><a href="<?php echo $root; ?>/tools/youtube-mp3-player.php">Mp3 Player</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php  if(checkstatusoftool("blog.php")){ ?>
                                    <li><a href="<?php echo $root; ?>/blog/">Blog</a></li>
                                <?php } ?>
                                <?php  if(checkstatusoftool("about-us.php")){ ?>
                                <li><a href="<?php echo $root; ?>/pages/about-us.php">About Us</a></li>
                                <?php } ?>
                            </ul>
                        </nav>
                        <div class="clearfix"></div>
                        <!-- Main Navigation / End -->
                    </div>
                    <!-- Left Side Content / End -->
                    <!-- Right Side Content / End -->
                    <div class="right-side">
                        <div class="header-widget hide-on-mobile">
                            <!-- Social Media -->
                            <div class="header-notifications">
                                <div class="header-notifications-trigger">
                                    <a href="<?php echo $social_facebook; ?>" target="_blank"><i class="icon-brand-facebook-f"></i></a>
                                </div>
                            </div>
                            <div class="header-notifications">
                                <div class="header-notifications-trigger">
                                    <a href="<?php echo $social_twitter; ?>" target="_blank"><i class="icon-brand-twitter"></i></a>
                                </div>
                            </div>
                            <div class="header-notifications">
                                <div class="header-notifications-trigger">
                                    <a href="<?php echo $social_youtube; ?>" target="_blank"><i class="icon-brand-youtube"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Navigation Button -->
                        <span class="mmenu-trigger">
        					<button class="hamburger hamburger--collapse" type="button">
        						<span class="hamburger-box">
        							<span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </span>

                    </div>
                    <!-- Right Side Content / End -->
                </div>
            </div>
            <!-- Header / End -->
        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End --> 
       