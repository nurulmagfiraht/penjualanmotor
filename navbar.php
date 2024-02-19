<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="img/logo.png" alt="" width="100" class="rounded-circle"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <?php if (isset($_SESSION['login'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="barang.php">Motor dan Alat-Alat</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome, <?php echo $_SESSION['a_global']->nama_panggilan ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profile.php">My profile</a></li>
              <li><a class="dropdown-item" href="history.php">History pemesanan</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">Logout</a></li>
            </ul>
          </li>
          <!-- <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us</a>
        </li> -->
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
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
        <h3 class="py-5">WELCOME TO THE WEBSITE</h3>
        <h1 class="mt-2 mb-5">PENJUALAN MOTOR DAN ALAT-ALAT TRAIL KAWASAKI BERBASIS WEBSITE</h1>
      </div>
    </div>

  </div>
</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>