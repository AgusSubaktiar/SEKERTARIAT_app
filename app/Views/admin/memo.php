<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Memo</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Memo<strong><?= session()->getFlashdata('message'); ?></strong>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahMemo">
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
                                        <th>Tanggal Memo</th>
                                        <th>No Memo</th>
                                        <th>Dibuat</th>
                                        <th>Perihal</th>
                                        <th>Dari</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tbody>
                                        <?php
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $no = 1 + (5 * ($page - 1));

                                        foreach ($memo as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['tgl_memo']; ?></td>
                                                <td><?= $row['no_surat']; ?></td>
                                                <td><?= $row['dibuat']; ?></td>
                                                <td><?= $row['perihal']; ?></td>
                                                <td><?= $row['dari']; ?></td>

                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelUbahMemo" id="btn-editmemo" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-tgl_memo="<?= $row['tgl_memo']; ?>" data-no_surat="<?= $row['no_surat']; ?>" data-dibuat="<?= $row['dibuat']; ?>" data-perihal="<?= $row['perihal']; ?>" data-dari="<?= $row['dari']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapusMemo" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>

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
<div class="modal fade" id="modelTambahMemo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Memo/addmemo'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="tgl_memo"></label>
                        <input type="date" name="tgl_memo" id="tgl_memo" class="form-control" placeholder="Masukan Tanggal memo">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_surat"></label>
                        <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Masukan No Memo">
                    </div>
                    <div class="form-group mb-1">
                        <label for="dibuat"></label>
                        <input type="text" name="dibuat" id="dibuat" class="form-control" placeholder="Masukan Dibuat">
                    </div>
                    <div class="form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan Perihal">
                    </div>
                    <div class="form-group mb-1">
                        <label for="dari"></label>
                        <input type="text" name="dari" id="dari" class="form-control" placeholder="Masukan Dari">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addmemo" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Surat-->
<div class="modal fade" id="modelUbahMemo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Memo/ubahmemo'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="hidden" name="id" id="id-memo">
                        <label for="tgl_memo"></label>
                        <input type="date" name="tgl_memo" id="tgl_memo" class="form-control" placeholder="Masukan Tanggal memo" <?= $row['tgl_memo'] ?>>
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_surat"></label>
                        <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Masukan No Memo" value="<?= $row['no_surat'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="dibuat"></label>
                        <input type="text" name="dibuat" id="dibuat" class="form-control" placeholder="Masukan Dibuat" value="<?= $row['dibuat'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal" value="<?= $row['perihal'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="dari"></label>
                        <input type="text" name="dari" id="dari" class="form-control" placeholder="Masukan dari" value="<?= $row['dari'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahmemo" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus Data Surat Masuk-->
<div class="modal fade" id="modelHapusMemo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus anda ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="Memo/hapusmemo/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>





<?= $this->endSection() ?>