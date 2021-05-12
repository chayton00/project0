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
                                <label for="username" class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fb" id="social_fb" value="<?php echo urldecode(htmlentities($result_profile->social_fb));?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tw" id="social_tw" value="<?php echo urldecode(htmlentities($result_profile->social_tw));?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Youtube</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="you" id="social_you" value="<?php echo urldecode(htmlentities($result_profile->social_you));?>">
                                </div>
                            </div>



                            

                            <button type="submit" name="saveSocial" class="btn btn-primary btn-icon-split float-right">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Save Changes</span>
                            </button>
                        </form>