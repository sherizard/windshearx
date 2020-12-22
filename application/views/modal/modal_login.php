<div id="modalLogin" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100">User Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="loginErrMsg" class="alert alert-danger collapse" role="alert"></div>

                <?php echo form_open(); ?>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo set_value('username') ?>" placeholder="Username">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" id="password" name="password"
                    value="<?php echo set_value('password') ?>" placeholder="Password">
                </div>

                <button id="modalLoginBtnSubmit" class="btn btn-block btn-primary">Login</button>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#modalLoginBtnSubmit').click(function(event){
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();

        if (username == '' || password == '') {
            $('#loginErrMsg').show();
            $('#loginErrMsg').html('Semua field harus diisi');
        } else {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('admin/login') ?>',
                data: {username: username, password: password},
                cache: false,
                success: function(result) {
                    if (result != 0) {
                        location.replace(result);
                    } else {
                        $('#loginErrMsg').show();
                        $('#loginErrMsg').html('Login gagal');
                    }
                }
            });
        }
    });
});
</script>
