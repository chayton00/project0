<form method="POST" name="changSite" enctype="multipart/form-data">


    <div class="form-group row">
        <label for="siteTitle" class="col-sm-2 col-form-label">Site Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="siteTitle" id="siteTitle" value="<?php echo htmlentities($result->siteTitle); ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="metaKeywords" class="col-sm-2 col-form-label">Meta Data</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="metaKeywords" id="metaKeywords" placeholder="Meta Keywords" value="<?php echo htmlentities($result->metaKeywords); ?>">
        </div>
        <label for="metaDescription" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10 mt-2">
            <textarea  class="form-control " name="metaDescription" id="metaDescription" rows="4" placeholder="Meta Description" ><?php echo htmlentities($result->metaDescription); ?></textarea >
        </div>                                
    </div>

    <div class="form-group row">
        <label for="logoTxt" class="col-sm-2 col-form-label">Site Logo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="logoTxt" id="logoTxt" value="<?php echo htmlentities($result->logoTxt); ?>"  >
        </div>
        <label for="" class="col-sm-2 col-form-label mt-3"></label>
        <div class="col-sm-10 mt-3">
            <p><i>Or</i></p>
            <input type="file" class="form-control-file" name="logoImg" id=""  onchange="readURL(this,'siteLogoPreview')">
            <img src="uploads/<?php echo htmlentities($result->logoImg); ?>" id="siteLogoPreview" alt="" width="100" >
            <?php 

            if(htmlentities($result->logoImg) != ""){ ?>
                <input type="text" class="d-none" id="imgStatus"  name="imgStatus" value="true">
                    <a href="javascript:void(0)" class="text-danger removeLogo">Remove</a>
           
            <?php 
            }


            ?>

        </div>                                
    </div>                             
    <div class="form-group row">
        <label for="siteTitle" class="col-sm-2 col-form-label">Theme Color</label>
        <div class="col-sm-10">
            <select name="logoTxttheame" class="form-control">
                <option value="1" <?php if($color == "1"){ echo "selected"; } else { echo "";} ?>>Blue</option>
                <option value="2" <?php if($color == "2"){ echo "selected"; } else { echo "";} ?>>Red</option>
                <option value="3" <?php if($color == "3"){ echo "selected"; } else { echo "";} ?>>Green</option>
                <option value="4" <?php if($color == "4"){ echo "selected"; } else { echo "";} ?>>Purple</option>
            </select>
            <input type="hidden" name="thid" value="2">
        </div>
    </div>

    <div class="form-group row">
        <label for="footer" class="col-sm-2 col-form-label">Footer</label>
        <div class="col-sm-10">
            <textarea  class="form-control " name="footer" id="footer" rows="4" placeholder="footer copyright" ><?php echo base64_decode(htmlentities($result->footer)); ?></textarea >
        </div>                                
    </div>


            <input type="hidden" name="id" value="1">











    <button type="submit" name="saveSettings" class="btn btn-primary btn-icon-split float-right">
        <span class="icon text-white-50">
            <i class="fas fa-check"></i>
        </span>
        <span class="text">Save Changes</span>
    </button>
</form>   