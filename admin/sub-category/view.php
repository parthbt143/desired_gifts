<?php
include "../../class/class.php";
include "../../themepart/toast-script.php";
$page_title = "Sub Category List";
admin_auth(); 
print_toast();
print_sweet_alert();
?>
<html>
    <?php
    include "../../themepart/header.php";
    ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php
            include "../../themepart/admin_head.php";
            include "../../themepart/admin_side_bar.php";
            ?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><?php echo $page_title ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo admin_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Sub Category </li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title float-right"><a href="add.php"><span class="fa fa-plus" style="color:green"> &nbsp; Add New Sub Category</span></a></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Sr</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Image</th> 
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sr</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Image</th> 
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
        </div>

    </body>
    <?php include "../../themepart/script.php"; ?>
    <?php include "../../themepart/datatable.php"; ?>
    <script>
        datatable("sub_category");
    </script>
</html>
