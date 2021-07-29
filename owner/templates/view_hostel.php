<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">View Hostel</h3>
            <p class="animated fadeInDown">
                Actions <span class="fa-angle-right fa"></span> My Hostels
            </p>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>My Hostels</h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Image 1</th>
                                <th>Image 2</th>
                                <th>Image 3</th>
                                <th>Fee</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $hostel = query("SELECT * FROM hostel,owner WHERE hostel.hostel_owner = owner.owner_id AND owner_email ='$_SESSION[hostel_owner]'");
                                //confirm($hostel);
                                $id = 1;
                                while ($row = fetch_array($hostel)) :
                                ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $row['hostel_name']; ?></td>
                                <td><?php echo $row['hostel_location']; ?></td>
                                <td><a href="../assets/hostel/<?php echo $row['hostel_img1']; ?>" target="popup" onclick="window.open('../assets/hostel/<?php echo $row['hostel_img1']; ?>','popup','width=600,height=600');return false;">View <span><i class="fa fa-eye"></i></span></a></td>
                                <td><a href="../assets/hostel/<?php echo $row['hostel_img2']; ?>" target="popup" onclick="window.open('../assets/hostel/<?php echo $row['hostel_img2']; ?>','popup','width=600,height=600');return false;">View <span><i class="fa fa-eye"></i></span></a></td>
                                <td><a href="../assets/hostel/<?php echo $row['hostel_img3']; ?>" target="popup" onclick="window.open('../assets/hostel/<?php echo $row['hostel_img3']; ?>','popup','width=600,height=600');return false;">View <span><i class="fa fa-eye"></i></span></a></td>
                                <td>Tshs <?php echo number_format($row['hostel_price']); ?>/-</td>
                                <td><?php echo $row['hostel_details']; ?></td>
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