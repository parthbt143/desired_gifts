<?php

include "../class/class.php";

if (isset($_POST['tbl'])) {
    $tbl = $_POST['tbl'];
    $id = $_POST['id'];
    $pk = $_POST['pk'];

    if ($tbl == "tbl_category_request") {
        $data = get_single("select * from $tbl where $pk = '$id'  ");
        $ar = array(
            "cat_name" => $data['cat_name'],
            "img" => $data['img']
        );
        $ins = insertdata($ar, "tbl_category");
        hard_delete("delete from $tbl where $pk = '$id'");
        if ($ins) {
            $flag = "1";
            $msg = "Category Request Accepted Successfully";
        } else {

            $flag = "0";
            $msg = "Something Went Wrong !";
        }
    }
    if ($tbl == "tbl_sub_category_request") {
        $data = get_single("select * from $tbl where $pk = '$id'  ");
        $ar = array(
            "cat_id" => $data['cat_id'],
            "sc_name" => $data['sc_name'],
            "img" => $data['img'] ,
        );
        $ins = insertdata($ar, "tbl_sub_category");
        hard_delete("delete from $tbl where $pk = '$id'");
        if ($ins) {
            $flag = "1";
            $msg = "Sub Category Request Accepted Successfully";
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
