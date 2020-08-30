<?php

include 'class/class.php';
if (isset($_POST)) {
    if (isset($_SESSION['cust_id'])) {
        $cust_id = $_SESSION['cust_id'];
    } else {
        $cust_id = 0;
    }
    if ($cust_id == 0) {
        $response["flag"] = "0";
        $response["message"] = "You Need To Login First!";
    } else {
        $pro_id = $_POST['pro_id'];

        mysqli_query($connection, "delete from tbl_cart where cust_id = '{$cust_id}' and pro_id = '{$pro_id}' ");
        $response["flag"] = "1";
//        $response["url"] = "product-details.php?id=$pro_id";
        $response["message"] = "Product Removed From Cart !";
    }
} else {
    $response["flag"] = "0";
    $response["message"] = "Something Went Wrong. Try Again !";
}
echo json_encode($response);
