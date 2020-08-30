<?php
include "../class/class.php";
unset($_SESSION['vendor_id']);
move("login.php");
set_toast(1, "Logout Successful");