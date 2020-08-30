<?php
include 'class/class.php';
$query = "select * from tbl_product where is_delete='0' ";
if (isset($_POST['keyword'])) {
    $keyword = preg_replace('/\s+/', ' ', escape_string($_POST['keyword']));
    $query .= " and pro_name like '%{$keyword}%'";
}
$sub_cat_ids = $_POST['sub_cat_ids'];
//$order = $_POST['order'];
if ($sub_cat_ids != 0) {
    $query .= "and sc_id in (" . implode(",", $sub_cat_ids) . ")";
}
$current_page = $_POST['current_page'];
//echo $current_page;
//$query .= " order by pro_name $order";
$result = get_all($query);
$numrows = count($result);
$rowsperpage = 12;
$totalpages = ceil($numrows / $rowsperpage);
$offset = ($current_page - 1) * $rowsperpage;
//echo $query;
$products = get_all("$query  limit $offset, $rowsperpage");
if (isset($_SESSION['cust_id'])) {
    $cust_id = $_SESSION['cust_id'];
} else {
    $cust_id = 0;
}
if (sizeof($products) > 0) {
    ?>

    <div class="row row_item">
        <?php
        foreach ($products as $product) {
            ?>

            <div class="col-sm-3  mt-4">
                <figure>
                    <!--<span class="ribbon off">-30%</span>-->
                    <a href="product-details.php?id=<?php echo $product['pro_id'] ?>">
                        <?php
                        $img = get_single("select * from tbl_product_image where pro_id = '{$product['pro_id']}' limit 1");
                        ?>
                        <img class="img-fluid lazy" style="height:250px" src="<?php echo check_image(upload_url() . "products/{$img['img']}") ?>" data-src="assets/frontEnd/img/products/shoes/1.jpg" alt="">
                    </a>
                    <!--<div data-countdown="2020/03/15" class="countdown"></div>-->
                </figure>
                <hr>
                            <!--<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>-->
                <a href="product-details.php?id=<?php echo $product['pro_id'] ?>" class="mt-4">
                    <h3  style="height:50px"> <?php echo ucwords($product['pro_name']) ?></h3>
                </a>
                <!--<p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident...</p>-->
                 <hr>
                <div class="price_box">
                    <span class="new_price">₹ <?php echo ucwords($product['price']) ?></span>
                    <!--<span class="old_price">$60.00</span>-->
                </div>
                <ul>
                    <?php
                    if ($cust_id == 0) {
                        ?>
                        <li class="col"><button   onclick="add_to_cart(<?php echo $product['pro_id'] ?>)" class ="btn_1 col-md-12">Add to cart</button></li>
                        <?php
                    } else {
                        $is_in_cart = get_single("select count(cart_id) as total from tbl_cart where cust_id = '{$cust_id}' and pro_id = '{$product['pro_id']}' ");
                        if ($is_in_cart['total'] == 1) {
                            ?>
                            <li class="col">
                                <button class="add_to_cart btn_1 col-md-12"  onclick="remove_from_cart(<?php echo $product['pro_id'] ?>)" style="background:red" >Remove From Cart</button>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="col"><button   onclick="add_to_cart(<?php echo $product['pro_id'] ?>)" class ="btn_1 col-md-12">Add to cart</button></li>

                            <?php
                        }
                    }
                    ?>


                </ul>
            </div>


            <?php
        }
        ?>
    </div>
    <div class="pagination__wrapper">
        <ul class="pagination"> 
            <?php
            $prev_disabled = "";
            if ($current_page == 1) {
                $prev_disabled = "disabled";
            }

            $next_disabled = "";
            if ($current_page == $totalpages) {
                $next_disabled = "disabled";
            }
            ?>
            <li class=" prev"   title="previous page">
                <button class="btn btn-success" <?php echo $prev_disabled ?> onclick="prev(<?php echo $current_page - 1 ?>)">Previous</button>
            </li>
            <!--<li><a  class="prev" title="previous page">&#10094;</a></li>-->
            <?php
            for ($i = 1; $i <= $totalpages; $i++) {
                if ($current_page == $i) {
                    $active = "active";
                } else {
                    $active = "";
                }
                ?>
                <!--                <li>
                                    <a href="#0">4</a>
                                </li>-->
                <li class="<?php echo $active ?>"><button class="btn btn-success" onclick="page(<?php echo $i ?>)"><?php echo $i ?></button></li>
                <?php
            }
            ?>
            <li class="next"><button class="btn btn-success"  <?php echo $next_disabled ?> onclick="next(<?php echo $current_page + 1 ?>)">Next</button></li>
            <!--<li><a href="#0" class="next" title="next page">&#10095;</a></li>-->
        </ul>

    </div>

    <?php
} else {
    ?>
    <div class="row row_item">
        <h1>No Product Found</h1>
    </div>
    <?php
}
?>