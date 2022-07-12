<?php
$servername = "localhost"; //127.0.0.1
$database = "db_uas";
$user_db = "root";
$pass_db = "";

$koneksidb = mysqli_connect($servername, $user_db, $pass_db, $database);
if (!$koneksidb) {
    echo "<h3>koneksi gagal!! </h3>";
    exit;
}
//set database
mysqli_select_db($koneksidb, $database);
