<?php include('includes/header.php'); ?>
<!-- start: Content -->
<div id="content">
    <?php
    #including pages / templates based on the link clicked
    if (($_SERVER['REQUEST_URI'] ==  '/hostel/admin/admin.php') || (isset($_GET['dashboard']))) {
        include('templates/dashboard.php');
    }
    if ((isset($_GET['profile']))) {
        include('templates/profile.php');
    }
    if ((isset($_GET['hostel_owners'])) || isset($_GET['hostel_owner'])) {
        include('templates/hostel_owner.php');
    }
    if ((isset($_GET['pending_approval'])) || isset($_GET['pending'])) {
        include('templates/pending.php');
    }
    if ((isset($_GET['booking'])) || isset($_GET['bookings'])) {
        include('templates/booking.php');
    }
    if ((isset($_GET['hosteler'])) || isset($_GET['hostelers'])) {
        include('templates/hosteler.php');
    }
    if ((isset($_GET['edit_profile'])) || isset($_GET['heditprofile'])) {
        include('templates/edit_profile.php');
    }
    ?>
</div>
<!-- end: Content -->

</div>
<?php include('includes/footer.php'); ?>