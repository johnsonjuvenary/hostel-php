<?php
#checking if session has already started otherwise user need to login
if (!isset($_SESSION['admin'])) {
    set_message('Please Login First!');
    redirect_page("index.php");
}
