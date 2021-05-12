<?php if($filename == 'youtube-videos-downloader.php' || $filename == 'youtube-to-mp3-converter.php'){ ?>
    <script src="https://unpkg.com/@ungap/custom-elements-builtin"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.1/flickity.pkgd.min.js'></script>
    <script src="<?php echo $root; ?>/assets/frontend/js/x-frame-bypass.js" type="module"></script>
<?php } ?>

<script type="text/javascript">
"use strict";
//<![CDATA[

    (function() {   
        var $;
        $ = jQuery;
        $(document).ready(function() {
            return $('#call-to-action').on('click', function() {
                $(this).prop('disabled',true); 
                return $(this).toggleClass('button--loading disable');
            });
        });
    
        $('form input:not([type="submit"])').keydown(function(e) {
            if (e.keyCode == 13) {
                var inputs = $(this).parents("form").eq(0).find(":input");
                if (inputs[inputs.index(this) + 1] != null) {                    
                    inputs[inputs.index(this) + 1].focus();
                }
                e.preventDefault();
                return false;
            }
        });
    }).call(this);
    
    $(document).ready(function () {
        <?php $filename = basename($_SERVER['PHP_SELF']); ?>
      
        <?php if($filename == 'index.php' || $filename == ''){ ?>
            
            $(".category-box").slice(0, 8).show();
            
            $("#seeMore").on('click',function(e)
            {
                e.preventDefault();
                $(".category-box:hidden").slice(0, 8).fadeIn("slow");
                if ($(".category-box:hidden").length == 0) 
                {
                    $("#seeMore").fadeOut("slow");
                }
            });
            
        <?php } ?>
            //check cookies is define or undefinded
            if (Cookies.get('cookies') == undefined) 
            {
                $(".cookies-modal").show();
            }
       
        <?php if($filename == 'find-youtube-video-tags.php' || $filename == 'youtube-tags-generator.php'  || $filename == 'find-channel-keywords.php'){ ?>
            function copyToClipboard(text) 
            {
                var textArea = document.createElement("textarea");
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                try 
                {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                }
                catch (err) 
                {
                    console.log('Oops, unable to copy');
                }
                document.body.removeChild(textArea);
            }
    
            $(document).on("click", "#copybtn", function()
            {
                var clipboardText = '';
                $('.keyword-text').each(function () 
                {
                    clipboardText = clipboardText + $(this).text() + ',';
                });
                copyToClipboard(clipboardText);
                $(this).find("span").text("Copied");
                setTimeout(function () 
                {
                    $("#copybtn").find("span").text("Copy");
                }, 2000);
            });
    
            $(document).on("click", ".keyword-remove", function() {
                $(this).parent().addClass('keyword-removed');
    
                function removeFromMarkup() {
                    $(".keyword-removed").remove();
                }
                setTimeout(removeFromMarkup, 500);
                keywordsList.css({
                    'height': 'auto'
                }).height();
            });
            
            // Snackbar for copy to clipboard button
            $(document).on("click", ".copy-url-button", function() { 
            	Snackbar.show({
            		text: 'Copied to clipboard!',
            	}); 
            }); 
        <?php } ?>
        
        <?php if($filename == 'youtube-thumbnails-generator.php' || $filename == 'find-youtube-animated-thumbnails.php'){ ?>
            $(".yt-thumnail").slice(0, 12).show();
            
            $("#seeMore").on('click',function(e)
            {
                e.preventDefault();
                $(".yt-thumnail:hidden").slice(0, 8).fadeIn("slow");
                if ($(".yt-thumnail:hidden").length == 0) 
                {
                    $("#seeMore").fadeOut("slow");
                }
            });
        <?php } ?>
        
        <?php if($filename == 'youtube-videos-downloader.php'){ ?>
            
            //check cookies for recent videos
            if (Cookies.get('recentVideos') != undefined) 
            {
                var recentVideos = Cookies.get('recentVideos');
                var vidList = "";
                var recentVideosArray = recentVideos.split(',');
                var recentVideosArray = recentVideosArray;
                var storeData = recentVideosArray;
                var arrayLength = recentVideosArray.length;
        
                $('#rv-data').attr('value', storeData.toString());
                var classs = "";
                for (var i = 0; i < arrayLength; i++) 
                {
                    if(i===1){ classs = "first"; }
                    $('#myRecentVideos .responsive').append('<a href="javascript:void(0)" data-url="https://www.youtube.com/watch?v=' + storeData[i] + '" class="popup-with-zoom-anim playVideo"><div class="js-carousel-cell"><div class="ag-shop-card_box-wrap"><div class="ag-shop-card_box"><div class="ag-shop-card_body"><div class="js-card-bg ag-card-bg" style="background-image: url(https://i.ytimg.com/vi/' + storeData[i] + '/mqdefault.jpg);"></div></div></div></div></div></a>');
                }
            } 
            else 
            {
                $('#myRecentVideos .responsive').html("<span class='msg'>No Data To Display !</span>");
            }
            
            $("iframe").on("load", function () {var doc = $('iframe').attr('srcdoc');
                var myStr = doc;
                var ytid = myStr.match("_id:'(.*)',");
                var v_id = myStr.match("v_id:'(.*)',");
                $('input[name=ytid]').val(ytid[1]);
                $('input[name=v_id]').val(v_id[1]);
            });
            


            
        <?php } ?>
        

        
        <?php if($filename == 'live-subscribers.php' || $filename == 'youtube-live-subscribers-counter.php'){ ?>
            var subs = <?php echo $subscribers; ?> ;
            
            setTimeout(function()
            { 
                $('.odometer').html(subs);
            }, 1000);
           
           function countSubscribers()
           {
                var str =$(".liveSubs").attr('data-url');
                var str = str.replace("https://", '');
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        $('.odometer').html(this.responseText);
                    }
                }
                xmlhttp.open("GET", "<?php echo $root; ?>/inc/ajax.php?subs="+str, true);
                xmlhttp.send();
            }
            window.setInterval(function(){
                countSubscribers();
            }, 1000);
                
        <?php } ?>
        
        <?php if($filename == 'youtube-username-checker.php'){ ?>
            
            $("#checkUserName").click(function()
            {
                var str = $("#autocomplete-input").val();
                if (str.length == 0) 
                {
                } 
                else 
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            var $response = this.responseText;
                            $(".username_results a").attr("href",'https://www.youtube.com/user/'+str);
                            $(".customurl_results a").attr("href",'https://www.youtube.com/'+str);
                            $(".username_results a b,.customurl_results a b").text(str);
                            if ($response.indexOf("unu") >= 0 ) 
                            {
                                $(".username_results .card-title").html('<span class="text-danger"><i class="icon-line-awesome-hand-stop-o"></i>  Taken !<span>');
                                $(".username_results .ustatus").text("Your Username is Unavailable !");
                                $(".username_results").removeClass('d-none');
                            }
                            else
                            {
                                $(".username_results .card-title").html('<span class="text-success"><i class="icon-line-awesome-smile-o"></i> Congratulations !</span>');
                                $(".username_results .ustatus").text("Your Username is Available !");
                                $(".username_results").removeClass('d-none');
                            }
                            
                            if ($response.indexOf("cuu") >= 0 ) 
                            {
                                $(".customurl_results .card-title").html('<span class="text-danger"><i class="icon-line-awesome-hand-stop-o"></i>  Taken !</span>');
                                $(".customurl_results .ustatus").text("Custom URL is Unavailable !");
                                $(".customurl_results").removeClass('d-none');
                            }
                            else
                            {
                                $(".customurl_results .card-title").html('<span class="text-success"><i class="icon-line-awesome-smile-o"></i> Congratulations !</span>');
                                $(".customurl_results .ustatus").text("Custom URL is Available !");
                                $(".customurl_results").removeClass('d-none');
                            }
                        }
                    };
                    xmlhttp.open("GET", "<?php echo $root; ?>/inc/ajax.php?username=" + str, true);
                    xmlhttp.send();
                }
            });
                
        <?php } ?>
    
        <?php if($filename == 'youtube-videos-downloader.php' || $filename == 'youtube-trending-videos.php'){ ?>
            $('.playVideo ').on('click', function(e)
            {
                e.preventDefault();
                $('#modale1').click();
                var videoUrl = $(this).attr('data-url');
                var videoUrl = videoUrl.replace("watch?v=", "embed/");
                $('#small-dialog-1 .popup-tab-content').html('<iframe width="560" style="    max-width: 100%;" height="315" src="' + videoUrl + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><div class="mdl-overly"><span class="loader loader-quart-1"></span></div>');
               
                e.stopPropagation();
                return false;
            });
                
            $('iframe').load(function() 
            {
                setTimeout(iResize, 100);
            });
            
            function iResize() 
            {
                document.getElementById('ytrevenue').contentWindow.document.body.offsetHeight + 'px';
            }
            
            $('[name="cc"]').change(function() 
            {
                var selectedVal = $('[name="cc"]').find(':selected').val();
                var selectiontext = $('[name="cc"]').find(':selected').text();
                $('input[name="country"]').val(selectiontext);
            });
            
        <?php } ?>
        
        <?php if($filename == 'youtube-revenue-calculator.php'){ ?>//set iframe 
              $('iframe#ytrevenue').load(function () {
                setTimeout(iResize, 500);
              });

            function iResize() {   
                var height = document.getElementById('ytrevenue').contentWindow.document.body.offsetHeight + 'px';
                document.getElementById('ytrevenue').style.height = height;
            }
            
        <?php } ?>
        
        <?php if($filename == 'youtube-live-likes-dislikes-counter.php' && isset($_POST['submit'])) { ?>
   
            setTimeout(function()
            { 
                var likes = <?php echo $likes; ?>;
                var dislikes = <?php echo $dislikes; ?>;
                $('.liveVideoLikes').html(likes);
                $('.liveVideoDislikes').html(dislikes);
            }, 1000);

            function videoStatus()
            {
                var str =$("#liveVideStatus").attr('data-url');
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        var videoInfo = JSON.parse(this.responseText);
                        $('.liveVideoLikes').html(videoInfo[0]);
                        $('.liveVideoDislikes').html(videoInfo[1]);
                    }
                }
                xmlhttp.open("GET", "<?php echo $root; ?>/inc/ajax.php?liveVideoStatus="+str, true);
                xmlhttp.send();
            }
   
            window.setInterval(function(){
                videoStatus();
            }, 1000);
   
        <?php } ?>
        
        <?php if($filename == 'youtube-embed-generator.php') { ?>
        $(function() {    
            var form_id = 'youtube-options';
            var YOUTUBE_API_KEY = 'AIzaSyBohGMMjYGfhVqtIALRgsr--FsZ5aRiiow';
            
            var alertMessage = function() 
            {
                var show_errors = false;
                var error_array = Object.keys(errors);
        
                document.getElementById('error-container').innerHTML = '';
        
                error_array.forEach(function(error_key) 
                {
                    if (window.errors[error_key].active) 
                    {
                        show_errors = true;
                        document.getElementById('error-container').innerHTML += '<div class="alert alert-danger" role="alert">' + window.errors[error_key].message + '</div>';
                    }
                });
        
                if (show_errors) {
                    $('#error-container').show();
                } else {
                    $('#error-container').hide();
                }
            };
        
            var checkVideoDimensions = function() 
            {
                var video_width = parseInt(document.getElementById('video-width').value, 10);
                var video_height = parseInt(document.getElementById('video-height').value, 10);
        
                if (video_width < 200 || video_height < 200) 
                {
                    window.errors.video_embed_too_small.active = true;
                } 
                else 
                {
                    window.errors.video_embed_too_small.active = false;
                }
            };
        
            var checkVideoId = function() 
            {
                var video_id = document.getElementById('youtube-id').value;
                window.errors.video_id_invalid.active = false;
        
                if ([0, 11].indexOf(video_id.length) === -1) {
                    window.errors.video_id_invalid.active = true;
                }
            };
        
            var cleanArray = function(input_array) {
                return input_array.filter(function(n) { return n });
            };
        
            var displayMetadata = function(data) {
                var video_data = data.items[0];
                if (video_data) {
                    document.getElementById('video-title').innerHTML = video_data.snippet.title;
                    document.getElementById('video-author').innerHTML = video_data.snippet.channelTitle;
                    document.getElementById('video-published').innerHTML = Date(Date.parse(video_data.snippet.publishedAt)).toLocaleString();
                    document.getElementById('video-views').innerHTML = parseInt(video_data.statistics.viewCount).toLocaleString();
                    document.getElementById('video-duration').innerHTML = parseDuration(video_data.contentDetails.duration);
        
                    $('#video-metadata, #video-links').show();
                }
            };
        
            var getVideoMetadata = function(video_id) {
                var video_lookup_api = 'https://www.googleapis.com/youtube/v3/videos/?id=' + video_id + '&part=snippet%2CcontentDetails%2Cstatistics&key=' + YOUTUBE_API_KEY;
        
                $.get(video_lookup_api, function(response) {
                    displayMetadata(response);
                });
            };
        
            var parseDuration = function(duration) {
                var days = duration.match(/(\d+)\s*D/);
                var hours = duration.match(/(\d+)\s*H/);
                var minutes = duration.match(/(\d+)\s*M/);
                var seconds = duration.match(/(\d+)\s*S/);
        
                var output_string = [];
                if (days) { output_string.push(days[1] + ' day(s)'); }
                if (hours) { output_string.push(hours[1] + ' hour(s)'); }
                if (minutes) { output_string.push(minutes[1] + ' minute(s)'); }
                if (seconds) { output_string.push(seconds[1] + ' second(s)'); }
        
                return output_string.join(', ');
            };
        
            var parseVideoId = function(input_string) {
                if ([0, 11].indexOf(input_string.length) === -1) {
                    /* Parse the video id out of a pasted video URL */
                    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/;
                    var match = input_string.match(regExp);
        
                    if (match && match[2].length === 11) {
                        document.getElementById('youtube-id').value = match[2];
                    }
                }
        
                checkVideoId();
            };
        
            var serializeForm = function() {
                var optionsForm = document.forms[0];
       
                var form_selector = $(optionsForm);
                var form_data = form_selector.serializeArray().filter(
                    function(field) {
                        return field.value !== "";
                    }
                );
        
                var query_string = form_data.map(function(field) { return field.name + '=' + field.value }).join('&');
        
                return { 'form_data': form_data, 'query_string': query_string };
            };
        
            var updateEmbedAndPreview = function() {
                var video_id = document.getElementById('youtube-id').value;
                
                if (video_id.length > 0) {
                    var form_settings = serializeForm();
                    var form_inputs = form_settings.form_data;
                     
                    var query_string_components = [form_settings.query_string, document.getElementById('custom-params').value];
                    var embed_query = cleanArray(query_string_components).join('&');
                    embed_query = (embed_query.length > 0 ? '?' + embed_query : '');
        
                    var video_height = document.getElementById('video-height').value;
                    var video_width = document.getElementById('video-width').value;
        
                    var embed_protocol = document.getElementById('security').checked ? 'https' : 'http';
                    var embed_domain = document.getElementById('enhanced-privacy').checked ? 'www.youtube-nocookie.com' : 'www.youtube.com';
                    var embed_url = '//' + embed_domain + '/embed/' + video_id + embed_query;
                    var embed_output = '<iframe src="' + embed_protocol + ':' + embed_url + '" width="' + video_width + '" height="' + video_height + '" frameborder="0"></iframe>';
        
                    var preview_output = embed_output;
                    document.getElementById('embed-code').value = preview_output;
                    document.getElementById('embed-preview').innerHTML = preview_output;
                }
            };
        
            var updateVideoInfo = function() {
                var video_id = document.getElementById('youtube-id').value;
         
                document.getElementById('direct-link').innerHTML = 'https://www.youtube.com/watch?v=' + video_id;
                document.getElementById('direct-link').href = 'https://www.youtube.com/watch?v=' + video_id;
                document.getElementById('short-link').innerHTML = 'https://youtu.be/' + video_id;
                document.getElementById('short-link').href = 'https://youtu.be/' + video_id;
                document.getElementById('fullscreen-link').innerHTML = 'https://www.youtube.com/v/' + video_id;
                document.getElementById('fullscreen-link').href = 'https://www.youtube.com/v/' + video_id;
                document.getElementById('video-edit-link').href = 'https://www.youtube.com/edit?video_id=' + video_id;
                document.getElementById('video-endscreen-link').href = 'https://www.youtube.com/endscreen?v=' + video_id;
        
                getVideoMetadata(video_id);
            };
            
            window.errors = {
                'video_id_invalid': {
                    'active': false,
                    'message': 'The value you entered does not appear to be a valid video URL.'
                },
                'video_embed_too_small': {
                    'active': false,
                    'message': 'Warning: YouTube does not support video embed sizes smaller than 200x200.'
                }
            };
        
            // TODO: limit the rate at which the listeners fire
            var last_video_id = document.getElementById('youtube-id').value;
        
            $("form :input").change(function() {  
                // If video ID changed (api requests happen)
                var current_video_id = document.getElementById('youtube-id').value;
                if (current_video_id !== last_video_id) {
                    parseVideoId(current_video_id);
                    updateVideoInfo();
        
                    last_video_id = current_video_id;
                }
        
                updateEmbedAndPreview();
                checkVideoDimensions();
                alertMessage();
            });
            
            // On page load
            updateEmbedAndPreview();
            updateVideoInfo();
        
        });    
   
        // Polyfills
        // From https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/keys
        if (!Object.keys) {
            Object.keys = (function() {
                'use strict';
                var hasOwnProperty = Object.prototype.hasOwnProperty,
                    hasDontEnumBug = !({ toString: null }).propertyIsEnumerable('toString'),
                    dontEnums = [
                        'toString',
                        'toLocaleString',
                        'valueOf',
                        'hasOwnProperty',
                        'isPrototypeOf',
                        'propertyIsEnumerable',
                        'constructor'
                    ],
                    dontEnumsLength = dontEnums.length;
        
                return function(obj) {
                    if (typeof obj !== 'function' && (typeof obj !== 'object' || obj === null)) {
                        throw new TypeError('Object.keys called on non-object');
                    }
        
                    var result = [],
                        prop, i;
        
                    for (prop in obj) {
                        if (hasOwnProperty.call(obj, prop)) {
                            result.push(prop);
                        }
                    }
        
                    if (hasDontEnumBug) {
                        for (i = 0; i < dontEnumsLength; i++) {
                            if (hasOwnProperty.call(obj, dontEnums[i])) {
                                result.push(dontEnums[i]);
                            }
                        }
                    }
                    return result;
                };
            }());
        }

        <?php } ?>

        <?php if($filename == 'top-youtube-channels.php') { ?>
            
            $("#popularselection").change(function() 
           	{
        	    var selectedVal = $(this).find(':selected').val();
    	   		var url = '<?php echo $root; ?>/tools/top-youtube-channels.php?sort='+selectedVal;
    		    window.location = url;
        	});
        	
        	
        	$('body').on('click','.channelana',function(){
        	    $('.companydet').html('<div class="text-center"><div class="loader-20"></div><p>Please wait while loading data...</p></div>');
        	    var link = $(this).attr('data-link');
        	    $('.channelanass').click();
        	    $.ajax({
                    url: "<?php echo $root; ?>/inc/ajax.php?getchann=getchann&url="+link,
                    type: 'GET',
                    success: function(data) 
                    {
                        $('.companydet').html(data);
                    }
                });   
        	});
        	
        <?php } ?>
        
        <?php if($filename == 'find-youtube-video-thumbnails.php'){ ?>
            if(Cookies.get('recentThumbs') != undefined )
            {
                var recentVideos = Cookies.get('recentThumbs') ;
                var vidList ="";
                var recentVideosArray = recentVideos.split(',');
                var recentVideosArray = recentVideosArray;
                var storeData = recentVideosArray;
                var arrayLength = storeData.length;
                
                $('#rt-data').attr('value',storeData.toString());
                
                for (var i = 0; i < arrayLength; i++) 
                {
                    $('#myRecentThumbs .responsive').append('<div class="col-md-4"><div class="blog-compact-item"><img src="https://i.ytimg.com/vi/'+storeData[i]+'/mqdefault.jpg" class=""></div></div>');
                }
            }
            else
            {
                $('#myRecentThumbs .responsive').html("<span class='msg'>No Data To Display !</span>");
            }
            
            $('body').on('click','.downloadimg', function()
            {
                var id = $(this).attr('data-link');
                $('input[name="t"]').val(id);
                $(".downloadimagesubmit").click();
                // alert();
            });
            
        <?php } ?>
        
        
        $("#CountrySelectorSidebar").change(function() 
        {
            var selectedVal = $(this).find(':selected').val();
            if (selectedVal != "default") 
            {
                $(this).attr('disabled','disabled');
                var url = '<?php echo $root; ?>/tools/top-youtube-channels.php?cc='+selectedVal;
                window.location = url;
            }
        });
        
        $("#trendingNowSelector").change(function() 
        {
            var selectedVal = $(this).find(':selected').val();
            var selectiontext = selectedVal.text();
            if (selectedVal != "default") 
            {
                $(this).attr('disabled','disabled');
                var url = '<?php echo $root; ?>/tools/youtube-trending-videos.php?cc='+selectedVal+'&value='+selectiontext;
                window.location = url;
            }
        });


    });
    
    (function ($) {
        $(function () {
    
        var agSlideFlickity = $('.js-flickity-slider').flickity({
            autoPlay: 2000,
            imagesLoaded: true,
            percentPosition: false,
            prevNextButtons: false,
            initialIndex: 5,
            pageDots: false,
            groupCells: 1
        });
    
        var agCard = agSlideFlickity.find('.js-carousel-cell .js-card-bg'),
            agTransform = 'string' == typeof document.documentElement.style.transform ? 'transform' : 'WebkitTransform',
            agSlide = agSlideFlickity.data('flickity');
    
        agSlideFlickity.on('scroll.flickity', function () {
            agSlide.slides.forEach(function (t, e) {
            var n = agCard[e],
                i = -1 * (t.target + agSlide.x) / 3;
    
            // n.style[agTransform] = 'translateX(' + i + 'px)';
            });
        });
    
        agSlideFlickity.on('dragStart.flickity', function (t, e) {
            document.ontouchmove = function (t) {
            t.preventDefault();
            }
        });
    
        agSlideFlickity.on('dragEnd.flickity', function (t, e) {
            document.ontouchmove = function (t) {
            return true;
            }
        });
    
        });
    })(jQuery);
    
