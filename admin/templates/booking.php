<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Bookings</h3>
            <p class="animated fadeInDown">
                Actions <span class="fa-angle-right fa"></span> Bookings
            </p>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Bookings</h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>University</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Hostel</th>
                                <th>Check_in</th>
                                <th>Check_out</th>
                                <th colspan="2">Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $book = query("SELECT * FROM booking,hostel WHERE booking.booking_hostel = hostel.hostel_id AND booking_status = 'null'");
                            //confirm($hostel);
                            $id = 1;
                            while ($row = fetch_array($book)) :
                            ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $row['booking_name']; ?></td>
                                    <td><?php echo $row['booking_university']; ?></td>
                                    <td><?php echo $row['booking_gender']; ?></td>
                                    <td><?php echo $row['booking_phone']; ?></td>
                                    <td><?php echo $row['booking_email']; ?></td>
                                    <?php
                                    $hostel = $row['booking_hostel'];
                                    $hostel_check = query("SELECT * FROM hostel WHERE hostel_id = '$hostel' LIMIT 1");
                                    confirm($hostel);
                                    $hostel_row = fetch_array($hostel_check);
                                    $hostel_name = $hostel_row['hostel_name'];
                                    ?>
                                    <td><?php echo $hostel_name; ?></td>
                                    <td><?php echo $row['booking_chekin']; ?></td>
                                    <td><?php echo $row['booking_checkout']; ?></td>
                                    <td><a href="owner.php?booking&approve=<?php echo $row['booking_id']; ?>" class="btn btn-mn btn-success"><span class="fa fa-check"></span></a>
                                        <?php
                                        #approving booking
                                        if (isset($_GET['approve'])) {
                                            $approve_id = escape_string($_GET['approve']);
                                            #checking if id is available in the db
                                            $approve_id_check = query("SELECT * FROM booking WHERE booking_id = '$approve_id' LIMIT 1");
                                            if (mysqli_num_rows($approve_id_check) == 0) {
                                                echo '
                                        <script>
                                        swal("Failed","Error, Try again!","warning").then(function(){
                                            window.location = "owner.php?booking";
                                            });
                                        </script>				
                                        ';
                                            } else {
                                                #sending email to hostel booker notifying him/her that is approved
                                                include('../config/mail_function.php');
                                                $date = date('Y');
                                                $approve = query("SELECT * FROM booking,hostel WHERE booking.booking_hostel = hostel.hostel_id AND booking_status = 'null'");
                                                $approve_row = fetch_array($approve);
                                                $booker_email_approve = $approve_row['booking_email'];
                                                $booker_name_approve = ucwords($approve_row['booking_name']);
                                                $hostel_location_approve = $hostel_row['hostel_location'];
                                                $mail->addAddress("$booker_email_approve", "$booker_name_approve");
                                                $mail->isHTML(true);
                                                $mail->Subject = "Approval | Hostel Renta";
                                                $mail->Body = "<div>
                                                        Dear $booker_name_approve,
                                                        <p>Conguratulations you have been approved to <b>$hostel_name</b> at <i>$hostel_location</i> so you`ll be contacted by hostel owner shortly for further informations</p>                                   
                                                        <br><br>                  
                                                        Regards.
                                                        <br>
                                                        <b>&copy; Hostel Rental Team $date </b>
                                                        </div>";
                                                $mail->AltBody = "";
                                                try {
                                                    $mail->send();
                                                    #Updating
                                                    $book_id = $row['booking_id'];
                                                    $update_approve = query("UPDATE `booking` SET `booking_status` = 'approved' WHERE `booking`.`booking_id` = '$book_id'");
                                                    if (!$update_approve) {
                                                        echo '
                                                            <script>
                                                            swal("Failed","Error, Try again!","error").then(function(){
                                                                window.location = "owner.php?bookings";
                                                                });
                                                            </script>				
                                                            ';
                                                    } else {
                                                        echo '
                                                            <script>
                                                            swal("Success","Hostel Booking approved successful","success").then(function(){
                                                                window.location = "owner.php?hosteler";
                                                                });
                                                            </script>				
                                                            ';
                                                    }
                                                } catch (Exception $e) {
                                                    //echo "Mailer Error: " . $mail->ErrorInfo;
                                                    echo '
                                                            <script>
                                                            swal("Failed","Error, Try again!","error").then(function(){
                                                                window.location = "owner.php?bookings";
                                                                });
                                                            </script>				
                                                            ';
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="owner.php?booking&dissapprove=<?php echo $row['booking_id']; ?>" class="btn btn-mn btn-danger"><span class="fa fa-times"></span></a>
                                        <?php
                                        #dissapproving 
                                        if (isset($_GET['dissapprove'])) {
                                            $dissapprove_id = escape_string($_GET['dissapprove']);
                                            #checking if id is available in the db
                                            $dissapprove_id_check = query("SELECT * FROM booking WHERE booking_id = '$dissapprove_id' LIMIT 1");
                                            if (mysqli_num_rows($dissapprove_id_check) == 0) {
                                                echo '
                                    <script>
                                    swal("Failed","Error, Try again!","warning").then(function(){
                                        window.location = "owner.php?booking";
                                        });
                                    </script>				
                                    ';
                                            } else {
                                                #sending email to hostel booker notifying him/her that is approved
                                                include('../config/mail_function.php');
                                                $date = date('Y');
                                                $dissapprove = query("SELECT * FROM booking,hostel WHERE booking.booking_hostel = hostel.hostel_id AND booking_status = 'null'");
                                                $dissapprove_row = fetch_array($dissapprove);
                                                $booker_email_dissapprove = $dissapprove_row['booking_email'];
                                                $booker_name_dissapprove = ucwords($row['booking_name']);
                                                $hostel_location = $hostel_row['hostel_location'];
                                                $mail->addAddress("$booker_email_dissapprove", "$booker_name_dissapprove");
                                                $mail->isHTML(true);
                                                $mail->Subject = "Approval | Hostel Renta";
                                                $mail->Body = "<div>
                                                    Dear $booker_name_dissapprove,
                                                    <p>Your booking request at <b>$hostel_name</b> of <i>$hostel_location</i> has been denied for some reasons,perhaps later on hostel owner(lnd lord) will contact you</p>                                   
                                                    <br><br>                  
                                                    Regards.
                                                    <br>
                                                    <b>&copy; Hostel Rental Team $date </b>
                                                    </div>";
                                                $mail->AltBody = "";
                                                try {
                                                    $mail->send();
                                                    #Updating
                                                    $book_id = $row['booking_id'];
                                                    $update_dissapprove = query("UPDATE `booking` SET `booking_status` = 'dissapproved' WHERE `booking`.`booking_id` = '$book_id'");
                                                    if (!$update_dissapprove) {
                                                        echo '
                                                        <script>
                                                        swal("Failed","Error, Try again!","error").then(function(){
                                                            window.location = "owner.php?bookings";
                                                            });
                                                        </script>				
                                                        ';
                                                    } else {
                                                        echo '
                                                        <script>
                                                        swal("Success","Hostel Booking approved successful","success").then(function(){
                                                            window.location = "owner.php?booking";
                                                            });
                                                        </script>				
                                                        ';
                                                    }
                                                } catch (Exception $e) {
                                                    //echo "Mailer Error: " . $mail->ErrorInfo;
                                                    echo '
                                                        <script>
                                                        swal("Failed","Error, Try again!","error").then(function(){
                                                            window.location = "owner.php?bookings";
                                                            });
                                                        </script>				
                                                        ';
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $id++;
                            endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>