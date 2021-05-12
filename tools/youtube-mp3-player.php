<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 
   //Site Setttings
   $pageId = 26;
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
                        <h3>YT Mp3 Player</h3>
                        <div class="intro-banner-search-form margin-top-95 mb-5">
                           <!-- Search Field -->
                           <div class="intro-search-field with-autocomplete">
                              <label for="autocomplete-input" class="field-title ripple-effect">Video URL</label>
                              <div class="input-with-icon">
                                 <input id="autocomplete-input" required type="text" name="" placeholder="Please enter video url here">
                                 <i class="icon-brand-youtube"></i>
                              </div>
                           </div>
                           <!-- Button -->
                           <div class="intro-search-button">
                              <button class="button ripple-effect  " name="submit" id="play_mp3" type="button"><span>Play Mp3</span></button>
                           </div>
                        </div>
                        <span class="notes">Example : https://www.youtube.com/watch?v=cd-ozdPSAIA</span>
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
   <div class="listings-container  compact-list-layout d-none  mb-5" id="mp3_player">

      <div class="player">
         <ul class="player-info">
            <li class="title"></li>
            <li class="uploader"></li>
            <li><span id="duration"></span><i> / </i><span class="duration"></span></li>
            <div class="seek-field">
               <input id="audioSeekBar" min="0" max="334" step="1" value="0" type="range" oninput="audioSeekBar()" onchange="this.oninput()">
            </div>
         </ul>

         <div id="play-button" class="unchecked">
            <i class="icon icon-feather-play"></i>

       <div class="loader-inner ball-clip-rotate-pulse d-none">
          <div></div>
          <div></div>
        </div>

         </div>
      </div>


      <div class="playlist">
         
         <ul>


           

         </ul>

      </div>

      <audio id="audio-player" ontimeupdate="SeekBar()" ondurationchange="CreateSeekBar()" preload="auto" loop>
         <source src="" type="audio/ogg">
         <source src="" type="audio/mpeg">
      </audio>

   </div>
   <div class="single-page-section">
      <h3 class="margin-bottom-25">About YT Mp3 Player</h3>
      <?php echo $pcontent; ?>
   </div>
</div>
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>