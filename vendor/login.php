<?php
include "../class/class.php";
include "../themepart/toast-script.php";
if (isset($_SESSION['vendor_id'])) {
    move(vendor_url());
}
print_toast();
?>

<!DOCTYPE html>
<html> 
    <?php
    include "../themepart/header.php";
    ?>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b> <?php echo get_setting("project_name"); ?> </b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Vendor Login </p>


                    <div class="input-group mb-3">
                        <input id="user_email" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="user_password" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="button" onclick="login()"class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="text-right mt-4"> Don't Have A Account ? <br> <a href="registration.php">Create Account</a>  </div>


                </div> 
            </div>
        </div>
        <!-- /.login-box -->
        <?php
        include "../themepart/script.php";
        ?>

        <script>
            function login()
            {
                var user_email = $("#user_email").val();
                var user_password = $("#user_password").val();
                if (user_email !== "" || user_password !== "")
                {
                    $.ajax({
                        url: '<?php echo vendor_url(); ?>apis/login.php',
                        type: 'post',
                        data: {
                            user_password: user_password,
                            user_email: user_email
                        },
                        success: function (response) {
//                            console.log(response);
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
                                            toast_danger_alert(response['msg']);
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
        </script>
    </body>
</html>
