<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="#" data-toggle="modal" data-target="#addAdminModal" class="d-inline d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Admin</a>
    </div>

    <!-- Modal -->
    <form action="<?= route_to('save_admin_user') ?>" method="POST">
        <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Tambah Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Username</label>
                        <input type="text" name="username" oninvalid="invalid_alert(this, 'username')" minlength="5" required class="form-control" placeholder="Username">
                        <label class="font-weight-bold mt-3">Password</label>
                        <input type="password" name="password" oninvalid="invalid_alert(this, 'password')" minlength="5" required class="form-control" placeholder="Password">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Simpan</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="<?= route_to('edit_admin_user') ?>" method="POST">
        <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Edit Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Username</label>
                        <input type="text" oninvalid="invalid_alert(this, 'username')" minlength="5" required name="username" class="form-control" id="username" placeholder="Username">
                        <input type="hidden" name="id" class="form-control" id="id" placeholder="Username">
                        <label class="font-weight-bold mt-3">Password</label>
                        <input type="password" oninvalid="invalid_alert(this, 'password')" minlength="5" required name="password" class="form-control" id="password" placeholder="Password">
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
                    <table class="table table-striped table-responsive-xs" id="dataTableAdmin" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($user as $u) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $u['username'] ?></td>
                                    <td><?= $u['password'] ?></td>
                                    <td>
                                        <button data-toggle="modal" data-target="#editAdminModal" class="btn btn-warning btn-sm" onclick="editUserAdmin(<?= $u['id'] ?>,'<?= $u['username'] ?>','<?= $u['password'] ?>')"><i class="fas fa-edit"></i> Edit</button>
                                        <a href="javascript:void(0)" onclick="confirm_delete('delete_admin', '<?= $u['id'] ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                        <form action="<?= route_to('delete_admin_user', $u['id']) ?>" id="delete_admin-<?= $u['id'] ?>"></form>
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