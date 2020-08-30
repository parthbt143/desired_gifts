<?php
include "../class/class.php";
include "../themepart/toast-script.php";
$page_title = "Admin DashBoard";
admin_auth();
print_toast();
?>
<html>
    <?php
    include "../themepart/header.php";
    ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <?php
            include "../themepart/admin_head.php";
            include "../themepart/admin_side_bar.php";
            ?>

            <div class="content-wrapper" style="min-height: 352px;">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Dashboard</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <!--<li class="breadcrumb-item"><a href="">Dashboard</a></li>--> 
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><?php
                                            $vendor_count = get_single("select count(user_id) as total from tbl_user where role_id = '2'");
                                            echo $vendor_count['total']
                                            ?></h3>

                                        <p>Vendors</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <a href="<?php echo admin_url() . "vendor/view.php" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>
                                            <?php
                                            $cust_count = get_single("select count(user_id) as total from tbl_user where role_id = '3'");
                                            echo $cust_count['total']
                                            ?>
                                        </h3>

                                        <p>Customers</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <a href="<?php echo admin_url() . "customer/view.php" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><?php
                                            $product_count = get_single("select count(pro_id) as total from tbl_product where is_delete = '0'");
                                            echo $product_count['total']
                                            ?></h3>

                                        <p>Products</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-chart-pie"></i>
                                    </div>
                                    <a href="<?php echo admin_url() . "products/view.php" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>
                                            <?php
                                            $order_count = get_single("select count(order_id) as total from tbl_order where status = 'Placed'");
                                            echo $order_count['total']
                                            ?>
                                        </h3>

                                        <p>New Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-calendar-alt"></i>
                                    </div>
                                    <a href="<?php echo admin_url() . "orders/view.php" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><?php
                                            $cat_count = get_single("select count(cat_id) as total from tbl_category where is_delete = '0'");
                                            echo $cat_count['total']
                                            ?></h3>

                                        <p>Categories</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-chart-pie"></i>
                                    </div>
                                    <a href="<?php echo admin_url() . "category/view.php" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3><?php
                                            $request_count = get_single("select count(cat_id) as total from tbl_category_request");
                                            echo $request_count['total']
                                            ?></h3>

                                        <p>New Category Request</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-chart-pie"></i>
                                    </div>
                                    <a href="<?php echo admin_url() . "category/request.php" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3><?php
                                            $sub_count = get_single("select count(sc_id) as total from tbl_sub_category where is_delete = '0'");
                                            echo $sub_count['total']
                                            ?></h3>

                                        <p>Sub Categories</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-chart-pie"></i>
                                    </div>
                                    <a href="<?php echo admin_url() . "sub-category/view.php" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3><?php
                                            $sub_request_count = get_single("select count(sc_id) as total from tbl_sub_category_request");
                                            echo $sub_request_count['total']
                                            ?></h3>

                                        <p>New Sub Category Requests </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-chart-pie"></i>
                                    </div>
                                    <a href="<?php echo admin_url() . "sub-category/request.php" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div> 
                    </div><!-- /.container-fluid -->
                </section>
            </div>
        </div>


    </body>
    <?php include "../themepart/script.php"; ?>
</html>
