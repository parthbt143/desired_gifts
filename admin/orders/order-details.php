<script>$('#clickmodel').trigger('click');</script>
<!-- Trigger the modal with a button -->
<a  id="clickmodel"  data-toggle="modal" data-target="#message"></a>
<?php
include "../../class/class.php";
if (isset($_POST['id'])) {
    $order_id = $_POST['id'];
    $order_data = get_single("select * from tbl_order where order_id = '{$_POST['id']}'");
    $cust_data = get_single("Select * from tbl_user where user_id = '{$order_data['cust_id']}'");
} else {
    exit();
}
?>
<div class="modal fade" id="message" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Customer Name</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $cust_data['user_name'] ?>"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Amount</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="₹ <?php echo number_format($order_data['amt'], 2) ?>"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Date</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $order_data['date'] ?>"  >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Shipping Details</label>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Receiver Name</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $order_data['receiver_name'] ?>"  >
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Receiver Mobile Number</label>  
                                <input type="text" class="form-control fa" aria-hidden="true"  readonly=""  placeholder=""   value="<?php echo $order_data['receiver_number'] ?> "  >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Status</label>  
                                <input type="text" class="form-control fa" aria-hidden="true"  readonly=""  placeholder=""   value="<?php echo $order_data['status'] ?> "  >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Address </label>  
                                <textarea class="form-control fa" aria-hidden="true"  readonly=""  placeholder=""     ><?php echo $order_data['address'] . " - " . $order_data['area_pincode'] ?></textarea>
                            </div>
                        </div>
                    </div>


                </div>

                <?php
                $details = get_all("select * from tbl_order_details where order_id = '{$order_id}' ");
                $sr = 0;
                foreach ($details as $detail) {
                    $sr++;
                    $product_data = get_single("select * from tbl_product where pro_id ='{$detail['pro_id']}' ");
                    $img = get_single("select * from tbl_product_image where pro_id = '{$detail['pro_id']}' limit 1");
                    $seller_data = get_single("select * from tbl_user where user_id = '{$detail['supp_id']}' ");
                    ?>

                    <hr style="border: 10px solid green;  border-radius: 5px;">
                    <div class="row mt-4 mb-4">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-sm-12">  
                                    <label  class="form-label"> <?php echo $sr ?> ) </label>  <img  src="<?php echo check_image(upload_url() . "products/" . $img['img']) ?>" style="height: 200px;width:200px" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-sm-12">  
                                    <label  class="form-label"> Name :-  <?php echo $product_data['pro_name'] ?> </label> <br>   <br>        
                                    <label  class="form-label"> Price :-  <?php echo "₹ " . number_format($product_data['price'], 2) ?> </label> <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-sm-12"> 

                                    <label  class="form-label"> Seller :-  <?php echo $seller_data['user_name'] ?> </label> <br><br>   
                                    <label  class="form-label">  Status :-   <?php echo $detail['status'] ?> </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $images = get_all("select * from tbl_cust_images where order_details_id = '{$detail['order_details_id']}' ");
                    $img_sr = 0;
                    ?>

                    <div class="row mt-4 mb-4">
                        <?php
                        foreach ($images as $image) {
                            $img_sr++;
                            $size = get_single("select * from tbl_product_image_size where pis_id  = '{$image['pis_id']}'");
                            ?>


                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-sm-12">  
                                        <label  class="form-label"><?php echo $img_sr . " ) &nbsp;" . $size['height'] . " x " . $size['width'] . " inches" ?>  </label>   <br>
                                        <img  src="<?php echo check_image(upload_url() . "customer_images/" . $image['image']) ?>" style="height: 100px;width:100px" ><br>
                                        <a download href="<?php echo check_image(upload_url() . "customer_images/" . $image['image']) ?>"  class="btn btn-default mt-2 " type="button">Download</a>
                                    </div>
                                </div>
                            </div>



                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-sm-12">  
                                <?php
                                $disabled = "";
                                if ($order_data['status'] == "Placed") {
                                    $next = "Ready";
                                    $btn = "Mark As Ready";
                                } else if ($order_data['status'] == "Ready") {
                                    $next = "Out of Delivery";
                                    $btn = "Mark As Out of Delivery";
                                } else if ($order_data['status'] == "Out of Delivery") {
                                    $next = "Delivered";
                                    $btn = "Mark As Delivered";
                                } else {
                                    $btn = "Delivered";
                                    $disabled = "Disabled";
                                }
                                ?>
                                <form method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
                                    <input type="hidden" name="next" value="<?php echo $next ?>">
                                    <button type="submit" <?php echo $disabled ?> name="change" class="btn btn-primary "> <?php echo $btn ?></button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
