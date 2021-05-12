<?php include "inc/header.php"; ?>





<?php 
error_reporting(0);


if(isset($_POST['adsSave'])){

    $bannerContent = base64_encode($_POST['bannerContent']);
    $bannerSidebar = base64_encode($_POST['bannerSidebar']);
    $bannerTop = base64_encode($_POST['bannerTop']);
    $popads = base64_encode($_POST['popads']);
    $bc ='banner-content';
    $bs = 'banner-sidebar';
    $bt = 'banner-top';
    $pa = 'popads';

    $sql="UPDATE ads SET ad_code=(:bannerTop) WHERE ad_type=:ad_type ";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':bannerTop', $bannerTop, PDO::PARAM_STR);
    $query-> bindParam(':ad_type', $bt, PDO::PARAM_STR);
    $query->execute();

    $sql="UPDATE ads SET ad_code=(:bannerContent) WHERE ad_type=:ad_type ";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':bannerContent', $bannerContent, PDO::PARAM_STR);
    $query-> bindParam(':ad_type', $bc, PDO::PARAM_STR);
    $query->execute();

    $sql="UPDATE ads SET ad_code=(:bannerSidebar) WHERE ad_type=:ad_type";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':bannerSidebar', $bannerSidebar, PDO::PARAM_STR);
    $query-> bindParam(':ad_type', $bs, PDO::PARAM_STR);
    $query->execute(); 

    $sql="UPDATE ads SET ad_code=(:popads) WHERE ad_type=:ad_type  ";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':popads', $popads, PDO::PARAM_STR);
    $query-> bindParam(':ad_type', $pa, PDO::PARAM_STR);
    $query->execute(); 

    $msg="Settings Updated Successfully";

}





$sql = "SELECT * from  ads ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0){
    foreach($results as $result){
        $adType =  htmlentities($result->ad_type);
        if(strpos($adType, 'banner-content') !== false){
            $bannerContent = base64_decode(htmlentities($result->ad_code));
        }elseif(strpos($adType, 'banner-sidebar') !== false){
            $bannerSidebar = base64_decode(htmlentities($result->ad_code));
        }elseif(strpos($adType, 'banner-top') !== false){
            $bannerTop = base64_decode(htmlentities($result->ad_code));
        }else{
            $popAds = base64_decode(htmlentities($result->ad_code));
        }
    }
}









?>








<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Settings</h1>


    <div class="row">

        <div class="col-lg-12">
            <div class="card w-100">
                <div class="card-body">
                   
                        <?php if($error){?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlentities($error); ?>
                        </div>
                        <?php }else if($msg){?>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlentities($msg); ?>
                        </div>
                        <?php }?>
                   
                   
                    <form action="" method="POST">

                        <div class="form-group row">
                            <label for="bannerTop" class="col-sm-2 col-form-label">Header Ads</label>
                            <div class="col-sm-10 mt-2">
                                <textarea  class="form-control " name="bannerTop" id="bannerTop" rows="8" placeholder="Ad code" ><?php echo $bannerTop ?></textarea >
                                <small class="text-danger">Ads bannner for header : 728*90</small>
                            </div>                                
                        </div>


                        <div class="form-group row">
                            <label for="bannerContent" class="col-sm-2 col-form-label">Content Ads</label>
                            <div class="col-sm-10 mt-2">
                                <textarea  class="form-control " name="bannerContent" id="bannerContent" rows="8" placeholder="Ad code" ><?php echo $bannerContent; ?></textarea >
                                <small class="text-danger">Ads bannner for content : 728 * xxx</small>
                            </div>                                
                        </div>

                        <div class="form-group row d-none">
                            <label for="bannerSidebar" class="col-sm-2 col-form-label">Sidebar Ads</label>
                            <div class="col-sm-10 mt-2">
                                <textarea  class="form-control " name="bannerSidebar" id="bannerSidebar" rows="8" placeholder="Ad code" ><?php echo $bannerSidebar; ?></textarea >
                                <small class="text-danger">Ads bannner for sidebar : 300 * xxx</small>
                            </div>                                
                        </div>

                        <div class="form-group row">
                            <label for="popads" class="col-sm-2 col-form-label">Pop Ads</label>
                            <div class="col-sm-10 mt-2">
                                <textarea  class="form-control " name="popads" id="popads" rows="8" placeholder="Ad code" ><?php echo $popAds; ?></textarea >
                                <small class="text-danger">Popads code</small>
                            </div>                                
                        </div>                        








                        <button class="btn btn-primary btn-icon-split float-right" name="adsSave" type="submit">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Save changes</span>
                        </button>





                    </form>
                </div>
            </div>



            </col-lg-12>









    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->









<?php include "inc/footer.php" ?>