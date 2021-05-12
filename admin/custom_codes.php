<?php include "inc/header.php"; ?>





<?php 
error_reporting(0);


if(isset($_POST['codeSave'])){

    $headerCode = base64_encode($_POST['headerCode']);
    $footerCode = base64_encode($_POST['footerCode']);

    $hc ='header';
    $fc = 'footer';


    $sql="UPDATE custom_codes SET content=(:headerCode) WHERE id=:id ";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':headerCode', $headerCode, PDO::PARAM_STR);
    $query-> bindParam(':id', $hc, PDO::PARAM_STR);
    $query->execute();

    $sql="UPDATE custom_codes SET content=(:footerCode) WHERE id=:id ";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':footerCode', $footerCode, PDO::PARAM_STR);
    $query-> bindParam(':id', $fc, PDO::PARAM_STR);
        $status = $query->execute();
        if ($status) {
            $msg="Settings Updated Successfully";
        }else{
            $error="Error";
        }


   

}





$sql = "SELECT * from  custom_codes ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0){

    foreach($results as $result){

        $codeType =  htmlentities($result->id);

        if(strpos($codeType, 'header') !== false){
            $headerCode = base64_decode(htmlentities($result->content));
        }else{
            $footerCode = base64_decode(htmlentities($result->content));
       
        }  




    }




}









?>








<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Custom Codes</h1>


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
                            <label for="bannerTop" class="col-sm-2 col-form-label">Insert Header</label>
                            <div class="col-sm-10 mt-2">
                                <textarea  class="form-control " name="headerCode" id="bannerTop" rows="8" placeholder="HTML/CSS codes" ><?php echo $headerCode; ?></textarea >
                            </div>                                
                        </div>


                        <div class="form-group row">
                            <label for="bannerSidebar" class="col-sm-2 col-form-label">Insert Footer</label>
                            <div class="col-sm-10 mt-2">
                                <textarea  class="form-control " name="footerCode" id="bannerSidebar" rows="8" placeholder="Javascript codes" ><?php echo $footerCode; ?></textarea >
                            </div>                                
                        </div>

                   








                        <button class="btn btn-primary btn-icon-split float-right" name="codeSave" type="submit">
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