//]]>
</script>

<script id="INLINE_PEN_JS_ID">
    var audio = document.getElementById("audio-player");

$(document).ready(function () {
  $("#play-button").click(function () {

    if ($("#mp3_player").hasClass('error')) {

        alert("Can't play this video !");

    }else{


    if ($(this).hasClass("unchecked")) {
      $(this).
      addClass("play-active").
      removeClass("play-inactive").
      removeClass("unchecked");
      $("#pause-button").
      children('.icon').
      addClass("icon-line-awesome-pause").
      removeClass("icon-feather-play");
      audio.play();
    } else {
      $(this).
      addClass("unchecked");
      $("#pause-button").
      children(".icon").
      addClass("icon-line-awesome-pause").
      removeClass("icon-feather-play");
      audio.pause();
    }


    }



  });
  $("#pause-button").click(function () {
    $(this).children(".icon").
    toggleClass("icon-line-awesome-pause").
    toggleClass("icon-feather-play");

    if (audio.paused) {
      audio.play();
    } else {
      audio.pause();
    }
  });
  $("#play-button").click(function () {
    if (!($("#mp3_player").hasClass('error'))) {

    setTimeout(function () {
      $("#play-button").children(".icon").
      toggleClass("icon-feather-play").
      toggleClass("icon-line-awesome-pause");
    }, 350);

    }

  });

});

function CreateSeekBar() {
  var seekbar = document.getElementById("audioSeekBar");
  seekbar.min = 0;
  seekbar.max = audio.duration;
  seekbar.value = 0;
}

function EndofAudio() {
  document.getElementById("audioSeekBar").value = 0;
}

function audioSeekBar() {
  var seekbar = document.getElementById("audioSeekBar");
  audio.currentTime = seekbar.value;
}

function SeekBar() {
  var seekbar = document.getElementById("audioSeekBar");
  seekbar.value = audio.currentTime;
}

audio.addEventListener("timeupdate", function () {
  var duration = document.getElementById("duration");
  var s = parseInt(audio.currentTime % 60);
  var m = parseInt(audio.currentTime / 60 % 60);
  duration.innerHTML = m + ':' + s;
}, false);

Waves.init();
Waves.attach("#play-button", ["waves-button", "waves-float"]);

  </script>