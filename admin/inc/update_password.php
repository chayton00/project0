                <form method="POST" name="chngpwd" onSubmit="return valid();">
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="newpassword" id="newpassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword">
                        </div>
                    </div>

                    <button type="submit" name="updatePassword" class="btn btn-primary btn-icon-split float-right">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Save Changes</span>
                    </button>
                </form>   