<?= $this->extend('layout/defaultAdmin'); ?>
<?= $this->section('content'); ?>
<!-- <button class="btn btn-info" data-toggle="modal" data-target="#tambahUser">Tambah User</button> -->
<!-- <a class="btn btn-success" href="/User">Lihat User</a> -->

<div class="card mt-5">
    <div class="card-body">
        <table class="table table-responsive-lg">
            <thead>
                <tr>

                    <th>No</th>
                    <th>Nama File</th>
                    <th>Tanggal Upload</th>
                    <th>Data Bidang</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 1;
                foreach ($fileModel as $file) : ?>
                    <tr>
                        <?php if ($file['status'] == 1) { ?>
                            <td><?= $index++; ?></td>
                            <td><?= $file['nama_file'] ?></td>
                            <td><?= $file['tanggal_upload'] ?></td>
                            <td><?php foreach ($getBidangData as $gbdtd) {
                                    if ($gbdtd['id_isi_bidang'] == $file['data_bidang_id']) {
                                ?>
                                        <?= $gbdtd['nama_isi_bidang'] ?>
                                <?php }
                                } ?></td>
                            <td>
                                <?php if ($file['status'] == 1) { ?>
                                    <!-- <p class="text-info">Menunggu Persetujuan</p> -->
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#revisiModal<?= $file['id'] ?>">Revisi</button>
                                    <button class="btn btn-sm btn-success" data-target="#disetujuiModal<?= $file['id'] ?>">Disetujui</button>
                                <?php } ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="/Home/download/<?= $file['nama_file'] ?>">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                        <?php } ?>
                    </tr>

                    <form action=" HomeAdmin/editFileAdmin/<?= $file['id'] ?>" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="revisiModal<?= $file['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Bidang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Tuliskan kekuranga yang perlu di revisi.</h5>
                                        <input type="hidden" value="2" name="revisi">
                                        <input type="text" class="form-control" name="review">

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="product_id" class="productID">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="HomeAdmin/editFileAdmin/<?= $file['id'] ?>" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="disetujuiModal<?= $file['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Bidang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Apakah yakin data sudah benar?</h4>
                                        <input type="hidden" value="3" name="disetujui">

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="product_id" class="productID">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- <h4>Daftar Bidang Dan Data Bidang </h4>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                <?php $no = 1;
                foreach ($getNamaBidang as $showdat) { ?>
                    <th><?= $showdat['nama_bidang'] ?></th>
                <?php $no++;
                } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getBidangData as $sgbd) { ?>
                 <tr>
                    <?php foreach ($getNamaBidang as $vgnb) { ?>
                    <td>
                        <?php if ($sgbd['id_bidang'] == $vgnb['id_bidang']) { ?>
                            <?= $sgbd['nama_isi_bidang'] ?>
                        <?php } ?>
                    </td>
                    <?php } ?>
                 </tr>
                <?php } ?>
            </tbody>
        </table>
    </div> -->
<?= $this->endSection(); ?>