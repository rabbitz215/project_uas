<?php
include_once("kategoriCtrl.php");
if (!isset($_GET['action'])) {
?>
    <a href="?modul=mod_kategori&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Id Kategori</th>
                <th>Nama Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        $query = mysqli_query($koneksidb, "SELECT * FROM mst_kategori");
        foreach ($query as $q) :
        ?>
            <tr>
                <td><?= $q['id_kategori']; ?></td>
                <td><?= $q['nm_kategori']; ?></td>
                <td><a href="?modul=mod_kategori&action=edit&id=<?= $q['id_kategori']; ?>" class="btn btn-xs btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a href="?modul=mod_kategori&action=delete&id=<?= $q['id_kategori']; ?>" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i> Delete</a>
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
    if ($proses == "insert") {
    ?>
        <form action="?modul=mod_kategori&action=save" id="formkategori" method="POST">
            <div class="row pt-3">
                <label class="col-md-2">Nama Kategori</label>
                <div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="text" name="nm_kategori" id="nmkategori" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2"></label>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_kategori"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
        </form>
    <?php
    } else {
    ?>
        <form action="?modul=mod_kategori&action=save" method="POST">
            <?php
            $qry = mysqli_query($koneksidb, "select * from mst_kategori where id_kategori='$id' LIMIT 0,1");
            $dt = mysqli_fetch_array($qry);
            ?>
            <div class="row pt-3">
                <label class="col-md-2">Nama Kategori</label>
                <div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="hidden" name="idkategori" value="<?= $dt['id_kategori']; ?>">
                    <input type="text" class="form-control" name="nm_kategori" value="<?= $dt['nm_kategori']; ?>">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2"></label>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_kategori"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
        </form>
    <?php
    }
    ?>
<?php
}
?>