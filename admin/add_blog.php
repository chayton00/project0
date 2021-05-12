<?php 

include "inc/header.php";

error_reporting(0);

if(strlen($_SESSION['alogin'])==0)
{ 
    header('location:index.php');
}
else
{
  if (isset($_POST['addblog'])) 
  {
      $saveblog =  addBlog();
      if ($saveblog) 
      {
          $msg = "Blog added succesfully !";
      }
      else
      {
          $error = "Please try after sometime. There is some error occurred.";
      }
  }
}

$sql1 = "SELECT * from categories where status = 0;";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Blog</h1>
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
            <form method="POST" name="addblog" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Blog Title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="textediter" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10 mt-2">
                        <textarea class="" name="textediter" id="textediter"></textarea >
                    </div>                                
                </div>
                <div class="form-group row">
                    <label for="textediter" class="col-sm-2 col-form-label">Tags</label>
                    <div class="col-sm-10 mt-2">
                        <input type="text" class="form-control" name="tags" data-role="tagsinput" />
                    </div>                                
                </div>
                
                <div class="form-group row">
                  <label for="pstatus" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10 mt-2">
                    <select name="pstatus" class="form-control" id="pstatus"> 
                      <option value="0"> Published </option>
                      <option value="1"> Draft </option>
                    </select>
                  </div>                                
              </div>
              
              <div class="form-group row">
                  <label for="pstatus" class="col-sm-2 col-form-label">Publish on</label>
                  <div class="col-sm-10 mt-2">
                    <input type="date" name="post_on" class="form-control" id="post_on">
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
                                      echo '<option value="'.$results->id.'">'.$results->name.'</option>';
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
                      <input type="hidden" name="addblog" value="addblog">
                  </div>                                
              </div>
              <button type="submit" name="addblog" class="btn btn-primary btn-icon-split float-right">
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