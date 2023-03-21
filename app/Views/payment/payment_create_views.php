<?= $this->extend('template/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Payment Methode Management</h1>

    <div class="card shadow mb-4 col-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Apyment Methode</h6>
        </div>
        <div class="card-body">
            <form action="/payment/save" method="post">
                <div class="mb-3">
                    <label for="nama">Payment Methode</label>
                    <input class="form-control col-6" id="nama" name="nama" type="text" placeholder="DANA...">
                </div>
                <div class="mb-3">
                    <label for="is_active">Status</label>
                    <select class="form-control col-6" id="is_active" name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group row p-2">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
            <?php if (!empty(session()->getFlashdata('err'))) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?= session()->getFlashdata('err'); ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>