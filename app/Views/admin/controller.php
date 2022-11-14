<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="#" data-toggle="modal" data-target="#addController" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kontroler Pintu</a>
    </div>

    <!-- Modal -->
    <form action="<?= route_to('save_controller') ?>" method="POST">
        <div class="modal fade" id="addController" tabindex="-1" role="dialog" aria-labelledby="addControllerLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterDataLabel">Tambah Kontroler Pintu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Nama Kontroler Pintu</label>
                        <input type="text" name="nama_kontroller" class="form-control" placeholder="Nama Kontroler Pintu" required>
                        <label class="font-weight-bold mt-2">Tipe Kontroler Pintu</label>
                        <select class="form-control" name="type" required>
                            <option value="NodeMCU">NodeMCU</option>
                            <!-- <option value="ESP32">ESP32</option> -->
                        </select>
                        <label class="font-weight-bold mt-2">Password Keypad</label>
                        <input type="text" name="keypad_password" class="form-control" placeholder="Password Keypad" required>
                        <label class="font-weight-bold mt-2">Delay Kunci Pintu (detik)</label>
                        <input type="number" name="delay" class="form-control" placeholder="Delay Kunci Pintu (detik)" required>
                        <label class="font-weight-bold mt-2">Request Token (Automatic Value)</label>
                        <input type="text" name="token" class="form-control" placeholder="Request Key" readonly value="<?= uniqid() ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Simpan</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="<?= route_to('edit_controller') ?>" method="POST">
        <div class="modal fade" id="editController" tabindex="-1" role="dialog" aria-labelledby="editControllerLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterDataLabel">Edit Kontroler Pintu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Nama Kontroler Pintu</label>
                        <input type="text" name="nama_kontroller" id="name" class="form-control" placeholder="Nama Kontroler Pintu" required>
                        <!-- <label class="font-weight-bold mt-2">Tipe Kontroler Pintu</label> -->
                        <input type="hidden" name="type" value="NodeMCU">
                        <label class="font-weight-bold mt-2">Password Keypad</label>
                        <input type="text" pattern="\d*" minlength="5" maxlength="5" id="keypad_password" name="keypad_password" class="form-control" placeholder="Password Keypad" required>
                        <label class="font-weight-bold mt-2">Delay Kunci Pintu (detik)</label>
                        <input type="number" name="delay" id="delay" class="form-control" placeholder="Delay Kunci Pintu (detik)" required>
                        <label class="font-weight-bold mt-2">Request Token (Automatic Value)</label>
                        <input type="text" name="token" id="token" class="form-control" placeholder="Request Key" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Simpan</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row mb-5">
        <?php
        foreach ($mcu as $m) {
        ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h2><?= $m['nama_kontroller'] ?></h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fa fa-layer-group"></i> <?= $m['type'] ?></li>
                            <li class="list-group-item"><i class="fa fa-clock"></i> <?= $m['delay'] / 1000 ?></li>
                            <li class="list-group-item"><i class="fa fa-lock"></i> <?= $m['keypad_password'] ?></li>
                            <li class="list-group-item"><i class="fa fa-wifi"></i> <?= $m['token'] ?></li>
                        </ul>
                        <a class="btn btn-md btn-warning w-100 my-3" data-toggle="modal" data-target="#editController" onclick="editController('<?= $m['nama_kontroller'] ?>', '<?= $m['type'] ?>', '<?= $m['keypad_password'] ?>', <?= $m['delay'] / 1000 ?>, '<?= $m['token'] ?>')">Edit Kontroler Pintu</a>
                        <a class="btn btn-md btn-danger w-100 my-2" href="javascript:void(0)" onclick="confirm_delete('delete_controller', '<?= $m['token'] ?>')">Hapus Kontroler Pintu</a>
                        <form action="<?= route_to('delete_controller', $m['token']) ?>" id="delete_controller-<?= $m['token'] ?>"></form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?= $this->endSection() ?>