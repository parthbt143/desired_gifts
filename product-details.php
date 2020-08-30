<?php
include('class/class.php');
include "themepart/toast-script.php";
print_toast();
print_sweet_alert();
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $product_details = get_product_details($_GET['id']);
    if ($product_details == 0) {
        move('index.php');
    }
} else {
    move('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">


    <?php include './includes/head.php' ?>	

    <link href="assets/frontEnd/css/product_page.css" rel="stylesheet">

    <body>

        <div id="page">		
            <?php include './includes/header.php' ?>	
            <main>
                <div class="container margin_30">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="all">
                                <?php
                                $images = get_all("select * from tbl_product_image where pro_id = '{$product_details['pro_id']}'");
                                ?>
                                <div class="slider">
                                    <div class="owl-carousel owl-theme main">
                                        <?php
                                        foreach ($images as $img) {
                                            ?>
                                            <div style="background-image: url(<?php echo check_image(upload_url() . "products/{$img['img']}") ?>);" class="item-box"></div>

                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="left nonl"><i class="ti-angle-left"></i></div>
                                    <div class="right"><i class="ti-angle-right"></i></div>
                                </div>
                                <div class="slider-two">
                                    <div class="owl-carousel owl-theme thumbs">
                                        <?php
                                        foreach ($images as $img) {
                                            ?>
                                            <div style="background-image: url(<?php echo check_image(upload_url() . "products/{$img['img']}") ?>);" class="item active"></div>
                                            <?php
                                        }
                                        ?>
                                        <!--                                        <div style="background-image: url(assets/frontEnd/img/products/shoes/1.jpg);" class="item active"></div>
                                                                                <div style="background-image: url(assets/frontEnd/img/products/shoes/2.jpg);" class="item"></div>
                                                                               
                                                                                <div style="background-image: url(assets/frontEnd/img/products/shoes/4.jpg);" class="item"></div>
                                                                                <div style="background-image: url(assets/frontEnd/img/products/shoes/5.jpg);" class="item"></div>
                                                                                <div style="background-image: url(assets/frontEnd/img/products/shoes/6.jpg);" class="item"></div>-->
                                    </div>
                                    <div class="left-t nonl-t"></div>
                                    <div class="right-t"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Category</a></li>
                                    <li>Page active</li>
                                </ul>
                            </div>
                            <!-- /page_header -->
                            <div class="prod_info">
                                <h1><?php echo ucwords($product_details['pro_name']) ?></h1>
                                <!--<span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i><em>4 reviews</em></span>-->
                                <p><?php echo $product_details['pro_details'] ?></p>

                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="price_main"><span class="new_price">&#8377;<?= $product_details['price'] ?></span> 
                                        </div> 
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <?php
                                    if ($cust_id == 0) {
                                        ?>
                                        <div class="col-lg-4 col-md-6">
                                            <button class="add_to_cart btn_1"  onclick="add_to_cart(<?php echo $product_details['pro_id'] ?>)">Add to Cart</button>
                                        </div>
                                        <?php
                                    } else {
                                        $is_in_cart = get_single("select count(cart_id) as total from tbl_cart where cust_id = '{$cust_id}' and pro_id = '{$product_details['pro_id']}' ");
                                        if ($is_in_cart['total'] == 1) {
                                            ?>
                                            <div class="col-lg-4 col-md-6">
                                                <button class="add_to_cart btn_1"  onclick="remove_from_cart(<?php echo $product_details['pro_id'] ?>)" style="background:red" >Remove From Cart</button>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="col-lg-4 col-md-6">
                                                <button class="add_to_cart btn_1"  onclick="add_to_cart(<?php echo $product_details['pro_id'] ?>)">Add to Cart</button>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>



                                </div>


                                <?php
                                if ($product_details['need_images'] == "1") {
                                    ?>
                                    <div class="tabs_product">
                                        <div class="container">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Required Images </a>
                                                </li> 
                                            </ul>
                                        </div>
                                    </div><div class="tab_content_wrapper">
                                        <div class="container">
                                            <div class="tab-content" role="tablist">
                                                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                                                    <div class="card-header" role="tab" id="heading-A">
                                                        <h5 class="mb-0">
                                                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                                                Required Images :- 
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                                                        <div class="card-body">
                                                            <div class="row justify-content-between">

                                                                <div class="col-lg-12">

                                                                    <div class="table-responsive">
                                                                        <table class="table table-sm table-striped">
                                                                            <h3>Required Images Size In Inches :- </h3>
                                                                            <tbody>

                                                                                <tr>

                                                                                    <td><b>Index </b></td>
                                                                                    <td><b>Height</b></td>
                                                                                    <td><b>Width</b></td>

                                                                                </tr>

                                                                                <?php
                                                                                $sizes = get_all("select * from tbl_product_image_size where pro_id = '{$product_details['pro_id']}' order by idx");
                                                                                foreach ($sizes as $size) {
                                                                                    ?>

                                                                                    <tr>
                                                                                        <td><b><?php echo $size['idx'] ?></b></td>
                                                                                        <td><?php echo $size['height'] ?></td>
                                                                                        <td><?php echo $size['width'] ?></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                                ?>


                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- /table-responsive -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>	    
                                                </div>

                                            </div>
                                            <!-- /tab-content -->
                                        </div>
                                        <!-- /container -->
                                    </div> 

                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /container -->


                    <div class="container margin_60_35">
                        <div class="main_title">
                            <h2>Related</h2>
                            <span>Products</span>

                        </div>
                        <div class="owl-carousel owl-theme products_carousel">
                            <?php
                            $products = get_all("select * from tbl_product where sc_id = '{$product_details['sc_id']}' and pro_id != '{$product_details['pro_id']}' and is_delete = '0'");
                            foreach ($products as $product) {
                                $img = get_single("select *  from tbl_product_image where pro_id = '{$product['pro_id']}'  order by rand() limit 1");
                                ?>
                                <div class="item">
                                    <div class="grid_item">
                                        <!--<span class="ribbon new">New</span>-->
                                        <figure>
                                            <a href="product-details.php?id=<?php echo $product['pro_id'] ?>">
                                                <img style="height: 300px" class="img-fluid lazy" src="<?php echo check_image(upload_url() . "products/{$img['img']}") ?>"   alt="">
                                            </a>
                                        </figure>
                                        <!--<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>-->
                                        <a href="product-details.php?id=<?php echo $product['pro_id'] ?>">
                                            <h3> <?php echo ucwords($product['pro_name']) ?></h3>
                                        </a>
                                        <div class="price_box">
                                            <span class="new_price">₹ <?php echo $product['price'] ?></span>
                                        </div>

                                    </div>
                                    <!-- /grid_item -->
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                        <!-- /products_carousel -->
                    </div>
                    <!-- /container -->

                    <div class="feat">
                        <div class="container">
                            <ul>
                                <li>
                                    <div class="box">
                                        <i class="ti-gift"></i>
                                        <div class="justify-content-center">
                                            <h3>Free Shipping</h3>
                                            <p>For all oders over $99</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="box">
                                        <i class="ti-wallet"></i>
                                        <div class="justify-content-center">
                                            <h3>Secure Payment</h3>
                                            <p>100% secure payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="box">
                                        <i class="ti-headphone-alt"></i>
                                        <div class="justify-content-center">
                                            <h3>24/7 Support</h3>
                                            <p>Online top support</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/feat-->

            </main>
            <!-- /main -->

            <?php include('footer.php') ?>
            <!--/footer-->
        </div>
        <!-- page -->

        <div id="toTop"></div><!-- Back to top button -->

        <div class="top_panel">
            <div class="container header_panel">
                <a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
                <label>1 product added to cart</label>
            </div>
            <!-- /header_panel -->
            <div class="item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="item_panel">
                                <figure>
                                    <img src="assets/frontEnd/img/products/product_placeholder_square_small.jpg" data-src="assets/frontEnd/img/products/shoes/1.jpg" class="lazy" alt="">
                                </figure>
                                <h4>1x Armor Air X Fear</h4>
                                <div class="price_panel"><span class="new_price">$148.00</span><span class="percentage">-20%</span> <span class="old_price">$160.00</span></div>
                            </div>
                        </div>
                        <div class="col-md-5 btn_panel">
                            <a href="cart.html" class="btn_1 outline">View cart</a> <a href="checkout.html" class="btn_1">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /item -->
            <div class="container related">
                <h4>Who bought this product also bought</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="item_panel">
                            <a href="#0">
                                <figure>
                                    <img src="assets/frontEnd/img/products/product_placeholder_square_small.jpg" data-src="assets/frontEnd/img/products/shoes/2.jpg" alt="" class="lazy">
                                </figure>
                            </a>
                            <a href="#0">
                                <h5>Armor Okwahn II</h5>
                            </a>
                            <div class="price_panel"><span class="new_price">$90.00</span></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item_panel">
                            <a href="#0">
                                <figure>
                                    <img src="assets/frontEnd/img/products/product_placeholder_square_small.jpg" data-src="assets/frontEnd/img/products/shoes/3.jpg" alt="" class="lazy">
                                </figure>
                            </a>
                            <a href="#0">
                                <h5>Armor Air Wildwood ACG</h5>
                            </a>
                            <div class="price_panel"><span class="new_price">$75.00</span><span class="percentage">-20%</span> <span class="old_price">$155.00</span></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item_panel">
                            <a href="#0">
                                <figure>
                                    <img src="assets/frontEnd/img/products/product_placeholder_square_small.jpg" data-src="assets/frontEnd/img/products/shoes/4.jpg" alt="" class="lazy">
                                </figure>
                            </a>
                            <a href="#0">
                                <h5>Armor ACG React Terra</h5>
                            </a>
                            <div class="price_panel"><span class="new_price">$110.00</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /related -->
        </div>
        <!-- /add_cart_panel -->


        <?php include('include-script.php'); ?>  
        <!-- SPECIFIC SCRIPTS -->
        <script  src="assets/frontEnd/js/carousel_with_thumbs.js"></script>
        <script type="text/javascript">
                                            function add_to_cart(pro_id)
                                            {

                                                $.ajax({
                                                    url: 'add-to-cart-process.php',
                                                    type: 'post',
                                                    data: {
                                                        pro_id: pro_id,
                                                    },
                                                    success: function (response) {
                                                        response = JSON.parse(response);
                                                        if (response['flag'] === "1")
                                                        {
                                                            swal({
                                                                title: "Successful",
                                                                text: response['message'],
                                                                icon: "success"
                                                            }).then((value) => {
                                                                window.location.href = 'product-details.php?id='+pro_id;
                                                            }
                                                            );
                                                        } else {
                                                            swal({
                                                                title: response['message'],
                                                                icon: "warning"
                                                            });
                                                        }

                                                    }
                                                });

                                            }
                                            function remove_from_cart(pro_id)
                                            {

                                                $.ajax({
                                                    url: 'remove-from-cart-process.php',
                                                    type: 'post',
                                                    data: {
                                                        pro_id: pro_id,
                                                    },
                                                    success: function (response) {
                                                        response = JSON.parse(response);
                                                        if (response['flag'] === "1")
                                                        {
                                                            swal({
                                                                title: "Successful",
                                                                text: response['message'],
                                                                icon: "success"
                                                            }).then((value) => {
                                                                window.location.href = 'product-details.php?id='+pro_id;
                                                            }
                                                            );
                                                        } else {
                                                            swal({
                                                                title: response['message'],
                                                                icon: "warning"
                                                            });
                                                        }

                                                    }
                                                });

                                            }
        </script>
    </body>


    <!-- Mirrored from www.ansonika.com/allaia/product-detail-2.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] Thu, 12 Mar 2020 18:52:22 GMT -->
</html>
