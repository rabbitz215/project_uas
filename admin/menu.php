<li class="sidebar-header">
    Admin
</li>
<?php
$iduser = $_SESSION['id_user'];
// $qry_admin = mysqli_query($koneksidb, "SELECT * FROM mst_menu WHERE kategori_menu='admin'");
$qry_admin = mysqli_query($koneksidb, "SELECT a.*, b.*, c.* FROM hakakses_menu a INNER JOIN mst_userlogin b ON a.iduser = b.iduser INNER JOIN mst_menu c ON a.idmenu = c.idmenu WHERE a.iduser='$iduser' AND c.kategori_menu='admin'");
foreach ($qry_admin as $m) :
?>
    <li class="sidebar-item">
        <a class="sidebar-link" href="?modul=<?= $m['link']; ?>">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle"><?= $m['nmmenu']; ?></span>
        </a>
    </li>
<?php
endforeach;
?>
<li class="sidebar-header">
    Komik
</li>
<?php
$qry_komik = mysqli_query($koneksidb, "SELECT a.*, b.*, c.* FROM hakakses_menu a INNER JOIN mst_userlogin b ON a.iduser = b.iduser INNER JOIN mst_menu c ON a.idmenu = c.idmenu WHERE a.iduser='$iduser' AND c.kategori_menu='komik'");
foreach ($qry_komik as $m) :
?>
    <li class="sidebar-item">
        <a class="sidebar-link" href="?modul=<?= $m['link']; ?>">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle"><?= $m['nmmenu']; ?></span>
        </a>
    </li>
<?php
endforeach;
?>
<li class="sidebar-header">
    Penjualan
</li>
<?php
$qry_penjualan = mysqli_query($koneksidb, "SELECT a.*, b.*, c.* FROM hakakses_menu a INNER JOIN mst_userlogin b ON a.iduser = b.iduser INNER JOIN mst_menu c ON a.idmenu = c.idmenu WHERE a.iduser='$iduser' AND c.kategori_menu='penjualan'");
foreach ($qry_penjualan as $m) :
?>
    <li class="sidebar-item">
        <a class="sidebar-link" href="?modul=<?= $m['link']; ?>">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle"><?= $m['nmmenu']; ?></span>
        </a>
    </li>
<?php
endforeach;
?>