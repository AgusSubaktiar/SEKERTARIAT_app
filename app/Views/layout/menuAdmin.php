<li class="menu-header">Dashboard</li>
<li><a href="<?= base_url('HomeAdmin'); ?>"><i class=" fas fa-fire"></i><span>Dashboard</span></a></li>
<li class="menu-header">Surat</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-envelope"></i> <span>Surat</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url('SuratMasuk'); ?>">Surat Masuk</a></li>
        <li><a class="nav-link" href="<?= base_url('SuratKeluar'); ?>">Surat Keluar</a></li>
    </ul>
</li>

<li class="menu-header">Memo</li>
<li>
    <a href="<?= base_url('Memo'); ?>"><i class="fas fa-file-alt"></i> <span>Memo</span></a>
</li>

<li class="menu-header">Email</li>
<li class="nav-item dropdown">
    <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i> <span>Email</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url('EmailMs'); ?>">Email Masuk</a></li>
        <li><a class="nav-link" href="<?= base_url('EmailK'); ?>">Email Keluar</a></li>
    </ul>
</li>

<li class="menu-header">Formulir - formulir</li>
<li>
    <a href="<?= base_url('Formulir'); ?>"><i class="fas fa-clipboard"></i> <span>Formulir - formulir</span></a>
</li>

<li class="menu-header">Tambah User</li>
<li>
    <a href="<?= base_url('User'); ?>"><i class="fas fa-user-alt"></i> <span>Tambah User</span></a>
</li>