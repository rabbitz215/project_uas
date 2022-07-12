<?php
security_login();

if (!isset($_GET['action'])) {
    // $data_menu = mysqli_query($koneksidb, "select * from mst_menu ");
    //untuk contoh combo
    $data_produk = mysqli_query($koneksidb, "select * from mst_komik");
} else if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $id = $_GET['id'];
    $cekcover = mysqli_query($koneksidb, "SELECT cover FROM mst_komik WHERE kode_komik='$id'");
    $cc = mysqli_fetch_array($cekcover);
    $gambar = $cc['cover'];
    if ($gambar == "default.jpg") {
        $querydelete = mysqli_query($koneksidb, "DELETE FROM mst_komik WHERE kode_komik='$id'");
        header('Location: home.php?modul=mod_komik');
    } else {
        $querydelete = mysqli_query($koneksidb, "DELETE FROM mst_komik WHERE kode_komik='$id'");
        unlink("../assets/img/$gambar");
        header('Location: home.php?modul=mod_komik');
    }
} else if (isset($_GET['action']) && $_GET['action'] == "add") {
    $proses = "insert";
} else if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $kode = $_GET['id'];
    $qry = mysqli_query($koneksidb, "select * from mst_komik where kode_komik='$kode' LIMIT 0,1");
    $dt = mysqli_fetch_array($qry);
    $id = $dt['kode_komik'];
    $proses = "update";
} else if (isset($_GET['action']) && $_GET['action'] == "save") {
    $proses = $_POST['proses'];
    if ($proses == "insert") {
        $kode_komik = $_POST['kode'];
        $judul = $_POST['judul'];
        $stock = $_POST['stock'];
        $harga = $_POST['harga'];
        $penerbit = $_POST['penerbit'];
        $tahunterbit = $_POST['tahunterbit'];
        $kategori = $_POST['kategori'];
        if ($_FILES['cover']['name'] == "") {
            mysqli_query($koneksidb, "insert into mst_komik (kode_komik,judul,penerbit,tahun_terbit,id_kategori,harga,stock,cover) VALUES ('$kode_komik','$judul','$penerbit','$tahunterbit','$kategori','$harga','$stock','default.jpg')") or die(mysqli_error($koneksidb));
            header("Location: home.php?modul=mod_komik");
        } else {
            $file = $_FILES['cover'];
            $target_dir = "../assets/img/";
            $target_file =  $target_dir . basename($file['name']);
            $type_file = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            // echo $type_file."<br/>";
            $is_upload = 1;
            /* cek batas limit file maks.3MB*/
            if ($file['size'] > 3000000) {
                $is_upload = 0;
                pesan("File lebih dari 3MB!!");
            }
            /**cek tipe file */
            if ($type_file != "jpg" && $type_file != "png") {
                $is_upload = 0;
                pesan("hanya tipe file jpg/png yang diperbolehkan!!");
            }

            $namafile = "";
            /**proses upload */
            if ($is_upload == 1) {
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    $namafile = $file['name'];
                    mysqli_query($koneksidb, "insert into mst_komik (kode_komik,judul,penerbit,tahun_terbit,id_kategori,harga,stock,cover) VALUES ('$kode_komik','$judul','$penerbit','$tahunterbit','$kategori','$harga','$stock','$namafile')") or die(mysqli_error($koneksidb));
                    header("Location: home.php?modul=mod_komik");
                } else if ($is_upload == 0) {
                    pesan("GAGAL upload file gambar!!");
                }
            }
        }
    } else if ($proses == "update") {
        if ($_FILES['cover']['name'] == "") {
            $id = $_POST['kodekomik'];
            $judul = $_POST['judul'];
            $stock = $_POST['stock'];
            $harga = $_POST['harga'];
            $penerbit = $_POST['penerbit'];
            $tahunterbit = $_POST['tahunterbit'];
            $kategori = $_POST['kategori'];
            $namafile = $_POST['gambarlama'];
            mysqli_query($koneksidb, "UPDATE mst_komik SET judul='$judul',penerbit='$penerbit',tahun_terbit='$tahunterbit',id_kategori='$kategori',harga='$harga',stock='$stock',cover='$namafile' WHERE kode_komik = '$id' ") or die(mysqli_error($koneksidb));
            header("Location: home.php?modul=mod_komik");
        } else {
            $file = $_FILES['cover'];
            $target_dir = "../assets/img/";
            $target_file =  $target_dir . basename($file['name']);
            $type_file = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            // echo $type_file . "<br/>";
            $is_upload = 1;
            /* cek batas limit file maks.3MB*/
            if ($file['size'] > 3000000) {
                $is_upload = 0;
                pesan("File lebih dari 3MB!!");
            }
            /**cek tipe file */
            if ($type_file != "jpg" && $type_file != "png") {
                $is_upload = 0;
                pesan("hanya tipe file jpg/png yang diperbolehkan!!");
            }
            $namafile = "";
            /**proses upload */
            if ($is_upload == 1) {
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    $namafile = $file['name'];
                    $id = $_POST['kodekomik'];
                    $judul = $_POST['judul'];
                    $stock = $_POST['stock'];
                    $harga = $_POST['harga'];
                    $penerbit = $_POST['penerbit'];
                    $tahunterbit = $_POST['tahunterbit'];
                    $kategori = $_POST['kategori'];
                    if ($namafile == $_POST['gambarlama']) {
                        $edit = mysqli_query($koneksidb, "UPDATE mst_komik SET judul='$judul',penerbit='$penerbit',tahun_terbit='$tahunterbit',id_kategori='$kategori',harga='$harga',stock='$stock',cover='$namafile' WHERE kode_komik = '$id' ") or die(mysqli_error($koneksidb));
                    } else if ($_POST['gambarlama'] == "default.jpg" && !empty($namafile)) {
                        $edit = mysqli_query($koneksidb, "UPDATE mst_komik SET judul='$judul',penerbit='$penerbit',tahun_terbit='$tahunterbit',id_kategori='$kategori',harga='$harga',stock='$stock',cover='$namafile' WHERE kode_komik = '$id' ") or die(mysqli_error($koneksidb));
                    } else {
                        $old = $_POST['gambarlama'];
                        $edit = mysqli_query($koneksidb, "UPDATE mst_komik SET judul='$judul',penerbit='$penerbit',tahun_terbit='$tahunterbit',id_kategori='$kategori',harga='$harga',stock='$stock',cover='$namafile' WHERE kode_komik = '$id' ") or die(mysqli_error($koneksidb));
                        unlink("../assets/img/$old");
                    }
                    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_komik">';
                } else {
                    pesan("GAGAL upload file gambar!!");
                }
            }
        }
    }
}

function pesan($alert)
{
    echo '<script language="javascript">';
    echo 'alert("' . $alert . '")';  //not showing an alert box.
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0; url=http://localhost/project_uas/admin/home.php?modul=mod_komik">';
}
