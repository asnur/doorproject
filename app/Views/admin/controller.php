<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="#" data-toggle="modal" data-target="#addController" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Controller</a>
    </div>

    <!-- Modal -->
    <form action="<?= route_to('save_controller') ?>" method="POST">
        <div class="modal fade" id="addController" tabindex="-1" role="dialog" aria-labelledby="addControllerLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterDataLabel">Add New Controller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Controller Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Controller Name" required>
                        <label class="font-weight-bold mt-2">Controller Type</label>
                        <select class="form-control" name="type" required>
                            <option value="NodeMCU">NodeMCU</option>
                            <option value="ESP32">ESP32</option>
                        </select>
                        <label class="font-weight-bold mt-2">Keypad Password</label>
                        <input type="text" name="keypad_password" class="form-control" placeholder="Keypad Password" required>
                        <label class="font-weight-bold mt-2">Close Door Delay (ms)</label>
                        <input type="number" name="delay" class="form-control" placeholder="Close Door Delay" required>
                        <label class="font-weight-bold mt-2">Request Key (Automatic Value)</label>
                        <input type="text" name="token" class="form-control" placeholder="Request Key" readonly value="<?= uniqid() ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
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
                        <h5 class="modal-title" id="filterDataLabel">Add New Controller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Controller Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Controller Name" required>
                        <label class="font-weight-bold mt-2">Controller Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="NodeMCU">NodeMCU</option>
                            <option value="ESP32">ESP32</option>
                        </select>
                        <label class="font-weight-bold mt-2">Keypad Password</label>
                        <input type="number" pattern="\d*" maxlength="5" id="keypad_password" name="keypad_password" class="form-control" placeholder="Keypad Password" required>
                        <label class="font-weight-bold mt-2">Close Door Delay (ms)</label>
                        <input type="number" name="delay" id="delay" class="form-control" placeholder="Close Door Delay" required>
                        <label class="font-weight-bold mt-2">Request Key (Automatic Value)</label>
                        <input type="text" name="token" id="token" class="form-control" placeholder="Request Key" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
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
                        <h2><?= $m['name'] ?></h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fa fa-layer-group"></i> <?= $m['type'] ?></li>
                            <li class="list-group-item"><i class="fa fa-clock"></i> <?= $m['delay'] ?></li>
                            <li class="list-group-item"><i class="fa fa-lock"></i> <?= $m['keypad_password'] ?></li>
                            <li class="list-group-item"><i class="fa fa-wifi"></i> <?= $m['token'] ?></li>
                        </ul>
                        <a class="btn btn-md btn-warning w-100 my-3" data-toggle="modal" data-target="#editController" onclick="editController('<?= $m['name'] ?>', '<?= $m['type'] ?>', '<?= $m['keypad_password'] ?>', <?= $m['delay'] ?>, '<?= $m['token'] ?>')">Edit Controller</a>
                        <a class="btn btn-md btn-danger w-100 my-2" href="<?= route_to('delete_controller', $m['token']) ?>">Delete Controller</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?= $this->endSection() ?>