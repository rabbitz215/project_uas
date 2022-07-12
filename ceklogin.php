<?php
require_once("config/koneksidb.php");
require_once("config/config.php");

if (isset($_POST['btnlogin'])) {
    $txt_user = $_POST['username']; //sesuai name di form
    $txt_pass = md5($_POST['password']); //sesuai name di form
    $result = mysqli_query($koneksidb, "SELECT * FROM mst_userlogin where 
				username = '" . $txt_user . "' AND password = '" . $txt_pass . "' AND is_active=1");
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
        session_start();
        $_SESSION['userlogin'] = $txt_user;
        $_SESSION['namauser_log'] = $data['nama_lengkap'];
        $_SESSION['id_user'] = $data['iduser'];
        header("Location: " . MAIN_URL . "/admin/home.php");
    } else {
        header("Location: " . MAIN_URL . "");
    }
}
