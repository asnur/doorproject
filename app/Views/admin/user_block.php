<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <!-- <a href="#" data-toggle="modal" data-target="#addGuestModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a> -->
    </div>

    <!-- Modal -->
    <form action="<?= route_to('save_access_user') ?>" method="POST">
        <div class="modal fade" id="accessUserModal" tabindex="-1" role="dialog" aria-labelledby="accessUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accessUserModalLabel">Akses User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">UID</label>
                        <input type="text" name="uid" id="uid" class="form-control" placeholder="Automatic Value" readonly>
                        <label class="font-weight-bold mt-2">Nama</label>
                        <input type="text" class="form-control" placeholder="Username" id="username" readonly>
                        <label class="font-weight-bold mt-2">Akses</label>
                        <select name="access[]" multiple="multiple" id="access" class="form-control w-100">
                            <?php
                            foreach ($access as $a) {
                            ?> <option value="<?= $a['token'] ?>"><?= $a['nama_kontroller'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
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
                                <th>Status</th>
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
                                        <?php if ($u['block'] == 0) : ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else : ?>
                                            <span class="badge badge-danger">Terblokir</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= route_to('block_user', $u['uid'], $u['block'] == 0 ? 'block' : 'unblock') ?>" class="btn btn-warning btn-sm"><?= $u['block'] == 0 ? 'Blokir User' : 'Buka Blokir User' ?></a>
                                        <a href="javascript:void(0)" onclick="access_user('<?= $u['uid'] ?>', '<?= $u['nama'] ?>', '<?= base64_encode(json_encode($u['access'])) ?>')" data-toggle="modal" data-target="#accessUserModal" class=" btn btn-primary btn-sm"> Akses User</a>
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