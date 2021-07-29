<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Hostelers</h3>
            <p class="animated fadeInDown">
                Actions <span class="fa-angle-right fa"></span> Hostelers
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
                                <th>Gender</th>
                                <th>University</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $hostel = query("SELECT * FROM booking,hostel,owner WHERE hostel.hostel_id = booking.booking_hostel AND booking.booking_status='approved' GROUP BY booking.booking_name");
                                //confirm($hostel);
                                $id = 1;
                                while ($row = fetch_array($hostel)) :
                                ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $row['booking_name']; ?></td>
                                <td><?php echo $row['booking_gender']; ?></td>
                                <td><?php echo $row['booking_university']; ?></td>
                                <td><?php echo $row['booking_email']; ?></td>
                                <td><?php echo $row['booking_phone']; ?></td>
                                <td><?php echo $row['booking_chekin']; ?></td>
                                <td><?php echo $row['booking_checkout']; ?></td>        
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