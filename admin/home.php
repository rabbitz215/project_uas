<?php
session_start();
require_once("../config/koneksidb.php");
require_once("../config/config.php");
security_login();
function rupiah($angka)
{
	$hasil_rupiah = "Rp." . number_format($angka, 2, ',', '.');
	return $hasil_rupiah;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../assets/img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Admin | Comic Store</title>

	<link href="../assets/css/app.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="https://cdn.tiny.cloud/1/ctai2l7ettpdz3uyphr0lz4x23v2z3otpascq7sk3miw64e3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: 'textarea#deskripsi',
			plugins: [
				'advlist', 'autolink',
				'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
				'fullscreen', 'insertdatetime', 'media', 'table', 'help',
				'wordcount'
			],
			toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
				'alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
		});
	</script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand">
					<span class="align-middle">Comic Store</span>
				</a>

				<ul class="sidebar-nav">
					<?php
					include_once("menu.php");
					?>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-link d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<span><?= $_SESSION['namauser_log']; ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<?php
				if (isset($_GET['modul'])) {
					include_once $_GET['modul'] . "/index.php";
				} else {
				?>
					<h1>WELCOME <?= strtoupper($_SESSION['namauser_log']); ?> TO ADMIN PAGE</h1>
				<?php
				}
				?>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> &copy;
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="../assets/js/app.js"></script>
	<script src="../assets/js/galang.js"></script>

</body>

</html>