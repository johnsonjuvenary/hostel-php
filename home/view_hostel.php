<?php include('includes/header.php') ?>
<!-- END nav -->
<?php
if (isset($_GET['id'])) {
    $hostel_id = escape_string($_GET['id']);
    #checking if the hostel is found
    $hostel_check = query("SELECT * FROM hostel WHERE hostel_id = '$hostel_id' LIMIT 1");
    if (mysqli_num_rows($hostel_check) == 0) {
    } else {
        $hostel_row = fetch_array($hostel_check);
?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block hero-wrap hero-wrap-2" src="../assets/hostel/<?php echo $hostel_row['hostel_img1']; ?>" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block hero-wrap hero-wrap-2" src="../assets/hostel/<?php echo $hostel_row['hostel_img2']; ?>" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block hero-wrap hero-wrap-2" src="../assets/hostel/<?php echo $hostel_row['hostel_img3']; ?>" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="col-md-12">
            <div class="wrapper">
                <div class="row no-gutters">
                    <div class="col-lg-8 col-md-7 d-flex align-items-stretch">
                        <div class="contact-wrap w-100 p-md-5 p-4">
                            <h3 class="mb-4"><?php echo ucwords($hostel_row['hostel_name']); ?> Hostel</h3>
                            <div class="container mb-5">
                                <div>
                                    <?php echo $hostel_row['hostel_details']; ?>
                                </div>
                            </div>
                            <div class="container">
                                <?php book_hostel(); ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="" class="appointment-form" action="" method="POST">
                                            <h3 class="mb-3">Book <span class="text-danger"><?php echo ucwords($hostel_row['hostel_name']); ?></span> Hostel Now</h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="full_name" class="form-control" <?php echo $full_name; ?> placeholder="Full Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="university" class="form-control" <?php echo $university; ?> placeholder="University">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="gender" id="" class="form-control">
                                                            <option value="">Select Your Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-control" <?php echo $email; ?> id="" placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="phone_number" class="form-control" <?php echo $phone_number; ?> id="" placeholder="Phone Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <select name="hostel" id="" class="form-control">
                                                            <option value="">Select Hostel</option>
                                                            <?php
                                                            $hostel = query("SELECT hostel_id,hostel_name,hostel_location FROM hostel WHERE hostel_name='$hostel_row[hostel_name]' LIMIT 1");
                                                            confirm($hostel);
                                                            while ($row = fetch_array($hostel)) : ?>
                                                                <option value="<?php echo $row['hostel_id']; ?>"><?php echo $row['hostel_name']; ?> ~ <?php echo $row['hostel_location']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <span class="form-group small">Hostel Duration</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="input-wrap">
                                                            <div class="icon"><span class="ion-md-calendar"></span></div>
                                                            <input type="text" name="check_in" class="form-control appointment_date-check-in" placeholder="Check-In">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="input-wrap">
                                                            <div class="icon"><span class="ion-md-calendar"></span></div>
                                                            <input type="text" name="check_out" class="form-control appointment_date-check-out" placeholder="Check-Out">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="submit" name="book_hostel" value="Book Hostel Now" class="btn btn-primary btn-block py-3 px-4">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                        <div class="info-wrap bg-primary w-100 p-md-5 p-4">
                            <!-- <h3>Let's get in touch</h3>
							<p class="mb-4">We're open for any suggestion or just to have a chat</p> -->
                            <div class="dbox w-100 d-flex align-items-start">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-check"></span>
                                </div>
                                <div class="text pl-3">
                                    <p><span>Hostel Name:</span> <?php echo ucwords($hostel_row['hostel_name']); ?></p>
                                </div>
                            </div>
                            <div class="dbox w-100 d-flex align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-check"></span>
                                </div>
                                <div class="text pl-3">
                                    <p><span>Hostel Location:</span> <?php echo ucwords($hostel_row['hostel_location']); ?></p>
                                </div>
                            </div>
                            <div class="dbox w-100 d-flex align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-check"></span>
                                </div>
                                <div class="text pl-3">
                                    <p><span>Hostel Type:</span> <?php echo ucwords($hostel_row['hostel_type']); ?></p>
                                </div>
                            </div>
                            <div class="dbox w-100 d-flex align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-check"></span>
                                </div>
                                <div class="text pl-3">
                                    <p><span>Hostel Fee:</span> Tsh <?php echo number_format($hostel_row['hostel_price']); ?>/- per month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}

?>

<?php include('includes/footer.php'); ?>