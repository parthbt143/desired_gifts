<?php

include "../class/class.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $term = escape_string($_POST['term']);



    if ($page == "cat") {
        $query = "select count(cat_id) as total from tbl_category where cat_name like '{$term}' and is_delete = '0'";
    } 
    if ($page == "sub_cat") {
        $query = "select count(sc_id) as total from tbl_sub_category where sc_name like '{$term}' and is_delete = '0'";
    } 
    $count = get_single($query); 
    if ($count['total'] > 0) {
        $flag = "1";
    } else {
        $flag = "0";
    }
} else {
    exit();
}
$response = array(
    "flag" => $flag,
);
echo json_encode($response);
