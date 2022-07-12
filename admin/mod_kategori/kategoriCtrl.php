<?php
security_login();

if (!isset($_GET['action'])) {
    $data_kategori = mysqli_query($koneksidb, "select * from mst_kategori");
} else if (isset($_GET['action']) && $_GET['action'] == "add") {
    $proses = "insert";
} else if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $idq = $_GET['id'];
    $qry = mysqli_query($koneksidb, "select * from mst_kategori where id_kategori='$idq'");
    $dt = mysqli_fetch_array($qry);
    $id = $dt['id_kategori'];
    $nmkategori = $dt['nm_kategori'];
    $proses = "update";
} else if (isset($_GET['action']) && $_GET['action'] == "save") {
    $proses = $_POST['proses'];
    if ($proses == "insert") {
        $nmkategori = $_POST['nm_kategori'];
        mysqli_query($koneksidb, "insert into mst_kategori(nm_kategori)values('$nmkategori')") or die(mysqli_error($koneksidb));
        echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_kategori">';
    } else if ($proses == "update") {
        $id = $_POST['idkategori'];
        $nm_kategori = $_POST['nm_kategori'];
        mysqli_query($koneksidb, "UPDATE mst_kategori SET nm_kategori='$nm_kategori' WHERE id_kategori = $id ") or die(mysqli_error($koneksidb));
        echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_kategori">';
    }
} else if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $id = $_GET['id'];
    mysqli_query($koneksidb, "DELETE FROM mst_kategori WHERE id_kategori=$id");
    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_kategori">';
}
