<?= $this->extend('template/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Price Management</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Price</h6>
        </div>
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success mt-2 mx-2" role="alert">
                <?= session()->getFlashdata('msg'); ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kendaraan</th>
                            <th>Harga Awal</th>
                            <th>Harga Menggulung</th>
                            <th>Harga Maximal</th>
                            <th>Harga Menginap</th>
                            <th>Harga Kehilangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Kendaraan</th>
                            <th>Harga Awal</th>
                            <th>Harga Menggulung</th>
                            <th>Harga Maximal</th>
                            <th>Harga Menginap</th>
                            <th>Harga Kehilangan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($all_price as $i) : ?>
                            <tr>
                                <td><?= $i->nama ?></td>
                                <td><?= "Rp " . number_format($i->first_price, 0, ",", ".") ?></td>
                                <td><?= "Rp " . number_format($i->roll_price, 0, ",", ".") ?></td>
                                <td><?= "Rp " . number_format($i->max_price, 0, ",", ".") ?></td>
                                <td><?= "Rp " . number_format($i->stay_price, 0, ",", ".") ?></td>
                                <td><?= "Rp " . number_format($i->lost_price, 0, ",", ".") ?></td>
                                <td>
                                    <a data-toggle="modal" data-target="#exampleModal<?= $i->id ?>" class="btn btn-success">Detail</a>
                                    <a href="/payment/edit/<?= $i->id ?>" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?= $i->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Price</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Nama : <?= $i->nama ?></p>
                                            <p>Harga Awal : <?= "Rp " . number_format($i->first_price, 0, ",", ".") ?></p>
                                            <p>Harga Menggulung : <?= "Rp " . number_format($i->roll_price, 0, ",", ".") ?></p>
                                            <p>Harga Maximal : <?= "Rp " . number_format($i->max_price, 0, ",", ".") ?></p>
                                            <p>Harga Menginap : <?= "Rp " . number_format($i->stay_price, 0, ",", ".") ?></p>
                                            <p>Harga Kehilangan : <?= "Rp " . number_format($i->lost_price, 0, ",", ".") ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>