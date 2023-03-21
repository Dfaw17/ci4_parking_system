<?= $this->extend('template/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_user[0]->id ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Payment Methode</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pembayaran[0]->id ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Vehicle Type</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kendaraan[0]->id ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <p>EXPIRED SESSION : <?= $expired_session ?></p>
    <p>NOW : <?= $now ?></p>
    <p>Different : <?= $expired_session - $now ?></p> -->

</div>

<?= $this->endSection(); ?>