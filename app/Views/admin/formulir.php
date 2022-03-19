<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Formulir</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Formulir<strong><?= session()->getFlashdata('message'); ?></strong>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahFormulir">
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
                                        <th>Nama Dokumen</th>
                                        <th>Di input oleh</th>
                                        <th>Waktu input</th>
                                        <th>Ordner</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tbody>
                                        <?php
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $no = 1 + (5 * ($page - 1));

                                        foreach ($formulir_formulir as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['nama_dokumen']; ?></td>
                                                <td><?= $row['input_oleh']; ?></td>
                                                <td><?= $row['waktu_input']; ?></td>
                                                <td><?= $row['ordner']; ?></td>

                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelUbahFormulir" id="btn-editformulir" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-nama_dokumen="<?= $row['nama_dokumen']; ?>" data-input_oleh="<?= $row['input_oleh']; ?>" data-waktu_input="<?= $row['waktu_input']; ?>" data-ordner="<?= $row['ordner']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapusFormulir" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>

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
<div class="modal fade" id="modelTambahFormulir">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Formulir/addformulir'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="nama_dokumen"></label>
                        <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" placeholder="Masukan Nama dokumen">
                    </div>
                    <div class="form-group mb-1">
                        <label for="input_oleh"></label>
                        <input type="text" name="input_oleh" id="input_oleh" class="form-control" placeholder="Masukan di input oleh">
                    </div>
                    <div class="form-group mb-1">
                        <label for="waktu_input"></label>
                        <input type="date" name="waktu_input" id="waktu_input" class="form-control" placeholder="Masukan waktu input">
                    </div>
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="ordner">Pilih file</label>
                        <input type="file" name="ordner" id="ordner">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addformulir" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Surat-->
<div class="modal fade" id="modelUbahFormulir">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Formulir/ubahformulir'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="hidden" name="id" id="id-formulir">
                        <label for="nama_dokumen"></label>
                        <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" placeholder="Masukan Nama nama_dokumen" <?= $row['nama_dokumen'] ?>>
                    </div>
                    <div class="form-group mb-1">
                        <label for="input_oleh"></label>
                        <input type="text" name="input_oleh" id="input_oleh" class="form-control" placeholder="Masukan input_oleh" value="<?= $row['input_oleh'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="waktu_input"></label>
                        <input type="date" name="waktu_input" id="waktu_input" class="form-control" placeholder="Masukan Tangal Masuk" value="<?= $row['waktu_input'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="ordner"></label>
                        <input type="text" name="ordner" id="ordner" class="form-control" placeholder="Masukan ordner" value="<?= $row['ordner'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahformulir" class="btn btn-primary">Edit Data</button>
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
                <a href="Formulir/hapusformulir/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>





<?= $this->endSection() ?>