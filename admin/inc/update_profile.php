                        <?php if($error){?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlentities($error); ?>
                        </div>
                        <?php }else if($msg){?>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlentities($msg); ?>
                        </div>
                        <?php }?>


                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="username" value="<?php echo htmlentities($result_profile->username);?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlentities($result_profile->email);?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Profile image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" name="image" id="">
                                </div>
                            </div>

                            <button type="submit" name="saveProfile" class="btn btn-primary btn-icon-split float-right">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Save Changes</span>
                            </button>
                        </form>