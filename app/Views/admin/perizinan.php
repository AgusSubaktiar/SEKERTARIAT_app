<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Perizinan</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Perizinan<strong><?= session()->getFlashdata('message'); ?></strong>
        </div>

        <script>
            $(".alert").alert();
        </script>
    <?php endif; ?>

    <divc class="row">
        <div class="col-md-6">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger' role='alert'>" . session()->get('err') . "</div>";
                session()->remove('err');
            }
            ?>
        </div>
    </divc>

    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahPerizinan">
                                    <i class="fa fas-plus">Tambah Data</i>
                                </button>
                            </h4>
                            <div class="card-header-form">
                                <form action="" method="post">
                                    <div class="input-group">
                                        <input type="text" name="keyword" value="" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Tanggal Perizinan</th>
                                        <th>No Perizinan</th>
                                        <th>Perihal</th>
                                        <th>Masa Berlaku</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tbody>
                                        <?php
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $no = 1 + (5 * ($page - 1));

                                        foreach ($perizinan as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['tgl_perizinan']; ?></td>
                                                <td><?= $row['no_perizinan']; ?></td>
                                                <td><?= $row['perihal']; ?></td>
                                                <td><?= $row['masaberlaku']; ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelUbahPerizinan" id="btn-editperizinan" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-nama="<?= $row['nama']; ?>" data-tgl_perizinan="<?= $row['tgl_perizinan']; ?>" data-no_perizinan="<?= $row['no_perizinan']; ?>" data-perihal="<?= $row['perihal']; ?>" data-masaberlaku="<?= $row['masaberlaku']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapusPerizinan" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>

                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <nav class="d-inline-block">
                                        <ul class="pagination mb-0">
                                            <li class="page-item active"><?= $pager->links('default', 'pagination'); ?></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
</section>

<!-- Modal Tambah Surat-->
<div class="modal fade" id="modelTambahPerizinan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Perizinan/addperizinan'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="nama"></label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_perizinan"></label>
                        <input type="date" name="tgl_perizinan" id="tgl_perizinan" class="form-control" placeholder="Masukan Tanggal Perizinan">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_perizinan"></label>
                        <input type="text" name="no_perizinan" id="no_perizinan" class="form-control" placeholder="Masukan No Perizinan">
                    </div>
                    <div class="form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan Perihal">
                    </div>
                    <div class="form-group mb-1">
                        <label for="masaberlaku"></label>
                        <input type="date" name="masaberlaku" id="masaberlaku" class="form-control" placeholder="Masukan Masa Berlaku">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addperizinan" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Surat-->
<div class="modal fade" id="modelUbahPerizinan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Perizinan/ubahperizinan'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="hidden" name="id" id="id-perizinan">
                        <label for="nama"></label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama" <?= $row['nama'] ?>>
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_perizinan"></label>
                        <input type="date" name="tgl_perizinan" id="tgl_perizinan" class="form-control" placeholder="Masukan Tanggal Perizinan" value="<?= $row['tgl_perizinan'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_perizinan"></label>
                        <input type="text" name="no_perizinan" id="no_perizinan" class="form-control" placeholder="Masukan No Perizinan" value="<?= $row['no_perizinan'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal" value="<?= $row['perihal'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="masaberlaku"></label>
                        <input type="date" name="masaberlaku" id="masaberlaku" class="form-control" placeholder="Masukan masa berlaku" value="<?= $row['masaberlaku'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahperizinan" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus Data Surat Masuk-->
<div class="modal fade" id="modelHapusPerizinan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus anda ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="Perizinan/hapusperizinan/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection() ?>