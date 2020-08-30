<?php
include "../../class/class.php";
include "../../themepart/toast-script.php";
$page_title = "Sub Category Add";
admin_auth();
print_toast();
if (isset($_POST['add'])) {
    $cat_id = escape_string($_POST['cat_id']);
    $sub_cat_name = escape_string($_POST['sub_cat_name']);
    $filename = 'img';
    $upload = upload_image($filename, $sub_cat_name, "../../uploads/sub-category/", 0);
    $img = $upload[0];
    $data = array(
        "cat_id" => $cat_id,
        "sc_name" => $sub_cat_name,
        "img" => $img
    );
    $ins = insertdata($data, "tbl_sub_category");
    set_sweet_alert(1, "New Sub Category Added Successfully !");
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
            include "../../themepart/admin_head.php";
            include "../../themepart/admin_side_bar.php";
            ?>


            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><?php // echo $page_title               ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo admin_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="view.php">Sub Category</a> </li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Sub Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" id="form" enctype="multipart/form-data">
                            <div class="card-body row">
                                <div class="form-group col-md-4">
                                    <label for="cat_id">Select Category </label>
                                    <!--<br>--> 
                                    <select class="form-control select2" name="cat_id">
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
                                    <label for="sub_cat_name">Sub Category Name </label>
                                    <input type="text" onkeyup="unique()" required="" class="form-control" name="sub_cat_name" id="sub_cat_name" placeholder="Enter Category Name">

                                    <div id="sub_cat_name_response"></div>
                                </div> 
                                <div class="form-group col-md-4">
                                    <label for="img">File input</label>
                                    <div class="">
                                        <div class="custom-file">
                                            <input type="file" class="file-input"  name="img"> <!--             id="img"-->
                                            <!--<label class="custom-file-label" for="img">Choose file</label>-->

                                        </div> 
                                    </div>

                                    <div class="form-group row mt-2">
                                        <div class="col-sm-12">
                                            <img id="preview"   style="display:none"  style="width:150px;height:150px"  />
                                            <button type="button" class="btn" id="clear" style="display:none" onclick="clear_fun()">Clear </button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button id="submit" name="add"  type="submit" class="btn btn-primary">Add </button>
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
                    sub_cat_name: "required",

                },
                messages: {
                    cat_id: "<span style=\"color:red\"> Please Select A Category </span>",
                    sub_cat_name: "<span style=\"color:red\"> Please Enter A Valid Sub Category Name .</span>",
                }
            });
        });

        function unique()
        {
            var sub_cat_name = $("#sub_cat_name").val();
            if (sub_cat_name != "")
            {
                $.ajax({
                    url: '<?php echo user_url(); ?>apis/unique.php?page=sub_cat',
                    type: 'post',
                    data: {
                        term: sub_cat_name
                    },
                    success: function (response) {
                        response = JSON.parse(response);
                        if (response['flag'] === "1")
                        {
                            $("#sub_cat_name_response").html("<span class='not-exists' style='color:red;'>* This Sub Category Name Is Already in use.</span>");
                            $('#submit').attr("disabled", true);
                        } else {
                            $("#sub_cat_name_response").html("<span class='exists' style='color:green;'>Available.</span>");
                            $('#submit').removeAttr("disabled", "disabled");
                        }
                    },
                });
            } else {
                $("#sub_cat_name_response").html("<span class='exists' style='color:green;'> </span>");
            }


        }
        $(function () {
            $('#img').change(function () {
                $('#clear').show();
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
                {
                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('#preview').show();
                        $('#preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else
                {

                    clear_fun();
                    $('#preview').attr('src', '<?php echo get_image("ok") ?>');
                }
            });

        });
        function clear_fun()
        {
            $('#clear').hide();
            $('#img_path').val('');
            $('#preview').hide();
        }
    </script>
</html>
