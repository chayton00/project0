
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy;  2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="inc/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script src="js/fileinput.js"></script>
<script src="vendor/country-picker/js/countrySelect.min.js"></script>
<script src='js/tinymce.min.js'></script>
<script src='js/tags.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js'></script>
<script>
    
    $(document).ready(function() {
    $('#userList').DataTable( {
        "order": [[ 0, "asc" ]]
    } );
} );
    
<?php 
    
    
    
    if(isset($_GET['source']) && isset($_GET['id'])){
        
        
        echo '$("#country_selector").countrySelect({
  defaultCountry: "'.htmlentities($result->country).'"
});';
        
        
    }
    
    ?>
    

    
    
    $("#country_selector").countrySelect();

    var countryData = $("#country_selector").countrySelect("getSelectedCountryData");


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

</script>



<script>
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

</script>

<script>
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

</script>

<script>
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
        var url = 'inc/ajax.php?checkupdate=update&cversion='+current_version; 
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            success: function(response) {
                var new_version = response.version;
                if(response.update){ 
                    if (current_version === new_version) {
                        $('.updates').append('No new update currently. You have latest version');
                    }
                    else
                    {
                        $('.updates').append('<p>New version available. Please click on download button</p><form id="updateversion" name="changSite" method="post"> <input type="hidden" name="logoTxt" value="'+response.version+'"><input type="hidden" name="id" value="3"><button class="btn btn-primary btn-icon-split float-right" data-link="'+response.donwloadlink+'" data-version="'+response.version+'" onClick="updatedownload()" id="downloadforupdate" name="codeSave" type="button"><span class="text">Download Update</span></button><button type="submit" style="display:none;" name="codeSaveee"></button></form>'+response.descriptions);
                    }    
                }
                else
                {
                    $('.updates').append('No new update currently. You have latest version');
                }
            }
        });
        
    }
    
    function Ticker( elem ) {
    	elem.lettering();
    	this.done = false;
    	this.cycleCount = 5;
    	this.cycleCurrent = 0;
    	this.chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()-_=+{}|[]\\;\':"<>?,./`~'.split('');
    	this.charsCount = this.chars.length;
    	this.letters = elem.find( 'span' );
    	this.letterCount = this.letters.length;
    	this.letterCurrent = 0;
    
    	this.letters.each( function() {
    		var $this = $( this );
    		$this.attr( 'data-orig', $this.text() );
    		$this.text( '-' );
    	});
    }
    
    Ticker.prototype.getChar = function() {
    	return this.chars[ Math.floor( Math.random() * this.charsCount ) ];
    };
    
    Ticker.prototype.reset = function() {
    	this.done = false;
    	this.cycleCurrent = 0;
    	this.letterCurrent = 0;
    	this.letters.each( function() {
    		var $this = $( this );
    		$this.text( $this.attr( 'data-orig' ) );
    		$this.removeClass( 'done' );
    	});
    	this.loop();
    };
    
    Ticker.prototype.loop = function() {
    	var self = this;
    
    	this.letters.each( function( index, elem ) {
    		var $elem = $( elem );
    		if( index >= self.letterCurrent ) {
    			if( $elem.text() !== ' ' ) {
    				$elem.text( self.getChar() );
    				$elem.css( 'opacity', Math.random() );
    			}
    		}
    	});
    
    	if( this.cycleCurrent < this.cycleCount ) {
    		this.cycleCurrent++;
    	} else if( this.letterCurrent < this.letterCount ) {
    		var currLetter = this.letters.eq( this.letterCurrent );
    		this.cycleCurrent = 0;
    		currLetter.text( currLetter.attr( 'data-orig' ) ).css( 'opacity', 1 ).addClass( 'done' );
    		this.letterCurrent++;
    	} else {
    		this.done = true;
    	}
    
    	if( !this.done ) {
    		requestAnimationFrame( function() {
    			self.loop();
    		});
    	} else {
    		setTimeout( function() {
    			self.reset();
    		}, 750 );
    	}
    };
    
    $words = $( '.word' );
    
    $words.each( function() {
    	var $this = $( this ),
    		ticker = new Ticker( $this ).reset();
    	$this.data( 'ticker', ticker  );
    });
    
    
    function updatedownload()
    {
        var current_version = $('#downloadforupdate').attr('data-link');
        var new_version = $('#downloadforupdate').attr('data-version');
        var url = 'inc/ajax.php?downloadupdate=download&nurl='+current_version+'&newversion='+new_version; 
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            beforeSend: function(msg){
                $(".updates").append('<div class="word">DOWNLOADING UPDATE...</div><div class="overlay"></div>');
            },
            success: function(response) {
                $(".word").addClass('d-none');
                $(".overlay").addClass('d-none');
                if(response == 1){
                    $('.updates').append('Version updated successfully.');
                    setTimeout(function(){ $('#updateversion').submit(); }, 5000);
                }
            else{
                $('.updates').append('Version not updated successfully. Please try after sometime');
            }
            }
        });
        
    }

    function activeinactive(id,status)
    {
        console.log(id +" | "+ status);
        var url;
        if(status === 0)
        {
            url = 1;
        }
        else
        {
            url = 0;
        }
        
        $('input[name="id"]').val(id);
        $('input[name="status"]').val(url);
            $('#statusupdate').submit();    
    }
    
    function deleteblog(id,status)
    {
        var r = confirm("Are you sure, you want to delete this record!");
        if (r == true) {
           $('input[name="id"]').val(id);
            $('input[name="status"]').val(status);
            $('input[name="is_deleted"]').val("Y");
            $('#statusupdate').submit(); 
        }
          

    }

    
    
    $(function() {
  $('input, select').on('change', function(event) {
    var $element = $(event.target),
      $container = $element.closest('.example');

    if (!$element.data('tagsinput'))
      return;

    var val = $element.val();
    if (val === null)
      val = "null";
    $('code', $('pre.val', $container)).html( ($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\"") );
    $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));
  }).trigger('change');
});

    tinymce.init({
  selector: '#textediter',
  height: 400,
  menubar: true,
  plugins: [
  'advlist autolink lists link image charmap print preview anchor textcolor',
  'searchreplace visualblocks code fullscreen',
  'insertdatetime media table contextmenu paste code help wordcount'],

  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
  '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
  '//www.tinymce.com/css/codepen.min.css'] });

</script>




</body>

</html>
