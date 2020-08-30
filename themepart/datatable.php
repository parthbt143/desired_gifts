<script>
    function delete_this(tbl, pk, id)
    {
        swal({
            title: "Are you sure you want to delete this record ?",
//            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?php echo user_url(); ?>apis/delete.php',
                            type: 'post',
                            data: {
                                id: id,
                                tbl: tbl,
                                pk: pk
                            },
                            success: function (response) {
//                            console.log(response);
                                response = JSON.parse(response);
                                if (response['flag'] === "1")
                                {

                                    swal({
                                        title: "Successful",
                                        text: response['msg'],
                                        icon: "success"
                                    }).then(() => {
                                        $('#table').DataTable().ajax.reload();
                                        toast_success_alert("Record Deleted !");
                                    }
                                    );
                                } else if (response['flag'] === "0") {
                                    swal({
                                        title: "Failed",
                                        text: response['msg'],
                                        icon: "warning"
                                    });

                                }
                            },
                            error: function (response) {
//                        console.log(response);
                            }
                        });
                    }
                });

    }
    function datatable(page)
    {
        $(function () {
            $('#table').DataTable({
                "buttons": ['copy', 'excel'],
                "ajax": "<?php echo user_url() ?>apis/listing.php?page=" + page,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "dom": '<"top"lf>rt<"bottom"ip>',
//                "dom": '<"bottom"i>rt<"top"flp><"clear">',
                "pagingType": "simple_numbers"
//                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
//        '<"top"i>rt<"bottom"flp><"clear">'
            });

        });
    }
    function block_unblock_user(tbl, pk, id, status)
    {
        if (status === 1 || status === "1")
        {
            var title = "Are You Sure You Want To Block This User ? ";
        } else {
            var title = "Are You Sure You Want To Unblock This User ? ";
        }
        swal({
            title: title,
//            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?php echo user_url(); ?>apis/block_unblock.php',
                            type: 'post',
                            data: {
                                id: id,
                                tbl: tbl,
                                pk: pk,
                                status: status
                            },
                            success: function (response) {
//                            console.log(response);
                                response = JSON.parse(response);
                                if (response['flag'] === "1")
                                {

                                    swal({
                                        title: "Successful",
                                        text: response['msg'],
                                        icon: "success"
                                    }).then(() => {
                                        $('#table').DataTable().ajax.reload();
                                        toast_success_alert(response['msg']);
                                    }
                                    );
                                } else if (response['flag'] === "0") {
                                    swal({
                                        title: "Failed",
                                        text: response['msg'],
                                        icon: "warning"
                                    });

                                }
                            },
                            error: function (response) {
//                        console.log(response);
                            }
                        });
                    }
                });

    }
    function accept_this(tbl, pk, id)
    {
        $.ajax({
            url: '<?php echo user_url(); ?>apis/accept.php',
            type: 'post',
            data: {
                id: id,
                tbl: tbl,
                pk: pk
            },
            success: function (response) {
//                console.log(response);
                response = JSON.parse(response);
                if (response['flag'] === "1")
                {

                    swal({
                        title: "Successful",
                        text: response['msg'],
                        icon: "success"
                    }).then(() => {
                        $('#table').DataTable().ajax.reload();
                        toast_success_alert(response['msg']);

                    }
                    );
                } else if (response['flag'] === "0") {
                    swal({
                        title: "Failed",
                        text: response['msg'],
                        icon: "warning"
                    });

                }
            },
            error: function (response) {
//                        console.log(response);
            }
        });


    }

    function reject_this(tbl, pk, id)
    {
        $.ajax({
            url: '<?php echo user_url(); ?>apis/reject.php',
            type: 'post',
            data: {
                id: id,
                tbl: tbl,
                pk: pk
            },
            success: function (response) {
//                            console.log(response);
                response = JSON.parse(response);
                if (response['flag'] === "1")
                {

                    swal({
                        title: "Successful",
                        text: response['msg'],
                        icon: "success"
                    }).then(() => {
                        
                        $('#table').DataTable().ajax.reload();
                        toast_success_alert(response['msg']);

                    }
                    );
                } else if (response['flag'] === "0") {
                    swal({
                        title: "Failed",
                        text: response['msg'],
                        icon: "warning"
                    });

                }
            },
            error: function (response) {
                        console.log(response);
            }
        });


    }
</script>