<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="../img/logo.png" alt="" width="100" class="rounded-circle"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ">
        <?php if (isset($_SESSION['login'])) { ?>
          <?php if ($_SESSION['a_global']->nama_panggilan == 'pimpinan') { ?>
            <li class="nav-item">
              <a class="nav-link" href="laporan_penjualan.php">Laporan penjualan</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="barang.php">Data barang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pelanggan.php">Data pelanggan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pesanan.php">Data pesanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="peramalan.php">Data Peramalan Penjualan</a>
            </li>
          <?php } ?>
          <li class="nav-item">
          <li class="nav-item">
            <a class="nav-link" href="">Welcome, <?php echo $_SESSION['a_global']->email ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
          </li>

        <?php } else { ?>
          <li class="nav-item">
            <h3 class="text-white">Login</h3>
          </li> 
        <?php } ?>
      </ul>
      <ul class="navbar-nav ms-auto">
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->

<div class="container-fluid" id="bantuan">
  <div class="container">

    <div class="row text-white text-center">
      <div class="col-lg-10 offset-lg-1 mt-5 mb-5">
        <?php if (isset($_SESSION['login'])) { ?>
          <?php if ($_SESSION['a_global']->nama_panggilan == 'pimpinan') { ?>
            <h3 class="py-5">ANDA LOGIN SEBAGAI PIMPINAN</h3>
          <?php } else { ?>
            <h3 class="py-5">ANDA LOGIN SEBAGAI ADMIN</h3>
          <?php } ?>
          <h1 class="mt-2 mb-5">Penjualan Motor & Alat-Alat Trail Kawasaki</h1>
        <?php } else { ?>
          <h3 class="py-5">SILAHKAN LOGIN TERLEBIH DAHULU</h3>
        <?php } ?>
      </div>
    </div>
    <br><br><br><br><br><br>
  </div>
</div>