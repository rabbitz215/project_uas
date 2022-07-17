<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp." . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>
<div class="container pb-5">
    <div class="row">
        <div class="col-md-9 pt-4">
            <?php
            $id = $_GET['id'];
            $dtlproduk = mysqli_query($koneksidb, "SELECT a.*, b.nm_kategori FROM mst_komik a INNER JOIN mst_kategori b ON a.id_kategori = b.id_kategori WHERE kode_komik='$id'");
            while ($p = mysqli_fetch_array($dtlproduk)) {
            ?>
                <div class="row">
                    <div class="col-md-5 pe-0">
                        <img src="assets/img/<?= $p['cover']; ?>" class="card-img-top" alt="..." />
                    </div>
                    <div class="col-md-7 ps-3">
                        <div class="card">
                            <div class="card-body subkategori p-2">
                                <h3><?= $p['judul']; ?></h3>
                                <h5>Harga : <?= rupiah($p['harga']); ?></h5>
                                <h5>Genre : <?= $p['nm_kategori']; ?></h5>
                                <p style="color: black; font-family: Arial, Helvetica, sans-serif; font-size: 14px">
                                    <?= $p['desc_komik']; ?> <br />
                                </p>
                                <p style="color: black; font-family: Arial, Helvetica, sans-serif; font-size: 14px">
                                    Stok : <?= $p['stock']; ?> <br />
                                    <!-- Deskripsi : <?= $p['deskripsi']; ?> <br /> -->
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item btndetail">
                                    <a href="http://wa.me/6281339364971?text=Saya mau beli komik <?= $p['judul']; ?> , Harga Rp. <?= rupiah($p['harga']); ?> " target="_blank" class="btn btn-lg btn-primary">Beli Yuk</a>
                                    <a href="/project_uas" class="btn btn-lg btn-warning">Kembali</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<?php
            }
?>
</div>