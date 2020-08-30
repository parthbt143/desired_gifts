<?php

include "../../class/class.php";
$msg = "";
if (isset($_POST['user_email'])) {
    $user_email = escape_string($_POST['user_email']);
    $user_password = escape_string($_POST['user_password']);
    $user_name = escape_string($_POST['user_name']);
    $user_mobile = escape_string($_POST['user_mobile']);
    $user_data = get_single("select * from tbl_user where ( user_email = '{$user_email}' or user_mobile = '{$user_mobile}' ) and role_id = '2' ");
    if ($user_data) {
        $flag = "0";
        $msg = "This Email Address or Mobile Number Is Already Registered !";
    } else {
        $data = array(
            "user_name" => $user_name,
            "user_mobile" => $user_mobile,
            "user_email" => $user_email,
            "user_password" => $user_password,
            "role_id" => '2'
        );
        $insert = insertdata($data, 'tbl_user');
        $flag = "1";
        $msg = "Registration Successfull";
    }
} else {
    $flag = "2";
}
$response = array(
    "flag" => $flag,
    "msg" => $msg
);
echo json_encode($response);
?>

