<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 

//Site Setttings
$pageId = 10;
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
<div class="single-page-header" data-background-image="<?php echo $root; ?>/assets/frontend/images/single-job.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="GET">
                    <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>YT Trending Videos</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field">
                                    <label class="field-title ripple-effect">Country</label>
                                    <select class="select-class" name="cc" data-size="7" title="Select Country" data-live-search="true">
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australia</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaijan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>
										<option value="BB">Barbados</option>
										<option value="BY">Belarus</option>
										<option value="BE">Belgium</option>
										<option value="BZ">Belize</option>
										<option value="BJ">Benin</option>
										<option value="BM">Bermuda</option>
										<option value="BT">Bhutan</option>
										<option value="BG">Bulgaria</option>
										<option value="BF">Burkina Faso</option>
										<option value="BI">Burundi</option>
										<option value="KH">Cambodia</option>
										<option value="CM">Cameroon</option>
										<option value="CA">Canada</option>
										<option value="CV">Cape Verde</option>
										<option value="KY">Cayman Islands</option>
										<option value="CO">Colombia</option>
										<option value="KM">Comoros</option>
										<option value="CG">Congo</option>
										<option value="CK">Cook Islands</option>
										<option value="CR">Costa Rica</option>
										<option value="CI">Côte d'Ivoire</option>
										<option value="HR">Croatia</option>
										<option value="CU">Cuba</option>
										<option value="CW">Curaçao</option>
										<option value="CY">Cyprus</option>
										<option value="CZ">Czech Republic</option>
										<option value="DK">Denmark</option>
										<option value="DJ">Djibouti</option>
										<option value="DM">Dominica</option>
										<option value="DO">Dominican Republic</option>
										<option value="EC">Ecuador</option>
										<option value="EG">Egypt</option>
										<option value="GP">Guadeloupe</option>
										<option value="GU">Guam</option>
										<option value="GT">Guatemala</option>
										<option value="GG">Guernsey</option>
										<option value="GN">Guinea</option>
										<option value="GW">Guinea-Bissau</option>
										<option value="GY">Guyana</option>
										<option value="HT">Haiti</option>
										<option value="HN">Honduras</option>
										<option value="HK">Hong Kong</option>
										<option value="HU">Hungary</option>
										<option value="IS">Iceland</option>
										<option value="IN">India</option>
										<option value="ID">Indonesia</option>
										<option value="NO">Norway</option>
										<option value="OM">Oman</option>
										<option value="PK">Pakistan</option>
										<option value="PW">Palau</option>
										<option value="PA">Panama</option>
										<option value="PG">Papua New Guinea</option>
										<option value="PY">Paraguay</option>
										<option value="PE">Peru</option>
										<option value="PH">Philippines</option>
										<option value="PN">Pitcairn</option>
										<option value="PL">Poland</option>
										<option value="PT">Portugal</option>
										<option value="PR">Puerto Rico</option>
										<option value="QA">Qatar</option>
										<option value="RE">Réunion</option>
										<option value="RO">Romania</option>
										<option value="RU">Russian Federation</option>
										<option value="RW">Rwanda</option>
										<option value="SZ">Swaziland</option>
										<option value="SE">Sweden</option>
										<option value="CH">Switzerland</option>
										<option value="TR">Turkey</option>
										<option value="TM">Turkmenistan</option>
										<option value="TV">Tuvalu</option>
										<option value="UG">Uganda</option>
										<option value="UA">Ukraine</option>
										<option value="GB">United Kingdom</option>
										<option value="US" selected>United States</option>
										<option value="UY">Uruguay</option>
										<option value="UZ">Uzbekistan</option>
										<option value="YE">Yemen</option>
										<option value="ZM">Zambia</option>
										<option value="ZW">Zimbabwe</option>
									</select>
                                 </div>
                                 <input type="hidden" name="country" value="">
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" name="submit" id="checkUserName" type="submit">Trending Videos</button>
                                </div>
                            </div>
                            <span class="notes">Example : MyChannel</span>
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
<div class="container">
    <div class="row">
        <!-- Content -->
        <div class="col-xl-8 col-lg-8 content-right-offset">
            <?php 
               if ( isset($_GET['cc'])) 
               {
                    $countryCode = strtoupper($_GET['cc']);
                    $trendingVideos =  getTrendingVideo($countryCode,10);
           ?>
            <!-- Trending -->
            <div class="section padding-top-65 padding-bottom-70">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Section Headline -->
                            <div class="section-headline margin-top-0 margin-bottom-25">
                                <h3>Trending Videos From <?php echo $_GET['country']; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <?php 
                                $i = 1;
                                foreach ($trendingVideos as $video) 
                                {
                            ?>
                            <div class="col-md-6 margin-bottom-10">
                                <div class="yt-station1">
                                    <div class="yt-station-overview playVideo" data-url="<?php echo $video['videoUrl']; ?>">
                                        <div class="yt-station-overview-inner">
                                            <a href="<?php echo $video['videoUrl']; ?>" target="_blank"><img src="<?php echo $video['thumb']; ?>" alt="Trending-video"></a>
                                        </div>
                                    </div>
                                    <!-- Details -->
                                    <div class="yt-station-details">
                                        <div class="yt-station-details-list">
                                            <a href="<?php echo $video['videoUrl']; ?>" target="_blank"><?php    echo $video['videoTitle'] ?></a>
                                            <ul>
                                                <li><span class="popup-with-zoom-anim button dark ripple-effect tag"><i class="icon-material-outline-assessment"></i> | <?php echo $video['channelName']; ?></span></li>
                                                <li><span class="popup-with-zoom-anim button ripple-effect tag"><i class="icon-feather-eye"></i> | <?php echo $video['views']; ?></span></li>
                                            </ul>
                                        </div>
                                        <button data-url="<?php echo $video['videoUrl']; ?>" class="button w-100 button-sliding-icon trending-list playVideo ripple-effect" type="button">Play Video <i class="icon-brand-youtube"></i></button>
                                    </div>
                                </div>
                            </div>
                            <?php $i++;  } ?>
                		    <a href="#small-dialog-1" class="popup-with-zoom-anim button dark ripple-effect d-none" id="modale1"></a>
					    </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- Highest Rated Freelancers / End-->
            
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Live Subscribers</h3>
                <?php echo $pcontent; ?>
            </div>
        </div>    
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>