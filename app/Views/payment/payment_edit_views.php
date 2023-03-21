<?= $this->extend('template/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Payment Methode Management</h1>

    <div class="card shadow mb-4 col-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Payment Methode</h6>
        </div>
        <div class="card-body">
            <form action="/payment/update/<?= $detail['id'] ?>" method="post">
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <input class="form-control col-6" id="nama" name="nama" type="text" placeholder="DANA..." value="<?= $detail['nama'] ?>">
                </div>
                <div class="mb-3">
                    <label for="is_admin">Status</label>
                    <select class="form-control col-6" id="is_active" name="is_active">
                        <option <?php echo ($detail['is_active'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
                        <option <?php echo ($detail['is_active'] == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group row p-2">
                    <button type="submit" class="btn btn-primary">Edit</button>
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