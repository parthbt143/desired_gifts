<script>$('#clickmodel').trigger('click');</script>
<!-- Trigger the modal with a button -->
<a  id="clickmodel"  data-toggle="modal" data-target="#message"></a>
<?php
include "../../class/class.php";
if (isset($_POST['id'])) {
    $order_details_id = $_POST['id'];
    $order_data = get_single("select * from tbl_order_details where order_details_id = '{$order_details_id}'");
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
            <?php
            $product_data = get_single("select * from tbl_product where pro_id ='{$order_data['pro_id']}' ");
            ?>

            <div class="modal-body">
                <div class="row"> 
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Product Image</label>
                                <?php
                                $img = get_single("select * from tbl_product_image where pro_id = '{$order_data['pro_id']}' limit 1");
                                ?>
                                <img  src="<?php echo check_image(upload_url() . "products/" . $img['img']) ?>" style="height: 200px;width:200px" >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Product Name</label>

                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $product_data['pro_name'] ?>"  >
                            </div>
                            <div class="col-sm-12">
                                <label  class="form-label">Price</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="₹ <?php echo number_format($product_data['price'], 2) ?>"  >
                            </div>

                            <div class="col-sm-12">
                                <label  class="form-label">Status</label>  
                                <input type="text" class="form-control fa" aria-hidden="true"  readonly=""  placeholder=""   value="<?php echo $order_data['status'] ?> "  >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-4 ml-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <?php
                                $disabled = "";
                                if ($order_data['status'] == "Placed") {
                                    $next = "In Process";
                                    $btn = "Mark As In Process";
                                } else if ($order_data['status'] == "In Process") {
                                    $next = "Ready";
                                    $btn = "Mark As Ready";
                                } else {
                                    $btn = "Completed";
                                    $disabled = "Disabled";
                                }
                                ?>
                                <form method="post">
                                    <input type="hidden" name="order_details_id" value="<?php echo $order_details_id ?>">
                                    <input type="hidden" name="next" value="<?php echo $next ?>">
                                    <button type="submit" <?php echo $disabled ?> name="change" class="btn btn-default "> <?php echo $btn ?></button>
                                </form>

                            </div>
                        </div>
                    </div>



                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Images Uploaded By User :- </label>  

                            </div>
                        </div>
                    </div>

                </div>

                <?php
                $images = get_all("select * from tbl_cust_images where order_details_id = '{$order_details_id}' ");
                $sr = 0;
                foreach ($images as $image) {
                    $sr++;
                    $size = get_single("select * from tbl_product_image_size where pis_id  = '{$image['pis_id']}'");
                    ?>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group row">
                                <div class="col-sm-12">  
                                    <label  class="form-label"><?php echo $sr . " ) &nbsp;" . $size['height'] . " x " . $size['width'] . " inches" ?>  </label>  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-sm-12">  
                                    <img  src="<?php echo check_image(upload_url() . "customer_images/" . $image['image']) ?>" style="height: 200px;width:200px" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group row">
                                <div class="col-sm-12">  
                                    <a download href="<?php echo check_image(upload_url() . "customer_images/" . $image['image']) ?>"  class="btn btn-default " type="button">Download</a>

                                </div>
                            </div>
                        </div>


                    </div>
                    <?php
                }
                ?>
            </div>




            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
