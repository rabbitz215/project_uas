<!-- lupa passwordCtrl -->
<?php
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $datein = date('Y-m-d');
    $quser = mysqli_query($koneksidb, "SELECT username FROM mst_userlogin WHERE username='$username'");
    $row = mysqli_fetch_array($quser);
    if ($username != $row['username']) {
        header("Location: index.php?page=lupapassword&pesan=gagal");
    } else {
        $qinsert = mysqli_query($koneksidb, "INSERT INTO tst_request (username, password_baru, date_request) 
				VALUES ('$username', '$password', '$datein')") or die(mysqli_error($koneksidb));
        header("Location: index.php?page=home");
    };
}
?>
<!-- form lupa password -->
<?php
if (!isset($_GET['action'])) {
?>
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-1 pt-4"></div>
            <div class="col-md-10 pt-4">
                <div class="subkategori p-3" id="">
                    <?php
                    if (@$_GET['pesan'] == 'gagal') {
                    ?>
                        <div class="alert alert-danger" role="alert">Proses gagal, Username tidak terdaftar silahkan daftar terlebih dahulu</div>
                    <?php
                    }
                    ?>
                    <h5 class="text-center pb-2"><b>Form Lupa Password</b></h5>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <form action="#" id="formlupapass" method="post">
                                <div class="row pb-1">
                                    <label for="username" class="col-md-3">Username</label>
                                    <div class="col-md-6">
                                        <input type="text" name="username" id="username" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="password" class="col-md-3">Password Baru</label>
                                    <div class="col-md-6">
                                        <input type="password" name="password" id="password" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="password" class="col-md-3">Konfirmasi Password Baru</label>
                                    <div class="col-md-6">
                                        <input type="password" name="konfirmpassword" id="konfirmpassword" class="form-control" /><span id="txtkonfirm"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <button type="button" name="konfirm" id="konfirm" class="btn btn-primary form-control" data-bs-toggle="modal">
                                            Request
                                        </button>
                                    </div>
                                </div>
                                <!-- form modal -->
                                <div class="modal fade" id="konfirmasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Form Lupa Password</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apa anda yakin ingin melanjutkan?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>