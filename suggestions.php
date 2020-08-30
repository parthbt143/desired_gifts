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
                                $atr_grps = get_all("select * from tbl_attribute_group");
                                $i = 0;
                                if (isset($_GET['atr_grp_id'])) {
                                    $selected_atr_grp_id = $_GET['atr_grp_id'];
                                } else {
                                    $selected_atr_grp_id = '0';
                                }
                                foreach ($atr_grps as $atr_grp) {
                                    if ($selected_atr_grp_id == $atr_grp['atr_grp_id']) {
                                        $checked = "checked";
                                    } else {
                                        $checked = "";
                                    }
                                    $i++;
                                    ?>
                                    <div class="filter_type version_2">
                                        <h4><a href="#filter_<?php echo $i ?>" data-toggle="collapse" class="opened"> <?php echo ucwords($atr_grp['atr_grp_name']) ?></a></h4>
                                        <div class="collapse show" id="filter_<?php echo $i ?>">
                                            <ul> 
                                                <?php
                                                $atr_vals = get_all("select * from tbl_attribute_value where atr_grp_id = '{$atr_grp['atr_grp_id']}'");
                                                if (isset($_GET['atr_val_id'])) {
                                                    $selected_atr_val_id = $_GET['atr_val_id'];
                                                } else {
                                                    $selected_atr_val_id = '0';
                                                }


                                                foreach ($atr_vals as $atr_val) {
                                                    $count = get_single("select count(pro_id) as total from tbl_suggestion where atr_val_id = '{$atr_val['atr_val_id']}'");
                                                    if ($selected_atr_grp_id == '0') {
                                                        if ($selected_atr_val_id == $atr_val['atr_val_id']) {
                                                            $checked = "checked";
                                                        } else {
                                                            $checked = "";
                                                        }
                                                    }
                                                    ?>
                                                    <li>
                                                        <label class="container_check"><?php echo $atr_val['atr_val_name'] ?> <small> <?php echo $count['total'] ?></small>
                                                            <input onchange="reset_current_page();filter()" name="atr_val" value="<?php echo $atr_val['atr_val_id'] ?>" type="checkbox" <?php echo $checked ?>>
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
                                                                    var atr_val_ids = [];
                                                                    $.each($("input[name='atr_val']:checked"), function () {
                                                                        atr_val_ids.push($(this).val());
                                                                    });
                                                                    if (atr_val_ids.length === 0)
                                                                    {
                                                                        atr_val_ids = 0;
                                                                    }
                                                                    $.ajax({
                                                                        url: 'product-listing-div-suggestion.php',
                                                                        type: 'post',
                                                                        data: {
                                                                            keyword: keyword,
                                                                            current_page: current_page,
                                                                            atr_val_ids: atr_val_ids,
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
                            window.location.href = 'suggestions.php';
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
                            window.location.href = 'suggestions.php';
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