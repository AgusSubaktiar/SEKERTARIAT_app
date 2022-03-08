<?= $this->extend('layout/defaultAdmin'); ?>
<?= $this->section('content'); ?>
<div>
    <div class="section-header">
    </div>
    <div class="card-header bg-white text-dark">
        <h4 class="card-title">Data User</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nama Bidang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $i = 1;
                    foreach ($getUserData as $getUD) { ?>
                        <tr>
                            <td>
                                <?= $i; ?>
                            </td>
                            <td>
                                <?= $getUD['username'] ?>
                            </td>

                            <td>
                                <?php foreach ($getNamaBidang as $getNB) { ?>
                                    <?php if ($getUD['id_bidang'] == $getNB['id_bidang']) { ?>
                                        <?= $getNB['nama_bidang'] ?>
                                <?php }
                                } ?>
                            </td>
                            <td>
                                <button class="btn btn-info" data-toggle="modal" data-target="#editUser<?= $getUD['id_user'] ?>"> <i class="fas fa-pen"></i></button>
                                <button data-toggle="modal" class="btn btn-danger" data-target="#deleteUser<?= $getUD['id_user'] ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <form action="/User/deleteUser/<?= $getUD['id_user'] ?>" method="post">
                            <div class="modal fade" id="deleteUser<?= $getUD['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Bidang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Anda Yakin Ingin Menghapus Bidang Ini?</h4>

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
        </div>
        <!-- Edit User -->
        <form action="/User/editUser/<?= $getUD['id_user'] ?>" method="post">
            <div class="modal fade" id="editUser<?= $getUD['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="userEditUsername" value="<?= $getUD['username'] ?>">
                            </div>
                            <div class="form-group">
                                <label for=""> Bagian Bidang</label>
                                <select id="datbidBagianBidang" name="userEditIdBidang" class="form-control shwo-tick">
                                    <?php foreach ($getNamaBidang as $gnb) {
                                        if ($gnb['id_bidang'] == $getUD['id_bidang']) {
                                            # code...
                                    ?>
                                            <option value="<?= $gnb['id_bidang'] ?>" selected><?= $gnb['nama_bidang'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $gnb['id_bidang'] ?>"><?= $gnb['nama_bidang'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="userEditPassword" id="password" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php $i++;
                    } ?>
    </tbody>
    </table>
    <button class="btn btn-danger" data-toggle="modal" data-target="#tambahuser">Tambah User</button>
    <button class="btn btn-danger" data-toggle="modal" data-target="#tambahUserAdmin">Tambah User Admin</button>
    </div>
</div>
</div>

<!-- Tambah User Admin -->
<form action="/HomeAdmin/addUserAdmin" method="post">
    <div class="modal fade" id="tambahUserAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Bidang</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control " name="usernameAdmin" placeholder="Username">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="fomr-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control " name="passwordAdmin" placeholder="Product Name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End User Admin -->


<!-- tambah user -->
<div>
    <form action="/HomeAdmin/addUser/" method="post">
        <div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>

                        <label for="">Bagian Bidang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select id="t_user" name="t_user" class="form-control shwo-tick">
                                    <?php foreach ($getNamaBidang as $gnb) {
                                    ?>
                                        <option value="<?= $gnb['id_bidang'] ?>"><?= $gnb['nama_bidang'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="product_id" class="productID">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

</div>
<?= $this->endSection(); ?>