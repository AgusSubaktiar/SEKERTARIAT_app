<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Surat Keputusan</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Surat Keputusan<strong><?= session()->getFlashdata('message'); ?></strong>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahSuratKep">
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
                                        <th>No Surat Keputusan</th>
                                        <th>Tanggal Surat</th>
                                        <th>Kepada</th>
                                        <th>File Upload</th>
                                        <th>ordner</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tbody>
                                        <?php
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $no = 1 + (5 * ($page - 1));

                                        foreach ($surat_keputusan as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['no_sk']; ?></td>
                                                <td><?= $row['tgl_sk']; ?></td>
                                                <td><?= $row['kepada']; ?></td>
                                                <td><?= $row['ordner']; ?></td>
                                                <td><?= $row['upload_sk']; ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelUbahSuratKep" id="btn-editsuratkep" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-no_sk="<?= $row['no_sk']; ?>" data-tgl_sk="<?= $row['tgl_sk']; ?>" data-kepada="<?= $row['kepada']; ?>" data-ordner="<?= $row['ordner']; ?>" data-upload_sk="<?= $row['upload_sk']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapusSuratKep" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>

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
<div class="modal fade" id="modelTambahSuratKep">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('SuratKeputusan/addsurat_keputusan'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="no_sk"></label>
                        <input type="text" name="no_sk" id="no_sk" class="form-control" placeholder="Masukan No Surat Keputusan">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_sk"></label>
                        <input type="date" name="tgl_sk" id="tgl_sk" class="form-control" placeholder="Masukan Tanggal SK">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan Kepada">
                    </div>
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="ordner">Pilih file</label>
                        <input type="file" name="ordner" id="ordner">
                    </div>
                    <div class="form-group mb-1">
                        <label for="upload_sk"></label>
                        <input type="text" name="upload_sk" id="upload_sk" class="form-control" placeholder="Masukan upload_sk">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addsurat_keputusan" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Surat-->
<div class="modal fade" id="modelUbahSuratKep">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('SuratKeputusan/ubahsurat_keputusan'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="hidden" name="id" id="id-suratkep">
                        <label for="no_sk"></label>
                        <input type="text" name="no_sk" id="no_sk" class="form-control" placeholder="Masukan No SK" <?= $row['no_sk'] ?>>
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_sk"></label>
                        <input type="date" name="tgl_sk" id="tgl_sk" class="form-control" placeholder="Masukan Tanggal SK" value="<?= $row['tgl_sk'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan kepada" value="<?= $row['kepada'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="ordner"></label>
                        <input type="text" name="ordner" id="ordner" class="form-control" placeholder="Masukan ordner" value="<?= $row['ordner'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="upload_sk"></label>
                        <input type="text" name="upload_sk" id="upload_sk" class="form-control" placeholder="Masukan upload_sk" value="<?= $row['upload_sk'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahsurat_keputusan" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus Data Surat Masuk-->
<div class="modal fade" id="modelHapusSuratKep">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus anda ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="SuratKeputusan/hapussurat_keputusan/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection() ?>