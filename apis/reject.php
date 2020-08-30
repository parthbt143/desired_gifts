<?php

include "../class/class.php";

if (isset($_POST['tbl'])) {
    $tbl = $_POST['tbl'];
    $id = $_POST['id'];
    $pk = $_POST['pk'];

    if ($tbl == "tbl_category_request") {
        $dlt = hard_delete("delete from $tbl where $pk = '$id'");
        if ($dlt) {
            $flag = "1";
            $msg = "Category Request Rejected Successfully";
        } else {

            $flag = "0";
            $msg = "Something Went Wrong !";
        }
    }if ($tbl == "tbl_sub_category_request") {
        $dlt = hard_delete("delete from $tbl where $pk = '$id'");
        if ($dlt) {
            $flag = "1";
            $msg = "Sub Category Request Rejected Successfully";
        } else {

            $flag = "0";
            $msg = "Something Went Wrong !";
        }
    }
} else {
    exit();
}
$response = array(
    "flag" => $flag,
    "msg" => $msg
);
echo json_encode($response);
