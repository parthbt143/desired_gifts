<?php
include 'class/class.php';
include "themepart/toast-script.php";
print_toast();
print_sweet_alert();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include './includes/head.php' ?>
    
    <link href="assets/frontEnd/css/checkout.css" rel="stylesheet">
    <body>

        <div id="page">

            <?php include './includes/header.php' ?>	
            
            <!-- /header -->

            <main class="bg_gray">
                <div class="container margin_30">
                    <div class="page_header">

                        <h1>My Orders</h1>
                    </div>
                    <!-- /page_header -->
                    <table class="table table-striped cart-list">
                        <thead>
                            <tr>
                                <th style="width:10%">
                                    SR
                                </th>
                                <th style="width:30%">
                                    Products
                                </th>
                                <th style="width:10%">
                                    Date
                                </th> 
                                <th style="width:10%">
                                    Amount 
                                </th>
                                <th style="width:10%">
                                    Status
                                </th>
                                <th style="width:10%">
                                    Details
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $empty_order = 1;
                            if (isset($_SESSION['cust_id'])) {
                                $orders = get_all("select * from tbl_order where cust_id = '{$_SESSION['cust_id']}' order by order_id desc");

                                if (count($orders) > 0) {
                                    $empty_order = 0;
                                    $total = 0;
                                    $sr = 0;
                                    foreach ($orders as $order) {
                                        $sr++;
                                        ?>
                                        <tr class="list">
                                            <td>
                                                <b><?php echo $sr ?></b>
                                            </td>
                                            <td>
                                                <?php
                                                $details = get_all("select * from tbl_order_details where order_id = '{$order['order_id']}'");
                                                foreach ($details as $detail) {
                                                    $product = get_single("select * from tbl_product where pro_id = '{$detail['pro_id']}'");
                                                    ?>
                                                    <a href='product-details.php?id=<?php echo $product['pro_id'] ?>'>

                                                        <span class="item_cart"><?php echo ucwords($product['pro_name']) ?></span>
                                                    </a>
                                                    <?php
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <b><?php echo $order['date'] ?></b>
                                            </td>


                                            <td> 
                                                <b><?php echo "₹ " . number_format($order['amt'], 2) ?></b>
                                            </td> 
                                            <td> 
                                                <b><?php echo $order['status'] ?> </b>
                                            </td>
                                            <td> 
                                                <button class="btn_1 btn-primary"   onclick="show_details(<?php echo $order['order_id'] ?>)" >Detail</button> 

                                            </td>

                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>

                                <td colspan="3" align="center"  >No Orders</td>

                                <?php
                            }
                        } else {
                            ?>
                            <td colspan="3" align="center" id="cart-status" >You Need To <a href="login.php"> Login  </a>First To View Your Orders</td>

                            <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </div>


            </main>
            <!--/main-->
            
                    <div id="order_details"></div>

            <?php include('footer.php') ?>
            <!--/footer-->
        </div>
        <!-- page -->

        <div id="toTop"></div><!-- Back to top button -->

        <!-- COMMON SCRIPTS -->
        <?php include('include-script.php') ?>

         

        <script type="text/javascript">
             function show_details(id)
             {
                 $.ajax({
                url: 'order-details.php', // point to server-side controller method
                cache: false,
                type: 'post',
                data: {id: id},
                success: function (response) {

                    $('#order_details').empty();
                    $('#order_details').html(response);
                },
                error: function (response) {
                    $('#order_details').html(response);
                }
            });
             }
        </script>

    </body>

    <!-- Mirrored from www.ansonika.com/allaia/cart.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] Thu, 12 Mar 2020 18:52:32 GMT -->
</html>