<?= $this->extend('template/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">User Management</h1>

    <div class="card shadow mb-4 col-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Register User</h6>
        </div>
        <div class="card-body">
            <form action="/users/save" method="post">
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input class="form-control col-6" id="email" name="email" type="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="pwd">Password</label>
                    <input class="form-control col-6" id="pwd" name="pwd" type="password">
                </div>
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <input class="form-control col-6" id="nama" name="nama" type="text" placeholder="Fawwaz...">
                </div>
                <div class="mb-3">
                    <label for="is_admin">Role</label>
                    <select class="form-control col-6" id="is_admin" name="is_admin">
                        <option value="1">Super Admin</option>
                        <option value="0">Kasir</option>
                    </select>
                </div>
                <div class="form-group row p-2">
                    <button type="submit" class="btn btn-primary">Register</button>
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