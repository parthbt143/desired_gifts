<?php
include "../../class/class.php";
include "../../themepart/toast-script.php";
$page_title = "Category Add";
admin_auth();
print_toast();
if (isset($_POST['add'])) {
    $cat_name = escape_string($_POST['cat_name']);
    $filename = 'img';
    $upload = upload_image($filename, $cat_name, "../../uploads/category/", 0);
    $img = $upload[0];
    $data = array(
        "cat_name" => $cat_name,
        "img" => $img
    );
    $ins = insertdata($data, "tbl_category");
    set_sweet_alert(1, "New Category Added Successfully !");
    move("view.php"); 
//    refresh();
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
                                <h1><?php // echo $page_title         ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo admin_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="view.php">Category</a> </li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" id="form" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cat_name">Category Name </label>
                                    <input type="text" onkeyup="unique()" required="" class="form-control" name="cat_name" id="cat_name" placeholder="Enter Category Name">

                                    <div id="cat_name_response"></div>
                                </div> 
                                <div class="form-group ">
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
                    cat_name: "required",

                },
                messages: {
                    cat_name: "<span style=\"color:red\"> Please Enter A Valid Category Name .</span>",
                }
            });
        });

        function unique()
        {
            var cat_name = $("#cat_name").val();
            if (cat_name != "")
            {
                $.ajax({
                    url: '<?php echo user_url(); ?>apis/unique.php?page=cat',
                    type: 'post',
                    data: {
                        term: cat_name
                    },
                    success: function (response) {
                        response = JSON.parse(response);
                        if (response['flag'] === "1")
                        {
                            $("#cat_name_response").html("<span class='not-exists' style='color:red;'>* This Category Name Is Already in use.</span>");
                            $('#submit').attr("disabled", true);

                        } else {
                            $("#cat_name_response").html("<span class='exists' style='color:green;'>Available.</span>");
                            $('#submit').removeAttr("disabled", "disabled");
                        }
                    },
                });
            } else {
                $("#cat_name_response").html("<span class='exists' style='color:green;'> </span>");

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
