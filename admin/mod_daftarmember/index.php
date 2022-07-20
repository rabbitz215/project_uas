<?php
if (!isset($_GET['action'])) {
?>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Kode Member</th>
                <th>Nama Member</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
            $listuser = mysqli_query($koneksidb, "SELECT  * from daftarmember");
            while ($list = mysqli_fetch_array($listuser)) {
            ?>
                <tr>
                    <td><?= $list['kode_member']; ?></td>
                    <td><?= $list['nm_member']; ?></td>
                    <td><?= $list['email']; ?></td>
                    <td><?= $list['no_telp']; ?></td>
                    <td><?= $list['alamat']; ?></td>
                    <td><?= ($list['jk'] == "L" ? "Laki-Laki" : "Perempuan"); ?></td>
                    <td><img src="../assets/img/<?= $list['foto']; ?>" alt="" width="150px"></td>
                    <td>
                        <a href="?modul=mod_daftarmember&action=delete&id=<?= $list['idmember']; ?>" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else if (isset($_GET['action']) && ($_GET['action'] == "delete")) {
    $id = $_GET['id'];
    mysqli_query($koneksidb, "DELETE FROM daftarmember WHERE idmember='$id'");
    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_daftarmember">';
}
?>