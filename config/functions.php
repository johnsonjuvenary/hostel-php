<?php
session_start();
// session_destroy();
include 'db_connection.php';
$email = '';
$full_name = '';
$address = '';
$phone_number = '';
$success = '';
$hostel_name = '';
$hostel_location = '';
$hostel_fee = '';
$hostel_description = '';
$university = '';
$course = '';
$hostel = '';

/** HELPER FUNCTIONS  */
#SET MESSAGES 
function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

#DISPLAY MESSAGES 
function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

#REDIRECTING
function redirect_page($location)
{
    return header("Location: $location ");
}

#QUERY
function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

#CONFIRM QUERY
function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

#ESCAPING CHARACTERS AND SQL INJECTION
function escape_string($string)
{
    global $connection;
    $str = htmlentities(mysqli_real_escape_string($connection, $string));
    return trim($str);
}

#FETCHING RESULTS ROW
function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

/** END OF HELPER FUNCTIONS  */

function admin_login()
{
    global $email;
    if (isset($_POST['admin_signin'])) {
        #escaping characters and sql injections
        $email = escape_string($_POST['email']);
        $password = md5(escape_string($_POST['password']));
        #checking for empty fields
        if (empty($email) || empty($password)) {
            set_message('Fill all fields');
        }
        #checking if email ans password is found in the database
        else {
            $admin_Check = query("SELECT * FROM `admin` WHERE admin_email = '$email' AND admin_password = '$password' LIMIT 1");
            #confirming query
            confirm($admin_Check);
            if (mysqli_num_rows($admin_Check) == 0) {
                set_message('Invalid Email or Password');
            } else {
                $_SESSION['admin'] = $email;
                redirect_page("admin.php?dashboard");
            }
        }
    }
}

function owner_login()
{
    global $email;
    if (isset($_POST['owner_signin'])) {
        #escaping characters and sql injections
        $email = escape_string($_POST['email']);
        $password = md5(escape_string($_POST['password']));
        #checking for empty fields
        if (empty($email) || empty($password)) {
            set_message('Fill all fields');
        }
        #checking if email ans password is found in the database
        else {
            $owner_Check = query("SELECT * FROM `owner` WHERE `owner_email` = '$email' AND `owner_password` = '$password' AND owner_status = 'active' LIMIT 1");
            #confirming query
            confirm($owner_Check);
            if (mysqli_num_rows($owner_Check) == 0) {
                set_message('Invalid Email or Password');
            } else {
                $_SESSION['hostel_owner'] = $email;
                redirect_page("owner.php?dashboard");
            }
        }
    }
}

function owner_register()
{ 
    global $email;
    global $email;
    global $address;
    global $phone_number;
    global $full_name;
    global $success;

    if (isset($_POST['owner_sign_up'])) {
        #escaping characters and sql injections
        $full_name = escape_string($_POST['full_name']);
        $email = escape_string($_POST['email']);
        $phone_number = escape_string($_POST['phone_number']);
        $address = escape_string($_POST['address']);
        $password = md5(escape_string($_POST['password']));
        $password_confirm = md5(escape_string($_POST['password2']));

        //validating data before entering them into the database
        #checking if all fields are filled up
        if (empty($full_name) || empty($email) || empty($password) || empty($password_confirm) || empty($phone_number) || empty($address)) {
            set_message('Fill all fields');
        }
        #checking if password matches
        elseif ($password !== $password_confirm) {
            set_message('Passwords do not match');
        }
        #checking for valid email
        elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            set_message('Invalid Email Address');
        }
        #checking if email is available in the database
        else {
            $email_check = query("SELECT * FROM owner WHERe owner_email = '$email' LIMIT 1");
            #confirming query
            confirm($email_check);
            if (mysqli_num_rows($email_check) == 1) {
                set_message('Email already exists');
            }
            #checking if phone number has 10 digits
            elseif (strlen($phone_number) != 10) {
                set_message('Invalid Phone Number');
            }
            #checking if phone number exits
            else {
                $phone_check = query("SELECT * FROM owner WHERE owner_phone = '$phone_number' LIMIT 1");
                confirm($phone_check);
                if (mysqli_num_rows($phone_check) == 1) {
                    set_message('Phone Number Already exists');
                }
                #uploading the attachment
                else {
                    $file_id = $_FILES['attachment'];
                    $file_id_name = $_FILES['attachment']['name']; // getting file name
                    $file_id_path = $_FILES['attachment']['tmp_name']; //file temporary location
                    $file_id_size = $_FILES['attachment']['size']; // file size
                    $file_id_error = $_FILES['attachment']['error']; //file errors if any
                    $file_id_type = $_FILES['attachment']['type']; // file type
                    #Working out on the file extension
                    $file_id_extension = explode('.', $file_id_name);
                    $file_id_actual_extension = strtolower(end($file_id_extension));
                    #allowed file extensions
                    $allowed_file_id = array('png', 'jpg', 'jpeg', 'pdf');
                    #checking for extension
                    if (!in_array($file_id_actual_extension, $allowed_file_id)) {
                        set_message('Attachment must be either pdf, png, jpeg or jpg!');
                    }
                    #checking for file erors
                    elseif (!($file_id_error === 0)) {
                        set_message('attachment has error, try another one!');
                    }
                    #naming file name as it may contains special characters or so that similar file names do not get replaced
                    else {
                        $new_file_id_name = uniqid('', true) . "." . $file_id_actual_extension;
                        # moving file to attachement directory that is uploading file into the server
                        $file_id_directory = "../assets/attachment/hostel_owner/";
                        $file_id_destination = $file_id_directory . $new_file_id_name;
                        $id_upload = move_uploaded_file($file_id_path, $file_id_destination);
                        # cheking if file id has uploadded
                        if (!$id_upload) {
                            set_message('Failed to upload attachment, please try again');
                        }
                        #inserting inti the database
                        else {
                            $owner_register = query("INSERT INTO `owner` (`owner_id`, `owner_name`, `owner_email`, `owner_phone`, `owner_address`, `owner_attachment`, `owner_password`, `owner_status`) VALUES (NULL, '$full_name', '$email', '$phone_number', '$address', '$new_file_id_name', '$password', 'inactive')");
                            confirm($owner_register);
                            if (!$owner_register) {
                                set_message('Registration failed try again');
                            } else {
                                $success = 'Successfull registered, approval email will be sent to you shortly';
                            }
                        }
                    }
                }
            }
        }
    }
}

