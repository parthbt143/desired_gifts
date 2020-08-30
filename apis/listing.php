<?php

include "../class/class.php";
$alldata = array();
$data = [];
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if ($page == "vendor") {
        $vendors = get_all("select * from tbl_user where role_id = '2' and is_delete = '0'");
        $sr = 0;
        foreach ($vendors as $vendor) {
            $sr++;
            $ar = array($sr, $vendor['user_name'], $vendor['user_email'], $vendor['user_mobile'], "<span class=\"fa fa-trash\" style=\"color: red\"  onclick=\"delete_this('tbl_user','user_id',{$vendor['user_id']})\"></span>");
            $data[] = $ar;
        }
    }

    if ($page == "category") {
        $cats = get_all("select * from tbl_category where is_delete = '0'");
        $sr = 0;
        foreach ($cats as $cat) {
            $sr++;
            $ar = array($sr,
                $cat['cat_name'],
                "<img src= " . check_image(upload_url() . "category/{$cat['img']}") . " style=\"height:50px; \">",
                "<span class=\"fa fa-trash\" style=\"color: red\"  onclick=\"delete_this('tbl_category','cat_id',{$cat['cat_id']})\"></span>");
            $data[] = $ar;
        }
    }

    if ($page == "sub_category") {
        $sub_cats = get_all("select * from tbl_sub_category where is_delete = '0'");
        $sr = 0;
        foreach ($sub_cats as $sub_cat) {
            $sr++;
            $cat = get_single("select * from tbl_category where cat_id = '{$sub_cat['cat_id']}'");
            $ar = array(
                $sr,
                $cat['cat_name'],
                $sub_cat['sc_name'],
                "<img src= " . check_image(upload_url() . "sub-category/{$sub_cat['img']}") . " style=\"height:50px; \">",
                "<span class=\"fa fa-trash\" style=\"color: red\"  onclick=\"delete_this('tbl_sub_category','sc_id',{$sub_cat['sc_id']})\"></span>");
            $data[] = $ar;
        }
    }

    if ($page == "supp_product") {
        $products = get_all("select * from tbl_product where is_delete = '0' and supp_id = '{$_SESSION['vendor_id']}'  order by pro_id desc ");
        $sr = 0;
        foreach ($products as $product) {
            $sr++;
            $cat = get_single("select * from tbl_category where cat_id = '{$product['cat_id']}'");
            $sub_cat = get_single("select * from tbl_sub_category where sc_id = '{$product['sc_id']}'");
            $image = get_single("select * from tbl_product_image where pro_id = '{$product['pro_id']}' limit 1 ");
            $ar = array(
                $sr,
                $product['pro_name'],
                $product['price'] . "<span class=\"fa\" aria-hidden=\"true\">&nbsp;    &#xf156; </span> ",
                "<img src= " . check_image(upload_url() . "products/{$image['img']}") . " style=\"height:50px; \">",
                "<span onclick=\"show_details({$product['pro_id']})\" class=\"fa fa-eye\" aria-hidden=\"true\">  </span> ",
                "<span class=\"fa fa-trash\" style=\"color: red\"  onclick=\"delete_this('tbl_product','pro_id',{$product['pro_id']})\"></span>");
            $data[] = $ar;
        }
    }

    if ($page == "product") {
        $products = get_all("select * from tbl_product where is_delete = '0' order by pro_id desc ");
        $sr = 0;
        foreach ($products as $product) {
            $sr++;
            $cat = get_single("select * from tbl_category where cat_id = '{$product['cat_id']}'");
            $sub_cat = get_single("select * from tbl_sub_category where sc_id = '{$product['sc_id']}'");
            $supp = get_single("select * from tbl_user where user_id = '{$product['supp_id']}'");
            $image = get_single("select * from tbl_product_image where pro_id = '{$product['pro_id']}' limit 1 ");
            $ar = array(
                $sr,
                $product['pro_name'],
                $supp['user_name'],
                $product['price'] . "<span class=\"fa\" aria-hidden=\"true\">&nbsp;    &#xf156; </span> ",
                "<img src= " . check_image(upload_url() . "products/{$image['img']}") . " style=\"height:50px; \">",
                "<span onclick=\"show_details({$product['pro_id']})\" class=\"fa fa-eye\" aria-hidden=\"true\">  </span> ",
                "<span class=\"fa fa-trash\" style=\"color: red\"  onclick=\"delete_this('tbl_product','pro_id',{$product['pro_id']})\"></span>");
            $data[] = $ar;
        }
    }
    if ($page == "customer") {
        $customers = get_all("select * from tbl_user  where role_id = '3' ");
        $sr = 0;
        foreach ($customers as $customer) {
            $sr++;
            if ($customer['is_delete'] == "1") {
                $block = "<span class=\"btn btn-success\" style=\"color: white\"  onclick=\"block_unblock_user('tbl_user','user_id',{$customer['user_id']},'0')\">Unblock</span>";
            } else {
                $block = "<span class=\"btn btn-danger\" style=\"color: white\"  onclick=\"block_unblock_user('tbl_user','user_id',{$customer['user_id']},'1')\">Block</span>";
            }
            $ar = array($sr,
                $customer['user_name'],
                "<img src= " . check_image(upload_url() . "customer/{$customer['user_image']}") . " style=\"height:50px; \">",
                "<span onclick=\"show_details({$customer['user_id']})\" class=\"fa fa-eye\" aria-hidden=\"true\">  </span>",
                "$block");
            $data[] = $ar;
        }
    }

    if ($page == "request_category") {
        $cats = get_all("select * from tbl_category_request ");
        $sr = 0;
        foreach ($cats as $cat) {
            $sr++;
            $vendor_name = get_single("select * from tbl_user where user_id = '{$cat['user_id']}'");
            $ar = array($sr,
                $cat['cat_name'],
                "<img src= " . check_image(upload_url() . "category/{$cat['img']}") . " style=\"height:50px; \">",
                "{$vendor_name['user_name']}",
                "<span class=\"fa fa-check\" style=\"color: green\"  onclick=\"accept_this('tbl_category_request','cat_id',{$cat['cat_id']})\"></span> | <span class=\"fa fa-trash\" style=\"color: red\"  onclick=\"reject_this('tbl_category_request','cat_id',{$cat['cat_id']})\"></span>");
            $data[] = $ar;
        }
    }
    if ($page == "sub_category_request") {
        $sub_cats = get_all("select * from tbl_sub_category_request");
        $sr = 0;
        foreach ($sub_cats as $sub_cat) {
            $sr++;
            $vendor_name = get_single("select * from tbl_user where user_id = '{$sub_cat['user_id']}'");
            $cat = get_single("select * from tbl_category where cat_id = '{$sub_cat['cat_id']}'");
            $ar = array(
                $sr,
                $cat['cat_name'],
                $sub_cat['sc_name'],
                "<img src= " . check_image(upload_url() . "sub-category/{$sub_cat['img']}") . " style=\"height:50px; \">",
                "{$vendor_name['user_name']}",
                "<span class=\"fa fa-check\" style=\"color: green\"  onclick=\"accept_this('tbl_sub_category_request','sc_id',{$sub_cat['sc_id']})\"></span> | <span class=\"fa fa-trash\" style=\"color: red\"  onclick=\"reject_this('tbl_sub_category_request','sc_id',{$sub_cat['sc_id']})\"></span>");
            $data[] = $ar;
        }
    }
    if ($page == "order") {
        $orders = get_all("select * from tbl_order order by order_id desc");
        $sr = 0;
        foreach ($orders as $order) {
            $sr++;
            $cust_name = get_single("select * from tbl_user where user_id = '{$order['cust_id']}'");
            $ar = array(
                $sr,
                $cust_name['user_name'],
                $order['date'],
                "₹ " . number_format($order['amt'], 2),
                $order['status'],
                "<span onclick=\"show_details({$order['order_id']})\" class=\"fa fa-eye\" aria-hidden=\"true\">  </span>"
            );
            $data[] = $ar;
        }
    }
    if ($page == "vendor_orders") { 
        $orders = get_all("select * from tbl_order_details where supp_id = '{$_SESSION['vendor_id']}'  order by order_id desc");
        $sr = 0;
        foreach ($orders as $order) {
            $product_data = get_single("select * from tbl_product where pro_id = '{$order['pro_id']}'");
            $image = get_single("select * from tbl_product_image where pro_id = '{$order['pro_id']}' limit 1");
            $sr++;
            $ar = array(
                $sr,
                $product_data['pro_name'],
                "<img src= " . check_image(upload_url() . "products/{$image['img']}") . " style=\"height:50px; \">",
                "₹ " . number_format($order['price'], 2),
                      "{$order['status']}"  ,
                "<span onclick=\"show_details({$order['order_details_id']})\" class=\"fa fa-eye\" aria-hidden=\"true\">  </span>"
            );   
            $data[] = $ar;
        }
          
    }
} else {
    exit();
}
$alldata["data"] = $data;
echo json_encode($alldata);
