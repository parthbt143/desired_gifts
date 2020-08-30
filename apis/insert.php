<?php

include "../class/class.php";

if(isset($_GET['page']))
{
    $page=$_GET['page'];
    if($page == 'cat')
    {
        $cat_name = escape_string($_POST['cat_name']);
        $filename = escape_string($_POST['img']);
        $upload = upload_image($filename, $cat_name, "", 0);
        $img = $upload[0];
        $data = array(
            "cat_name" => $cat_name,
            "img" => $img
        );
        $insert = insertdata($data, "tbl_category");
        if($insert)
        {
            $flag = "1";
            $msg = "Category Inserted Successfully.";
        }else{
            $flag = "0";
            $msg = "Something Went Wrong.";
        }
    }

}
else{ 
    exit();
}
$response = array(
    "flag" => $flag,
    "msg" => $msg,
    "img" => $img
);
echo json_encode($response);