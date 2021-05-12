<?php include "inc/header.php"; ?>

<?php
error_reporting(0);

if(strlen($_SESSION['alogin'])==0){	
    header('location:index.php');
}else{

    if(isset($_POST['saveProfile']))
    {	
        $pUpdatedStatus = updateAdminProfile();
        if($pUpdatedStatus){
            $msg="Profile Updated Successfully";
        }else{
            $error="Profile Update Failed !.";	
        }
    }

    if(isset($_POST['saveSocial']))
    {
        $pUpdatedstatus = updateSocialMedia();
        if($pUpdatedstatus){
            $msg="Social Details succesfully Updated !";
        }else{
            $error="Social Details Update Failed.";	
        }
    }

     if(isset($_POST['updatePassword']))
    {
        $pUpdatedstatus = updateAdminPassword();
        if($pUpdatedstatus){
            $msg="Your Password succesfully changed";
        }else{
            $error="Your current password is not valid.";   
        }
    }

    if(isset($_POST['saveSettings']))
    {
        $sUpdatedStatus = updateSettings();
        if($sUpdatedStatus){
            $msg="Settings Updated Successfully";
        }else{
            $error="Settings Update Failed !.";	
        }
    }


    $sql = "SELECT * from admin;";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $result_profile=$query->fetch(PDO::FETCH_OBJ);
    $img =  htmlentities($result_profile->image); 

    $sql = "SELECT * from settings where id = 1;";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);

    $img =  htmlentities($result->logoImg); 

    $sql1 = "SELECT * from settings where id = 2;";
    $query1 = $dbh -> prepare($sql1);
    $query1->execute();
    $result1=$query1->fetch(PDO::FETCH_OBJ);
    $color = $result1->logoTxt;
    
}
?>





<script type="text/javascript">
    function valid() {
		"use strict";
        if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
            alert("New Password and Confirm Password Field do not match  !!");
            document.chngpwd.confirmpassword.focus();
            return false;
        }
        return true;
    }

</script>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Settings</h1>


    <div class="row">
        <div class="col-lg-3">
            <div class="card p-3">

                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" data-toggle="pill" href="#profile" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a>
                    <a class="nav-link" data-toggle="pill" href="#changePassword" role="tab" aria-controls="changePassword" aria-selected="false">Change Password</a>
                    <a class="nav-link" data-toggle="pill" href="#siteSettings" role="tab" aria-controls="siteSettings" aria-selected="false">Site Settings</a>
                    <!--<a class="nav-link" data-toggle="pill" href="#frontendSettings" role="tab" aria-controls="frontendSettings" aria-selected="false">Frontend Settings</a>-->
                    <a class="nav-link" id="v-pills-socialMedia-tab" data-toggle="pill" href="#socialMedia" role="tab" aria-controls="v-pills-messages" aria-selected="false">Social </a>
                    <a class="nav-link" id="v-pills-backupDB-tab" data-toggle="pill" href="#backupDB" role="tab" aria-controls="v-pills-messages" aria-selected="false">Backup</a>
                    <a class="nav-link" id="v-pills-updatecheck-tab" data-toggle="pill" href="#updatecheck" role="tab" aria-controls="v-pills-messages" aria-selected="false">Check for update</a>
                
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card p-3">
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile">
                        <?php include "inc/update_profile.php" ?>
                    </div>
                    <!--/. profile-->

                    <div class="tab-pane fade" id="changePassword" role="" aria-labelledby="changePassword">
                        <?php include "inc/update_password.php" ?>
                    </div>
                    <!--/. password-->

                    <div class="tab-pane fade" id="siteSettings" role="" aria-labelledby="v-pills-siteSettings-tab">
                        <?php include "inc/update_settings.php" ?>
                    </div>
                    <!--/. siteSettings-->

                    <!--<div class="tab-pane fade" id="frontendSettings" role="" aria-labelledby="v-pills-frontendSettings-tab">-->
                    <!--    <?php include "inc/update_frontedsettings.php" ?>-->
                    <!--</div>-->
                    <!--/. frontendSettings-->    

                    <div class="tab-pane fade" id="backupDB" role="" aria-labelledby="v-pills-backupDB-tab">
                      Backup your database <a href="inc/backup.php">backup now</a>
                    </div>

                    <!--/. SocialMedia-->

                    <div class="tab-pane fade" id="socialMedia" role="" aria-labelledby="v-pills-socialMedia-tab">
                      <?php include "inc/update_social.php" ?>
                    </div>

                     <div class="tab-pane fade" id="updatecheck" role="" aria-labelledby="v-pills-updatecheck-tab">
                      <?php include "updatecheck.php" ?>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<?php include "inc/footer.php" ?>