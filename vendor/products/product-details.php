<script>$('#clickmodel').trigger('click');</script>
<!-- Trigger the modal with a button -->
<a  id="clickmodel"  data-toggle="modal" data-target="#message"></a>
<?php
include "../../class/class.php";
if (isset($_POST['id'])) {
    $pro_data = get_single("select * from tbl_product where pro_id = '{$_POST['id']}'");
    $cat = get_single("select * from tbl_category where cat_id = '{$pro_data['cat_id']}'");
    $sub_cat = get_single("select * from tbl_sub_category where sc_id = '{$pro_data['sc_id']}'");
} else {
    exit();
}
?>
<div class="modal fade" id="message" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Product Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Category</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $cat['cat_name'] ?>"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Sub Category</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $sub_cat['sc_name'] ?>"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Name</label>
                                <input type="text" class="form-control"  readonly=""  placeholder=""   value="<?php echo $pro_data['pro_name'] ?>"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Details</label>
                                <textarea class="form-control"  readonly=""  placeholder=""   value=""  ><?php echo $pro_data['pro_details'] ?></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label  class="form-label">Price</label>  
                                <input type="text" class="form-control fa" aria-hidden="true"  readonly=""  placeholder=""   value="<?php echo $pro_data['price'] . " ₹" ?> "  >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <?php
                            $images = get_all("select * from tbl_product_image where pro_id = '{$pro_data['pro_id']}'");
                            foreach ($images as $img) {
                                ?> 
                                    <!--<label  class="form-label">Image</label>-->
                                    <img  src ="<?php echo check_image(upload_url() . "products/" . $img['img']) ?>" style="height: 150px;width:150px" >
                               &nbsp;      &nbsp;      &nbsp;        <!--<label  class="form-label">Image</label>-->
                                 
                                <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
               <?php
               $suggestions = get_all("select * from tbl_suggestion where pro_id = '{$pro_data['pro_id']}'");
               if(count($suggestions) > 0)
               {
                   ?>
                <div class="row">
                    <div class="form-group col-md-12"> 
                        <label> Suggested For  :- </label>
                        <?php
                        $str = "";
                        $first = 1;
                        foreach($suggestions as $suggestion)
                        {
                            if($first != 1)
                            {
                                $str .= " , ";
                            }else{
                                $first = 0;
                            }
                            $atr_val = get_single("select * from tbl_attribute_value where atr_val_id = '{$suggestion['atr_val_id']}'");
                            $str .= ucwords($atr_val['atr_val_name']);
                        }
                        ?>
                        <textarea readonly="" class="form-control"> <?php echo $str ?></textarea>
                    </div> 

                </div>
                  
                <?php
               }
               if($pro_data['need_images'] == "1")
               {
                   ?>
                 <div class="row">
                    <div class="form-group col-md-5"> 
                        <label>Required Images For Product :- </label>
                    </div> 

                </div>
                <?php
                $img_sizes = get_all("select * from tbl_product_image_size where pro_id = '{$_POST['id']}' order by idx ");
                foreach ($img_sizes as $img_size) {
                    ?>
                    <div class="row">
                        <div class="form-group col-md-4"> 
                            <label>Index</label>
                            <input type="text" readonly="" class="form-control" value="<?php echo $img_size['idx'] ?>">
                        </div> 
                        <div class="form-group col-md-4"> 
                            <label>Height</label>
                            <input type="text" readonly="" class="form-control" value="<?php echo $img_size['height'] ?>  Inches">
                        </div> 
                        <div class="form-group col-md-4"> 
                            <label>Width</label>
                            <input type="text" readonly="" class="form-control" value="<?php echo $img_size['width'] ?>  Inches">
                        </div> 

                    </div>
                    <?php
                }
                ?>
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
