<?php
include_once "memberCtrl.php";
if (!isset($_GET['action'])) {
?>
    <?php
    $query_cekkode = mysqli_query(
        $koneksidb,
        "SELECT kode_member from daftarmember ORDER BY kode_member DESC LIMIT 0,1"
    );
    $cekkode = mysqli_fetch_array($query_cekkode);
    if (mysqli_num_rows($query_cekkode) < 9) {
        $kodeakhir = $cekkode['kode_member'];
        $no_urutakhir = substr($kodeakhir, 6);
        $th_akhir = substr($kodeakhir, 2, 4);
        $th_sekarang = date("Y");

        if ($th_akhir == $th_sekarang) {
            if ($no_urutakhir == 0 || $no_urutakhir < 9) {
                $nourut_baru = "00" . ($no_urutakhir + 1);
            } else if ($no_urutakhir > 9) {
                $nourut_baru = "0" . ($no_urutakhir + 1);
            } else if ($no_urutakhir < 100) {
                $nourut_baru = "0" . ($no_urutakhir + 1);
            } else {
                $nourut_baru = ($no_urutakhir + 1);
            }
            // echo "kodenya:" . $nourut_baru . "<br>";
        } else {
            $nourut_baru =  "001";
        }
        $kodeterbaru = "MB" . $th_sekarang . $nourut_baru;
        // echo $no_urutakhir;
        // echo "kode: ".$kodeterbaru;
        //untuk contoh combo
        // $data_produk = mysqli_query($koneksidb,"select * from mst_produk ");
    }
    ?>
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-1 pt-4"></div>
            <div class="col-md-10 pt-4">
                <div class="subkategori p-3">
                    <h5 class="text-center pb-2"><b> DAFTAR MEMBER</b></h5>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <form action="#" id="formdaftar" method="POST" enctype="multipart/form-data">
                                <div class="row pb-1">
                                    <label for="kdmember" class="col-md-3">Kode member</label>
                                    <div class="col-md-6">
                                        <!-- <input type="text" name="proses" value="<?= $proses; ?>"> -->
                                        <input type="text" name="kdmember" id="kdmember" class="form-control" value="<?= $kodeterbaru; ?>" readonly />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="txtnama" class="col-md-3">Nama</label>
                                    <div class="col-md-6">
                                        <input type="text" name="txtnama" id="txtnama" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="txtemail" class="col-md-3">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" name="txtemail" id="txtemail" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="txtpass" class="col-md-3">Password</label>
                                    <div class="col-md-6">
                                        <input type="Password" name="txtpass" id="txtpass" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="txtemail" class="col-md-3">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="Password" name="txtpasscon" id="txtpasscon" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="tgllhr" class="col-md-3">Tanggal lahir</label>
                                    <div class="col-md-6">
                                        <input type="date" name="tgllhr" id="tgllhr" class="form-control" />
                                        <input type="hidden" name="tgldaftar" id="tgldaftar" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="notelp" class="col-md-3">No Telepon</label>
                                    <div class="col-md-6">
                                        <input type="text" name="notelp" id="notelp" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="tgllhr" class="col-md-3">Alamat</label>
                                    <div class="col-md-6">
                                        <input type="text" name="alamat" id="alamat" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="tgllhr" class="col-md-3">Jenis Kelamin</label>
                                    <div class="col-md-6">
                                        <select name="jk" id="jk" class=" text-center form-select">
                                            <option selected disabled>--- Jenis Kelamin ---</option>
                                            <option value="L">Laki Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <label for="foto" class="col-md-3">Foto</label>
                                    <div class="col-md-6">
                                        <input type="file" name="foto" id="foto" class="form-control" />
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-warning btn-sm form-control mt-2" name="btndaftar" id="btndaftar">Daftar</button>
                                    </div>
                                </div>
                                <div class="modal fade" id="konfirmasi" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" name="btnbatal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" id="btnsimpan" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- modal simpan -->

                <!-- ketika tampil hasil -->
                <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
                <!-- <script src="assets/js/galang.js"></script> -->