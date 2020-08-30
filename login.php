<?php
include 'class/class.php';
include "themepart/toast-script.php";
print_toast();
print_sweet_alert();
?>
<html lang="en">
    <?php
    if (isset($_SESSION['cust_id'])) {
        move(user_url() . "index.php");
    }
    ?>

    <?php include './includes/head.php' ?>	
    <link href="assets/frontEnd/css/account.css" rel="stylesheet">

    <body>

        <div id="page">
            <?php include './includes/header.php' ?>	
            <main class="bg_gray">

                <div class="container margin_30">
                    <div class="page_header">

                        <h1>Sign In or Create an Account</h1>
                    </div>
                    <!-- /page_header -->
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-8">
                            <div class="box_account">
                                <h3 class="client">Already Customer </h3>
                                <div class="form_container">							
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Email*">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="user_password" id="user_password" value="" placeholder="Password*">
                                    </div>
                                    <div class="clearfix add_bottom_15">
                                    </div>
                                    <div class="text-center"><button type="button" name="login_in" onclick="login()" id="login_in"  class="btn_1 full-width"> Login </button></div>
                                    <div id="forgot_pw">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
                                        </div>
                                        <p>A new password will be sent shortly.</p>
                                        <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                                    </div>
                                </div>
                                <!-- /form_container -->
                            </div>

                            <!-- /box_account -->

                            <!-- /row -->
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-8"> 
                            <div class="box_account">
                                <h3 class="new_client">New Customer</h3> <small class="float-right pt-2">* Required Fields</small>
                                <div class="form_container">
                                    <div class="form-group">
                                        <input type="text" class="form-control"  id="s_user_name" placeholder="Name*">
                                    </div>  
                                    <div class="form-group">
                                        <input type="email" class="form-control"  id="s_user_email" placeholder="Email*">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control"  id="s_user_mobile"  onkeypress="return isNumber(event)" minlength="10" maxlength="10"  placeholder="Mobile Number *">
                                    </div>
                                    <div class="private box">
                                        <div class="row no-gutters">
                                            <div class="col-6 pr-1">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="s_user_password" placeholder="Password*">
                                                </div>
                                            </div> 
                                            <div class="col-6 pr-1">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="s_confirm_password" placeholder="Confirm Password*">
                                                </div>
                                            </div>


                                        </div>

                                    </div>

                                    <div class="text-center"><button type="button" onclick="signup()" class="btn_1 full-width"> Sign Up </button></div>
                                </div>
                                <!-- /form_container -->
                            </div>

                            <!-- /box_account -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </main>
            <!--/main-->

            <?php include 'footer.php' ?>
            <!--/footer-->
        </div>
        <!-- page -->

        <?php include('include-script.php') ?>

        <script>
            function login()
            {
                var user_email = $("#user_email").val();
                var user_password = $("#user_password").val();
                if (user_email !== "" || user_password !== "")
                {
                    $.ajax({
                        url: '<?php echo user_url(); ?>apis/login.php',
                        type: 'post',
                        data: {
                            user_password: user_password,
                            user_email: user_email
                        },
                        success: function (response) {
                            response = JSON.parse(response);
                            if (response['flag'] === "1")
                            {

                                swal({
                                    title: "Successful",
                                    text: response['msg'],
                                    icon: "success"
                                }).then((value) => {
                                    window.location.href = "index.php";
                                }
                                );
                            } else if (response['flag'] === "0") {
                                swal({
                                    title: "Failed",
                                    text: response['msg'],
                                    icon: "warning"
                                })
                                        .then((value) => {
//                                            toast_danger_alert(response['msg']);
                                        }
                                        );

                            }
                        },
                        error: function (response) {
//                        console.log(response);
                        }
                    });
                } else {
                    swal({
                        title: "Required",
                        text: "Please Enter All Details.",
                        icon: "warning"
                    });
                }


            }
            function signup()
            {
                var s_user_name = $("#s_user_name").val();
                var s_user_email = $("#s_user_email").val();
                var s_user_mobile = $("#s_user_mobile").val();
                var s_user_password = $("#s_user_password").val();
                var s_confirm_password = $("#s_confirm_password").val();
                if (s_user_name !== "" || s_user_email !== "" || s_user_mobile !== "" || s_user_password !== "" || s_confirm_password !== "")
                {
                    $.ajax({
                        url: '<?php echo user_url(); ?>apis/signup.php',
                        type: 'post',
                        data: {
                            user_name: s_user_name,
                            user_email: s_user_email,
                            user_mobile: s_user_mobile,
                            user_password: s_user_password,
                            confirm_password: s_confirm_password
                        },
                        success: function (response) {
                            response = JSON.parse(response);

                            if (response['flag'] === "1")
                            {

                                swal({
                                    title: "Successful",
                                    text: response['msg'],
                                    icon: "success"
                                }).then((value) => {
//                                    window.location.href = "login.php";
                                }
                                );
                                $("#s_user_name").val('');
                                $("#s_user_email").val('');
                                $("#s_user_mobile").val('');
                                $("#s_user_password").val('');
                                $("#s_confirm_password").val('');
                            } else if (response['flag'] === "0") {
                                swal({
                                    title: "Failed",
                                    text: response['msg'],
                                    icon: "warning"
                                })
                                        .then((value) => {
//                                            toast_danger_alert(response['msg']);
                                        }
                                        );

                            }
                        },
                        error: function (response) {
//                        console.log(response);
                        }
                    });
                } else {
                    swal({
                        title: "Required",
                        text: "Please Enter All Details.",
                        icon: "warning"
                    });
                }


            }
            function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
        </script>




        <!-- COMMON SCRIPTS -->

    </body>


</html>