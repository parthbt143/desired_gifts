<?php

include "../class/class.php";

if(isset($_POST['tbl']))
{
    $tbl = $_POST['tbl'];
    $id = $_POST['id'];
    $pk = $_POST['pk'];
    
    $delete = soft_delete($tbl, $pk, $id);
    if($delete)
    {
        $flag = "1";
        $msg = "Record Deleted Successfully !";
    }else{
        $flag = "2";
        $msg = "Something Went Wrong !";        
    }
}else{ 
    exit();
}
$response = array(
    "flag" => $flag,
    "msg" => $msg
);
echo json_encode($response);