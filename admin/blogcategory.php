<?php include "inc/header.php"; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Category 
    <a href="add_blog_category.php" class="btn btn-primary btn-icon-split float-right">Add Category</a>
  </h1>
  <div class="card  mb-4">
    <div class="card-body">
        <?php
        if(isset($_POST['statusupdate']))
        {
            $updated = updateBlogCategoryStatus();
            if ($updated) 
            {
                $msg = "Category status updated succesfully !";
            }
            else
            {
                $error = "Category status updated failed !";
            }
        }
        if(isset($_GET['del']))
        {
            $updated = updateBlogCategoryStatua($_GET['id'],3);
            if ($updated) 
            {
                $msg = "Category deleted succesfully !";
            }
            else
            {
                $error = "Category deleted failed !";
            }
        }
        ?>
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
                <th>Name</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $sql = "SELECT * from  categories where status <> 3";
              $query = $dbh -> prepare($sql);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              if($query->rowCount() > 0)
              {
                foreach($results as $result)
                {       
              ?>  
              <tr>
                <td><?php echo $result->id;?></td>
                <td><?php echo $result->name;?></td>
                <td class="text-center">
                    <a href="javascript:void(0)" onClick="activeinactive(<?php echo htmlentities($result->id);?>,<?php echo $result->status;?>)" id="actinct" data-id="<?php echo htmlentities($result->id);?>" data-statu="<?php echo $result->status;?>">
                    <span class="badge badge-<?php if($result->status == 0 || $result->status == 3 ) { echo "success"; } elseif($result->status == 1 || $result->status == 2 ) {echo "danger";} ?>">
                        <?php if($result->status == 0) { echo "Active"; } elseif($result->status == 1) {echo "Inactive";} elseif($result->status == 2) {echo "Draft";} elseif($result->status == 3) {echo "Published";} ?>
                        </span>
                    </a></td>
                <td class="text-center">
                  <span class="badge "><a href="edit_blog_category.php?edit=<?php echo $result->id;?>" class="pr-3 border-right"><i class="fas fa-edit"></i> Edit</a></span>
                  <span class="badge "><a href="blogcategory.php?del=delete&id=<?php echo $result->id;?>" class="text-info"><i class="fas fa-eye"></i> Delete</a></span>
                </td>
              </tr>
            <?php  }} ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<form style="display:none;" id="statusupdate" method="post">
    <input type="hidden" name="id" value="">
    <input type="hidden" name="status" value="">
    <input type="hidden" name="statusupdate" value="statusupdate">
    <button type="submit" name="statusupdate"></button>
</form>


<?php include "inc/footer.php" ?>