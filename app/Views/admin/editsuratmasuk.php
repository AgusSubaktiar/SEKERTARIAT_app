<?= $this->extend('layout/defaultAdmin'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Form edit surat masuk</h1>
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

    <div class="row">
        <div class="col-md-6">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger' role='alert'>" . session()->get('err') . "</div>";
                session()->remove('err');
            }
            ?>
        </div>
    </div>

    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <form action="/suratmasuk/editsuratmasuk/<?= $suratmasuk[0]['id'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group mb-3">
                                    <input type="hidden" name="id" id="id-suratmasuk">
                                    <label for="tgl_suratmasuk">Tanggal Surat</label>
                                    <input type="date" name="tgl_suratmasuk" id="tgl_suratmasuk" class="form-control" placeholder="Masukan Tanggal Surat Masuk" value="<?= $suratmasuk[0]['tgl_suratmasuk']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_suratmasuk">Nomor Surat</label>
                                    <input type="text" name="no_suratmasuk" id="no_suratmasuk" class="form-control" placeholder="Masukan No surat masuk" value="<?= $suratmasuk[0]['no_suratmasuk']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kepada">Kepada</label>
                                    <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan kepada" value="<?= $suratmasuk[0]['kepada']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="perihal">Perihal</label>
                                    <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal" value="<?= $suratmasuk[0]['perihal']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <?php foreach ($disposisi as $dispos) : ?>
                                            <option value="<?= $dispos['id_disposisi']; ?>" <?= ($dispos['id_disposisi'] === $suratmasuk[0]['id_disposisi']) ? 'selected' : ''; ?>><?= $dispos['disposisi']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Untuk Bidang</label>
                                    <div class="row">
                                        <?php foreach ($bidang as $bid) : ?>
                                            <div class="col-sm-6">
                                                <input type="checkbox" name="bidang[]" id="bidang" value="<?= $bid['id_bidang']; ?>" multiple <?php foreach ($terdisposisi as $terdispos) : ?> <?= ($bid['id_bidang'] === $terdispos['id_bidang']) ? 'checked' : ''; ?> <?php endforeach; ?>>
                                                <label for="bidang"><?= $bid['nama_bidang']; ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_proyek">Kode Proyek</label>
                                    <input type="text" name="kode_proyek" id="kode_proyek" class="form-control" placeholder="Masukan kode proyek" value="<?= $suratmasuk[0]['kode_proyek']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_proyek">Nama Proyek</label>
                                    <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" placeholder="Masukan nama proyek" value="<?= $suratmasuk[0]['nama_proyek']; ?>">
                                </div>
                                <div class=" form-group mb-3">
                                    <label for="ordner">Ordner</label>
                                    <input type="file" name="ordner" id="ordner" class="form-control" placeholder="Masukan ordner" value="<?= $suratmasuk[0]['ordner']; ?>">
                                    <p><?= $suratmasuk[0]['ordner']; ?></p>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>