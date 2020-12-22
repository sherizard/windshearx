<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

<script>
$(function () {
    $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
        $(this).alert('close');
    });
});
</script>

</body>
</html>
