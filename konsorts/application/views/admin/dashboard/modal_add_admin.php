<form id="form-add-admin" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add New User</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">

            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" class="form-control" name="first_name">
                            <label>First Name</label>
                            <!--<span class="help-block">Some help goes here...</span>-->
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" class="form-control" name="username">
                            <label>Username</label>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="password" class="form-control" id="password" name="password">
                            <label>Password</label>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" class="form-control" name="facebook_link">
                            <label>Facebook Link</label>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" class="form-control" name="twitter_link">
                            <label>Linkedin Link</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" class="form-control" name="last_name">
                            <label>Last Name</label>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="email" class="form-control" name="email">
                            <label>Email</label>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="password" class="form-control" name="confirm_password">
                            <label>Confirm Password</label>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" class="form-control" name="twitter_link">
                            <label>Twitter Link</label>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" class="form-control" name="instagram_link">
                            <label>Instagram link</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="file" class="form-control" name="image">
                            <label for="form_control_1"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <textarea class="form-control" name="about_me"></textarea>
                            <label for="form_control_1">About Me</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn default">Close</button>
        <input type="submit" name="submit" value="Add" class="btn green">
    </div>
</form>