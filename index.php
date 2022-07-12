<?php
require_once("config/koneksidb.php");
require_once("config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Comic Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/project_uas">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?page=popularkomik">Popular Komik</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Genre</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $genre = mysqli_query($koneksidb, "SELECT nm_kategori FROM mst_kategori");
                            foreach ($genre as $g) :
                            ?>
                                <li><a class="dropdown-item" href="?genre=<?= $g['nm_kategori']; ?>"><?= $g['nm_kategori']; ?></a></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="?page=order">Order Comic</a></li>
                </ul>
                <div class="w-25">
                    <form class="d-flex flex-row-reverse" method="POST">
                        <input class="form-control me-2" type="text" placeholder="Cari disini" name="search">
                        <input class="btn btn-outline-success me-3" type="submit" value="Search"></input>
                    </form>
                </div>
                <form class="d-flex">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    <a class="nav-link" href="?page=daftarmember">Daftar Member</a>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Comic Store</h1>
                <p class="lead fw-normal text-white-50 mb-0">A Place To Buy Your Comic</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <?php
        if (isset($_GET['page'])) {
            include_once("" . $_GET['page'] . ".php");
        } else {
            include_once("home.php");
        }
        ?>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="bg-light p-5" action="ceklogin.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="logusername" />
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="logpassword" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnbatal" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="btnlogin" id="btnkeluar" class="btn btn-primary">Login</button>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-5 text-end">
                            <a href="?page=lupapassword" class="btn btn-primary">Lupa Password?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/galang.js"></script>
</body>

</html>