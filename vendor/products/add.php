<?php
include "../../class/class.php";
include "../../themepart/toast-script.php";
$page_title = "Product Add";
vendor_auth();
print_toast();
if (isset($_POST['add'])) {

    $cat_id = escape_string($_POST['cat_id']);
    $sc_id = escape_string($_POST['sc_id']);
    $pro_name = escape_string($_POST['pro_name']);
    $price = escape_string($_POST['price']);
    $pro_details = escape_string($_POST['pro_details']);
    $need_images = escape_string($_POST['need_images']);
    $data = array(
        "cat_id" => $cat_id,
        "sc_id" => $sc_id,
        "pro_name" => $pro_name,
        "img" => "",
        "price" => $price,
        "need_images" => $need_images,
        "pro_details" => $pro_details,
        "supp_id" => get_vendordata("user_id")
    );
    $pro_id = insertdata($data, "tbl_product");
    if ($need_images == "1") {
        $heights = $_POST['height'];
        $width = $_POST['width'];
        $i = 0;
        foreach ($heights as $height) {
            $size_data = array(
                "height" => $height,
                "width" => $width[$i],
                "idx" => $i + 1,
                "pro_id" => $pro_id
            );
            $insert_size = insertdata($size_data, "tbl_product_image_size");
            $i++;
        }
    }

    $upload_file = $_FILES['upload_file']['name'];
    $filename = 'upload_file';
    $i = 0;
    foreach ($upload_file as $upload_file) {
        $upload = upload_image_multiple($filename, $i, $pro_name, "../../uploads/products/", 0);
        $img = $upload[0];
        $ar = array(
            "pro_id" => $pro_id,
            "img" => $img
        );
        $insert = insertdata($ar, "tbl_product_image");
        $i++;
    }

    $suggestions = $_POST['suggestions'];
    foreach ($suggestions as $suggestion) {
        $ar = array(
            "atr_val_id" => $suggestion,
            "pro_id" => $pro_id
        );
        $in = insertdata($ar, "tbl_suggestion");
    } 
    set_sweet_alert(1, "New Product Added Successfully !");
    move("view.php");
}
?>
<html>
    <?php
    include "../../themepart/header.php";
    ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php
            include "../../themepart/vendor_head.php";
            include "../../themepart/vendor_side_bar.php";
            ?>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><?php // echo $page_title         ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo vendor_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="view.php">Product</a> </li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <form method="post" id="form" enctype="multipart/form-data">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <div class="card-body row">
                                <div class="form-group col-md-4">
                                    <label for="cat_id">Select Category </label>

                                    <select class="form-control select2" name="cat_id" onchange="load_sub_category(this.value)">
                                        <option value="">Select Category </option>
                                        <?php
                                        $cats = get_all("select * from tbl_category where is_delete = '0'");
                                        foreach ($cats as $cat) {
                                            ?>
                                            <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <!--<br>--> 
                                    <label for="sc_id">Select Sub Category </label>
                                    <select class="form-control select2" id="sc_id" name="sc_id">                                        
                                        <option value="">Select Category First </option>                                             
                                    </select>

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pro_name">Product Name </label>
                                    <input type="text"  required="" class="form-control" name="pro_name" id="pro_name" placeholder="Enter Product Name">

                                    <div id="pro_name_response"></div>
                                </div> 

                                <div class="form-group col-md-4">
                                    <label for="price">Product Price </label>
                                    <input type="number"  required="" class="form-control" name="price" id="price" placeholder="Enter Price">

                                </div>

                                <div class="form-group col-md-4">
                                    <label for="price">Product Details </label>
                                    <textarea  required="" class="form-control" name="pro_details" id="pro_details" placeholder="Enter Details"> </textarea>

                                </div>
                                <div class="form-group col-md-4 ">
                                    <label for="img">Select Images</label>
                                    <div class="">
                                        <div class="custom-file">
                                            <input type="file" id="upload_file" name="upload_file[]"  class="file-input"  onchange="preview_image();" multiple/>

    <!--<input type="file" name="main_img">              id="img"-->
                                            <!--<label class="custom-file-label" for="img">Choose file</label>-->
                                        </div> 
                                    </div>
                                </div>
                                <div id="wrapper" class="form-group col-md-12">


                                    <div id="image_preview" class="row">

                                    </div> 
                                </div>
                                <!--                                    <div class="form-group row mt-2">
                                                                        <div class="col-sm-12">
                                                                            <img id="preview"   style="display:none"  style="width:150px;height:150px"  />
                                                                            <button type="button" class="btn" id="clear" style="display:none" onclick="clear_fun()">Clear </button>
                                                                        </div>
                                                                    </div>-->
                            </div> 
                            <div class="card-body row">

                                <div class="form-group col-md-8">
                                    <!--<br>--> 
                                    <label > Suggested For :-  </label>
                                    <select class="form-control select2" multiple="" id="suggestions" name="suggestions[]">                                        
                                        <?php
                                        $atr_vals = get_all("select * from tbl_attribute_value ");
                                        foreach ($atr_vals as $atr_val) {
//                                    $atr_grp = get_single("select * from tbl_attribute_group where atr_grp_id = '{$atr_val['atr_grp_id']}'");
                                            ?>
                                            <option value="<?php echo $atr_val['atr_val_id'] ?>"><?php echo $atr_val['atr_val_name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group col-md-4">
                                    <!--<br>--> 
                                    <label for="sc_id">Need Images From Customer ?</label>
                                    <select class="form-control select2" id="need_images" onchange="need_image()" name="need_images">                                        
                                        <option value="0"> No </option>
                                        <option value="1"> Yes </option>

                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="img_size" style="display: none"> 
                            <div class="row">
                                <div class="form-group col-md-5"> 
                                    <label>Required Images For Product :- </label>
                                </div> 

                            </div>
                            <div class="row">
                                <div class="form-group col-md-5"> 
                                    <label for="height[]">Enter Height ( In Inches )  </label>
                                    <input id="height" required="" type="number" class="form-control img_size" name="height[]" placeholder="Enter Height">
                                </div> 
                                <div class="form-group col-md-5"> 
                                    <label for="width[]">Enter Width ( In Inches )  </label>
                                    <input id="width" required="" type="number" class="form-control img_size" name="width[]" placeholder="Enter Width">
                                </div> 
                                <div class="form-group col-md-2"> 
                                    <label style="color:transparent">.</label> 
                                    <span type="button" class="btn form-control fa fa-plus-square btn-success" style="color:white" onclick="add_img_size_row()"></span>
                                </div> 
                            </div>
                        </div>
                        <div class="card-footer">
                            <input name="add"  type="submit" class="btn btn-primary" value="Add">
                        </div>
                    </form>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>

</body>
<?php include "../../themepart/script.php"; ?>
<script>
    $().ready(function () {

        $("#form").validate({
            rules: {
                cat_id: "required",
                sc_id: "required",
                pro_name: "required",
                price: "required",
                pro_detalis: "required",

            },
            messages: {
                cat_id: "<span style=\"color:red\"> Please Select A Category .</span>",
                sc_id: "<span style=\"color:red\"> Please Select A Sub Category .</span>",
                pro_name: "<span style=\"color:red\"> Please Enter A Valid Product Name .</span>",
                price: "<span style=\"color:red\"> Please Enter A Valid Price .</span>",
                pro_detalis: "<span style=\"color:red\"> Please Enter Details .</span>",
            }
        });
        $(".img_size").each(function (item) {
            $(this).rules("add",
                    {
                        required: true
                    }
            );
        });
    });

    function delete_this_row(id)
    {
        $("#" + id).remove();
    }
    function add_img_size_row()
    {
        $.ajax({
            url: 'image_size_row.php',
            type: 'post',
            data: {
            },
            success: function (response) {

                $("#img_size").append(response);

            },
        });
    }

    function load_sub_category(cat_id)
    {
        $.ajax({
            url: '<?php echo user_url(); ?>apis/dropdown.php?page=sub_cat',
            type: 'post',
            data: {
                cat_id: cat_id
            },
            success: function (response) {
                response = JSON.parse(response);

                var len = response.length;
                $("#sc_id").empty();
                if (len > 0)
                {
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['sc_id'];
                        var name = response[i]['sc_name'];
                        $("#sc_id").append("<option value='" + id + "'>" + name + "</option>");
                    }
                } else {
                    $("#sc_id").append("<option value=''>No Sub Category Found </option>");

                }

            },
        });
    }


</script>
<script>



    function preview_image()
    {
        var total_file = document.getElementById("upload_file").files.length;
        $('#image_preview').html('');
        for (var i = 0; i < total_file; i++)
        {
            $('#image_preview').append("<div id='img_div_id_" + i + "' class='col-md-2'><img style='height:100px' src='" + URL.createObjectURL(event.target.files[i]) + "'><br></div>");
//<button type='button' onclick='delete_this_image(" + i + ")'>delete</button>
        }
    }


    function delete_this_image(i)
    {
//        console.log(document.getElementById("upload_file").files.length);
//        console.log(document.getElementById("upload_file").value);
        document.getElementById("img_div_id_" + i).remove();

    }
    function need_image()
    {
        var i = $("#need_images").val();
        if (i === "0")
        {
            $("#img_size").hide();
        } else {
            $("#img_size").show();
        }
    }

</script>
</html>
