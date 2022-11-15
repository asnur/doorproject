<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="#" data-toggle="modal" data-target="#addGuestModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
    </div>

    <!-- Modal -->
    <form action="<?= route_to('save_guest_user') ?>" method="POST">
        <div class="modal fade" id="addGuestModal" tabindex="-1" role="dialog" aria-labelledby="addGuestModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGuestModalLabel">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Nama</label>
                        <input type="text" name="nama" required minlength="3" oninvalid="invalid_alert(this, 'nama')" class="form-control" placeholder="Nama">
                        <label class="font-weight-bold mt-3">UID</label>
                        <input type="text" name="uid" id="uid_user" class="form-control" required oninvalid="invalid_alert(this, 'uid')"placeholder="Automatic Value" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Simpan</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="<?= route_to('edit_guest_user') ?>" method="POST">
        <div class="modal fade" id="editGuestModal" tabindex="-1" role="dialog" aria-labelledby="addGuestModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGuestModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Nama</label>
                        <input type="text" name="nama" required minlength="5" oninvalid="invalid_alert(this, 'nama')" class="form-control" id="nama" placeholder="Nama">
                        <label class="font-weight-bold mt-3">UID</label>
                        <input type="text" name="uid" class="form-control" id="uid" placeholder="Automatic Value" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Simpan</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data <?= $title ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UID</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($user as $u) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $u['uid'] ?></td>
                                    <td><?= $u['nama'] ?></td>
                                    <td>
                                        <button data-toggle="modal" onclick="editGuestUser('<?= $u['uid'] ?>', '<?= $u['nama'] ?>')" data-target="#editGuestModal" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <a href="javascript:void(0)" onclick="confirm_delete('delete_guest_user', '<?= $u['uid'] ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                        <form action="<?= route_to('delete_guest_user', $u['uid']) ?>" id="delete_guest_user-<?= $u['uid'] ?>"></form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>