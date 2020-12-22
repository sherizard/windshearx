<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

<!-- Validation errors -->
<?php if (validation_errors()): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>

<!-- Form -->
<?php echo form_open(); ?>
<div class="form-group row">
    <div class="col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password"
        value="<?php echo set_value('password') ?>" placeholder="Password Baru">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="passConf">Konfirmasi Password</label>
        <input type="password" class="form-control" id="passConf" name="pass_conf"
        value="<?php echo set_value('pass_conf') ?>" placeholder="Konfirmasi Password Baru">
    </div>
</div>

<input type="submit" class="btn btn-primary" name="submit" value="Simpan">
<a href="<?php echo base_url('admin/user') ?>" class="btn btn-secondary">Batal</a>

<?php echo form_close(); ?>
