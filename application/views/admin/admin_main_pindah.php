<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

<p>Data yang dapat dipindahkan dari tanggal <?php echo $tgl_awal ?> sampai tanggal <?php echo $tgl_akhir ?></p>

<!-- Success info -->
<?php if ($this->session->flashdata('info')):  ?>
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
<!-- <input type="submit" class="btn btn-primary" name="submit" value="Pindah"> -->
<!-- Form -->
<?php echo form_open();
?>


<div class="form-group row">
    <div class="col-md-4">
        <label for="tglAwal">Tanggal Awal</label>
        <input type="date" class="form-control" id="tglAwal" name="tgl_awal"
        value="<?php echo set_value('tgl_awal') ?>" min="<?php echo $tgl_awal?>">
    </div>

    <div class="col-md-4">
        <label for="tglAkhir">Tanggal Akhir</label>
        <input type="date" class="form-control" id="tglAkhir" name="tgl_akhir"
        value="<?php echo set_value('tgl_akhir') ?>" max="<?php echo $tgl_akhir?>">
    </div>
</div>

<input type="submit" class="btn btn-primary" name="submit" value="Pindah">

<?php echo form_close();
?>
