<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="#" data-toggle="modal" data-target="#filterData" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-calendar fa-sm text-white-50"></i> Filter Data</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="filterData" tabindex="-1" role="dialog" aria-labelledby="filterDataLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterDataLabel">Filter Data Log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="font-weight-bold">Date</label>
                    <input type="date" name="date" id="date" class="form-control" placeholder="date">
                    <label class="font-weight-bold mt-2">Access</label>
                    <select name="access" id="access" class="form-control">
                        <option value="">All Access</option>
                        <?php
                        foreach ($access as $a) {
                        ?> <option value="<?= $a['name'] ?>"><?= $a['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button onclick="filterLog()" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

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
                    <table class="table table-responsive table-striped" id="dataTableLog">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>Username</th>
                                <th>Access</th>
                                <th>Date Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($log as $l) : ?>
                                <tr>
                                    <td><?= $l['uid'] ?></td>
                                    <td><?= $l['username'] ?></td>
                                    <td><?= $l['access'] ?></td>
                                    <td><?= $l['date_time'] ?></td>
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