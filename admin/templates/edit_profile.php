<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Edit Profile</h3>
            <p class="animated fadeInDown">
                Actions <span class="fa-angle-right fa"></span> Edit Profile
            </p>
        </div>
    </div>
</div>
<?php
$admin = query("SELECT * FROM admin WHERE admin_email = '$_SESSION[admin]' LIMIT 1");
$result = fetch_array($admin);
?>
<div class="panel-body">
    <div class="col-md-12">
        <form class="cmxform" id="signupForm" method="POST" action="">
            <div class="col-md-12">
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="admin_name" value="<?php echo $result['admin_name']; ?>" required>
                    <span class="bar"></span>
                    <label>Admin Name</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="email" class="form-text" name="admin_email" value="<?php echo $result['admin_email']; ?>" required>
                    <span class="bar"></span>
                    <label>Email Address</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="admin_phone" value="<?php echo $result['admin_phone']; ?>" required>
                    <span class="bar"></span>
                    <label>Phone Number</label>
                </div>
            </div>
            <div class="col-md-12">
                <input class="submit btn btn-primary" name="edit_profile" type="submit" value="Edit Profile">
            </div>
        </form>
    </div>
</div>