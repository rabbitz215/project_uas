<?php
include_once("komikCtrl.php");
function rupiah($angka)
{
    $hasil_rupiah = "Rp." . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
if (!isset($_GET['action'])) {
?>
    <div class="d-flex justify-content-between mb-3">
        <a href="?modul=mod_komik&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
        <div class="w-25">
            <form action="?modul=mod_komik" class="d-flex flex-row-reverse" method="POST">
                <input class="form-control me-2" type="text" placeholder="Cari disini (Judul/Kategori)" name="search">
                <input class="btn btn-outline-success me-3" type="submit" value="Search"></input>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Kode Komik</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Deskripsi Komik</th>
                <th>Cover</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        $list_komik = mysqli_query($koneksidb, "SELECT a.*,b.nm_kategori FROM mst_komik a INNER JOIN mst_kategori b ON a.id_kategori = b.id_kategori");
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $list_komik = mysqli_query($koneksidb, "SELECT a.*,b.nm_kategori FROM mst_komik a INNER JOIN mst_kategori b ON a.id_kategori = b.id_kategori WHERE a.judul LIKE '%$search%' || b.nm_kategori LIKE '%$search%'");
        }
        foreach ($list_komik as $lk) :
        ?>
            <tr>
                <td><?= $lk['kode_komik']; ?></td>
                <td><?= $lk['judul']; ?></td>
                <td><?= $lk['nm_kategori']; ?></td>
                <td><?= $lk['penerbit']; ?></td>
                <td><?= $lk['tahun_terbit']; ?></td>
                <td><?= rupiah($lk['harga']); ?></td>
                <td><?= $lk['stock']; ?></td>
                <td><?= $lk['desc_komik']; ?></td>
                <td><img src="../assets/img/<?= $lk['cover']; ?>" width="100" alt=""></td>
                <td>
                    <a href="?modul=mod_komik&action=edit&id=<?= $lk['kode_komik']; ?>" class="btn btn-xs btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a href="?modul=mod_komik&action=delete&id=<?= $lk['kode_komik']; ?>" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i> Delete</a>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
    <hr>
<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
?>
    <?php
    $query_cekkode = mysqli_query(
        $koneksidb,
        "select kode_komik from mst_komik ORDER BY kode_komik DESC LIMIT 0,1"
    );
    $cekkode = mysqli_fetch_array($query_cekkode);
    if (mysqli_num_rows($query_cekkode) == 0) {
        $kodeakhir = "MG-";
    } else {
        $kodeakhir = $cekkode['kode_komik'];
    }
    // echo $kodeakhir . "<br>";
    $no_urutakhir = substr($kodeakhir, 7);
    // echo $no_urutakhir . "<br>";
    $th_akhir = substr($kodeakhir, 3, 4);
    $th_sekarang = date("Y");
    // echo $th_akhir . " : " . $th_sekarang . "<br>";
    if ($th_akhir == $th_sekarang) {
        //$nourut_baru = $no_urutakhir + 1;

        if ($no_urutakhir < 9) {
            $nourut_baru = "00" . ($no_urutakhir + 1);
        } else if ($no_urutakhir < 99) {
            $nourut_baru = "0" . ($no_urutakhir + 1);
        } else {
            $nourut_baru = ($no_urutakhir + 1);
        }
        // echo "kodenya:" . $nourut_baru . "<br>";
    } else {
        $nourut_baru =  "001";
    }
    $kodeterbaru = "MG-" . $th_sekarang . $nourut_baru;
    // echo "kode: " . $kodeterbaru;
    $data_kategori = mysqli_query($koneksidb, "select * from mst_kategori");
    ?>
    <?php
    if ($proses == "insert") {
    ?>
        <form action="?modul=mod_komik&action=save" id="formkomik" method="POST" enctype="multipart/form-data">
            <div class="row">
                <label class="col-md-2">Kode Komik</label>
                <div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="text" name="kode" id="kode" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Judul Komik/Manga</label>
                <div class="col-md-5">
                    <input type="text" name="judul" id="judul" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Deskripsi Komik/Manga</label>
                <div class="col-md-5">
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Penerbit</label>
                <div class="col-md-5">
                    <input type="text" name="penerbit" id="penerbit" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Tahun Penerbit</label>
                <div class="col-md-5">
                    <input type="number" name="tahunterbit" id="tahunterbit" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Stock</label>
                <div class="col-md-5">
                    <input type="text" name="stock" id="stock" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Harga</label>
                <div class="col-md-5">
                    <input type="text" name="harga" id="harga" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Kategori</label>
                <div class="col-md-5">
                    <select name="kategori" id="kategori" class="form-select" required>
                        <option value="" selected disabled>--Pilih Kategori--</option>
                        <?php
                        foreach ($data_kategori as $k) :
                        ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nm_kategori']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Cover</label>
                <div class="col-md-5">
                    <input type="file" id="cover" name="cover" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2"></label>
                <div class="col-md-5">
                    <button type="button" id="btnsubmit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_komik"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <form action="?modul=mod_komik&action=save" id="formkomik" method="POST" enctype="multipart/form-data">
            <?php
            // $qry = mysqli_query($koneksidb, "select * from tst_penjualan where no_invoice='$kode' LIMIT 0,1");
            $qry = mysqli_query($koneksidb, "SELECT a.*, b.* FROM mst_komik a INNER JOIN mst_kategori b ON a.id_kategori = b.id_kategori WHERE kode_komik ='$kode'");
            $dt = mysqli_fetch_array($qry);
            ?>
            <div class="row pt-3">
                <label class="col-md-2">Kode Komik</label>
                <div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input class="form-control" type="text" id="kodekomik" name="kodekomik" value="<?= $dt['kode_komik']; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Judul</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="judul" name="judul" value="<?= $dt['judul']; ?>">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Judul</label>
                <div class="col-md-5">
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"><?= $dt['desc_komik']; ?></textarea>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Penerbit</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="penerbit" name="penerbit" value="<?= $dt['penerbit']; ?>">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Tahun Terbit</label>
                <div class="col-md-5">
                    <input class="form-control" type="number" id="tahunterbit" name="tahunterbit" value="<?= $dt['tahun_terbit']; ?>">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Stock</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="stock" name="stock" value="<?= $dt['stock']; ?>">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Harga</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="harga" name="harga" value="<?= $dt['harga']; ?>">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Kategori</label>
                <div class="col-md-5">
                    <select name="kategori" id="kategori" class="form-select" required>
                        <option value="" disabled>--Pilih Kategori--</option>
                        <?php

                        foreach ($data_kategori as $k) :
                        ?>
                            <option value="<?= $k['id_kategori']; ?> <?php ($k['id_kategori'] == $dt['id_kategori']) ? "selected" : "" ?>"><?= $k['nm_kategori']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Cover</label>
                <div class="col-md-5">
                    <input type="hidden" name="gambarlama" value="<?= $dt['cover']; ?>">
                    <?php
                    if ($dt['cover'] == "") {
                    ?>
                        <input type="file" id="cover" name="cover" class="form-control">
                    <?php
                    } else {
                    ?>
                        <img src="../assets/img/<?= $dt['cover']; ?>" class="img img-thumbnail mb-3" width="150px" alt="">
                        <input type="file" id="cover" name="cover" class="form-control">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2"></label>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_komik"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
        </form>
    <?php } ?>
    <div class="modal" tabindex="-1" id="modalsubmit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btntidak" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" id="btnya" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>