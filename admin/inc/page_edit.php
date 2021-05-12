<?php 
    error_reporting(0);
    if (isset($_POST['savePage'])) 
    {
        $updated =  updatePage();
        if ($updated) 
        {
            $msg = "Page updated succesfully !";
        }
        else
        {
            $error = "Page Update Failed !";
        }
    }
    $pageId = stripslashes($_GET['edit']);
    $sql = "SELECT * from pages where id = :pageId";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':pageId',$pageId,PDO::PARAM_INT);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);
 ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Page</h1>
<div class="row">
  <div class="col-lg-12">
    <div class="card p-3">
      <?php if(isset($error)){?>
          <div class="alert alert-danger" role="alert">
              <?php echo htmlentities($error); ?>
          </div>
      <?php }else if(isset($msg)){?>
          <div class="alert alert-success" role="alert">
              <?php echo htmlentities($msg); ?>
          </div>
      <?php }?>
      <form method="POST" name="changSite" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Page Title" value="<?php echo htmlentities($result->title);?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="textediter" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10 mt-2">
                <textarea  class="" name="textediter" id="textediter" ><?php echo base64_decode(htmlentities($result->content));?></textarea >
            </div>                                
        </div>
        <div class="form-group row">
            <label for="Status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10 mt-2">
              <select name="status" class="form-control" id="status"> 
                <option value="0" <?php if($result->status == 0){ echo "selected"; } else {echo "";}?>> Active </option>
                <option value="1" <?php if($result->status == 1){ echo "selected"; } else {echo "";}?>> Inactive </option>
              </select>
            </div>                                
        </div>
        <hr>
        <h3 class="h3 mb-4 text-gray-800">SEO</h3>
        <hr>
        <div class="form-group row">
            <label for="metaKeywords" class="col-sm-2 col-form-label">Meta Data</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="metaKeywords" id="metaKeywords" placeholder="Meta Keywords" value="<?php echo htmlentities($result->meta_keywords);?>">
            </div>
            <label for="metaDescription" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10 mt-2">
                <textarea  class="form-control " name="metaDescription" id="metaDescription" rows="4" placeholder="Meta Description" ><?php echo htmlentities($result->meta_description);?></textarea >
            </div>                                
        </div>
        <button type="submit" name="savePage" class="btn btn-primary btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">Save Changes</span>
        </button>
      </form>   
    </div>
  </div>
</div>