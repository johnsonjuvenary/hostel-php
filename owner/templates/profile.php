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
$owner = query("SELECT * FROM owner WHERE owner_email = '$_SESSION[hostel_owner]' LIMIT 1");
$result = fetch_array($owner);
?>
<div class="panel-body">
    <div class="col-md-12">
        <div>
            <table class="table table-striped table-sm table-responsive-md table-responsive-sm">
                <tbody>
                    <tr>
                        <td>Name : </td>
                        <td><?php echo owner_name($_SESSION['hostel_owner']); ?></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><?php echo $_SESSION['hostel_owner']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number :</td>
                        <td><?php echo $result['owner_phone']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address :</td>
                        <td><?php echo $result['owner_address']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Attachment :</td>
                        <td><?php echo $_SESSION['hostel_owner']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="owner.php?edit_profile" class="submit btn btn-primary">Edit</a>
        </div>
    </div>
</div>