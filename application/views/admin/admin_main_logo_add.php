<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

<!-- Upload errors -->
<?php if ($upload_error): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $upload_error; ?>
    </div>
<?php endif; ?>

<!-- Form -->
<?php echo form_open_multipart(); ?>

<div class="form-group">
    <label for="image-file">File Gambar</label>
    <input type="file" class="form-control-file" id="image-file" name="image_file">
</div>

<input type="submit" class="btn btn-primary" name="submit" value="Simpan">
<a href="<?php echo base_url('admin/logo') ?>" class="btn btn-secondary">Batal</a>

<?php echo form_close(); ?>
