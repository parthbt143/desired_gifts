<?php

include "../class/class.php";
$alldata = array();
$data = [];
if (isset($_GET['page'])) {
    $page = $_GET['page'];



    if ($page == "sub_cat") {
        $sub_cats = get_all("select * from tbl_sub_category where cat_id = '{$_POST['cat_id']}' and  is_delete = '0'");
        $sr = 0;
        foreach ($sub_cats as $sub_cat) {
            $sr++;
            $ar = array(
                "sc_id" => $sub_cat['sc_id'],
                "sc_name" => $sub_cat['sc_name']
            );
            $data[] = $ar;
        }
    }
} else {
    exit();
}
echo json_encode($data);
