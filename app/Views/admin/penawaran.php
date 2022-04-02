<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Berkas Penawaran</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Berkas Penawaran<strong><?= session()->getFlashdata('message'); ?></strong>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahPenawaran">
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
                                        <th>Kepada</th>
                                        <th>No Penawaran</th>
                                        <th>Tanggal Penawaran</th>
                                        <th>Uraian</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tbody>
                                        <?php
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $no = 1 + (10 * ($page - 1));

                                        foreach ($penawaran as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['kepada']; ?></td>
                                                <td><?= $row['no_penawaran']; ?></td>
                                                <td><?= $row['tgl_penawaran']; ?></td>
                                                <td><?= $row['uraian']; ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelUbahPenawaran" id="btn-editpenawaran" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-kepada="<?= $row['kepada']; ?>" data-no_penawaran="<?= $row['no_penawaran']; ?>" data-tgl_penawaran="<?= $row['tgl_penawaran']; ?>" data-uraian="<?= $row['uraian']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapusPenawaran" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelDownloadPenawaran" class="btn btn-sm btn-success"> <i class="fas fa-download"></i></button>
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
<div class="modal fade" id="modelTambahPenawaran">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Penawaran/addpenawaran'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan Kepada">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_penawaran"></label>
                        <input type="text" name="no_penawaran" id="no_penawaran" class="form-control" placeholder="Masukan No Penawaran">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_penawaran"></label>
                        <input type="date" name="tgl_penawaran" id="tgl_penawaran" class="form-control" placeholder="Masukan Tanggal Penawaran">
                    </div>
                    <div class="custom-file mb-1">
                        <label class="custom-file-label" for="uraian">Pilih file</label>
                        <input type="file" name="uraian" id="uraian">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addpenawaran" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Surat-->
<div class="modal fade" id="modelUbahPenawaran">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Penawaran/ubahpenawaran'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="text" name="id" id="id-penawaran">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan Tanggal Surat Masuk" <?= $row['kepada'] ?>>
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_penawaran"></label>
                        <input type="text" name="no_penawaran" id="no_penawaran" class="form-control" placeholder="Masukan No surat masuk" value="<?= $row['no_penawaran'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_penawaran"></label>
                        <input type="date" name="tgl_penawaran" id="tgl_penawaran" class="form-control" placeholder="Masukan tgl_penawaran" value="<?= $row['tgl_penawaran'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="uraian"></label>
                        <input type="text" name="uraian" id="uraian" class="form-control" placeholder="Masukan uraian" value="<?= $row['uraian'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahpenawaran" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Data Surat Masuk-->
<div class="modal fade" id="modelHapusFormulir">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus anda ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="Penawaran/hapuspenawaran/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal download Data-->
<div class="modal fade" id="modelDownloadPenawaran">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin mendownload file ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a href="Penawaran/download/<?= $row['uraian'] ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>