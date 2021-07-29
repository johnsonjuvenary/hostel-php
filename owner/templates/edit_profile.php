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
$owner = query("SELECT * FROM owner WHERE owner_email = '$_SESSION[hostel_owner]' LIMIT 1");
$result = fetch_array($owner);
?>
<div class="panel-body">
    <div class="col-md-12">
        <form class="cmxform" id="signupForm" method="POST" action="">
            <div class="col-md-12">
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="owner_name" value="<?php echo $result['owner_name']; ?>" required>
                    <span class="bar"></span>
                    <label>Owner Name</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="email" class="form-text" name="owner_email" value="<?php echo $result['owner_email']; ?>" required>
                    <span class="bar"></span>
                    <label>Email Address</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="owner_phone" value="<?php echo $result['owner_phone']; ?>" required>
                    <span class="bar"></span>
                    <label>Phone Number</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="owner_address" value="<?php echo $result['owner_address']; ?>" required>
                    <span class="bar"></span>
                    <label>Address</label>
                </div>
            </div>
            <div class="col-md-12">
                <input class="submit btn btn-primary" name="edit_profile" type="submit" value="Edit Profile">
            </div>
        </form>
    </div>
</div>