<?php

include "../class/class.php";
$msg = "";
if (isset($_POST['user_email'])) {
    $user_email = escape_string($_POST['user_email']);
    $user_password = escape_string($_POST['user_password']);
    $user_name = escape_string($_POST['user_name']);
    $user_mobile = escape_string($_POST['user_mobile']);
    $confirm_password = escape_string($_POST['confirm_password']);
    if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        if (is_numeric($user_mobile) && strlen($user_mobile) == "10") {
            $user_data = get_single("select * from tbl_user where (user_email = '{$user_email}' or user_mobile = '{$user_mobile}' )and role_id = '3' and is_delete='0'");
            if ($user_data) {
                $msg = "Email or Mobile Number Already Exist !";
                $flag = "0";
            } else {

                if (strlen($user_password) < 8) {
                    $msg = "Password Length Should Be Minimum 8 Characters.";
                    $flag = "0";
                } else {
                    if ($user_password == $confirm_password) {
                        $data = array(
                            "user_name" => $user_name,
                            "user_email" => $user_email,
                            "user_password" => $user_password,
                            "role_id" => "3",
                            "user_mobile" => $user_mobile,
                            "is_delete" => "0"
                        );
                        $insert = insertdata($data, "tbl_user");
                        if ($insert) {
                            $msg = "Account Registered Successfully!";
                            $flag = "1";
                        } else {
                            $msg = "Something Went Wrong";
                            $flag = "0";
                        }
                    } else {
                        $msg = "Password And Confirm Password Not Matched .";
                        $flag = "0";
                    }
                }
            }
        } else {
            $msg = "Enter Valid Mobile Number ";
            $flag = "0";
        }
    } else {
        $msg = "Enter Valid Email Address.";
        $flag = "0";
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

