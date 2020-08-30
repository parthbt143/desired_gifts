<?php

include "../class/class.php";

if (isset($_POST['tbl'])) {
    $tbl = $_POST['tbl'];
    $id = $_POST['id'];
    $pk = $_POST['pk'];
    $status = $_POST['status'];

    $delete = soft_delete($tbl, $pk, $id, $status);
    if ($delete) {
        $flag = "1";
        if ($status == "1") {
            $msg = "User Blocked Successfully";
        } else {
            $msg = "User Unblocked Successfully";
        }
    } else {
        $flag = "2";
        $msg = "Something Went Wrong !";
    }
} else {
    exit();
}
$response = array(
    "flag" => $flag,
    "msg" => $msg
);
echo json_encode($response);
