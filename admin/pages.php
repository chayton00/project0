<?php include "inc/header.php"; ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
    <?php 
        if (isset($_GET['edit'])) 
        {
            include "inc/page_edit.php";
        }
        else
        {
            if(isset($_POST['statusupdate'])){
                $updated =  updatePageStatua();
                if ($updated) 
                {
                    $msg = "Page status succesfully !";
                }
                else
                {
                    $error = "Page status Failed !";
                }
            }
    ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">All Pages</h1>
    <div class="card  mb-4">
        <div class="card-body">
            <?php if(isset($error)){?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlentities($error); ?>
                </div>
            <?php }else if(isset($msg)){?>
                <div class="alert alert-success" role="alert">
                    <?php echo htmlentities($msg); ?>
                </div>
            <?php }?>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#id</th>
                    <th>Page</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql = "SELECT * from  pages where type = 1 ";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {       
                  ?>  
                  <tr>
                    <td><?php echo htmlentities($result->id);?></td>
                    <td><?php echo htmlentities($result->name);?></td>
                    <td class="text-center"><a href="javascript:void(0)" onClick="activeinactive(<?php echo htmlentities($result->id);?>,<?php echo $result->status;?>)" id="actinct" data-id="<?php echo htmlentities($result->id);?>" data-statu="<?php echo $result->status;?>">
                        <span class="badge badge-<?php if($result->status == 0) { echo "success"; } else {echo "danger";} ?>"><?php if($result->status == 0) { echo "Active"; } else {echo "Inactive";} ?></span>
                        </a>
                    </td>
                    <td class="text-center">
                      <span class="badge "><a href="pages.php?edit=<?php echo htmlentities($result->id);?>" class="pr-3 border-right"><i class="fas fa-edit"></i> Edit</a></span>
                      <span class="badge "><a href="../<?php echo htmlentities($result->url);?>" class="text-info" target="_blank"><i class="fas fa-eye"></i> View</a></span>
                    </td>
                  </tr>                 
                  <?php  } } ?>
                </tbody>
              </table>
            </div>
        </div>
    </div>
<?php } ?>
<form style="display:none;" id="statusupdate" method="post">
    <input type="hidden" name="id" value="">
    <input type="hidden" name="status" value="">
    <input type="hidden" name="statusupdate" value="statusupdate">
    <button type="submit" name="statusupdate" value="statusupdate"></button>
</form>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include "inc/footer.php" ?>