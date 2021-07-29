<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Pending Approval</h3>
            <p class="animated fadeInDown">
                Actions <span class="fa-angle-right fa"></span> Pending Approval
            </p>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Hostelers</h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>E-Mail</th>
                                <th>Phone Number</th>
                                <th>Attachment</th>
                                <th>Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hostel_owner = query("SELECT * FROM owner WHERE owner_status = 'inactive'");
                            confirm($hostel_owner);
                            $id = 1;
                            while ($row = fetch_array($hostel_owner)) :
                            ?>
                                <tr>

                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $row['owner_name']; ?></td>
                                    <td><?php echo $row['owner_address']; ?></td>
                                    <td><?php echo $row['owner_email']; ?></td>
                                    <td><?php echo $row['owner_phone']; ?></td>
                                    <td><a href="../assets/attachment/hostel_owner/<?php echo $row['owner_attachment']; ?>" target="popup" onclick="window.open('../assets/attachment/hostel_owner/<?php echo $row['owner_attachment']; ?>','popup','width=600,height=600');return false;">View <span><i class="fa fa-eye"></i></span></a></td>
                                    <td><a href="admin.php?pending&id=<?php echo $row['owner_id']; ?>" class="btn btn-success">Approve</a></td>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $id = escape_string($_GET['id']);
                                        #check if that id is found in the db
                                        $id_check = query("SELECT * FROM owner WHERE owner_id = '$id' LIMIT 1");
                                        confirm($id_check);
                                        if (mysqli_num_rows($id_check) == 0) {
                                            echo '
                                                    <script>
                                                    swal("Failed","Error, Try again!","error").then(function(){
                                                        window.location = "admin.php?pending";
                                                        });
                                                    </script>				
                                                    ';
                                        } else {
                                            #sending email to hostel owner notifying him/her that is acctive can log in
                                            include('../config/mail_function.php');
                                            $date = date('Y');
                                            $owner = fetch_array($id_check);
                                            $email = $owner['owner_email'];
                                            $name = ucwords($owner['owner_name']);
                                            $mail->addAddress("$email", "$name");
                                            $mail->isHTML(true);
                                            $mail->Subject = "Approval | Hostel Renta";
                                            $mail->Body = "<div>
                                                        Dear $name,
                                                        <p>You`ve been activated to use <b>Hostel Rental</b> as Hostel Owner.</p>
                                                        <p> You can do the followings:- </p>
                                                        <ul>
                                                        <li>Add Your Hostels</li>
                                                        <li>Check Bookings</li>
                                                        <li>Manage your account
                                                        <ul>
                                                        <li>Changing Passwords</li>
                                                        <li>Updating Profile</li>
                                                        </ul>
                                                        <li>Chack your Hostelers</li>
                                                        </ul>                                    
                                                        <br><br>                  
                                                        Regards.
                                                        <br>
                                                        <b>&copy; Hostel Rental Team $date </b>
                                                        </div>";
                                            $mail->AltBody = "";
                                            try {
                                                $mail->send();
                                                #Updating
                                                $update = query("UPDATE `owner` SET `owner_status` = 'active' WHERE `owner`.`owner_id` = '$id'");
                                                confirm($update);
                                                if (!$update) {
                                                    echo '
                                                            <script>
                                                            swal("Failed","Error, Try again!","error").then(function(){
                                                                window.location = "admin.php?pending";
                                                                });
                                                            </script>				
                                                            ';
                                                } else {
                                                    echo '
                                                            <script>
                                                            swal("Success","Hostel Owner activated successful","success").then(function(){
                                                                window.location = "admin.php?pending";
                                                                });
                                                            </script>				
                                                            ';
                                                }
                                            } catch (Exception $e) {
                                                //echo "Mailer Error: " . $mail->ErrorInfo;
                                                echo '
                                                            <script>
                                                            swal("Failed","Error, Try again!","error").then(function(){
                                                                window.location = "admin.php?pending";
                                                                });
                                                            </script>				
                                                            ';
                                            }
                                        }
                                    }
                                    ?>
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