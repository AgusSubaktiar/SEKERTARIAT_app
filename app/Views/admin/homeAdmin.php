<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>


<section class="section">
    <div class="section-header">
        <h1>Halaman Admin</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-envelope"></i>
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
                <div class="card-icon bg-dark">
                    <i class="far fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Memo</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_memo ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Email Masuk</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_emailms ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Email Keluar</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_emailk ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Formulir - formulir</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_formulir ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>User</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot_user ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>