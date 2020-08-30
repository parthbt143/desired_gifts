<?php
include 'class/class.php';
include "themepart/toast-script.php";
print_toast();
print_sweet_alert();
if (isset($_SESSION['cust_id'])) {
    $cart_data = get_all("select * from tbl_cart where cust_id = '{$_SESSION['cust_id']}'");
    if (count($cart_data) == 0) {
        move(user_url());
    }
} else {
    move(user_url());
}
if (isset($_POST['place_order'])) {

    $receiver_name = escape_string($_POST['receiver_name']);
    $receiver_number = escape_string($_POST['receiver_number']);
    $address = escape_string($_POST['address']);
    $area_pincode = escape_string($_POST['area_pincode']);
    $amt = escape_string($_POST['amt']);
    $date = date("Y-m-d", time());
    $status = "Placed";
    $cust_id = $_SESSION['cust_id'];
 

    $pro_id = $_POST['pro_id'];
    $pis_id = $_POST['pis_id'];


    $order_data = array(
        "cust_id" => "$cust_id",
        "date" => "$date",
        "amt" => "$amt",
        "receiver_name" => "$receiver_name",
        "receiver_number" => "$receiver_number",
        "address" => "$address",
        "area_pincode" => "$area_pincode",
        "status" => "$status"
    );
    $order_id = insertdata($order_data, "tbl_order");
    foreach ($cart_data as $cart) {
        $product = get_single("select * from tbl_product where pro_id = '{$cart['pro_id']}'");
        $product_id = $cart['pro_id'];
        $supp_id = $product['supp_id'];
        $price = $product['price'];
        $details_data = array(
            "order_id" => "$order_id",
            "pro_id" => "$product_id",
            "supp_id" => "$supp_id",
            "price" => "$price",
            "status" => "Placed"
        );
        $order_details_id = insertdata($details_data, "tbl_order_details");
        $sr = 0;
        $filename = "cust_images";
        //define('UPLOAD_DIR', 'uploads/customer_images/');        
        foreach ($pro_id as $pro) {        
            if ($pro == $product_id) {
               if(preg_match("/^data:image\/(?<extension>(?:png|gif|jpg|jpeg));base64,(?<image>.+)$/", $_POST['image_upload'][$sr], $matchings)){
                   $imageData = base64_decode($matchings['image']);
                   $extension = $matchings['extension'];   
                   $img_name = uniqid() . sprintf("image.%s", $extension);                
                   $filename = 'uploads/customer_images/' . $img_name ;
                   file_put_contents($filename, $imageData);
                }
                $cust_image_ar = array(
                    "order_details_id" => "$order_details_id",
                    "pro_id" => "$pro",
                    "pis_id" => "{$pis_id[$sr]}",
                    "image" => "$img_name"
                );
                insertdata($cust_image_ar, "tbl_cust_images");
            }
            $sr++;
        }
    }

    mysqli_query($connection, "delete from tbl_cart where cust_id = '{$cust_id}'");
    set_sweet_alert(1, "Order Placed Successfully !");
    move('index.php');
}
?>
<html lang="en">
    <?php include './includes/head.php' ?>

    <link href="assets/frontEnd/css/checkout.css" rel="stylesheet">
    <body>

        <div id="page">
            <?php include './includes/header.php' ?>    
            <main class="bg_gray">


                <div class="container margin_30">
                    <div class="page_header">
                        <!--                        <div class="breadcrumbs">
                                                    <ul>
                                                        <li><a href="#">Home</a></li>
                                                        <li><a href="#">Category</a></li>
                                                        <li>Page active</li>
                                                    </ul>
                                                </div>-->
                        <h1>Checkout</h1>

                    </div> 
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-md-10">
                                <div class="step first">
                                    <h3>1. Upload Images To Respective Products </h3>

                                    <?php
                                    $img_id = 0;
                                    $pro_sr = 0;
                                    $total = 0;
                                    foreach ($cart_data as $cart) {

                                        $pro_sr++;
                                        $product = get_single("Select * from tbl_product where pro_id = '{$cart['pro_id']}'");
                                        $imgs = get_all("select * from tbl_product_image where pro_id = '{$cart['pro_id']}' limit 1");
                                        $total += $product['price'];

                                        $image_sizes = get_all("select *  from tbl_product_image_size where pro_id = '{$product['pro_id']}' ");
                                        ?>


                                        <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true"><?php echo "<b>$pro_sr .</b>&nbsp;" . ucwords($product['pro_name']) ?> &nbsp;( <b><?php echo count($image_sizes) ?></b> Images Required)</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content checkout">

                                            <div class="row no-gutters">
                                                <?php
                                                foreach ($imgs as $img) {
                                                    ?>
                                                    <div class="col-3 form-group pr-1 ">
                                                        <img style="height:200px" src="<?php echo check_image(upload_url() . "products/{$img['img']}") ?>"  class="lazy" alt="Image">
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="col-8 form-group pr-1">
                                                    <b><?php echo ucwords($product['pro_name']) ?></b>
                                                    <br>
                                                    <p><?php echo ucwords($product['pro_details']) ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php
                                            $sr = 0;
                                            foreach ($image_sizes as $image_size) {
                                                $img_id++;
                                                $sr++;
                                                $height = $image_size['height'] * 96;
                                                $width = $image_size['width'] * 96;
                                                ?>
                                                <div class="row no-gutters">

                                                    <div class="col-1 ml-4 form-group pr-1">
                                                        <b><?php echo $sr ?> </b>
                                                    </div>
                                                    <div class="col-2 ml-4 form-group pr-1">
                                                        <b><?php echo $image_size['height'] . " x " . $image_size['width'] . " inches " ?> </b>
                                                    </div>

                                                    <div class="col-2 form-group pr-1">                                                        
                                                        <input id="cust_file_id_<?php echo $img_id ?>" type="hidden" name="pis_id[]" value="<?php echo $image_size['pis_id'] ?>">
                                                        <input type="hidden" name="pro_id[]" value="<?php echo $product['pro_id'] ?>">
                                                        <input  type="file" class="crop_img form-control" id="crop_img_<?=$img_id ?>" required=""  name="cust_images[]" style="height: auto;" data-width="<?=$width?>" data-height="<?=$height?>" >
                                                    </div>
                                                    <!-- Modal -->
                                                     <div class="modal fade" data-backdrop="false"  id="previewModal<?='_'.$pro_sr.'_'.$sr?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" >
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="modalforpreview">Preview Image</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body modal-lg">
                                                            <div class="col-12 form-group">
                                                                <img  id="cust_img_id_<?php echo $img_id ?>" class="image_id_name img-fluid" style="height:<?php echo $height ?>px;width:<?php echo $width ?>" src="<?php echo check_image(upload_url() . "default.png") ?>" >
                                                                <input type="hidden" name="image_upload[]" value="">
                                                            </div>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                                           
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!-- Button trigger modal -->
                                                    <div class="ml-3">
                                                        <button type="button" class="btn_1" data-toggle="modal" data-target="#previewModal<?='_'.$pro_sr.'_'.$sr?>">
                                                          Preview Image
                                                        </button>                                                        
                                                    </div>                                                                                                                            
                                                </div>
                                                <div class="clearfix mt-2"></div>  
                                                <?php
                                            }
                                            ?>
                                        </div>  
                                        <hr>
                                        <?php
                                    }
                                    ?>

                                    <input type="hidden" name="amt" value="<?php echo $total ?>">

                                </div>
                                <!-- /step -->
                            </div>                        
                            <div class="col-lg-12 col-md-6">
                                <div class="step last">
                                    <h3>2. Enter Shipping Details </h3>
                                </div>
                                <div class="row no-gutters">

                                    <div class="col-3 mt-2 ml-4 form-group pr-1">
                                        Receiver Name :- 
                                    </div>
                                    <div class="col-8 ml-4 form-group pr-1">
                                        <input type="text" name="receiver_name" class="form-control"  placeholder="Enter Receiver Name " required="">
                                    </div> 
                                    <div class="col-3 mt-2 ml-4 form-group pr-1">
                                        Receiver Number :- 
                                    </div>
                                    <div class="col-8 ml-4 form-group pr-1">
                                        <input type="text" name="receiver_number" onkeypress="return isNumber(event)" minlength="10" maxlength="10"   class="form-control"  placeholder="Enter Receiver Mobile Number " required="">
                                    </div>

                                    <div class="col-3 mt-2 ml-4 form-group pr-1">
                                        Enter Address :- 
                                    </div>
                                    <div class="col-8 ml-4 form-group pr-1">
                                        <textarea name="address"  class="form-control"  placeholder="Enter Address " required=""></textarea>
                                    </div>


                                    <div class="col-3 mt-2 ml-4 form-group pr-1">
                                        Select Area :- 
                                    </div>
                                    <div class="col-8 ml-4 form-group pr-1">
                                        <select name="area_pincode" class="form-control" required="">

                                            <?php
                                            $areas = get_all("Select * from tbl_area_pincode where is_active = '1' ");
                                            foreach ($areas as $area) {
                                                ?>
                                                <option value="<?php echo $area['area_name'] . " - " . $area['pincode'] ?>"><?php echo $area['area_name'] . " - " . $area['pincode'] ?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div> 
                                    <div class="container">
                                        <div class="row justify-content-end">
                                            <div class="col-xl-12 col-lg-12 col-md-12">

                                                <input type="submit" name="place_order" class="btn_1 full-width cart" value="Place Order ">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /step -->
                            </div> 
                        </div>
                    </form>
                </div>
                <!-- /container -->
            </main>
                 <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false"  data-backdrop='static' >
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                                    <button type="button" class="close btnClose" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="img-container">
                                      <img id="image" src="../3456749.jpg">                                      
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal" >Cancel</button>
                                    <input type="hidden" id="temp_img_name">
                                    <input type="hidden" id="temp_input">
                                    <input type="hidden" id="temp_width">
                                    <input type="hidden" id="temp_height">
                                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                  </div>
                                </div>
                              </div>
                            </div>
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

    function crop(t,img,e) {    
      $('#temp_img_name').val(img);
      $('#temp_input').val($(t).attr('id'));
      var image= document.getElementById('image');      
      $('#temp_width').val($(t).data('width'));
      $('#temp_height').val($(t).data('height'));      
      var input =t;      
      $(input).removeAttr("required");
      var $modal = $('#modal');
      var $modalClose = $('#modal .btnClose');
      if( typeof cropper != 'undefined' ){
        cropper.reset();        
      }
       var cropper;       
       var files = input.files;               
       var fileName = input.value.toLowerCase();
        if (!fileName.endsWith('.png') && !fileName.endsWith('.jpg')) {
            danger_sweet_alert('Please Select PNG / JPG  file only.');
            input.value = "";            
        } else{

        var files = e.target.files;

        var done = function (url) {

          image.src = url;

          $modal.modal('show');

        };

        var reader;

        var file;

        var url;


        if (files && files.length > 0) {

          file = files[0];


          if (URL) {

            done(URL.createObjectURL(file));

          } else if (FileReader) {

            reader = new FileReader();

            reader.onload = function (e) {

              done(reader.result);

            };

            reader.readAsDataURL(file);

          }

        }
        $modalClose.on('click',function(){
            var tmp_input = $('#temp_input').val();                                   
            $('#'+tmp_input).val('');                        
        });
          $modal.on('shown.bs.modal', function () {     
            w=$('#temp_width').val();               
            h=$('#temp_height').val();
            image.width=w;
            image.height=h;              
            cropper = new Cropper( image , {            
            viewMode: 1,
            background: false,
            center: false,
            autoCropArea: 1,
            // minCropBoxWidth:w,
            // minCropBoxHeight:h,
            movable: false,
            rotatable: false,
            scalable: false,            
            });        
          }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;        
          });

          document.getElementById('crop').addEventListener('click', function () {            
            var initialAvatarURL;   
            if(canvas != null ){                        
                var canvas;
            }else{
                 canvas = null;  
            }                                         
            temp=$('#temp_img_name').val();               
            w=$('#temp_width').val();               
            h=$('#temp_height').val();               
             $modal.modal('hide');        
             if (cropper) {            
              canvas = cropper.getCroppedCanvas({             
                 width:w,
                 height:h
              });    
              if(canvas != null){
                $('#'+temp).attr('src',canvas.toDataURL());  
                $('#'+temp).siblings('input').val(canvas.toDataURL());  
              }                                                          
            }                
        });
     }
    }
  </script>

  <script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }       
    $(document).on('change','.crop_img',function(e){
        t=this;
        image_id_name=$(t).closest('.row').find('.image_id_name').attr('id');            
       window.addEventListener('DOMContentLoaded', crop(t,image_id_name,e), false);            
    });                
  </script>
</html>