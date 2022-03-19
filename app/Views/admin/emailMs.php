<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Email Masuk</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Email Masuk<strong><?= session()->getFlashdata('message'); ?></strong>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahEms">
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

                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>No.</th>
                                <th>Proyek</th>
                                <th>Kontak</th>
                                <th>Tgl Surat</th>
                                <th>No Surat</th>
                                <th>Dibuat di</th>
                                <th>Perihal</th>
                                <th>Kerahasiaan</th>
                                <th>Urgensi</th>
                                <th>Ordner</th>
                                <th>Aksi</th>
                            </tr>
                            <tbody>
                                <?php
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $no = 1 + (2 * ($page - 1));

                                foreach ($email_masuk as $row) : ?>
                                    <tr>
                                        <td scope"row"><?= $no; ?></td>
                                        <td><?= $row['proyek']; ?></td>
                                        <td><?= $row['kontak']; ?></td>
                                        <td><?= $row['tgl_surat']; ?></td>
                                        <td><?= $row['no_surat']; ?></td>
                                        <td><?= $row['dibuat']; ?></td>
                                        <td><?= $row['hal']; ?></td>
                                        <td><?= $row['kerahasiaan']; ?></td>
                                        <td><?= $row['urgensi']; ?></td>
                                        <td><?= $row['ordner']; ?></td>

                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#modelEmailm" id="btn-editEms" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-proyek="<?= $row['proyek']; ?>" data-kontak="<?= $row['kontak']; ?>" data-tgl_surat="<?= $row['tgl_surat']; ?>" data-no_surat="<?= $row['no_surat']; ?>" data-dibuat="<?= $row['dibuat']; ?>" data-hal="<?= $row['hal']; ?>" data-kerahasiaan="<?= $row['kerahasiaan']; ?>" data-urgensi="<?= $row['urgensi']; ?>" data-ordner="<?= $row['ordner']; ?>"> <i class="fas fa-edit"></i></button>
                                            <button type="button" data-toggle="modal" data-target="#modelHapusEm" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $pager->links('default', 'pagination'); ?>
                    </div>
                </div>
</section>

<!-- Modal Tambah Surat-->
<div class="modal fade" id="modelTambahEms">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('EmailMs/addEmailMs'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="proyek"></label>
                        <input type="text" name="proyek" id="proyek" class="form-control" placeholder="Masukan Nama proyek">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kontak"></label>
                        <input type="text" name="kontak" id="kontak" class="form-control" placeholder="Masukan kontak">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_surat"></label>
                        <input type="date" name="tgl_surat" id="tgl_surat" class="form-control" placeholder="Masukan Tangal Masuk">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_surat"></label>
                        <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Masukan No Surat">
                    </div>
                    <div class="form-group mb-1">
                        <label for="dibuat"></label>
                        <input type="text" name="dibuat" id="dibuat" class="form-control" placeholder="Masukan dibuat">
                    </div>
                    <div class="form-group mb-1">
                        <label for="hal"></label>
                        <input type="text" name="hal" id="hal" class="form-control" placeholder="Masukan hal">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kerahasiaan"></label>
                        <input type="text" name="kerahasiaan" id="kerahasiaan" class="form-control" placeholder="Masukan kerahasiaan">
                    </div>
                    <div class="form-group mb-1">
                        <label for="urgensi"></label>
                        <input type="text" name="urgensi" id="urgensi" class="form-control" placeholder="Masukan urgensi">
                    </div>
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="ordner">Pilih file</label>
                        <input type="file" name="ordner" id="ordner">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addEmailMs" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Surat -->
<div class="modal fade" id="modelEmailm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('EmailMs/ubahEmailm'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="hidden" name="id" id="id-email">
                        <label for="proyek"></label>
                        <input type="text" name="proyek" id="proyek" class="form-control" placeholder="Masukan Nama proyek" <?= $row['proyek'] ?>>
                    </div>
                    <div class="form-group mb-1">
                        <label for="kontak"></label>
                        <input type="text" name="kontak" id="kontak" class="form-control" placeholder="Masukan kontak" value="<?= $row['kontak'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_surat"></label>
                        <input type="date" name="tgl_surat" id="tgl_surat" class="form-control" placeholder="Masukan Tangal Masuk" value="<?= $row['tgl_surat'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_surat"></label>
                        <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Masukan No Surat" value="<?= $row['no_surat'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="dibuat"></label>
                        <input type="text" name="dibuat" id="dibuat" class="form-control" placeholder="Masukan dibuat" value="<?= $row['dibuat'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="hal"></label>
                        <input type="text" name="hal" id="hal" class="form-control" placeholder="Masukan hal" value="<?= $row['hal'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kerahasiaan"></label>
                        <input type="text" name="kerahasiaan" id="kerahasiaan" class="form-control" placeholder="Masukan kerahasiaan" value="<?= $row['kerahasiaan'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="urgensi"></label>
                        <input type="text" name="urgensi" id="urgensi" class="form-control" placeholder="Masukan urgensi" value="<?= $row['urgensi'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="ordner"></label>
                        <input type="text" name="ordner" id="ordner" class="form-control" placeholder="Masukan ordner" value="<?= $row['ordner'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahEmailm" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus Data Surat Masuk-->
<div class="modal fade" id="modelHapusEm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="/SuratMasukU/hapuEms/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>





<?= $this->endSection() ?>