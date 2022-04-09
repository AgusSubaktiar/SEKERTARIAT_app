<!-- edit surat masuk -->
<div class="modal fade" id="modelSuratMasuk">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('SuratMasuk/ubahsuratmasuk'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="hidden" name="id" id="id-suratmasuk">
                        <label for="tgl_suratmasuk"></label>
                        <input type="date" name="tgl_suratmasuk" id="tgl_suratmasuk" class="form-control" placeholder="Masukan Tanggal Surat Masuk" <?= $row['tgl_suratmasuk'] ?>>
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_suratmasuk"></label>
                        <input type="text" name="no_suratmasuk" id="no_suratmasuk" class="form-control" placeholder="Masukan No surat masuk" value="<?= $row['no_suratmasuk'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan kepada" value="<?= $row['kepada'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal" value="<?= $row['perihal'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kode_proyek"></label>
                        <input type="text" name="kode_proyek" id="kode_proyek" class="form-control" placeholder="Masukan kode proyek" value="<?= $row['kode_proyek'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="nama_proyek"></label>
                        <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" placeholder="Masukan nama proyek" value="<?= $row['nama_proyek'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="ordner"></label>
                        <input type="text" name="ordner" id="ordner" class="form-control" placeholder="Masukan ordner" value="<?= $row['ordner'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahsuratmasuk" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- hapus data surat masuk -->

<div class="modal fade" id="modelHapusSuratMasuk">
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