<?php 
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){	 
    header('location:index.php');
}else{
    $sql = "SELECT * from settings where id = 3 ";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetch(PDO::FETCH_OBJ);
    
    if($query->rowCount() > 0){
     $current_version = $results->logoTxt;
    }
}


?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Check for update  
        <button class="btn btn-primary btn-icon-split float-right" onClick="updatecheck(<?php echo $current_version; ?>)" id="checkforupdate" name="codeSave" type="button">
            <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
            </span>
            <span class="text">Check for update</span>
        </button>
    </h1> 
    
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Current Version :: <b><?php echo $current_version; ?></b></h6>
                </div>
            </div>
            <div class="card w-100">
                <div class="card-body updates">
                       
                </div>
            </div>
        </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
</div>
<!-- End of Main Content -->
