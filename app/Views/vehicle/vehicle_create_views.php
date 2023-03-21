<?= $this->extend('template/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Vehicle Type Management</h1>

    <div class="card shadow mb-4 col-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Vehicle Type</h6>
        </div>
        <div class="card-body">
            <form action="/vehicle/save" method="post">
                <div class="mb-3">
                    <label for="nama">Vehicle Type</label>
                    <input class="form-control col-6" id="nama" name="nama" type="text" placeholder="BUS...">
                </div>
                <div class="mb-3">
                    <label for="is_active">Status</label>
                    <select class="form-control col-6" id="is_active" name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <?php if (empty(session()->getFlashdata('reactivate'))) : ?>
                    <div class="form-group row p-2">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                <?php endif ?>
            </form>
            <?php if (!empty(session()->getFlashdata('err'))) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?= session()->getFlashdata('err'); ?>
                </div>
            <?php endif ?>
            <?php if (!empty(session()->getFlashdata('reactivate'))) : ?>
                <div class="alert alert-warning mt-3" role="alert">
                    <h5>Confirmation Re-activate <b><?= session()->getFlashdata('reactivate'); ?></b> ?</h5>
                    <br>
                    <p>this vehicle type is already delete before, want to activate again ?</p>
                    <a href="" class="btn btn-danger">Cancel</a>
                    <a href="/vehicle/reactivate/<?= session()->getFlashdata('reactivate'); ?>" class="btn btn-warning">Re-activate</a>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>