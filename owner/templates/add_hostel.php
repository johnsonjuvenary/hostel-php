<?php hostel_add(); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Add Hostel</h3>
            <p class="animated fadeInDown">
                Actions <span class="fa-angle-right fa"></span> Add Hostel
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
            <h4>Add Hostel</h4>
        </div>
        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <div class="col-md-12">
                <form class="cmxform" id="signupForm" method="POST" action="" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text" id="validate_firstname" name="hostel_name" value="<?php echo $hostel_name; ?>" required>
                            <span class="bar"></span>
                            <label>Hostel Name</label>
                        </div>

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text" id="validate_lastname" name="hostel_location" value="<?php echo $hostel_location; ?>" required>
                            <span class="bar"></span>
                            <label>Hostel Location</label>
                        </div>

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text" id="validate_username" name="hostel_fee" value="<?php echo $hostel_fee; ?>" required>
                            <span class="bar"></span>
                            <label>Hostel Fee (Per Month)</label>
                        </div>
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <select class="select2-A form-control" name="hostel_type">
                                <option value="#">Select Hostel Type</option>
                                <option value="Boys">Boys</option>
                                <option value="Girls">Girls</option>
                                <option value="Mixed">Mixed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <div class="input-group fileupload-v1">
                                <input type="file" name="img1" class="form-control" />
                                <span class="">Hostel Image 1
                                </span>
                            </div>
                        </div>
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <div class="input-group fileupload-v1">
                                <input type="file" name="img2" class="form-control" />
                                <span class="">Hostel Image 2
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <div class="input-group fileupload-v1">
                                <input type="file" name="img3" class="form-control" />
                                <span class="">Hostel Image 3
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-animate-texterea">
                            <textarea name="hostel_description" class="form-control" id="validate_textarea" id="" cols="10" rows="5" value="<?php echo $hostel_description; ?>" required></textarea>
                            <label>Hostel Description</label>
                        </div>
                        <input class="submit btn btn-primary btn-block btn-lg" type="submit" name="hostel_add" value="Add Hostel">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>