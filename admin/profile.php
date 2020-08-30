<?php
include "../class/class.php";
include "../themepart/toast-script.php";
$page_title = "Admin Profile";
admin_auth();
print_toast();
print_sweet_alert();
if (isset($_POST['change'])) {
    $opass = escape_string($_POST['opass']);
    $npass = escape_string($_POST['npass']);
    $cpass = escape_string($_POST['cpass']);

    if (get_admindata('user_password') == $opass) {
        if ($opass == $npass) {
            set_sweet_alert(2, "Your Old Password Can\'t Be Your New Password");
        } else {
            if ($npass != $cpass) {
                set_sweet_alert(2, "New Password Not Matched With Confirm Password");
            } else {
                $admin_id = get_admindata('user_id');
                mysqli_query($connection, "update tbl_user set user_password = '{$cpass}'  where user_id = '{$admin_id}'");
                set_sweet_alert(1, "Password Changed.");
            }
        }
    } else {
        set_sweet_alert(2, "Old Password Did Not Match With The System");
    }
//    exit;
    refresh();
}

if (isset($_POST['update'])) {
    $user_name = escape_string($_POST['user_name']);
    $user_email = escape_string($_POST['user_email']);
    $user_mobile = escape_string($_POST['user_mobile']);
    $admin_id = get_admindata('user_id');
    mysqli_query($connection, "update tbl_user set user_name = '{$user_name}' , user_mobile = '{$user_mobile}', user_email = '{$user_email}' where user_id = '{$admin_id}'");
    set_sweet_alert(1, "Profile Updated Successfully");
//    exit;
    refresh();
}
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
                                     <li class="breadcrumb-item active"><a href="profile.php">Profile</a> </li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Personal Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" id="form" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user_name">Name </label>
                                    <input type="text" value="<?php echo get_admindata('user_name') ?>"   required="" class="form-control" name="user_name" placeholder="Enter Your Name">

                                </div><div class="form-group">
                                    <label for="user_email">Email </label>
                                    <input type="email"  value="<?php echo get_admindata('user_email') ?>"  required="" class="form-control" name="user_email" placeholder="Enter Your Email">

                                </div><div class="form-group">
                                    <label for="user_mobile">Mobile  </label>
                                    <input type="text" value="<?php echo get_admindata('user_mobile') ?>"  onkeypress="return isNumber(event)"   minlength="10" maxlength="10" required="" class="form-control" name="user_mobile" placeholder="Enter Your Number">

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button id="submit" name="update"  type="submit" class="btn btn-primary">Update </button>
                            </div>
                        </form>
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <form method="post" id="form" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user_name">Old Password </label>
                                    <input type="password"    required="" class="form-control" name="opass" placeholder="Enter Old Password">

                                </div>
                                <div class="form-group">
                                    <label for="user_name">New Password </label>
                                    <input type="password"    required="" class="form-control" name="npass" placeholder="Enter New Password">

                                </div><div class="form-group">
                                    <label for="user_name">Confirm Password </label>
                                    <input type="password"    required="" class="form-control" name="cpass" placeholder="Enter Confirm Password">

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button id="submit" name="change"  type="submit" class="btn btn-primary">Change Password </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>

        </div>
    </body>
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
    <?php include "../themepart/script.php"; ?>
</html>
