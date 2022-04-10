<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Surat Masuk</h1>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahSuratMasuk">
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
                                <table class="table dataTable table-striped table-md" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Surat</th>
                                            <th>No Surat</th>
                                            <th>Kepada</th>
                                            <th>Perihal</th>
                                            <th>Kode Proyek</th>
                                            <th>Nama Proyek</th>
                                            <th>ordner</th>
                                            <th>Bidang</th>
                                            <th>Status</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $no = 1 + (5 * ($page - 1));

                                        foreach ($terdisposisi as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['tgl_suratmasuk']; ?></td>
                                                <td><?= $row['no_suratmasuk']; ?></td>
                                                <td><?= $row['kepada']; ?></td>
                                                <td><?= $row['perihal']; ?></td>
                                                <td><?= $row['kode_proyek']; ?></td>
                                                <td><?= $row['nama_proyek']; ?></td>
                                                <td><?= $row['ordner']; ?></td>
                                                <td><?= $row['bidang']; ?></td>
                                                <?php foreach ($disposisi as $dispos) : ?>
                                                    <?php if ($row['id_disposisi'] === $dispos['id_disposisi']) : ?>
                                                        <td><?= $dispos['disposisi'] ?></td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelSuratMasuk" id="btn-editsuratmasuk" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-tgl_suratmasuk="<?= $row['tgl_suratmasuk']; ?>" data-no_suratmasuk="<?= $row['no_suratmasuk']; ?>" data-kepada="<?= $row['kepada']; ?>" data-perihal="<?= $row['perihal']; ?>" data-kode_proyek="<?= $row['kode_proyek']; ?>" data-nama_proyek="<?= $row['nama_proyek']; ?>" data-ordner="<?= $row['ordner']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapusSuratMasuk<?= $row['id']; ?>" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>

                                                </td>
                                            </tr>
                                            <!-- Modal Hapus Data Surat Masuk-->
                                            <form action="SuratMasuk/hapussuratmasuk/<?= $row['id']; ?>" method="post">
                                                <div class="modal fade" id="modelHapusSuratMasuk<?= $row['id']; ?>" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus anda ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a href="SuratMasuk/hapussuratmasuk/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php $no++; ?>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Surat-->
<div class="modal fade" id="modelTambahSuratMasuk" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('SuratMasuk/addsuratmasuk'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="tgl_suratmasuk"></label>
                        <input type="date" name="tgl_suratmasuk" id="tgl_suratmasuk" class="form-control" placeholder="Masukan No Surat Keputusan">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_suratmasuk"></label>
                        <input type="text" name="no_suratmasuk" id="no_suratmasuk" class="form-control" placeholder="Masukan Tanggal SK">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan Kepada">
                    </div>
                    <div class="form-group mb-3">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal">
                    </div>
                    <div class="form-group mb-1">
                        <select class="form-control" name="disposisi" id="disposisi">
                            <option value="">----Pilih Status-----</option>
                            <?php foreach ($disposisi as $dispos) : ?>
                                <option value="<?= $dispos['id_disposisi']; ?>"><?= $dispos['disposisi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-1">
                        <label for="">Bidang</label>
                        <div class="row">
                            <?php foreach ($bidang as $key) : ?>
                                <div class="col-6">
                                    <input type="checkbox" name="bidang[]" id="bidang" value="<?= $key['id_bidang']; ?>" multiple>
                                    <label for=""><?= $key['nama_bidang']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group mb-1">
                        <label for="kode_proyek"></label>
                        <input type="text" name="kode_proyek" id="kode_proyek" class="form-control" placeholder="Masukan kode_proyek">
                    </div>
                    <div class="form-group mb-1">
                        <label for="nama_proyek"></label>
                        <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" placeholder="Masukan nama_proyek">
                    </div>
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="ordner">Pilih file</label>
                        <input type="file" name="ordner" id="ordner">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addsuratmasuk" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Surat-->

<?= $this->endSection() ?>