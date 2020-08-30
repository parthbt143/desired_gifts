<?php ?>

<script src="<?php echo user_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo user_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo user_url() ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo user_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo user_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo user_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo user_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo user_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo user_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo user_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo user_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo user_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) --> 
<!-- AdminLTE for demo purposes -->

<script src="<?php echo user_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo user_url(); ?>assets/dist/js/jquery.validate.min.js"></script>
<script src="<?php echo user_url() ?>assets/dist/js/demo.js"></script>
<script src="<?php echo user_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<!--<script src="<?php echo user_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>-->

<script>
    $(function () {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>