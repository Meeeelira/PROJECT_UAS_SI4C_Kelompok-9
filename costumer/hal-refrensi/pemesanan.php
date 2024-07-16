<?php 
session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: ../../Form_Login/FormLogin.php");
    exit;
}
require "../DB.php";
$p = $_SESSION["user"];

$dt = mysqli_query($koneksi,"SELECT * FROM penjualan WHERE Pengirim = '$p' ");

if (isset($_GET["psn"])) {
  $psn = $_GET["psn"];
  if ($psn >= 0) {
    echo "
                  <script>
                      alert('Pesanan anda berhasil di kirim!');
                  </script>
              ";
  }else {
    echo "
                  <script>
                      alert('Pesanan anda gagal di kirim!');
                  </script>
              ";
  }
}

?>

<!DOCTYPE html>
<html lang="en">    

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistem Informasi Penjualan Butik <b>Costumer-order Page.com</b></title>  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medicio
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-clock"></i> Monday - Saturday, 8AM to 10PM
      </div>
      <div class="d-flex align-items-center">
        <i class="bi bi-phone"></i> Call us now +62 852 4567 8910
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container  mt-0 d-flex align-items-center">

      <a href="index.html" class="logo me-auto"><img src="../logobutik.png" alt=""></a>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="../#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="pemesanan.php">Pemesanan</a></li>
          <li><a class="nav-link scrollto" href="../../Form_Login/FormLogin.php" ><button style="border-radius: 100px;">Login</button></a></li>
          <li><a class="nav-link scrollto" href="../../Form_Login/Logout.php" ><button style="border-radius: 100px;">Logout</button></a></li>
          <ul>
           
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- tabel -->
<div class="container" style="margin-top: 140px;">
    <div class="row">
        <div class="col-md-12">
        <table  class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Pengirim</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Kategori</th>
            <th scope="col">Ukuran</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
            <th scope="col">Total Bayar</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
        <?php foreach ($dt as $data ) : ?> 
            <?php 
                $j = $data["JumlahBarang"];
                $h = $data["HargaBarang"];
                $t = $j * $h;
            ?>
            <tr>
                <td scope="row"><?= $i ?></td>
                <td><?= $data["Pengirim"]?></td>
                <td><?= $data["NamaBarang"]?></td>
                <td><?= $data["Kategori"]?></td>
                <td><?= $data["Ukuran"]?></td>
                <td><?= $data["Message"]?></td>
                <td><?= $data["JumlahBarang"]?></td>
                <td><?= $data["HargaBarang"]?></td>
                <td><?= $t;?></td>
                <td>
                  <?php if (isset($_POST["krm"])) :
                    $ubh = $_POST["krm"];
                    if ($ubh > 0) {
                      echo"
                    <button class='btn btn-sm btn-primary ms-2 me-2 mb-2' type='submit' name='psn' ><a href='pemesanan.php?psn=1'class='text-light'>Kirim</a></button>
                      ";
                    }
                    
                  ?>
                  <?php endif; ?>
                    <form action="" method="post">
                    <button class='btn btn-sm btn-warning ms-2 me-2 mb-2' type="submit" value="1" name="krm">Selesai</button>
                    </form>
                    <button class='btn btn-sm btn-success ms-2 me-2'><a href='u-pms.php?id=<?= $data["Id_Barang"] ?>' class='text-light'>Ubah</a></button>
                </td>
            </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
        </div>
    </div>
</div>
  <!-- tabel berakhir -->

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>