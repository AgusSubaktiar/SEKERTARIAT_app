<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Memo Masuk</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Memo Masuk<strong><?= session()->getFlashdata('message'); ?></strong>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahMemoMasuk">
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
                                        <th>Tanggal Surat</th>
                                        <th>No Memo</th>
                                        <th>Dari</th>
                                        <th>Kepada</th>
                                        <th>Perihal</th>
                                        <th>ordner</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tbody>
                                        <?php
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $no = 1 + (10 * ($page - 1));

                                        foreach ($memomasuk as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['tgl_memomasuk']; ?></td>
                                                <td><?= $row['no_memo']; ?></td>
                                                <td><?= $row['dari']; ?></td>
                                                <td><?= $row['kepada']; ?></td>
                                                <td><?= $row['perihal']; ?></td>
                                                <td><?= $row['ordner']; ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelUbahMemoMasuk" id="btn-editmemomasuk" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-tgl_memomasuk="<?= $row['tgl_memomasuk']; ?>" data-no_memo="<?= $row['no_memo']; ?>" data-dari="<?= $row['dari']; ?>" data-kepada="<?= $row['kepada']; ?>" data-perihal="<?= $row['perihal']; ?>" data-ordner="<?= $row['ordner']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapusMemoMasuk" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>

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
<div class="modal fade" id="modelTambahMemoMasuk">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('MemoMasuk/addmemomasuk'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="tgl_memomasuk"></label>
                        <input type="date" name="tgl_memomasuk" id="tgl_memomasuk" class="form-control" placeholder="Masukan Tanggal Memo Masuk">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_memo"></label>
                        <input type="text" name="no_memo" id="no_memo" class="form-control" placeholder="Masukan No Memo">
                    </div>
                    <div class="form-group mb-1">
                        <label for="dari"></label>
                        <input type="text" name="dari" id="dari" class="form-control" placeholder="Masukan Dari">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan Kepada">
                    </div>
                    <div class="form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal">
                    </div>
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="ordner">Pilih file</label>
                        <input type="file" name="ordner" id="ordner">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addmemomasuk" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Surat-->
<div class="modal fade" id="modelUbahMemoMasuk">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('MemoMasuk/ubahmemomasuk'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="hidden" name="id" id="id-memomasuk">
                        <label for="tgl_memomasuk"></label>
                        <input type="date" name="tgl_memomasuk" id="tgl_memomasuk" class="form-control" placeholder="Masukan Tanggal Memo" value="<?= $row['tgl_memomasuk'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_memo"></label>
                        <input type="text" name="no_memo" id="no_memo" class="form-control" placeholder="Masukan No memo" value="<?= $row['no_memo'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="dari"></label>
                        <input type="text" name="dari" id="dari" class="form-control" placeholder="Masukan dari" value="<?= $row['dari'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan kepada" value="<?= $row['kepada'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal" value="<?= $row['perihal'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="ordner"></label>
                        <input type="text" name="ordner" id="ordner" class="form-control" placeholder="Masukan ordner" value="<?= $row['ordner'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahmemomasuk" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus Data Surat Masuk-->
<div class="modal fade" id="modelHapusMemoMasuk">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus anda ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="MemoMasuk/hapusmemomasuk/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>