<?php
include "../../class/class.php";
$msg = "";
if (isset($_POST['user_email'])) {
    $user_email = escape_string($_POST['user_email']);
    $user_password = escape_string($_POST['user_password']);

    $user_data = get_single("select * from tbl_user where user_email = '{$user_email}' and user_password = '{$user_password}' ");
    if ($user_data) {
        $_SESSION["admin_id"] = $user_data["user_id"];
        $msg = "Welcome {$user_data['user_name']}";
        $flag = "1";
        set_toast($flag, "Login Successful !");
    } else {
        $msg = "Invalid Email or Password !";
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

