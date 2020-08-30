<?php
include 'class/class.php';
include "themepart/toast-script.php";
print_toast();
print_sweet_alert();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include './includes/head.php' ?>
    <body>

        <div id="page">

            <?php include './includes/header.php' ?>	
            <!-- /header -->

            <main class="bg_gray">
                <div class="container margin_30">
                    <div class="page_header">

                        <h1>Cart page</h1>
                    </div>
                    <!-- /page_header -->
                    <table class="table table-striped cart-list">
                        <thead>
                            <tr>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Price
                                </th> 
                                <th>
                                    Required Images 
                                </th>
                                <th>
                                    Remove
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $empty_cart = 1;
                            if (isset($_SESSION['cust_id'])) {
                                $cart_data = get_all("select * from tbl_cart where cust_id = '{$_SESSION['cust_id']}'");

                                if (count($cart_data) > 0) {
                                    $empty_cart = 0;
                                    $total = 0;
                                    foreach ($cart_data as $cart) {

                                        $product = get_single("Select * from tbl_product where pro_id = '{$cart['pro_id']}'");
                                        $img = get_single("select * from tbl_product_image where pro_id = '{$cart['pro_id']}' limit 1");
                                        $total += $product['price'];
                                        ?>
                                        <tr class="list">
                                            <td>
                                                <a href='product-details.php?id=<?php echo $product['pro_id'] ?>'>
                                                    <div class="thumb_cart">

                                                        <img src="<?php echo check_image(upload_url() . "products/{$img['img']}") ?>"  class="lazy" alt="Image">
                                                    </div>
                                                    <span class="item_cart"><?php echo ucwords($product['pro_name']) ?></span>
                                                </a>
                                            </td>
                                            <td>
                                                <b><?php echo "₹ " . number_format($product['price']) ?></b>
                                            </td>


                                            <td>
                                                <?php
                                                $count = get_single("select count(pro_id) as total from tbl_product_image_size where pro_id = '{$product['pro_id']}' ");
                                                ?>
                                                <b><?php echo $count['total'] ?></b>
                                            </td>
                                            <td>
                                                <button style='background: red' class="btn_1 full-width cart" onclick="remove_from_cart(<?php echo $product['pro_id'] ?>)">
                                                    Remove 
                                                </button>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>

                                <td colspan="3" align="center"  >Your Cart Is Empty</td>

                                <?php
                            }
                        } else {
                            ?>
                            <td colspan="3" align="center" id="cart-status" >You Need To <a href="login.php"> Login  </a>First To View Your Cart</td>

                            <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
                <!-- /container -->
                <?php
                if ($empty_cart == 0) {
                    ?>
                    <div class="box_cart">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-xl-4 col-lg-4 col-md-6">
                                    <ul>

                                        <li>
                                            <span>Total</span>   <?php echo "₹ " . number_format($total) ?>
                                        </li>
                                    </ul>
                                    <a href="checkout.php" class="btn_1 full-width cart">Upload Image And Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /box_cart -->
                    <?php
                }
                ?>

            </main>
            <!--/main-->

            <?php include('footer.php') ?>
            <!--/footer-->
        </div>
        <!-- page -->

        <div id="toTop"></div><!-- Back to top button -->

        <!-- COMMON SCRIPTS -->
        <?php include('include-script.php') ?>

        <script type="text/javascript">
            $(document).on('submit', '.upload-prod-image', function (e) {
                e.preventDefault();
                var t = $(this);
                var str = "";
                var i = 0;
                $.ajax({
                    url: "apis/image-processing.php",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        response = JSON.parse(data);
                        // console.log(response);	   		
                        Object.entries(response).forEach(([key, val]) => {
                            str = 'pro_img_id_' + i;
                            Object.entries(val).forEach(([key, value]) => {
                                if (key == 'error' && value == "true") {
                                    var html = "<p>" + val.data + "</p>"
                                    t.find("input[name=" + str + "]").parent().append(html);
                            }
                            });
                            i += 1;
                        });
                    }
                });
            });
            $(document).on('click', '.remove-product', function (e) {
                e.preventDefault();
                var cart_id = $(this).parents('td').find('input[name="cart_id"]').val();
                var t = $(this);
                $.ajax({
                    url: "apis/cart.php",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    data: {cart_id: cart_id, flag: 'removecart'},
                    success: function (data) {
                        response = JSON.parse(data);
                        $(t).closest('.list').remove();
                        if (response.is_null == true) {
                            $('#cart-status').show();
                        }
                    }
                });
            });
        </script>

        <script type="text/javascript">
            function addImage(pk) {
                alert("addImage: " + pk);
            }

            $('#myModal .save').click(function (e) {
                e.preventDefault();
                addImage(5);
                $('#myModal').modal('hide');
                //$(this).tab('show')
                return false;
            })
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
                                window.location.href = 'cart.php';
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

    <!-- Mirrored from www.ansonika.com/allaia/cart.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] Thu, 12 Mar 2020 18:52:32 GMT -->
</html>