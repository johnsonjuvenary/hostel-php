<?php include('includes/header.php'); ?>
<!-- start: Content -->
<div id="content">
    <?php
    #including pages / templates based on the link clicked
    if (($_SERVER['REQUEST_URI'] ==  '/hostel/owner/owner.php') || (isset($_GET['dashboard']))) {
        include('templates/dashboard.php');
    }
    if ((isset($_GET['profile']))) {
        include('templates/profile.php');
    }
    if ((isset($_GET['add_hostel'])) || isset($_GET['add_hostels'])) {
        include('templates/add_hostel.php');
    }
    if ((isset($_GET['view_hostel'])) || isset($_GET['view_hostels'])) {
        include('templates/view_hostel.php');
    }
    if ((isset($_GET['booking'])) || isset($_GET['bookings'])) {
        include('templates/booking.php');
    }
    if ((isset($_GET['hosteler'])) || isset($_GET['hostelers'])) {
        include('templates/hosteler.php');
    }
    if ((isset($_GET['edit_profile'])) || isset($_GET['editprofile'])) {
        include('templates/edit_profile.php');
    }
    ?>
</div>
<!-- end: Content -->

</div>
<?php include('includes/footer.php'); ?>