<script>$('#clickmodel').trigger('click');</script>
<!-- Trigger the modal with a button -->
<a  id="clickmodel"  data-toggle="modal" data-target="#message"></a>
<?php
include "../../class/class.php";
if (isset($_POST['id'])) {
    $cust_data = get_single("select * from tbl_user where user_id = '{$_POST['id']}'");
    
} else {
    exit();
}
?>
<div class="modal fade" id="message" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Customer Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Name</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $cust_data['user_name'] ?>"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Email</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $cust_data['user_email'] ?>"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Mobile Number </label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $cust_data['user_mobile'] ?>"  >
                            </div>
                        </div>
                    </div>

                     

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <!--<label  class="form-label">Image</label>-->
                                <img  src ="<?php echo check_image(upload_url() . "customer/" . $cust_data['user_image']) ?>" style="height: 150px;width:150px" >
                            </div>
                        </div>
                    </div>
                     

                </div>
                <div class="row">
                    <div class="form-group col-md-5"> 
                        <!--<label>Addresses  :- </label>-->
                    </div> 

                </div>
                <?php
                $cust_addresses = get_all("select * from tbl_address where cust_id = '{$cust_data['user_id']}'");
                
                $sr = 0;
                foreach ($cust_addresses as $cust_address) {
                    $area = get_single("select * from tbl_area_pincode where area_id = '{$cust_address['area_id']}'");
                    $sr++;
                    ?>
                    <div class="row">
                        <div class="form-group col-md-8"> 
                            <label>Address</label>
                            <textarea readonly="" class="form-control"><?php echo $cust_address['address']  ?></textarea>
                        </div> 
                        <div class="form-group col-md-4"> 
                            <label>Area</label>
                            <input type="text" readonly="" class="form-control" value="<?php echo $area['area_name'] . " - " . $area['pincode'] ?> ">
                        </div>  

                    </div>
                    <?php
                }
                if($sr == 0)
                {
                    ?>
                <div class="row">
                    <div class="form-group col-md-12">
                         <!--<label>No Address Found</label>-->
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
