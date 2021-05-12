<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 

//Site Setttings
$pageId = 13;
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
                            <h3>YT Find Animated Thumbnail from page source</h3>
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
                if (isset($_POST['submit'])) 
                { 
                    $q = $_POST['video_link'];
                    if(isset($_POST['show']))
                    {
                        $show = (int)$_POST['show'];
                        $result  = getAnimatedThumb($_POST[q],$show);
                    }
                    else
                    {   $show = 1;
                        $result  = getAnimatedThumb($q,$show);
                    }
            ?>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">Animated Thumbnails</h3>
                <div class="yt-thumnail-list">
                    <?php  foreach($result as $img){ ?>
    				<a href="<?php echo $root; ?>/inc/download.php?at=<?php echo urlencode($img); ?>" target="_blank" class="yt-thumnail">
    					<div class="yt-thumnail-inner-alignment">
						    <img src="<?php echo $img; ?>" alt="">
					    </div>
    				</a>
    				<?php
                        }
                    ?>
    			</div>
    			<div class="text-center">
                    <a href="#" id="seeMore" class="button dark ripple-effect button-sliding-icon">Show More <i class="icon-feather-check"></i></a>
                </div>
            </div>

        <?php
            }
        ?>
        <form method="POST">
            <div class="single-page-section">
                <h3 class="margin-bottom-25">Find Animated Thumbnails <small>from page source code</small></h3>
                <div class="yt-thumnail-list">
                    <textarea class="form-control form-control-lg " name="q" rows="10" placeholder="Enter youtube page source code"></textarea>
                </div>
                <div class="text-center">
                	<div class="radio">
        				<input id="onlyFirst" value="1" name="show" type="radio" checked="">
        				<label for="onlyFirst"><span class="radio-label"></span> Only First Video</label>
        			</div>
        			<br>
        			<div class="radio">
        				<input id="firstFive" value="5" name="show" type="radio">
        				<label for="firstFive"><span class="radio-label"></span> First 5 Videos</label>
        			</div>
        			<br>
        			<div class="radio">
        				<input id="all" value="50" name="show" type="radio">
        				<label for="all"><span class="radio-label"></span> All Videos</label>
        			</div>
            	</div>
               <button class="button ripple-effect" type="submit" name="submit">Submit</button>
           </div>
      </form>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Animated Thumbnails</h3>
                <?php echo $pcontent; ?>
            </div>
        </div>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>