<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 

//Site Setttings
$pageId = 5;
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
                            <h3>YT Thumbnails Generator</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Video Title</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" required type="text" name="video_title" placeholder="Please enter video title here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" name="submit" type="submit">Generate Thumbnail</button>
                                </div>
                            </div>
                            <span class="notes">Example : How to rank youtube videos on google</span>
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
                    $search = $_POST['video_title'];
                    $page='';
                    $page2= 'amp;sp=SBSYAQHqAwA%253D';
                    $page3= 'amp;sp=SCiYAQHqAwA%253D';
               
               
                    $videoIdLists = searchThumb($search,$page);
                    $videoIdLists2 = searchThumb($search,$page2);
                    $videoIdLists3 = searchThumb($search,$page3);
                    $videoIdLists = array_merge($videoIdLists, $videoIdLists2, $videoIdLists3);
            ?>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">Thumbnails Generated for <b><?php echo $search; ?></b></h3>
                <!-- Listings Container -->
                <div class="yt-thumnail-list">
                    <?php 
                        foreach($videoIdLists as $id)
                        {
                            $defalt  =  "https://i.ytimg.com/vi/{$id}/mqdefault.jpg"; 
                            $standed  =  "https://i.ytimg.com/vi/{$id}/sddefault.jpg";  
                    ?>
    				<a href="<?php echo $root; ?>/tools/find-youtube-video-thumbnails.php?q=<?php echo $id; ?>" target="_blank" class="yt-thumnail">
    					<div class="yt-thumnail-inner-alignment">
						    <img src="<?php echo $defalt; ?>" alt="">
					    </div>
    				</a>
    				<?php
                        }
                    ?>
    			</div>
    			<div class="text-center">
                    <a href="#" id="seeMore" class="button dark ripple-effect button-sliding-icon">Show More <i class="icon-feather-check"></i></a>
                </div>
                <!-- Listings Container / End -->
            </div>
            <?php } ?>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Thumbnails Generator</h3>
                <?php echo $pcontent; ?>
            </div>
        </div>
        <!-- ./ card [main form] -->
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>