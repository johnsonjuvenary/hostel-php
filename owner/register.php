<?php
include('../config/functions.php');
owner_register();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="description" content="Miminium Admin Template v.1">
    <meta name="author" content="Isna Nur Azis">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hostel Rental | Owner</title>

    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

    <!-- plugins -->
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css" />
    <link href="asset/css/style.css" rel="stylesheet">
    <!-- end: Css -->

    <link rel="shortcut icon" href="asset/img/logomi.png">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body id="mimin" class="dashboard form-signin-wrapper">

    <div class="container">

        <form class="form-signin" action="" method="POST" enctype="multipart/form-data">
            <div class="panel periodic-login">
                <div class="panel-body text-center">
                    <h1 class="">Hostel Rental</h1>
                    <p class="atomic-mass">Hostel Owner</p>
                    <p class="element-name">Signup</p>
                    <?php if (!empty($_SESSION['message'])) : ?>
                        <div class="alert alert-danger">
                            <?php display_message(); ?>
                        </div>
                 
                    <?php endif; ?>
                    <?php if (!empty($success)) : ?>
                        <div class="alert alert-success">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>
                    <i class="icons icon-arrow-down"></i>
                    <div class="form-group form-animate-text" style="margin-top:10px !important;">
                        <input type="text" name="full_name" class="form-text" value="<?php echo $full_name; ?>" required>
                        <span class="bar"></span>
                        <label>Full Name</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:10px !important;">
                        <input type="email" name="email" class="form-text" value="<?php echo $email; ?>" required>
                        <span class="bar"></span>
                        <label>Email</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:10px !important;">
                        <input type="text" name="phone_number" class="form-text" value="<?php echo $phone_number; ?>" required>
                        <span class="bar"></span>
                        <label>Phone Number</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:10px !important;">
                        <input type="text" name="address" class="form-text" value="<?php echo $address; ?>" required>
                        <span class="bar"></span>
                        <label>Address</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:10px !important;">
                        <input type="file" name="attachment" class="form-text" required>
                        <span class="bar">A valid idntification</span>
                        <label></label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:10px !important;">
                        <input type="password" name="password" class="form-text" required>
                        <span class="bar"></span>
                        <label>Password</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:10px !important;">
                        <input type="password" name="password2" class="form-text" required>
                        <span class="bar"></span>
                        <label>Repeat Password</label>
                    </div>
                    <label class="pull-left">
                        <input type="checkbox" class="icheck pull-left" name="checkbox1" required /> &nbsp Agree the terms and policy
                    </label>
                    <input type="submit" name="owner_sign_up" class="btn col-md-12" value="SignUp" />
                </div>
                <div class="text-center" style="padding:2px;">
                    <a href="index.php">Already have an account?</a>
                </div>
            </div>
        </form>

    </div>

    <!-- end: Content -->
    <!-- start: Javascript -->
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery.ui.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>

    <script src="asset/js/plugins/moment.min.js"></script>
    <script src="asset/js/plugins/icheck.min.js"></script>

    <!-- custom -->
    <script src="asset/js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-aero',
                radioClass: 'iradio_flat-aero'
            });
        });
    </script>
    <!-- end: Javascript -->
</body>

</html>