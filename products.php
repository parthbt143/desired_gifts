<?php
include 'class/class.php';
include "themepart/toast-script.php";
print_toast();
print_sweet_alert();
if (isset($_GET['keyword'])) {
    $keyword = escape_string($_GET['keyword']);
} else {
    $keyword = "";
}
?><!DOCTYPE html>
<html lang="en">


    <?php include './includes/head.php' ?>	

    <link href="assets/frontEnd/css/listing.css" rel="stylesheet">
    <body>

        <div id="page" class="theia-exception">
            <?php include('includes/header.php'); ?>	
            <main>
                <div class="container margin_30">
                    <input type="hidden" id="current_page" value="1" > 
                    <div class="row">
                        <aside class="col-lg-3" id="sidebar_fixed">
                            <div class="filter_col">
                                Search :-

                                <input class="mt-2 col-md-12"  onkeyup="reset_current_page();filter()"  type="text" id="keyword" value="<?php echo $keyword ?>" >
                            </div>
                            <div class="filter_col">
                                <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                                <?php
                                $cats = get_all("select * from tbl_category where is_delete = '0'");
                                $i = 0;
                                if (isset($_GET['cat_id'])) {
                                    $selected_cat_id = $_GET['cat_id'];
                                } else {
                                    $selected_cat_id = '0';
                                }
                                foreach ($cats as $cat) {
                                    if ($selected_cat_id == $cat['cat_id']) {
                                        $checked = "checked";
                                    } else {
                                        $checked = "";
                                    }
                                    $i++;
                                    ?>
                                    <div class="filter_type version_2">
                                        <h4><a href="#filter_<?php echo $i ?>" data-toggle="collapse" class="opened"> <?php echo ucwords($cat['cat_name']) ?></a></h4>
                                        <div class="collapse show" id="filter_<?php echo $i ?>">
                                            <ul> 
                                                <?php
                                                $sub_cats = get_all("select * from tbl_sub_category where cat_id = '{$cat['cat_id']}' and is_delete = '0'");
                                                if (isset($_GET['sub_cat_id'])) {
                                                    $selected_sub_cat_id = $_GET['sub_cat_id'];
                                                } else {
                                                    $selected_sub_cat_id = '0';
                                                }


                                                foreach ($sub_cats as $sub_cat) {
                                                    $count = get_single("select count(pro_id) as total from tbl_product where sc_id = '{$sub_cat['sc_id']}' and is_delete = '0'");
                                                    if ($selected_cat_id == '0') {
                                                        if ($selected_sub_cat_id == $sub_cat['sc_id']) {
                                                            $checked = "checked";
                                                        } else {
                                                            $checked = "";
                                                        }
                                                    }
                                                    ?>
                                                    <li>
                                                        <label class="container_check"><?php echo $sub_cat['sc_name'] ?> <small> <?php echo $count['total'] ?></small>
                                                            <input onchange="reset_current_page();filter()" name="sub_cat" value="<?php echo $sub_cat['sc_id'] ?>" type="checkbox" <?php echo $checked ?>>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </li>
                                                    <?php
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                        <!-- /filter_type -->
                                    </div>
                                    <?php
                                }
                                ?>

                                
                            </div>
                        </aside>
                        <!-- /col -->
                        <div class="col-lg-9">
                            <!--                            <div class="top_banner">
                                                            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                                                                <div class="container pl-lg-5">
                                                                    <div class="breadcrumbs">
                                                                        <ul>
                                                                            <li><a href="#">Home</a></li>
                                                                            <li><a href="#">Category</a></li>
                                                                            <li>Page active</li>
                                                                        </ul>
                                                                    </div>
                                                                    <h1>Shoes - Grid listing</h1>
                                                                </div>
                                                            </div>
                                                            <img src="assets/frontEnd/img/bg_cat_shoes.jpg" class="img-fluid" alt="">
                                                        </div>-->
                            <!-- /top_banner -->
                            <!--<div id="stick_here"></div>-->

                            <!-- /toolbox -->
                            <div id="product_div">


                            </div>



                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </main>
            <!-- /main -->

            <?php include('footer.php') ?>
            <!--/footer-->
        </div>
        <!-- page -->

        <div id="toTop"></div> Back to top button 

        <!-- COMMON SCRIPTS -->
        <?php include('include-script.php') ?>

        <!-- SPECIFIC SCRIPTS -->
        <script src="assets/frontEnd/js/sticky_sidebar.min.js"></script>
        <script src="assets/frontEnd/js/specific_listing.js"></script>

    </body>
    <script>
                                                                $(document).ready(function () {
//            document.getElementById("keyword").value = document.getElementById("searchbox").value;
                                                                    filter();
                                                                });
                                                                function page(current_page)
                                                                {
                                                                    document.getElementById("current_page").value = current_page;
                                                                    filter();
                                                                }
                                                                function prev(current_page)
                                                                {
                                                                    document.getElementById("current_page").value = current_page;
                                                                    filter();
                                                                }
                                                                function next(current_page)
                                                                {
                                                                    document.getElementById("current_page").value = current_page;
                                                                    filter();
                                                                }
                                                                function reset_current_page()
                                                                {
                                                                    document.getElementById("current_page").value = 1;
                                                                }
                                                                function filter()
                                                                {

                                                                    var keyword = document.getElementById("keyword").value;
                                                                    var current_page = document.getElementById("current_page").value;
//            var order = document.getElementById("order").value;
                                                                    var products = document.getElementById("product_div");
                                                                    var sub_cat_ids = [];
                                                                    $.each($("input[name='sub_cat']:checked"), function () {
                                                                        sub_cat_ids.push($(this).val());
                                                                    });
                                                                    if (sub_cat_ids.length === 0)
                                                                    {
                                                                        sub_cat_ids = 0;
                                                                    }
                                                                    $.ajax({
                                                                        url: 'product-listing-div.php',
                                                                        type: 'post',
                                                                        data: {
                                                                            keyword: keyword,
                                                                            current_page: current_page,
                                                                            sub_cat_ids: sub_cat_ids,
//                    order: order
                                                                        },
                                                                        success: function (response) {
                                                                            products.innerHTML = response;
                                                                        }
                                                                    });
                                                                }
    </script>
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
                            window.location.href = 'products.php';
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
                            window.location.href = 'products.php';
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
</html>