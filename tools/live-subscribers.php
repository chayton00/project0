<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php include dirname(__FILE__)."/../inc/header.php"; ?>
<?php 
    if (isset($_POST['submit'])) 
    {
        $url = trim($_POST['Channel_URL']);
        if($url !== false)
        {
            $channelData = getChannelName($url);
            $channelBanner = getChannelBanner($url);
            $subscribers = getSubscribers($url);
        }
?>
<div class="single-page-header" data-background-image="<?php echo $channelBanner; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner liveSubs" data-url="<?php echo $url; ?>">
					<div class="left-side">
						<div class="header-image">
						    <img src="<?php echo $channelData['avatar']; ?>" alt="">
						</div>
						<div class="header-details">
							<h3><?php echo $channelData['title']; ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-12">
                <ul class="intro-stats margin-top-45 hide-under-992px">
                    <li>
                        <strong class="counter odometer"></strong>
                        <span>Subscribers</span>
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
		</div>
<?php  } ?>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>