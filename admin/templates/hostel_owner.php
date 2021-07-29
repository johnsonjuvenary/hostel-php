<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Hosteler Owners</h3>
            <p class="animated fadeInDown">
                Actions <span class="fa-angle-right fa"></span> Hosteler Owners
            </p>
        </div>
    </div>
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hostel_owner = query("SELECT * FROM owner WHERE owner_status = 'active'");
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
                        <td class="text-success"><?php echo $row['owner_status']; ?></td>
                    </tr>

                <?php
                    $id++;
                endwhile; ?>
            </tbody>
        </table>
    </div>
</div>