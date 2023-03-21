<?= $this->extend('template/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Vehicle Type Management</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Vehicle Type</h6>
        </div>
        <a href="/vehicle/create" class="btn btn-primary col-2 m-3"> + Add Vehicle Type</a>
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
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($all_vehicle as $i) : ?>
                            <tr>
                                <td><?= $i->nama ?></td>
                                <td><?php echo ($i->is_active == 1) ? 'Active' : 'Inactive'; ?></td>
                                <td>
                                    <a data-toggle="modal" data-target="#exampleModal<?= $i->id ?>" class="btn btn-success">Detail</a>
                                    <a href="/vehicle/edit/<?= $i->id ?>" class="btn btn-warning">Edit</a>
                                    <a href="/vehicle/delete/<?= $i->id ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?= $i->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Vehicle</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Nama : <?= $i->nama ?></p>
                                            <p>Status : <?php echo ($i->is_active == 1) ? 'Active' : 'Inactive'; ?></p>
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