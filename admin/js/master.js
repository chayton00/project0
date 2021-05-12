(function($){
	"use strict";
	function include(file) { 
  
	  var script  = document.createElement('script'); 
	  script.src  = file; 
	  script.type = 'text/javascript'; 
	  script.defer = true; 
	  
	  document.getElementsByTagName('head').item(0).appendChild(script); 
	  
	} 
	  
	/* Include Many js files */
// 	include('vendor/bootstrap/js/bootstrap.bundle.min.js'); 
// 	include('vendor/jquery-easing/jquery.easing.min.js'); 
// 	include('vendor/datatables/jquery.dataTables.min.js'); 
// // 	include('vendor/datatables/dataTables.bootstrap4.min.js'); 
// 	include('js/sb-admin-2.min.js'); 
// 	include('js/demo/datatables-demo.js'); 
// 	include('js/fileinput.js'); 
// 	include('vendor/country-picker/js/countrySelect.min.js'); 
// 	include('https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js'); 
// 	include('http://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js'); 
// 	include('js/tinymce.min.js'); 
	
	    
    
    function readURL(input, elemnt) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var ele = '#'+elemnt;
                $(ele).show();
                $(ele).attr('src', e.target.result);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function checkUserName(str,id) {
        if (str.length == 0) {
            document.getElementById("usernameError").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("usernameError").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "inc/validate.php?name=" + str +"&id=" +id, true);
            xmlhttp.send();
        }
    }
    
    function checkEmail(str,id) {
        if (str.length == 0) {
            document.getElementById("emailError").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("emailError").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "inc/validate.php?email=" + str + "&id=" +id, true);
            xmlhttp.send();
        }
    }
    
    $("#updateUser").click(function(e) {
        if ($('#usernameError').text() != "" || $('#emailError').text() != "") {
         
            
            return false;
        }
    });
    
    $("#addNewUser").click(function(e) {
        if ($('#usernameError').text() != "" || $('#emailError').text() != "" || ($('#password').val()).trim().length < "6" || ($('#username').val()).trim() == "") {

            if ((($('#password').val()).trim()).length < "6") {
                $('#passError').text('Password must be at least 6 characters !');
            }
            if($('#usernameError').text() == "" && ($('#username').val()).trim() < "4"){
               $('#usernameError').text('Username must be at least 4 characters !');
               }
            
            if($('#emailError').text() == "" && ($('#email').val()).trim() == ""){
               $('#emailError').text('Please provide a valid e mail Address');
               }            
            
            
            return false;
        }
    });

    $('form input[type=password],#username').on("keyup blur keypress",function(){
          if($('#passError').text() != '' ){
                    if ((($('form input[type=password]').val()).trim()).length >= "6") {
                $('#passError').text("");
            }
    }                         
              
          if($('#usernameError').text() == '' ){
                    if ((($('#username').val()).trim()).length >= "4") {
                $('#usernameError').text("");
            }
    }             
        
                                      
                                      
 });

        $(".removeLogo").click(function(){
        $("#siteLogoPreview").attr('src','');
        $('#imgStatus').attr('value','false');
        $(this).hide();
    });
    
        document.querySelectorAll('input[type=color]').forEach(function(picker) {

        var targetLabel = document.querySelector('label[for="' + picker.id + '"]'),
            codeArea = document.createElement('span');

        codeArea.innerHTML = picker.value;
        targetLabel.appendChild(codeArea);

        picker.addEventListener('change', function() {
            codeArea.innerHTML = picker.value;
            targetLabel.appendChild(codeArea);
        });
    });
    //# sourceURL=pen.js
    
    
    function updatecheck(data)
    {
        var current_version = data;
        
        $.ajax({
            url: 'http://atithiinfosoft.com/insta-tools/response.json?cversion='+current_version,
            type: "GET",
            dataType: "html",
            success: function(response) {
                var new_version = response.data.version;
                if(response.data.update){
                    if (current_version === new_version) {
                        $('.updates').append('No new update currently. You have latest version');
                    }
                    else
                    {
                        $('.updates').append('<p>New version available. Please click on download button<p><form><button type="button" data-link="'+response.data.donwloadlink+'">Dowbload</button>');
                    }    
                }
                else
                {
                    $('.updates').append('No new update currently. You have latest version');
                }
                
            }
        });
        
    }
    
})(jQuery)