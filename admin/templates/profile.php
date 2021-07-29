<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">My Profile</h3>
            <p class="animated fadeInDown">
                Actions <span class="fa-angle-right fa"></span> My Profile
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
        <div>
            <table class="table table-striped table-sm table-responsive-md table-responsive-sm">
                <tbody>
                    <tr>
                        <td>Name : </td>
                        <td><?php echo admin_name($_SESSION['admin']); ?></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><?php echo $_SESSION['admin']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number :</td>
                        <td><?php echo $result['admin_phone']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="admin.php?edit_profile" class="submit btn btn-primary">Edit</a>
        </div>
    </div>
</div>