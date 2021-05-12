<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 

//Site Setttings
$pageId = 21;
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
<?php 
    $pageUrl = $_SERVER['REQUEST_URI'];
    if ((isset($_GET['sort']) || isset($_GET['cc'])))
    {
        if (isset($_GET['sort']) && isset($_GET['cc'])) 
        {
            $sort = $_GET['sort'];
            $cc = $_GET['cc'];
            if ($sort == 'mostviewed') 
            {
                $results = topChannels('top/country/'.$cc.'/mostviewed');
            }
            else
            {
                $results = topChannels('top/country/'.$cc.'/mostsubscribed');
            }
        }
        else if(isset($_GET['sort']))
        {
            $sort = $_GET['sort'];
            if ($sort == 'mostviewed') 
            {
                $results = topChannels('top/50/mostviewed');
                $resultType = 'MOST VIEWED ';
                $selected = 'selected';
            }
            else
            {
                $results = topChannels('top/50/mostsubscribed');
                $resultType = 'SUBSCRIBED';
                $selected = 'selected';
            }
        }
        else if(isset($_GET['cc']))
        {
            $cc = $_GET['cc'];
            $results = topChannels('top/country/'.$cc.'/mostsubscribed');
        }
    }
    else
    {   
        $sort = isset($_GET['sort']) ? 'mostsubscribed' : "";
        $resultType = 'SUBSCRIBED';
        $results = topChannels('top/50/mostsubscribed');
    }
?>

<div class="single-page-header" data-background-image="<?php echo $root; ?>/assets/frontend/images/single-job.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>TOP 100 <?php echo $resultType; ?> YOUTUBE CHANNELS</h3>
                            <?php 
                              if (isset($_GET['cc'])) {?>
                                <input type="text" name="cc" class="d-none" value="<?php echo $_GET['cc']; ?>">
                                <input type="text" name="sort" class="d-none" value="mostsubscribed">
                          <?php } ?>
                        </div>
                    </div>
                </div>
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
        
        <div class="single-page-section">
			<div class="section-headline margin-bottom-30">
			    <form>
			        <div class="keywords-container">
        				<div class="keyword-input-container">
        			        <select class="form-control keyword-input " name="sort" id="popularselection">
                              <option value="mostsubscribed" <?php if(isset($selected)){ echo $selected;} ?>>Most subscribed</option>
                              <option value="mostviewed" <?php if(isset($selected)){ echo $selected;} ?>>Most viewed</option>
                            </select>
                            <input type="text" value="null" name="" class="d-none">
        					<button class="keyword-input-button ripple-effect"><i class="icon-feather-filter"></i></button>
        				</div>
        				<div class="clearfix"></div>
        			</div>
                </form>
			</div>
			<div class="dashboard-box margin-top-0">
				<div class="content">
					<ul class="dashboard-box-list">
						<?php 
                            $i=1; 
                            foreach ($results as $result) 
                            { 
                        ?>
						    <li>
							    <div class="yt-station-overview manage-candidates channelana" data-link="<?php echo trim($result['channelId']); ?>">
    								<div class="yt-station-overview-inner">
                        				<!-- Name -->
    									<div class="yt-station-name">
    										<h4><?php echo $result['channelName']; ?></h4>
    										<!-- Rating -->
    										<div class="yt-station-rating">
    											<div class="star-rating" data-rating="<?php 
                                                    if ($result['channelType'] == "") 
                                                    {
                                                       echo "--";
                                                    }
                                                    else
                                                    {
                                                        echo $result['channelType'];
                                                    }
                                                ?>"></div>
    										</div>
    									</div>
    									<ul class="dashboard-task-info">
    										<li><strong><?php echo $i; ?></strong><span>Rank</span></li>
    										<li><strong><?php echo $result['subscribers']; ?></strong><span>Subscribers</span></li>
    										<li><strong><?php echo $result['uploads']; ?></strong><span>Uploads</span></li>
    										<li><strong><?php 
                                                if ($result['views'] != "0") 
                                                {
                                                    echo thousandsCurrencyFormat($result['views']);
                                                }
                                                else
                                                {
                                                    echo "--";
                                                }
                                           ?></strong><span>Views</span></li>
    									</ul>
    								</div>
    							</div>
    						</li>
    					<?php $i++; } ?>
    					<a href="#small-dialog" class="popup-with-zoom-anim button channelanass ripple-effect margin-top-5 margin-bottom-10"></a>
					</ul>
				</div>
			</div>
		</div>
        <div class="single-page-section">
            <h3 class="margin-bottom-25">About YT Live Subscribers</h3>
            <?php echo $pcontent; ?>
        </div>
    </div>    
<?php  ?>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>