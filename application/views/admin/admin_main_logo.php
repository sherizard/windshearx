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

<!-- Button Add Logo -->
<a href="<?php echo base_url('admin/logo_add') ?>" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i>&nbsp;Tambah
</a>

<!-- Table Logo Prepare -->
<?php
$this->table->set_template(array(
    'table_open' => '<table class="table table-striped">',
    'thead_open' => '<thead class="thead-dark">'
));
$this->table->set_heading('No', 'Logo', 'Aksi');

$no = 0;
foreach ($logos as $logo)
{
    $this->table->add_row(
        ++$no,
        '<img src="' . base_url('assets/img/') . $logo->file . '" width="100">',
        '<a href="' . base_url('admin/logo_edit/' . $logo->id) . '"' .
        'class="btn btn-info btn-circle">' .
        '<i class="fas fa-edit"></i></a>' .
        '&nbsp;' .
        '<button class="btn btn-danger btn-circle" ' .
        'data-toggle="modal" data-target="#modalLogoDel"' .
        'data-href="' . base_url('admin/logo_delete/' . $logo->id) . '">' .
        '<i class="fas fa-trash-alt"></i></button>'
    );
}
?>

<!-- Table Logo -->
<div class="row">
    <div class="col-md-6">
        <?php echo $this->table->generate(); ?>
    </div>
</div>

<!-- Modal Delete Logo -->
<div class="modal fade" id="modalLogoDel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Konfirmasi Hapus Logo
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin menghapus logo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                data-dismiss="modal">Batal</button>
                <a href="#" id="modalLogoDelBtn" class="btn btn-primary">OK</a>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#modalLogoDel').on('show.bs.modal', function(e) {
        $(this).find('#modalLogoDelBtn').attr('href', $(e.relatedTarget).data('href'));
    });
});
</script>
