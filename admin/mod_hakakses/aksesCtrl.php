<?php
security_login();
if (isset($_GET['act']) && ($_GET['act'] == 'add')) {
    $judul = "Form Hak Akses";
}
if (isset($_GET['act']) && ($_GET['act'] == 'edit')) {
    $judul = "Ubah Form Hak Akses";
    $qakses = mysqli_query($koneksidb, "SELECT * FROM hakakses_menu WHERE iduser='" . $_GET['iduser'] . "' ");
    $data = mysqli_fetch_array($qakses);
    $username = @$data['iduser'];
} else if (isset($_POST['submit'])) {
    $txtuser = $_POST['iduser'];
    $txtmenu = $_POST['idmenu'];
    $pilihan = count($txtmenu);
    $delete = mysqli_query($koneksidb, "DELETE FROM hakakses_menu WHERE iduser='$txtuser'");
    if ($delete) {
        for ($i = 0; $i < $pilihan; $i++) {
            $qinsert = mysqli_query($koneksidb, "INSERT INTO hakakses_menu VALUES ('', '$txtmenu[$i]','$txtuser')");
            echo "gagal";
        }
    }
    header("Location: home.php?modul=mod_hakakses&tampil");
    // $tampil = 1;
}
