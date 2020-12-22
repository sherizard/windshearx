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

<!-- Button Add User -->
<a href="<?php echo base_url('admin/user_add') ?>" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i>&nbsp;Tambah
</a>


<!-- Table User Prepare -->
<?php
$this->table->set_template(array(
    'table_open' => '<table class="table table-striped">',
    'thead_open' => '<thead class="thead-dark">'
));
$this->table->set_heading('No', 'Username', 'Role', 'Aksi');

$no = 0;
foreach ($users as $user)
{
    $this->table->add_row(
        ++$no,
        $user->username,
        $user->role == 1 ? 'admin' : 'user',
        '<a href="' . base_url('admin/user_edit/' . $user->id) . '"' .
        'class="btn btn-info btn-circle">' .
        '<i class="fas fa-edit"></i></a>&nbsp;' .
        '<button class="btn btn-danger btn-circle"' .
        ($user->role == 1 ? 'hidden ' : '') .
        'data-toggle="modal" data-target="#modalUserDelete" data-href="' . base_url('admin/user_delete/' . $user->id) . '">' .
        '<i class="fas fa-trash-alt"></i></button>'
    );
}
?>

<!-- Table User -->
<div class="row">
    <div class="col-md-6">
        <?php echo $this->table->generate(); ?>
    </div>
</div>

<!-- Modal Delete User -->
<div class="modal fade" id="modalUserDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Konfirmasi Hapus User
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin menghapus user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                data-dismiss="modal">Batal</button>
                <a href="#" id="modalUserDelBtn" class="btn btn-primary">OK</a>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#modalUserDelete').on('show.bs.modal', function(e) {
        $(this).find('#modalUserDelBtn').attr('href', $(e.relatedTarget).data('href'));
    });
});
</script>
