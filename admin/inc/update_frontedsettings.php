<form method="POST" name="changSite" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="siteTitle" class="col-sm-2 col-form-label">Choose Color</label>
        <div class="col-sm-10">
            <select name="logoTxt" class="form-control">
                <option value="1" <?php if($color == "1"){ echo "selected"; } else { echo "";} ?>>Blue</option>
                <option value="2" <?php if($color == "2"){ echo "selected"; } else { echo "";} ?>>Red</option>
                <option value="3" <?php if($color == "3"){ echo "selected"; } else { echo "";} ?>>Green</option>
                <option value="4" <?php if($color == "4"){ echo "selected"; } else { echo "";} ?>>Purple</option>
            </select>
            <input type="hidden" name="id" value="2">
        </div>
    </div>

    <button type="submit" name="saveSettings" class="btn btn-primary btn-icon-split float-right">
        <span class="icon text-white-50">
            <i class="fas fa-check"></i>
        </span>
        <span class="text">Save Changes</span>
    </button>
</form>   