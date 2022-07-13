<?php
if (!isset($_GET['act'])) {
?>
    <div class="container">
        <?php
        if (@$_GET['pesan'] == "berhasil") {
        ?>
            <div class="alert alert-success" role="alert">Proses ganti password berhasil</div>
        <?php
        } else if (@$_GET['pesan'] == "ditolak") {
        ?>
            <div class="alert alert-warning" role="alert">Proses request ganti password ditolak</div>
        <?php
        }
        ?>
        <h3 class="text-center"> Daftar Request Password User </h3>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th> Tanggal Request </th>
                    <th> Username </th>
                    <th> Password Baru </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php
                $qry_listrequest = mysqli_query($koneksidb, "SELECT * FROM tst_request order by id_request DESC") or die("gagal akses tabel mst_blog" . mysqli_error($koneksidb));
                while ($row = mysqli_fetch_array($qry_listrequest)) {
                ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($row['date_request'])); ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['password_baru']; ?></td>
                        <td>
                            <div class="d-grid gap-1 d-md-block">
                                <a href="?modul=mod_lupapass&act=accept&id=<?= $row['id_request']; ?>" class="btn btn-xs btn-success text-white"> <i class="bi bi-pencil-square"> </i> Accept </a>
                                <a href="?modul=mod_lupapass&act=decline&id=<?= $row['id_request']; ?>" class="btn btn-xs btn-danger text-white"> <i class="bi bi-pencil-square"> </i> Decline </a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="?modul=mod_lupapass&act=history" class="btn btn-primary btn-xs mb-1">History Request Password</a>
    </div>
<?php
} else if (isset($_GET['act']) && ($_GET['act'] == "decline")) {
    $idrequest = $_GET['id'];
    $qry_listrequest = mysqli_query($koneksidb, "SELECT * FROM tst_request WHERE id_request=$idrequest");
    $row = mysqli_fetch_array($qry_listrequest);
    $username = $row['username'];
    $pass = $row['password_baru'];
    $date = $row['date_request'];
    $qhistory = mysqli_query($koneksidb, "INSERT INTO tst_historyrequest (username, password_baru, date_request, status) 
        VALUES ('$username', '$pass', '$date', 0)") or die(mysqli_error($connect_db));
    if ($qhistory) {
        $qupdate = mysqli_query($koneksidb, "DELETE from tst_request WHERE id_request=$idrequest") or die(mysqli_error($connect_db));
    }
    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_lupapass&pesan=ditolak">';
} else if (isset($_GET['act']) && ($_GET['act'] == "accept")) {
    $idrequest = $_GET['id'];
    $qry_listrequest = mysqli_query($koneksidb, "SELECT * FROM tst_request WHERE id_request=$idrequest");
    $row = mysqli_fetch_array($qry_listrequest);
    $username = $row['username'];
    $pass = $row['password_baru'];
    $date = $row['date_request'];
    $qinsert = mysqli_query($koneksidb, "UPDATE mst_userlogin SET password='$pass' WHERE username='$username'")
        or die(mysqli_error($koneksidb));
    if ($qinsert) {
        $qhistory = mysqli_query($koneksidb, "INSERT INTO tst_historyrequest (username, password_baru, date_request, status) 
        VALUES ('$username', '$pass', '$date', 1)") or die(mysqli_error($connect_db));
        $qdelete = mysqli_query($koneksidb, "DELETE FROM tst_request WHERE id_request=$idrequest") or die(mysqli_error($connect_db));
        echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_lupapass&pesan=berhasil">';
    }
} else if (isset($_GET['act']) && ($_GET['act'] == "history")) {
?>
    <div class="container">
        <h3 class="text-center"> History Request Password User </h3>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th> Tanggal Request </th>
                    <th> Username </th>
                    <th> Password Baru </th>
                    <th> Status</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php
                $qry_listrequest = mysqli_query($koneksidb, "SELECT * FROM tst_historyrequest order by id_request DESC") or die("gagal akses tabel mst_blog" . mysqli_error($koneksidb));
                while ($row = mysqli_fetch_array($qry_listrequest)) {
                ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($row['date_request'])); ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['password_baru']; ?></td>
                        <td><?= ($row['status'] == 1) ? "Accepted" : "Declined"; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="?modul=mod_lupapass" class="btn btn-warning btn-xs mb-1">Kembali</a>
    </div>
<?php
}
?>