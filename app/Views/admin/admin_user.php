<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="#" data-toggle="modal" data-target="#addAdminModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>

    <!-- Modal -->
    <form action="<?= route_to('save_admin_user') ?>" method="POST">
        <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Add Admin User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <label class="font-weight-bold mt-3">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
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
                        <h5 class="modal-title" id="addAdminModalLabel">Edit Admin User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                        <input type="hidden" name="id" class="form-control" id="id" placeholder="Username">
                        <label class="font-weight-bold mt-3">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
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
                                <th>Username</th>
                                <th>Password</th>
                                <th>Action</th>
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
                                        <a href="javascript:void(0)" onclick="confirm_delete('delete_admin')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                                        <form action="<?= route_to('delete_admin_user', $u['id']) ?>" id="delete_admin"></form>
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