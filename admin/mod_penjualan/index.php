<?php
include_once("penjualanCtrl.php");
if (!isset($_GET['action'])) {
?>
    <div class="container">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No Invoice</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal Order</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php
                foreach ($datajual as $q) :
                ?>
                    <tr>
                        <td><?= $q['nojual']; ?></td>
                        <td><?= $q['nm_member']; ?></td>
                        <td><?= $q['tgl_transaksi']; ?></td>
                        <td><a href="?modul=mod_penjualan&action=detail&nojual=<?= $q['nojual']; ?>" class="btn btn-xs btn-primary"><i class="bi bi-pencil-square"></i> Detail</a>
                            <a href="?modul=mod_penjualan&action=delete&nojual=<?= $q['nojual']; ?>" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
<?php
} else if (isset($_GET['action']) && ($_GET['action'] == "detail")) { ?>
    <form action="#" class="pb-5" id="formorderadmin" method="POST">
        <h3 class="pt-3">Form Pembelian</h3>
        <div class="row pb-1">
            <label class="control-label col-md-2">Nama Member</label>
            <div class="col-md-3">
                <select name="nm_member" id="nm_member" value="" class="form-control">
                    <?php
                    $nojual = $_GET['nojual'];
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
        <div class="row pb-1">
            <label class="control-label col-md-2">Nama Barang</label>
            <div class="col-md-3">
                <select name="kodekomik" id="kodekomik" value="" class="form-control">
                    <option value="">--Pilih Barang--</option>
                    <?php
                    foreach ($data_komik as $k) {
                        echo '<option value="' . $k['kode_komik'] . '"
							data-namabrg="' . $k['judul'] . '"
							data-hargabrg=' . $k['harga'] . '>
							' . $k['judul'] . '</option>';
                    }
                    ?>
                </select>
                <input type="hidden" name="nm_barang" id="nm_barang">
            </div>
            <label class=" control-label col-md-1">Harga</label>
            <div class="col-md-2">
                <input type="text" name="harga" id="harga" value="" class="form-control" readonly>
            </div>
            <label class="control-label col-md-1">Jumlah</label>
            <div class="col-md-1">
                <input type="text" name="jml" id="jml" value="" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="button" id="btn_addbarang" class="btn btn-primary">Tambah Barang</button>
            </div>
        </div>
        <div class="row pb-1">
            <div class="col-md-12">
                <table class="table table-bordered" id="">
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
                        $nojual = $_GET['nojual'];
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
            </div>
        </div>
        <div class="row pb-1">
            <div class="col-md-12">
                <button type="button" id="btn_orderadmin" class="btn btn-primary"> Simpan Order</button>
            </div>
        </div>
        <!-- konfirmasi modal -->
        <div class="modal" tabindex="-1" id="konfirmasiorder">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin melakukan order dan melanjutkan pembayaran???</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="button" id="btn_saveorderadmin" class="btn btn-primary">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>