<?php
include 'class/class.php';
include "themepart/toast-script.php";
print_toast();
print_sweet_alert();
if (isset($_POST['change'])) {
    $opass = escape_string($_POST['opass']);
    $npass = escape_string($_POST['npass']);
    $cpass = escape_string($_POST['cpass']);
    $user_data = get_single("select * from tbl_user where user_id = '{$_SESSION['cust_id']}'");

    if ($user_data['user_password'] == $opass) {  
        if ($opass == $npass) {  
            set_sweet_alert(2, "Your Old Password Can\'t Be Your New Password");
        } else { 
            if ($npass != $cpass) { 
                set_sweet_alert(2, "New Password Not Matched With Confirm Password");
            } else { 
                mysqli_query($connection, "update tbl_user set user_password = '{$cpass}'  where user_id = '{$_SESSION['cust_id']}'");
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

    mysqli_query($connection, "update tbl_user set user_name = '{$user_name}' , user_mobile = '{$user_mobile}', user_email = '{$user_email}' where user_id = '{$_SESSION['cust_id']}'");
    set_sweet_alert(1, "Profile Updated Successfully");
    refresh();
}
?>
<!DOCTYPE html>
<html lang="en">`
    <?php include './includes/head.php' ?>

    <link href="assets/frontEnd/css/checkout.css" rel="stylesheet">
    <body>

        <div id="page">

            <?php include './includes/header.php' ?>	

            <!-- /header -->

            <main class="bg_gray">
                <div class="container margin_30">
                    <div class="page_header">

                        <h1>My Account</h1>
                    </div>
                    <!-- /page_header -->                        <form method="post">

                        <?php
                        $user_data = get_single("select * from tbl_user where user_id = '{$_SESSION['cust_id']}'");
                        ?>
                        <table class="table  cart-list">
                            <thead>

                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        Name :- 
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="user_name" value="<?php echo $user_data['user_name'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email :- 
                                    </td>
                                    <td>
                                        <input type="email" class="form-control" name="user_email" value="<?php echo $user_data['user_email'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Mobile :- 
                                    </td>
                                    <td>
                                        <input type="text" minlength="10" maxlength="10" class="form-control"  onkeypress="return isNumber(event)"  name="user_mobile" value="<?php echo $user_data['user_mobile'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="update" value="Update Profile" class="btn_1 btn-success">
                                    </td> 
                                </tr>


                            </tbody>
                        </table>

                    </form>
                    <div class="page_header">

                        <h1>Change Password</h1>
                        <form method="post">

                            <table class="table  cart-list">


                                <tbody>

                                    <tr>
                                        <td>
                                            Enter Current Password :- 
                                        </td>
                                        <td>
                                            <input type="password" autocomplete="off" class="form-control" name="opass">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Enter New Password :- 
                                        </td>
                                        <td>
                                            <input type="password" class="form-control" name="npass">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Confirm New Password :- 
                                        </td>
                                        <td>
                                            <input type="password" class="form-control" name="cpass">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="change" value="Change Password" class="btn_1 btn-success">
                                        </td> 
                                    </tr>


                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>


            </main>
            <!--/main-->


            <?php include('footer.php') ?>
            <!--/footer-->
        </div>
        <!-- page -->

        <div id="toTop"></div><!-- Back to top button -->

        <!-- COMMON SCRIPTS -->
        <?php include('include-script.php') ?>
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
    <!-- Mirrored from www.ansonika.com/allaia/cart.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] Thu, 12 Mar 2020 18:52:32 GMT -->
</html>