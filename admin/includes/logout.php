<?php
session_start();
session_unset();
session_destroy();
include('../../config/functions.php');
set_message('Logged out');
redirect_page('../index.php');
