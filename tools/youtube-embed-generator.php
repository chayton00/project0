<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 
   //Site Setttings
   $pageId = 20;
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
                <form name="youtube-options" id="youtube-options">
                    <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>YT Custom Video Embed Generator</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Video URL/ID</label>
                                    <div class="input-with-icon">
                                        <input id="youtube-id" onFocus="select(this);" type="text" value="6nIcjua7YSo" name="video_URL" placeholder="Please enter video URL/id here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                            </div>
                            <span class="notes">Example : https://www.youtube.com/watch?v=7k_EW3skxzM</span>
                            
                            <div class="row margin-top-5">
                                <div class="col-xl-3 col-md-3">
                                    <div class="col-md-12 section-headline margin-top-25 margin-bottom-12">
                        				<h5>Play Options</h5>
                            		</div>
                                    <div class="col-md-12">
    									<div class="submit-field">
    										<h5 class="font-sm">Width</h5>
    										<div class="input-with-icon">
											    <input type="number" min="0" class="with-border numbers-only-input" id="video-width" size="4" maxlength="5" value="560" onFocus="select(this);" />
    											<i class="currency">pixels</i>
											</div>
    									</div>
    								</div>

    								<div class="col-md-12">
    									<div class="submit-field">
    										<h5 class="font-sm">Height</h5>
    										<div class="input-with-icon">
    										    <input type="number" min="0" class="with-border numbers-only-input" id="video-height" size="4" maxlength="5" value="315" onFocus="select(this);" />
    									    	<i class="currency">pixels</i>
											</div>
    									</div>
    								</div>
    
    								<div class="col-md-12">
    									<div class="submit-field">
    										<h5 class="font-sm">Start Video at</h5>
    										<div class="input-with-icon">
    										    <input type="number" min="0" class="with-border numbers-only-input" name="start" size="4" maxlength="5" onFocus="select(this);" />
    										    <i class="currency">seconds</i>
											</div>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="submit-field">
    										<h5 class="font-sm">End Video at</h5>
    										<div class="input-with-icon">
    										    <input type="number" min="0" class="with-border numbers-only-input" name="end" size="4" maxlength="5" onFocus="select(this);" />
                    					        <i class="currency">seconds</i>
											</div>
                    					</div>
    								</div>
    
                                </div>
                                
                                <div class="col-xl-3 col-md-3">
                                    <div class="col-md-12 section-headline margin-top-25 margin-bottom-12">
                        				<h5>Appearence</h5>
                            		</div>
                            		
                            		<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="vq" name="vq" value="hd1080">
    										<label class="font-sm" for="vq"><span class="checkbox-icon"></span> Force 1080 HD Resolution</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="security" checked>
    										<label class="font-sm" for="security"><span class="checkbox-icon"></span> Use Enhanced Security (&nbsp;<span class="help" title="Encrypts the connection between the user and YouTube; required for embeds on most modern websites.">?</span>&nbsp;)</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="enhanced-privacy">
    										<label class="font-sm" for="enhanced-privacy"><span class="checkbox-icon"></span> Use Enhanced Privacy (&nbsp;<span class="help" title="Turns off YouTube's tracking until the video plays.">?</span>&nbsp;)</label>
    									</div>
    								</div>
    								
    								
                            		
                                    <div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="modestbranding" name="modestbranding" value="1" />
    										<label class="font-sm" for="modestbranding"><span class="checkbox-icon"></span> Modest Branding</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="showinfo" name="showinfo" value="0" />
    										<label class="font-sm" for="showinfo"><span class="checkbox-icon"></span> Disable dropdown video information box</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="rel" name="rel" value="0" />
    										<label class="font-sm" for="rel"><span class="checkbox-icon"></span> Do not show related videos on playback</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="cc_load_policy" name="cc_load_policy" value="1" />
    										<label class="font-sm" for="cc_load_policy"><span class="checkbox-icon"></span> Show closed captions by default</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="iv_load_policy" name="iv_load_policy" value="3" />
    										<label class="font-sm" for="iv_load_policy"><span class="checkbox-icon"></span> Annotations disabled by default</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="theme" name="theme" value="light" />
    										<label class="font-sm" for="theme"><span class="checkbox-icon"></span> Use alternate "Light" UI theme</label>
    									</div>
    								</div>
							    </div>
                                
                                <div class="col-xl-3 col-md-3">
                                    <div class="col-md-12 section-headline margin-top-25 margin-bottom-12">
                        				<h5>Control Options</h5>
                            		</div>
                            		
                            		<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="autoplay" name="autoplay" value="1" />
    										<label class="font-sm" for="autoplay"><span class="checkbox-icon"></span> Autoplay Video</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="loop" name="loop" value="1" />
    										<label class="font-sm" for="loop"><span class="checkbox-icon"></span> Loop the video/playlist</label>
    									</div>
    								</div>
                            		
                            		<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="fs" name="fs" value="0" />
    										<label class="font-sm" for="fs"><span class="checkbox-icon"></span> Disable fullscreen button</label>
    									</div>
    								</div>
								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="color" name="color" value="white" />
    										<label class="font-sm" for="color"><span class="checkbox-icon"></span> Use white progress bar instead of red</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="autohide" name="autohide" value="0" />
    										<label class="font-sm" for="autohide"><span class="checkbox-icon"></span> Do not autohide play bar</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="controls" name="controls" value="0" />
    										<label class="font-sm" for="controls"><span class="checkbox-icon"></span> Disable player controls</label>
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="checkbox">
    										<input type="checkbox" id="disablekb" name="disablekb" value="1" />
    										<label class="font-sm" for="disablekb"><span class="checkbox-icon"></span> Disable keyboard control shortcuts</label>
    									</div>
    								</div>
								</div>
								
								<div class="col-xl-3 col-md-3">
                                    <div class="col-md-12 section-headline margin-top-25 margin-bottom-12">
                        				<h5>Other Options</h5>
                            		</div>
                            		
                            		<div class="col-md-12">
    									<div class="submit-field">
    										<h5 class="font-sm">On-the-fly playlist (comma-seperated video IDs) (&nbsp;<span class="help" title="Appears in the embed playlist menu.">?</span>&nbsp;)</h5>
    										<input type="text" class="with-border" id="playlist" name="playlist" onFocus="select(this);" />
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="submit-field">
    										<h5 class="font-sm">Search term playlist (single-word search term) (&nbsp;<span class="help" title="Appears in the embed playlist menu, and overrides the 'on-the-fly' playlist.">?</span>&nbsp;)</h5>
    										<input type="text" class="with-border" id="q" name="q" onFocus="select(this);" />
    									</div>
    								</div>
    								
    								<div class="col-md-12">
    									<div class="submit-field">
    										<h5 class="font-sm">Custom Parameters</h5>
    										<input type="text" class="with-border" id="custom-params" onFocus="select(this);" />
    									</div>
    								</div>
                        		</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info d-none">
                  <div class="panel-heading">Where did the other options go?</div>
                  <div class="panel-body">
                    <p>Some features previously available in this tool are now offered as official YouTube features, and so do not require complex workarounds.</p>
                    <ul class="list-unstyled">
                      <li><a id="video-edit-link" href="https://www.youtube.com/edit?video_id=QH2-TGUlwu4">Custom Preview Image</a><br><span class="text-muted">(look for the "custom thumbnail" button)</span></li>
                      <li><a href="https://www.youtube.com/branding">Custom Watermark</a></li>
                      <li><a id="video-endscreen-link" href="https://www.youtube.com/endscreen?v=QH2-TGUlwu4">Call-to-Action</a></li>
                    </ul>
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
            <div class="single-page-section">
                <div class="listings-container">
                    <!-- Tag Listing -->
                    <div class="yt-station-listing">
                        <!-- Tag Listing Details -->
                        <div class="yt-station-listing-details" id="hero-demo">
                            <label for="embed-code">Embed</label>
                            <textarea id="embed-code" class=" embed-code" rows="9" readonly="readonly" onFocus="select(this);"></textarea>        
                        </div>
                        <!-- Tag Listing Footer -->
                        <div class="yt-station-listing-footer">
                            <div class="copy-url">
                                <button class="copy-url-button button dark ripple-effect button-sliding-icon" id="copybtn" data-clipboard-target="#embed-code">Copy Embed Link <i class="icon-material-outline-file-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Listings Container / End -->
            </div>

            <div class="single-page-section">
                <div class="listings-container">
                    <!-- Tag Listing -->
                    <div class="yt-station-listing">
                        <!-- Tag Listing Details -->
                        <div class="yt-station-listing-details" id="hero-demo">
                            <div id="embed-preview"></div>        
                        </div>
                        <!-- Tag Listing Footer -->
                        <div class="yt-station-listing-footer">
                            <ul class="list-2">
        						<li id="video-title"></li>
        						<li id="video-author"></li>
        						<li id="video-published"></li>
        						<li id="video-views"></li>
        						<li id="video-duration"></li>
        						<li>
        						    <label for="direct-link">Direct Link</label>
                                    <a id="direct-link" href="" target="_blank" rel="noopener"></a>
                                </li>
                                <li>
        						    <label for="short-link">Short Link</label>
                                    <a id="short-link" href="" target="_blank" rel="noopener"></a>
                                </li>
                                <li>
        						    <label for="fullscreen-link">Fullscreen Link</label>
                                    <a id="fullscreen-link" href="" target="_blank" rel="noopener"></a>
                                </li>
        					</ul>
                        </div>
                    </div>
                </div>
                <!-- Listings Container / End -->
            </div>
             
             <div class="single-page-section">
            <h3 class="margin-bottom-25">About YT Video Embed</h3>
            <?php echo $pcontent; ?>
        </div>
    </div>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>