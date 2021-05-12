<?php include "inc/header.php"; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Post 
    <a href="add_blog.php" class="btn btn-primary btn-icon-split float-right">Add Post</a>
  </h1>
  <?php
        $sql1 = "SELECT COUNT(id) as ids from posts where status NOT IN (3,4)";
        $query1 = $dbh -> prepare($sql1);
        $query1->execute();
        $results1=$query1->fetchAll(PDO::FETCH_OBJ);
        
        $sql2 = "SELECT COUNT(id) as ids from posts where pstatus = 0 AND status NOT IN (3,4)";
        $query2 = $dbh -> prepare($sql2);
        $query2->execute();
        $results2=$query2->fetchAll(PDO::FETCH_OBJ);
        
        $sql3 = "SELECT COUNT(id) as ids from posts where pstatus = 1 AND status NOT IN (3,4)";
        $query3 = $dbh -> prepare($sql3);
        $query3->execute();
        $results3=$query3->fetchAll(PDO::FETCH_OBJ);
        
        $sql4 = "SELECT COUNT(id) as ids from posts where status = 3";
        $query4 = $dbh -> prepare($sql4);
        $query4->execute();
        $results4=$query4->fetchAll(PDO::FETCH_OBJ);
  ?>
  
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All Posts</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $results1[0]->ids; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Published</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $results2[0]->ids; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Drafts</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $results3[0]->ids; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        
      <div class="card border-left-warning shadow h-100 py-2">
        <a href="blog-trash.php" style="text-decoration:none;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Trash</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $results4[0]->ids; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>
    
  </div>
  
  <div class="card  mb-4">
    <div class="card-body">
        <?php
        if(isset($_POST['statusupdate']))
        {
            $updated = updateBlogStatua();
            if($_POST['is_deleted'] == "Y")
            {
                if ($updated) 
                {
                    $msg = "Post deleted succesfully !";
                }
                else
                {
                    $error = "Post delete failed !";
                }
            }
            else
            {
                if ($updated) 
                {
                    $msg = "Post status updated succesfully !";
                }
                else
                {
                    $error = "Post status updated failed !";
                }
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
                <th>Title</th>
                <!--<th class="text-center">Status</th>-->
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $sql = "SELECT * from  posts where status NOT IN (3,4)";
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
                <td><?php echo $result->title;?></td>
                <!--<td class="text-center">-->
                <!--    <a href="javascript:void(0)" onClick="activeinactive(<?php echo htmlentities($result->id);?>,<?php echo $result->status;?>)" id="actinct" data-id="<?php echo htmlentities($result->id);?>" data-statu="<?php echo $result->status;?>">-->
                <!--    <span class="badge badge-<?php if($result->status == 0 || $result->status == 3 ) { echo "success"; } elseif($result->status == 1 || $result->status == 2 ) {echo "danger";} ?>">-->
                <!--        <?php if($result->status == 0) { echo "Active"; } elseif($result->status == 1) {echo "Inactive";} elseif($result->status == 2) {echo "Draft";} elseif($result->status == 3) {echo "Published";} ?>-->
                <!--        </span>-->
                <!--    </a></td>-->
                    <td class="text-center">
                    <span class="badge badge-<?php if($result->pstatus == 0 ) { echo "success"; } else {echo "danger";} ?>">
                        <?php if($result->pstatus == 1) {echo "Draft";} else {echo "Published";} ?>
                        </span>
                  </td>
                <td class="text-center">
                  <span class="badge "><a href="blog-edit.php?edit=<?php echo $result->id;?>" class="pr-3 border-right"><i class="fas fa-edit"></i> Edit</a></span>
                  <span class="badge "><a href="javascript:void(0)" onClick="deleteblog(<?php echo htmlentities($result->id);?>,3)" id="actinct" data-id="<?php echo htmlentities($result->id);?>" data-statu="3" class="text-info"><i class="fas fa-eye"></i> Delete</a></span>
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
    <input type="hidden" name="is_deleted" value="Y">
    <input type="hidden" name="statusupdate" value="statusupdate">
    <button type="submit" name="statusupdate"></button>
</form>


<?php include "inc/footer.php" ?>