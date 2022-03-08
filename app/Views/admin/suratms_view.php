<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Surat Masuk</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Surat Masuk<strong><?= session()->getFlashdata('message'); ?></strong>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambah">
                                    <i class="fa fas-plus">Tambah Data</i>
                                </button>
                            </h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>No.</th>
                                        <th>Perusahaan</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Masuk</th>
                                        <th>No Surat</th>
                                        <th>Perihal</th>
                                        <th>Arsip</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($surat_masuk->getResultArray() as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $i; ?></td>
                                                <td><?= $row['perusahaan']; ?></td>
                                                <td><?= $row['alamat']; ?></td>
                                                <td><?= $row['tgl_masuk']; ?></td>
                                                <td><?= $row['no_surat']; ?></td>
                                                <td><?= $row['perihal']; ?></td>
                                                <td><?= $row['arsip']; ?></td>

                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelUbah" id="btn-edit" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-perusahaan="<?= $row['perusahaan']; ?>" data-alamat="<?= $row['alamat']; ?>" data-tgl_masuk="<?= $row['tgl_masuk']; ?>" data-no_surat="<?= $row['no_surat']; ?>" data-perihal="<?= $row['perihal']; ?>" data-arsip="<?= $row['arsip']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapus" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
</section>

<!-- Modal Tambah Surat-->
<div class="modal fade" id="modelTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('SuratMasuk/addSurat'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="perusahaan"></label>
                        <input type="text" name="perusahaan" id="perusahaan" class="form-control" placeholder="Masukan Nama Perusahaan">
                    </div>
                    <div class="form-group mb-1">
                        <label for="alamat"></label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_masuk"></label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" placeholder="Masukan Tangal Masuk">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_surat"></label>
                        <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Masukan No Surat">
                    </div>
                    <div class="form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan Perihal">
                    </div>
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="arsip">Pilih file</label>
                        <input type="file" name="arsip" id="arsip">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addSurat" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Surat-->
<div class="modal fade" id="modelUbah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('SuratMasuk/ubah'); ?>" method="POST">
                    <input type="hidden" name="id" id="id-surat_masuk">
                    <div class=" form-group mb-1">
                        <label for="perusahaan"></label>
                        <input type="text" name="perusahaan" id="perusahaan" class="form-control" placeholder="Masukan Nama Perusahaan" value="<?= $row['perusahaan'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="alamat"></label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat" value="<?= $row['alamat'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="tgl_masuk"></label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" placeholder="Masukan Tangal Masuk" value="<?= $row['tgl_masuk'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="no_surat"></label>
                        <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Masukan No Surat" value="<?= $row['no_surat'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan Perihal" value="<?= $row['perihal'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="arsip"></label>
                        <input type="text" name="arsip" id="arsip" class="form-control" placeholder="Masukan Arsip" value="<?= $row['arsip'] ?>">
                    </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Data Surat Masuk-->
<div class="modal fade" id="modelHapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus anda ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="/SuratMasuk/hapus/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>