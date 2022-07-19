<?php
session_start();
session_destroy();
?>
<h1 class="text-center mb-3">Top 4 Komik</h1>
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php
        $querytop = "SELECT a.*, b.*, SUM(qty) FROM trn_jualdetail a INNER JOIN mst_komik b ON a.kode_komik = b.kode_komik GROUP BY a.kode_komik ORDER BY SUM(qty) DESC LIMIT 4";
        $hasil = mysqli_query($koneksidb, $querytop);
        foreach ($hasil as $p) :
        ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="assets/img/<?= $p['cover']; ?>" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?= $p['judul']; ?></h5>
                            <!-- Product price-->
                            Rp.<?= $p['harga']; ?>
                            <br>
                            Sold : <?= $p['SUM(qty)']; ?>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?page=detailkomik&id=<?= $p['kode_komik']; ?>">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
</div>