<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('USER_URL', 'http://localhost/desired_gifts/');
    define('ADMIN_URL', 'http://localhost/desired_gifts/admin/');
    define('VENDOR_URL', 'http://localhost/desired_gifts/vendor/');
    define('UPLOAD', 'http://localhost/desired_gifts/uploads/');
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $db = "desired_gift";
} else { //Database Connection for Live Hosting
    define('USER_URL', '');
    define('ADMIN_URL', '');
    define('UPLOAD', '');
    $host = "localhost:3306";
    $user = "";
    $pwd = "";
    $db = "";
}

$connection = mysqli_connect("$host", "$user", "$pwd", "$db");
date_default_timezone_set('Asia/Calcutta');


function user_url() {
    return USER_URL;
}


function admin_url() {
    return ADMIN_URL;
}


function vendor_url() {
    return VENDOR_URL;
}


function upload_url() {
    return UPLOAD;
}