function admin_name($user)
{
    $name = query("SELECT * FROM admin WHERE admin_email = '$user' LIMIT 1 ");
    confirm($name);
    $name_result = fetch_array($name);
    $admin = ucwords($name_result['admin_name']);
    return ucwords($admin);
}

function owner_name($user)
{
    $name = query("SELECT * FROM owner WHERE owner_email = '$user' LIMIT 1 ");
    confirm($name);
    $name_result = fetch_array($name);
    $owner = ucwords($name_result['owner_name']);
    return ucwords($owner);
}

function admin_change_password()
{
}


function hostel_add()
{
    global $hostel_name;
    global $hostel_location;
    global $hostel_fee;
    global $hostel_description;
    if (isset($_POST['hostel_add'])) {
        #escaping characters and sql injections
        $hostel_name = escape_string($_POST['hostel_name']);
        $hostel_location = escape_string($_POST['hostel_location']);
        $hostel_fee = escape_string($_POST['hostel_fee']);
        $hostel_type =  escape_string($_POST['hostel_type']);
        $hostel_description = escape_string($_POST['hostel_description']);
        if (empty($hostel_name) || empty($hostel_location) || empty($hostel_type) || empty($hostel_fee) || empty($hostel_description)) {
            echo '
        <script>
        swal("Warning","FIll all fields!","warning");
        </script>				
        ';
        } else if (!is_numeric($hostel_fee)) {
            echo '
        <script>
        swal("Error","Invalid Hostel Fee!","error");
        </script>				
        ';
        }
        #uploading images
        else {
            //image 1
            $file_id1 = $_FILES['img1'];
            $file_id_name1 = $_FILES['img1']['name']; // getting file name
            $file_id_path1 = $_FILES['img1']['tmp_name']; //file temporary location
            $file_id_size1 = $_FILES['img1']['size']; // file size
            $file_id_error1 = $_FILES['img1']['error']; //file errors if any
            $file_id_type1 = $_FILES['img1']['type']; // file type
            #Working out on the file extension
            $file_id_extension1 = explode('.', $file_id_name1);
            $file_id_actual_extension1 = strtolower(end($file_id_extension1));
            #allowed file extensions
            $allowed_file_id1 = array('png', 'jpg', 'jpeg');
            #checking for extension
            if (!in_array($file_id_actual_extension1, $allowed_file_id1)) {
                echo '
            <script>
            swal("Error","Image1 must be either  png, jpeg or jpg!","error");
            </script>				
            ';
            }
            #checking for file erors
            elseif (!($file_id_error1 === 0)) {
                echo '
            <script>
            swal("Error","Image1  has error, try another one!","error");
            </script>				
            ';
            }
            #naming file name as it may contains special characters or so that similar file names do not get replaced
            else {
                $new_file_id_name1 = uniqid('', true) . "." . $file_id_actual_extension1;
                # moving file to attachement directory that is uploading file into the server
                $file_id_directory1 = "../assets/hostel/";
                $file_id_destination1 = $file_id_directory1 . $new_file_id_name1;
                $id_upload1 = move_uploaded_file($file_id_path1, $file_id_destination1);
                # cheking if file id has uploadded
                if (!$id_upload1) {
                    echo '
                <script>
                swal("Error","Failed to upload image1, please try again","error");
                </script>				
                ';
                } else {
                    #image2 
                    $file_id2 = $_FILES['img2'];
                    $file_id_name2 = $_FILES['img2']['name']; // getting file name
                    $file_id_path2 = $_FILES['img2']['tmp_name']; //file temporary location
                    $file_id_size2 = $_FILES['img2']['size']; // file size
                    $file_id_error2 = $_FILES['img2']['error']; //file errors if any
                    $file_id_type2 = $_FILES['img2']['type']; // file type
                    #Working out on the file extension
                    $file_id_extension2 = explode('.', $file_id_name2);
                    $file_id_actual_extension2 = strtolower(end($file_id_extension2));
                    #allowed file extensions
                    $allowed_file_id2 = array('png', 'jpg', 'jpeg');
                    #checking for extension
                    if (!in_array($file_id_actual_extension2, $allowed_file_id2)) {
                        echo '
                    <script>
                    swal("Error","Image2 must be either  png, jpeg or jpg!","error");
                    </script>				
                    ';
                    }
                    #checking for file erors
                    elseif (!($file_id_error2 === 0)) {
                        echo '
                    <script>
                    swal("Error","Image2  has error, try another one!","error");
                    </script>				
                    ';
                    }
                    #naming file name as it may contains special characters or so that similar file names do not get replaced
                    else {
                        $new_file_id_name2 = uniqid('', true) . "." . $file_id_actual_extension2;
                        # moving file to attachement directory that is uploading file into the server
                        $file_id_directory2 = "../assets/hostel/";
                        $file_id_destination2 = $file_id_directory2 . $new_file_id_name2;
                        $id_upload2 = move_uploaded_file($file_id_path2, $file_id_destination2);
                        # cheking if file id has uploadded
                        if (!$id_upload2) {
                            echo '
                        <script>
                        swal("Error","Failed to upload image2, please try again","error");
                        </script>				
                        ';
                        } else {
                            #image 3 
                            $file_id3 = $_FILES['img3'];
                            $file_id_name3 = $_FILES['img3']['name']; // getting file name
                            $file_id_path3 = $_FILES['img3']['tmp_name']; //file temporary location
                            $file_id_size3 = $_FILES['img3']['size']; // file size
                            $file_id_error3 = $_FILES['img3']['error']; //file errors if any
                            $file_id_type3 = $_FILES['img3']['type']; // file type
                            #Working out on the file extension
                            $file_id_extension3 = explode('.', $file_id_name3);
                            $file_id_actual_extension3 = strtolower(end($file_id_extension3));
                            #allowed file extensions
                            $allowed_file_id3 = array('png', 'jpg', 'jpeg');
                            #checking for extension
                            if (!in_array($file_id_actual_extension3, $allowed_file_id3)) {
                                echo '
                    <script>
                    swal("Error","Image3 must be either  png, jpeg or jpg!","error");
                    </script>				
                    ';
                            }
                            #checking for file erors
                            elseif (!($file_id_error3 === 0)) {
                                echo '
                    <script>
                    swal("Error","Image3  has error, try another one!","error");
                    </script>				
                    ';
                            }
                            #naming file name as it may contains special characters or so that similar file names do not get replaced
                            else {
                                $new_file_id_name3 = uniqid('', true) . "." . $file_id_actual_extension3;
                                # moving file to attachement directory that is uploading file into the server
                                $file_id_directory3 = "../assets/hostel/";
                                $file_id_destination3 = $file_id_directory3 . $new_file_id_name3;
                                $id_upload3 = move_uploaded_file($file_id_path3, $file_id_destination3);
                                # cheking if file id has uploadded
                                if (!$id_upload3) {
                                    echo '
                        <script>
                        swal("Error","Failed to upload image2, please try again","error");
                        </script>				
                        ';
                                } else {
                                    #getting owner id 
                                    $owner_id = query("SELECT * FROM owner WHERE owner_email ='$_SESSION[hostel_owner]' LIMIT 1");
                                    confirm($owner_id);
                                    $row = fetch_array($owner_id);
                                    $owner = $row['owner_id'];
                                    #adding hostel
                                    $add_hostel = query("INSERT INTO `hostel` (`hostel_id`, `hostel_name`, `hostel_location`, `hostel_img1`, `hostel_img2`, `hostel_img3`, `hostel_price`, `hostel_details`, `hostel_type`, `hostel_owner`) VALUES (NULL, '$hostel_name', '$hostel_location', '$new_file_id_name1', '$new_file_id_name2', '$new_file_id_name3', '$hostel_fee', '$hostel_description','$hostel_type', '$owner')");
                                    if (!$add_hostel) {
                                        echo '
                                        <script>
                                        swal("Error","Failed to add Hostel Please try again","error");
                                        </script>				
                                        ';
                                    } else {
                                        echo '
                                        <script>
                                        swal("Success","Hostel added successful!","success").then(function(){
                                            window.location = "owner.php?view_hostel";
                                        });
                                        </script>				
                                        ';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function book_hostel()
{

    global $full_name;
    global $university;
    global $phone_number;
    global $email;
    if (isset($_POST['book_hostel'])) {
        #escaping characters and sql injections
        $full_name = escape_string($_POST['full_name']);
        $email = escape_string($_POST['email']);
        $phone_number = escape_string($_POST['phone_number']);
        $university = escape_string($_POST['university']);
        $gender = escape_string($_POST['gender']);
        $hostel = escape_string($_POST['hostel']);
        $check_in = escape_string($_POST['check_in']);
        $check_out = escape_string($_POST['check_out']);

        if (empty($full_name) || empty($email) || empty($phone_number) || empty($university) || empty($gender) || empty($hostel) || empty($check_in) || empty($check_out)) {
            echo '
        <script>
        swal("Warning","FIll all fields!","warning");
        </script>				
        ';
        } else {
            $book = query("INSERT INTO `booking` (`booking_id`, `booking_name`, `booking_university`, `booking_gender`, `booking_phone`, `booking_email`, `booking_hostel`, `booking_chekin`, `booking_checkout`, `booking_time`) VALUES (NULL, '$full_name', '$university', '$gender', '$phone_number', '$email', '$hostel', '$check_in', '$check_out', current_timestamp())");
            //confirm($book);
            if (!$book) {
                echo '
            <script>
            swal("Error","Failed try again!","error");
            </script>				
            ';
            } else {
                echo '
            <script>
            swal("Success","Succesful booked a hostel, a hostel owner will contact you shortly ","success").then(function(){
                window.location = "index.php";
            });
            </script>				
            ';
            }
        }
    }
}

function hostels()
{
    $hostel = query("SELECT * FROM hostel");
    if (mysqli_num_rows($hostel) == 0) {
?>
        <div class="col-lg-12">
            <div class="room-wrap d-md-flex">
                <a href="#" class="img" style="background-image: url(images/room-1.jpg);"></a>
                <div class="half left-arrow d-flex align-items-center">
                    <div class="text p-4 p-xl-5 text-center">
                        <p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
                        <!-- <p class="mb-0"><span class="price mr-1">$120.00</span> <span class="per">per night</span></p> -->
                        <h3 class="mb-3"><a href="#">No Hostels Available</a></h3>
                        <ul class="list-accomodation">
                            <li><span>nill:</span>---</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        while ($row = fetch_array($hostel)) {
        ?>
            <div class="col-lg-6">
                <div class="room-wrap d-md-flex">
                    <a href="#" class="img" style="background-image: url(../assets/hostel/<?php echo $row['hostel_img1']; ?>);"></a>
                    <div class="half left-arrow d-flex align-items-center">
                        <div class="text p-4 p-xl-5 text-center">
                            <p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
                            <p class="mb-0"><span class="price mr-1">Tsh <?php echo number_format($row['hostel_price']); ?>/- </span> <span class="per">per month</span></p>
                            <h3 class="mb-3"><a href="view_hostel.php?id=<?php echo $row['hostel_id'];?>"><?php echo ucwords($row['hostel_name']); ?></a></h3>
                            <ul class="list-accomodation">
                                <li><span>Location:</span> <?php echo ucwords($row['hostel_location']); ?></li>
                                <li><span>Type:</span> <?php echo ucwords($row['hostel_type']);?> </li>
                            </ul>
                            <a href="view_hostel.php?id=<?php echo $row['hostel_id'];?>" class="pt-1 btn-custom px-3 py-2">View Hostel Details</a>

                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }
}
