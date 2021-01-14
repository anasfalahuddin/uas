<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Network Store</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <style>
          container {
            padding-top: 15px;
          }
        </style>
    </head>
    <body>
        <!-- Image and text -->
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #2ca4fc;">
            <a class="navbar-brand" href="#">
            <img src="gambar/logo.png" width="170" height="120" class="d-inline-block align-top" alt="">
            <!-- Brand -->
            <?php
                include 'config/database.php';
                $ambil_kategori = mysqli_query ($kon,"select * from profil limit 1");
                $row = mysqli_fetch_assoc($ambil_kategori); 
                $nama_website = $row['nama_website'];
                $copy_right = $row['nama_website'];
            ?>
            <a class="navbar-brand" href="index.php?halaman=home"><h2><?php echo $nama_website;?></h2></br>Jasa Instalasi Jaringan Dan CCTV</a>
            </a>
        </nav>

        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #4ccc6c;">
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?halaman=home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                            include 'config/database.php';
                            $sql="select * from kategori";
                            $hasil=mysqli_query($kon,$sql);
                            while ($data = mysqli_fetch_array($hasil)):
                        ?>
                            <a class="dropdown-item" href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori'];?></a> 
                    
                    <?php endwhile; ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=home">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=home">Tentang</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php 
                        session_start();
                        if (isset($_SESSION["id_pengguna"])) {
                                echo " <li><a class='nav-link' href='admin/index.php?halaman=kategori'>Halaman Admin</a></li>";
                        }else {
                            echo " <li><a class='nav-link' href='index.php?halaman=login'><span class='fas fa-log-in'></span> Login</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </nav>

        <div class="jumbotron">
            <?php
            include 'config/database.php';
            if (isset($_GET['id'])) {
                $sql="select * from produk where status=1 and id_produk=".$_GET['id']."";
                $hasil=mysqli_query($kon,$sql);
                $data = mysqli_fetch_array($hasil);
                $judul=$data['judul_produk'];  
            }else if (isset($_GET['kategori'])){
                $sql="select * from kategori where id_kategori=".$_GET['kategori']."";
                $hasil=mysqli_query($kon,$sql);
                $data = mysqli_fetch_array($hasil);
                $judul=$data['nama_kategori'];  
            }
            ?>
            <img src="gambar/banner.jpg" alt="Wireless Router" width="100%" height="450px">
        </div>

        <div class="container pt-3">
            <div class="row">
                <div class="col-md-3">
                    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #2ca4fc;">
                        <div class="mx-auto order-0">
                            <a class="navbar-brand mx-auto" href="#">Order</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </nav>
                    <center>
                        <p>Isi Form Pemesanan dengan Klik Tombol di bawah ini</p>
                        <button type="button" class="btn btn-success">Order</button>
                    </center>
                </div>
                <div class="col-md-6">
                    <?php 
                        if(isset($_GET['halaman'])){
                            $halaman = $_GET['halaman'];
                            switch ($halaman) {
                                case 'home':
                                    include "home.php";
                                    break;
                                case 'produk':
                                    include "produk.php";
                                    break;
                                case 'login':
                                    include "login.php";
                                    break;
                                default:
                                echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                                break;
                            }
                        }else {
                            include "home.php";
                        }
                    ?>
                </div>
                <div class="col-md-3">
                    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #2ca4fc;">
                        <div class="mx-auto order-0">
                            <a class="navbar-brand mx-auto" href="#">Produk Terbaru</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </nav>
                    <?php
                        include 'config/database.php';
                        $sql="select * from produk where status=1 order by id_produk desc";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                    ?>

                    <div class="col-sm-12">
                        <div class="caption">
                            <div class="row pt-3">
                                <div class="col-xl-3">
                                    <img src="admin/produk/gambar/<?php echo $data['gambar'];?>" width="100%" alt="Cinque Terre">
                                </div>
                                <div class="col-xl-7">
                                <a class="text-dark" href="index.php?halaman=produk&id=<?php echo $data['id_produk'];?>"><?php echo $data['judul_produk'];?></a>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #2ca4fc;">
            <div class="mx-auto order-0">
                <a class="navbar-brand mx-auto" href="#">Copyright <?php echo $nama_website;?> 2020</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </body>
</html>