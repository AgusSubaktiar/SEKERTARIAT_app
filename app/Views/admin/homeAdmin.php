<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Masuk</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_suratm ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-envelope-open"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_suratk ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Memo Masuk</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_memomasuk ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Memo Keluar</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_memokeluar ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-address-card"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Email Masuk</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_emailkeluar ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-address-card"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Email Keluar</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_emailkeluar ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-folder"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Keputusan</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_suratkeputusan ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-cart-plus"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Perizinan</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_perizinan ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fab fa-accusoft"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Formulir</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_formulir ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Berkas Penawaran</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_berkas ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-folder-plus"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Berkas Tender</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_tender ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total User</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_user ?>
                    </div>
                </div>
            </div>
        </div>


</section>


<?= $this->endSection() ?>