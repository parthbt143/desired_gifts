
<script src="<?php echo user_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo user_url() ?>assets/dist/css/jquery.toast.css"/>
<script src="<?php echo user_url(); ?>assets/dist/js/jquery.toast.js"></script>

<script src="<?php echo user_url() ?>assets/plugins/sweetalert2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="<?php echo user_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
<script>
    function toast_success_alert(data) {
        $.toast({
            heading: data,
            position: 'top-right',
            icon: 'success',
            hideAfter: 3500,
            stack: 6
        });
    }
    function toast_danger_alert(data) {
        $.toast({
            heading: data,
            position: 'top-right',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        });
    }
    function success_sweet_alert(data)
    {
        swal({text: data, icon: 'success'});
    }
    
    function danger_sweet_alert(data)
    {
        swal({text: data, icon: 'warning'});
    }
</script>