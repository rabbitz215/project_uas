<?php
require_once "config/config.php";
require_once "config/koneksidb.php";

if (isset($_POST['submit'])) {
    $cekemail = mysqli_query($koneksidb, "SELECT email FROM daftarmember WHERE email='" . $_POST['txtemail'] . "'");
    if (mysqli_num_rows($cekemail) > 0) {
        pesan("email sudah terdaftar");
    } else {
        $kodemember = $_POST['kdmember'];
        $nmmember = $_POST['txtnama'];
        $email = $_POST['txtemail'];
        $pass = md5($_POST['txtpass']);
        $tgllhr = $_POST['tgllhr'];
        $notelp = $_POST['notelp'];
        $alamat = $_POST['alamat'];
        $jk = $_POST['jk'];
        $tgldaftar = date("Y/m/d H:i:s");
        // upload 
        $file = $_FILES['foto'];
        $target_dir = "assets/img/";
        $target_file =  $target_dir . basename($file['name']);
        $type_file = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $is_upload = 1;
        if ($file['size'] > 2000000) {
            $is_upload = 0;
            pesan("File lebih dari 2MB!!");
        }
        /**cek tipe file */
        if ($type_file != "jpg") {
            $is_upload = 0;
            pesan("hanya tipe file jpg yang diperbolehkan!!");
        }

        $namafile = "";
        /**proses upload */
        if ($is_upload == 1) {
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                $namafile = $file['name'];
                mysqli_query($koneksidb, "INSERT into daftarmember (kode_member,nm_member,email,password,tgl_daftar,tgl_lhr,no_telp,alamat,jk,foto) VALUES ('$kodemember','$nmmember','$email','$pass','$tgldaftar','$tgllhr','$notelp','$alamat','$jk','$namafile')") or die(mysqli_error($koneksidb));
                header("Location: index.php?page=daftarmember");
            } else if ($is_upload == 0) {
                pesan("GAGAL upload file gambar!!");
            }
        }
    }
}
function pesan($alert)
{
    echo '<script language="javascript">';
    echo 'alert("' . $alert . '")';  //not showing an alert box.
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0; url=http:index.php?page=daftarmember">';
}
