<?php
// include_once("transaksiCtrl.php");
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
                    <td>
                        <a href="?modul=mod_trnmember&action=detail&id=<?= $list['idmember']; ?>" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>History Order</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else if (isset($_GET['action']) && ($_GET['action'] == "detail")) {
?>
    <div class="row mb-2">
        <?php
        $kode = $_GET['id'];
        $cek = mysqli_query($koneksidb, "SELECT * FROM daftarmember WHERE idmember='$kode'");
        foreach ($cek as $d) :
        ?>
            <div class="col-md-4">
                <img src="../assets/img/<?= $d['foto'] ?>" class="rounded" width="250px">
            </div>
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item"><?= $d['kode_member']; ?> (kode member)</li>
                    <li class="list-group-item">Nama : <?= $d['nm_member']; ?></li>
                    <li class="list-group-item">Email :<?= $d['email']; ?></li>
                    <li class="list-group-item">Password : <?= $d['password']; ?></li>
                    <li class="list-group-item">Tanggal daftar : <?= date_format(new DateTime($d['tgl_daftar']), 'd-m-Y'); ?>
                    </li>
                    <li class="list-group-item">Tanggal Lahir : <?= $d['tgl_lhr']; ?></li>
                    <li class="list-group-item">No.Telp : <?= $d['no_telp']; ?></li>
                    <li class="list-group-item">Alamat : <?= $d['alamat']; ?></li>
                    <li class="list-group-item">Jenis Kelamin : <?= ($d['jk'] == "L" ? "Laki-Laki" : "Perempuan"); ?></li>
                <?php
            endforeach;
                ?>
                </ul>
            </div>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>No Invoice</th>
                <th>Tanggal Transaksi</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
            $listuser = mysqli_query($koneksidb, "SELECT  a.idmember,b.* from daftarmember a INNER JOIN trn_jualhead b ON a.idmember = b.idmember WHERE b.idmember='$kode'");
            while ($list = mysqli_fetch_array($listuser)) {
            ?>
                <tr>
                    <td><?= $list['nojual']; ?></td>
                    <td><?= $list['tgl_transaksi']; ?></td>
                    <td><?= $list['total']; ?></td>
                    <td>
                        <a href="?modul=mod_trnmember&action=detailorder&id=<?= $list['nojual']; ?>" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>Detail</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="?modul=mod_trnmember" class="btn btn-warning">Kembali</a>
<?php } else if (isset($_GET['action']) && ($_GET['action'] == "detailorder")) { ?>
    <form action="#" class="pb-5" id="formorderadmin" method="POST">
        <h3 class="pt-3">Detail Pembelian</h3>
        <div class="row pb-1">
            <label class="control-label col-md-2">Nama Member</label>
            <div class="col-md-3">
                <select name="nm_member" id="nm_member" value="" class="form-select">
                    <?php
                    $nojual = $_GET['id'];
                    $qjual = mysqli_query($koneksidb, "select jh.*, jd.* from trn_jualhead jh inner join trn_jualdetail jd
	on jh.nojual=jd.nojual where jh.nojual='$nojual' order by jh.nojual desc");
                    $dto = mysqli_fetch_array($qjual);
                    $transaksi = mysqli_query($koneksidb, "SELECT a.*, b.nm_member FROM trn_jualhead a INNER JOIN daftarmember b ON a.idmember = b.idmember WHERE a.nojual='$nojual'");
                    foreach ($transaksi as $t) :
                    ?>
                        <option value="<?= $t['idmember']; ?>" <?= ($t['nojual'] == $nojual) ? "selected" : ""; ?>><?= $t['nm_member']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <label class="control-label col-md-1">No.Invoice</label>
            <div class="col-md-2">
                <input type="text" name="no_inv" id="no_inv" value="<?= $dto['nojual']; ?>" class="form-control" readonly>
            </div>
            <label class="control-label col-md-1">Tanggal</label>
            <div class="col-md-2">
                <input type="date" name="tgl_trans" id="tgl_trans" value="<?= $dto['tgl_transaksi']; ?>" class="form-control" readonly>
            </div>
        </div>
        <div class="row pb-1 mt-3">
            <div class="col-md-12">
                <table class="table table-striped" id="">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Barang</th>
                            <th width="10%">Harga</th>
                            <th width="5%">Jumlah</th>
                            <th width="10%">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="listbarang" class="table-light">
                        <?php
                        $nojual = $_GET['id'];
                        $qdata = mysqli_query($koneksidb, "SELECT a.*, b.judul FROM trn_jualdetail a INNER JOIN mst_komik b ON a.kode_komik = b.kode_komik WHERE a.nojual='$nojual'");
                        foreach ($qdata as $d) :
                        ?>
                            <tr>
                                <td><?= $d['judul']; ?></td>
                                <td width="10%"><?= $d['harga']; ?></td>
                                <td width="5%"><?= $d['qty']; ?></td>
                                <td width="10%"><?= $d['subtotal']; ?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total Bayar</th>
                            <th>
                                <?php
                                $total = mysqli_query($koneksidb, "SELECT * FROM trn_jualhead WHERE nojual='$nojual'");
                                foreach ($total as $t) :
                                ?>
                                    <span id="viewtotalbayar"></span>
                                    <input type="hidden" name="total" id="total" value="<?= $t['total']; ?>">
                                    <span id="hargalama"><?= $t['total']; ?></span>
                                <?php
                                endforeach;
                                ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <a href="?modul=mod_trnmember&action=detail&id=<?= $t['idmember']; ?>" class="btn btn-warning">Kembali</a>
                <a href="?modul=mod_trnmember" class="btn btn-danger">Exit</a>
            </div>
        </div>
    <?php } ?>
    </form>
    <!--modal -->
    <div class="modal fade" id="btnkonfirm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    apakah anda yakin ingin menyimpan?
                </div>
                <div class="modal-footer">
                    <button type="button" name="btnbatal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="btnsimpan" id="btnsimpan" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>