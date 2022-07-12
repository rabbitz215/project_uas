<?php
security_login();

if (!isset($_GET['action'])) {
    $data_menu = mysqli_query($koneksidb, "select * from mst_menu ");
} else if (isset($_GET['action']) && $_GET['action'] == "add") {
    $nmmenu = "";
    $proses = "insert";
    $idmenu = 0;
} else if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $idq = $_GET['id'];
    $qry = mysqli_query($koneksidb, "select * from mst_menu where idmenu='$idq'");
    $dt = mysqli_fetch_array($qry);
    $id = $dt['idmenu'];
    $nmmenu = $dt['nmmenu'];
    $link = $dt['link'];
    $icon = $dt['icon'];
    $proses = "update";
} else if (isset($_GET['action']) && $_GET['action'] == "save") {
    $proses = $_POST['proses'];
    if ($proses == "insert") {
        $kode = $_POST['kode_menu'];
        $nmmenu = $_POST['nmmenu'];
        $link = $_POST['link'];
        $kategori = $_POST['kategorimenu'];
        $icon = $_POST['icon'];
        mysqli_query($koneksidb, "insert into mst_menu(kode_menu,nmmenu,kategori_menu,link,icon)values('$kode','$nmmenu','$kategori','$link','$icon')") or die(mysqli_error($koneksidb));
        echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_menu">';
    } else if ($proses == "update") {
        $id = $_POST['idmenu'];
        $nmmenu = $_POST['nmmenu'];
        $link = $_POST['link'];
        $kategori = $_POST['kategorimenu'];
        $icon = $_POST['icon'];
        mysqli_query($koneksidb, "update mst_menu set nmmenu='$nmmenu',kategori_menu='$kategori' ,link='$link', icon='$icon' where idmenu = $id ") or die(mysqli_error($koneksidb));
        echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_menu">';
    }
} else if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $id = $_GET['id'];
    mysqli_query($koneksidb, "DELETE FROM mst_menu WHERE idmenu=$id");
    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_menu">';
}
