<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 
   //Site Setttings
   $pageId = 16;
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
<?php } else { ?>
<div class="single-page-header" data-background-image="<?php echo $root; ?>/assets/frontend/images/single-job.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>YT Live Subscribers Counter</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Channel URL</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" type="url" required name="Channel_URL" placeholder="Please enter channel URL here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" name="submit" type="submit">Get Subscribers Count</button>
                                </div>
                            </div>
                            <span class="notes">Example : https://www.youtube.com/mrbabyhacker   https://www.youtube.com/channel/UCAmZxVMNtMMe-lFolMpDTYw</span>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="ad-space-768">
   <?php echo $bannerTop; ?>
</div>
<!-- Page Content ================================================== -->
<div class="container">
    <div class="row">
        <!-- Content -->
        <div class="col-xl-8 col-lg-8 content-right-offset">
        
        <div class="single-page-section">
			<div class="section-headline margin-bottom-30">
				<h4>Understand public subscriber counts</h4>
				<p>Your audience will only see a shortened version of your subscriber count. This public subscriber count is shortened depending on the number of subscribers your channel has.</p>
			</div>
			<table class="basic-table">
				<tbody><tr>
					<th>If you have...   </th>
					<th>then your public subscriber count updates for every:</th>
				</tr>
				<tr>
					<td data-label="Column 1">Less than 1,000 subscribers</td>
					<td data-label="Column 2">1 new subscriber</td>
				</tr>
                <tr>
                   <td data-label="Column 1">1,000 to 9,999 subscribers</td>
                   <td data-label="Column 2">10 new subscribers</td>
                </tr>
                <tr>
                   <td data-label="Column 1">10,000 to 99,999 subscribers</td>
                   <td data-label="Column 2">100 new subscribers</td>
                </tr>
                <tr>
                   <td data-label="Column 1">100,000 to 999,999 subscribers  </td>
                   <td data-label="Column 2">1,000 new subscribers</td>
                </tr>
                <tr>
                   <td data-label="Column 1">1,000,000 to 9,999,999 subscribers </td>
                   <td data-label="Column 2">10,000 new subscribers</td>
                </tr>
                <tr>
                   <td data-label="Column 1">10,000,000 to 99,999,999 subscribers  </td>
                   <td data-label="Column 2">100,000 new subscribers</td>
                </tr>
                <tr>
                   <td data-label="Column 1">100,000,000 to 999,999,999 subscribers   </td>
                   <td data-label="Column 2">1,000,000 new subscribers</td>
                </tr>
			</tbody></table>
			<a href="https://support.google.com/youtube/answer/6051134?hl=en" target="_blank">More information...</a>
		</div>
        
        <div class="single-page-section">
            <h3 class="margin-bottom-25">About YT Live Subscribers</h3>
            <?php echo $pcontent; ?>
        </div>
    </div>    

<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>