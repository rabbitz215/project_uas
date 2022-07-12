<?php
session_start();
session_destroy();
?>
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php
        $batas = 4;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

        $previous = $halaman - 1;
        $next = $halaman + 1;
        $genre = @$_GET['genre'];
        if (empty($genre)) {
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
                $hasil = mysqli_query($koneksidb, "SELECT a.*,b.nm_kategori FROM mst_komik a INNER JOIN mst_kategori b ON a.id_kategori = b.id_kategori WHERE a.judul LIKE '%$search%'");
            } else {
                $query = mysqli_query($koneksidb, "SELECT a.*, b.nm_kategori FROM mst_komik a INNER JOIN mst_kategori b ON a.id_kategori = b.id_kategori");
                $jumlah_data = mysqli_num_rows($query);
                $total_halaman = ceil($jumlah_data / $batas);
                $hasil = mysqli_query($koneksidb, "SELECT a.*, b.nm_kategori FROM mst_komik a INNER JOIN mst_kategori b ON a.id_kategori = b.id_kategori LIMIT $halaman_awal, $batas");
            }
        } else {
            $hasil = mysqli_query($koneksidb, "SELECT a.*, b.nm_kategori FROM mst_komik a INNER JOIN mst_kategori b ON a.id_kategori = b.id_kategori WHERE nm_kategori = '$genre'");
        }
        $hitung = mysqli_num_rows($hasil);
        if ($hitung == 0) {
        ?>
            <h1>Hasil Tidak Ditemukan</h1>
        <?php
        }
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
<nav>
    <ul class="pagination justify-content-center">
        <?php
        for ($x = 1; $x <= @$total_halaman; $x++) {
        ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
        <?php
        }
        ?>
    </ul>
</nav>