<?php
if (!isset($_GET['action'])) {
    $datajual = mysqli_query($koneksidb, "select t.*, m.nm_member from trn_jualhead t inner join daftarmember m
			on t.idmember=m.idmember order by nojual desc ") or die("gagal akses " . mysqli_error($koneksidb));
} else if (isset($_GET['action']) && $_GET['action'] == "detail") {
    $data_member = mysqli_query($koneksidb, "select * from daftarmember");
    $data_komik = mysqli_query($koneksidb, "select * from mst_komik");

    $no = $_GET['nojual'];
    $qjual = mysqli_query($koneksidb, "select jh.*, jd.* from trn_jualhead jh inner join trn_jualdetail jd
	on jh.nojual=jd.nojual where jh.nojual='$no' order by jh.nojual desc");
    $dto = mysqli_fetch_array($qjual);
} else if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $no = $_GET['nojual'];
    $delete = mysqli_query($koneksidb, "DELETE FROM trn_jualdetail WHERE nojual='$no'");
    if ($delete) {
        mysqli_query($koneksidb, "DELETE FROM trn_jualhead WHERE nojual='$no'");
        echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_penjualan">';
    }
} else if (isset($_GET['action']) && $_GET['action'] == "ordersave") {
    $no = $_POST['no_inv'];
    //head
    $nm_member = $_POST['nm_member'];
    $no_inv = $_POST['no_inv'];
    $tgl_trans = $_POST['tgl_trans'];
    $total = $_POST['total'];
    //detail
    $kodekomik = $_POST['row_kodekomik'];
    $harga = $_POST['row_harga'];
    $qty = $_POST['row_qty'];
    $subtotal = $_POST['row_subtotal'];
    $jml_list = count($kodekomik);

    //proses simpan ke head
    $qinsert_head = mysqli_query($koneksidb, "UPDATE trn_jualhead SET total='$total' WHERE nojual='$no'") or die("error head" . mysqli_error($koneksidb));
    if ($qinsert_head) {
        for ($i = 0; $i < $jml_list; $i++) {
            $qinsert_det = mysqli_query($koneksidb, "INSERT INTO trn_jualdetail 
			(nojual,kode_komik,harga,qty,subtotal) VALUES ('$no_inv', '$kodekomik[$i]', $harga[$i], $qty[$i], $subtotal[$i])")
                or die("error detail " . mysqli_error($koneksidb));
            echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_penjualan">';
        }
    }
}
