<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php include dirname(__FILE__)."/../inc/header.php"?>
<?php 
    if (isset($_POST['submit']) || isset($_GET['cid']) ) 
    {        
        if (isset($_GET['cid'])) 
        {
            $url = trim($_GET['cid']);
            $userData = getChannelName('https://www.youtube.com/channel/'.$url);
            $channelBanner = getChannelBanner('https://www.youtube.com/channel/'.$url);
   
            $url = 'channel/'.$url;
            $result = getChannleAnalyticsData($url);
        }
        else
        {
            $url = trim($_POST['channel']);
            if($url !== false)
            {
                $userData = getChannelName($url);
                $channelBanner = getChannelBanner($url);
   
                if (strpos($url, 'user')!== false) 
                {
                    $userId = parse_channel_username($url);
                    $url = 'user/'.$userId;
                }
                
                if (strpos($url, 'channel')!== false) 
                {
                    $userId = parse_channel_id($url);
                    $url = 'channel/'.$userId;
                }
   
                $result = getChannleAnalyticsData($url);
            }
        }
   ?>
<div class="single-page-header" data-background-image="<?php echo $channelBanner; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image">
						    <img src="<?php echo $userData['avatar']; ?>" alt="">
						</div>
						<div class="header-details">
							<h3><?php echo $userData['title']; ?></h3>
							<ul>
								<li>
								    <img class="flag" src="https://www.countryflags.io/<?php echo trim($result['country']);?>/shiny/32.png" alt=""> <?php echo $result['country']; ?>
								</li>
								<li><div class="verified-badge-with-title"><?php echo $result['channelType']; ?></div></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-12">
                <ul class="intro-stats margin-top-45 hide-under-992px">
                    <li>
                        <strong class="counter"><?php echo $result['uploads']; ?></strong>
                        <span>Uploads</span>
                    </li>
                    <li>
                        <strong class=""><?php echo $result['subscribers']; ?></strong>
                        <span>Subscribers</span>
                    </li>
                    <li>
                        <strong class="counter"><?php echo $result['views']; ?></strong>
                        <span>Video View</span>
                    </li>
                </ul>
            </div>
        </div>
	</div>
</div>
<div class="ad-space-768">
   <?php echo $bannerTop; ?>
</div>
<div class="container">
	<div class="row">
		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">
            <div class="row">
                <div class="col-md-12">
                    <div class="yt-attachments-container margin-bottom-0">
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Social Blade Rank</span>
							<h4 class="fots counter"><?php echo $result['sbRank']; ?></h4>
						</div>
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Subscriber Rank</span>
							<h4 class="fots counter"><?php echo $result['subsRank']; ?></h4>
						</div>
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Video Views Rank</span>
							<h4 class="fots counter"><?php echo $result['videoViewsRank']; ?></h4>
						</div>
					</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="yt-attachments-container margin-bottom-0">
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Country Rank</span>
							<h4 class="fots counter"><?php echo $result['countryRank']; ?></h4>
						</div>
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Music Rank</span>
							<h4 class="fots counter"><?php echo $result['catRank']; ?></h4>
						</div>
					</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="yt-attachments-container margin-top-20 margin-bottom-0">
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Subscriber For The Last 30 Days</span>
							<h4 class="fots"><?php echo $result['subsForLast30Days']; ?></h4>
						</div>
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Video Views For The Last 30 Days</span>
							<h4 class="fots"><?php echo $result['viewsForLast30Days']; ?></h4>
						</div>
					</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="yt-attachments-container margin-bottom-0">
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Estimated Daily Earnings</span>
							<h4 class="fots"><?php echo $result['dailyEarnings']; ?></h4>
						</div>
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Estimated Monthly Earnings</span>
							<h4 class="fots"><?php echo $result['monthlyEarnings']; ?></h4>
						</div>
					</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="yt-attachments-container margin-bottom-0">
						<div class="yt-attachment-box ripple-effect fotts">
							<span class="fot">Estimated Yearly Earnings</span>
							<h4 class="fots"><?php echo $result['yearlyEarnings']; ?></h4>
						</div>
					</div>
                </div>
            </div>
		</div>
<?php  } ?>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>