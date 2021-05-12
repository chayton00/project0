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
      $saveblog =  updateCategory();
      if ($saveblog) 
      {
          $msg = "Category updated succesfully !";
      }
      else
      {
          $error = "Please try after sometime. There is some error occurred.";
      }
  }
}

$pageId = stripslashes($_GET['edit']);
$sql = "SELECT * from categories where id = :pageId";
$query = $dbh -> prepare($sql);
$query->bindParam(':pageId',$pageId,PDO::PARAM_INT);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);
?>

<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Category</h1>
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
                    <label for="title" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="<?php echo $result->name; ?>" id="title" placeholder="Enter category name" required>
                    </div>
                </div>
                
              <button type="submit" name="editblog" class="btn btn-primary btn-icon-split float-right">
                  <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                  </span>
                  <input type="hidden" name="id" value="<?php echo $result->id; ?>">
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