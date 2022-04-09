<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>


<section class="section">
    <div class="section-header">
        <h1><?php
            $idBidang = session()->get('id_bidang');
            foreach ($getNamaBidang as $gnb) {
                if ($idBidang == $gnb['id_bidang']) { ?>
                    <h4>Selamat datang <?= session()->get('username'); ?> bidang <?= $gnb['nama_bidang']  ?> </h4>
            <?php }
            } ?>
        </h1>
    </div>


</section>

<div class="card mt-5">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Surat</th>
                        <th>Kepada</th>
                        <th>Perihal</th>
                        <th>Kode Proyek</th>
                        <th>Nama Proyek</th>
                        <th>Ordner</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($suratByBidang as $surat) : ?>
                        <tr>
                            <td><?= $index; ?></td>
                            <td><?= $surat['tgl_suratmasuk']; ?></td>
                            <td><?= $surat['kepada']; ?></td>
                            <td><?= $surat['perihal']; ?></td>
                            <td><?= $surat['kode_proyek']; ?></td>
                            <td><?= $surat['nama_proyek']; ?></td>
                            <td><?= $surat['ordner']; ?></td>
                            <td>
                                <?php foreach ($disposisi as $dispos) :
                                    if ($surat['id_disposisi'] === $dispos['id_disposisi']) : ?>
                                        <?= $dispos['disposisi']; ?>
                                <?php endif;
                                endforeach; ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-success">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?= $this->endSection(); ?>