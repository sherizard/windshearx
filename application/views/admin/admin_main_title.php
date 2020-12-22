<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

<!-- Success info -->
<?php if ($this->session->flashdata('info')): ?>
    <div class="alert alert-success alert-dismissible">
        <?php echo $this->session->flashdata('info'); ?>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
<?php endif; ?>

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
        <label for="judul">Silahkan Masukkan Judul baru yang diinginkan</label>
        <input type="text" class="form-control" id="judul" name="judul"
        value="<?php echo set_value('judul', $judul, FALSE) ?>"
        placeholder="Judul">
    </div>
</div>

<input type="submit" class="btn btn-primary" name="submit" value="Simpan">

<?php echo form_close(); ?>
