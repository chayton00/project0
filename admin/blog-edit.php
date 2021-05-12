<?php 

include "inc/header.php";

error_reporting(0);

if(strlen($_SESSION['alogin'])==0)
{ 
    header('location:index.php');
}
else
{
  if (isset($_POST['editblog'])) 
  {
      $saveblog =  updateBlog();
      if ($saveblog) 
      {
          $msg = "Blog updated succesfully !";
      }
      else
      {
          $error = "Please try after sometime. There is some error occurred.";
      }
  }
}

$pageId = stripslashes($_GET['edit']);
$sql = "SELECT * from posts where id = :pageId";
$query = $dbh -> prepare($sql);
$query->bindParam(':pageId',$pageId,PDO::PARAM_INT);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);

$sql1 = "SELECT * from categories where status = 0;";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Blog</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
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
            <form method="POST" name="editblog" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" value="<?php echo $result->title; ?>" id="title" placeholder="Enter Blog Title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="textediter" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10 mt-2">
                        <textarea class="" name="textediter" id="textediter"><?php echo base64_decode(htmlentities($result->contents)); ?></textarea >
                    </div>                                
                </div>
                <div class="form-group row">
                    <label for="textediter" class="col-sm-2 col-form-label">Tags</label>
                    <div class="col-sm-10 mt-2">
                        <input type="text" class="form-control" name="tags" value="<?php echo $result->tags; ?>" data-role="tagsinput" />
                    </div>                                
                </div>
                
                <div class="form-group row">
                  <label for="pstatus" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10 mt-2">
                    <select name="pstatus" class="form-control" id="pstatus"> 
                      <option value="0" <?php if($result->pstatus == 0){ echo "selected"; } else {echo "";}?>> Published </option>
                      <option value="1" <?php if($result->pstatus == 1){ echo "selected"; } else {echo "";}?>> Draft </option>
                    </select>
                  </div>                                
              </div>
              
              <div class="form-group row">
                  <label for="pstatus" class="col-sm-2 col-form-label">Publish on</label>
                  <div class="col-sm-10 mt-2">
                    <input type="date" name="post_on" class="form-control" id="post_on" value="<?php echo $result->date_posted; ?>">
                  </div>                                
              </div>
              
              <div class="form-group row d-none">
                  <label for="metaKeywords" class="col-sm-2 col-form-label">Blog Category</label>
                  <div class="col-sm-10 mt-2">
                      <select name="cat_id" class="form-control" id="cat_id">
                          <?php 
                              if($query1->rowCount() > 0)
                              {
                                  foreach($results1 as $results)
                                  { 
                                      if($results->id == $result->cat_id)
                                          $selection = "selected";
                                      echo '<option value="'.$results->id.'" '.$selection.' >'.$results->name.'</option>';
                                  }
                              }
                          ?>
                      </select>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="textediter" class="col-sm-2 col-form-label">Blog Image</label>
                  <div class="col-sm-10 mt-2">
                      <input type="file" name="post_image" id="post_image">
                      <input type="hidden" name="editblog" value="editblog">
                      <input type="hidden" name="oldimag" value="<?php echo $result->post_image; ?>">
                      <input type="hidden" name="blogid" value="<?php echo $result->id; ?>">
                  </div>                                
              </div>
              <button type="submit" name="editblog" class="btn btn-primary btn-icon-split float-right">
                  <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                  </span>
                  <span class="text">Save Changes</span>
              </button>
          </form>   
      </div>
  </div>
</div>
</div>
</div>
<!-- End of Main Content -->
<?php include "inc/footer.php" ?>