<?php
include_once("menuCtrl.php");
if (!isset($_GET['action'])) {
?>
    <a href="?modul=mod_menu&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Kode Menu</th>
                <th>Nama menu</th>
                <th>Kategori menu</th>
                <th>Link</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        $query = mysqli_query($koneksidb, "SELECT * FROM mst_menu");
        foreach ($query as $q) :
        ?>
            <tr>
                <td><?= $q['kode_menu']; ?></td>
                <td><?= $q['nmmenu']; ?></td>
                <td><?= $q['kategori_menu']; ?></td>
                <td><?= $q['link']; ?></td>
                <td><a href="?modul=mod_menu&action=edit&id=<?= $q['idmenu']; ?>" class="btn btn-xs btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a href="?modul=mod_menu&action=delete&id=<?= $q['idmenu']; ?>" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i> Delete</a>
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
        "select kode_menu from mst_menu ORDER BY kode_menu DESC LIMIT 0,1"
    );
    $cekkode = mysqli_fetch_array($query_cekkode);
    $kodeakhir = $cekkode['kode_menu'];
    // echo $kodeakhir . "<br>";
    $no_urutakhir = substr($kodeakhir, 5);
    // echo $no_urutakhir . "<br>";
    $th_akhir = substr($kodeakhir, 1, 4);
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
    $kodeterbaru = "M" . $th_sekarang . $nourut_baru;
    // echo "kode: " . $kodeterbaru;
    if ($proses == "insert") {
    ?>
        <form action="?modul=mod_menu&action=save" id="formmenu" method="POST">
            <div class="row pt-3">
                <label class="col-md-2">Kode Menu</label>
                <div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="text" name="kode_menu" id="kode_menu" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Nama Menu</label>
                <div class="col-md-5">
                    <input type="text" name="nmmenu" id="nmmenu" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Kategori Menu</label>
                <div class="col-md-5">
                    <select name="kategorimenu" id="kategorimenu" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="komik">Komik</option>
                        <option value="penjualan">Penjualan</option>
                    </select>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Link</label>
                <div class="col-md-5">
                    <input type="text" name="link" id="link" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2"></label>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_menu"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
        </form>
    <?php
    } else {
    ?>
        <form action="?modul=mod_menu&action=save" method="POST">
            <?php
            $qry = mysqli_query($koneksidb, "select * from mst_menu where idmenu='$id' LIMIT 0,1");
            $dt = mysqli_fetch_array($qry);
            ?>
            <div class="row pt-3">
                <label class="col-md-2">Nama Menu</label>
                <div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="hidden" name="idmenu" value="<?= $dt['idmenu']; ?>">
                    <input type="text" class="form-control" name="nmmenu" value="<?= $dt['nmmenu']; ?>">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Kategori Menu</label>
                <div class="col-md-5">
                    <select name="kategorimenu" id="kategorimenu" value="" class="form-select">
                        <option value="admin" <?= ($dt['kategori_menu'] == "admin") ? "selected" : ""; ?>>Admin</option>
                        <option value="komik" <?= ($dt['kategori_menu'] == "komik") ? "selected" : ""; ?>>Komik</option>
                        <option value="penjualan" <?= ($dt['kategori_menu'] == "penjualan") ? "selected" : ""; ?>>Penjualan</option>
                    </select>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Link</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="link" value="<?= $dt['link']; ?>">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2"></label>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_menu"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
        </form>
    <?php
    }
    ?>
<?php
}
?>