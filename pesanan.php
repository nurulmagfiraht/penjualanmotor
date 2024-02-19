<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['login'])) {
  header('Location: login.php');
}

if (isset($_GET['id_gula'])) {
  $id_gula    = $_GET['id_gula'];
} else {
  die("Error. No ID Selected!");
}

$gula = mysqli_query($con, "SELECT * FROM tb_gula WHERE id_gula  = '$id_gula'
                          ");
$gula= mysqli_fetch_array($gula);

// Proses Pemesanan
if (isset($_POST['submit'])) {

  $id_user   = $_POST['id_user'];
  $id_gula     = $_POST['id_gula'];
  $jumlah_pesan     = $_POST['jumlah_pesan'];
  $no_handphone     = $_POST['no_handphone'];
  $tanggal_pesanan     = $_POST['tanggal_pesanan'];
  $total_harga             = $_POST['jumlah_pesan'] * $gula['harga'];
  $status     = $_POST['status'];
  $keterangan     = $_POST['keterangan'];
  $alamat_lengkap     = $_POST['alamat_lengkap'];

  if ($jumlah_pesan > $gula['stock']) {
    echo '<script>alert("Jumlah stock tidak tersedia!")</script>';
    echo '<script>window.location=""</script>';
  } else {
    $pesan = mysqli_query($con, "INSERT INTO tb_pesanan VALUES (
          '',
          '" . $id_user . "',
          '" . $id_gula . "',
          '" . $tanggal_pesanan . "',
          '" . $jumlah_pesan . "',
          '" . $no_handphone . "',
          '" . $total_harga . "',
          '" . $status . "',
          '" . $keterangan . "',
          '" . $alamat_lengkap . "'
          )");


    if ($pesan) {
      echo '<script>alert("Pesanan success di lakukan!")</script>';
      echo '<script>window.location="history.php"</script>';
    } else {
      echo 'Gagal' . mysqli_error($con);
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penjualan Motor & Alat-Alat Motor Kawasaki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php
  include 'navbar.php';
  ?>

  <div class="container-fluid bg-light">
    <div class="container">

      <div class="row text-center mb-b">
        <div class="col-lg-12 mt-5 mb-5">
          <h3>Silahkan melakukan pemesanan barang</h3>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="card mb-5">
            <img src="admin/img/<?php echo $gula['gambar'] ?>" class="card-img-top" alt="..." height="300" data-aos="flip-left" data-aos-duration="2000">
            <div class="card-body">
              <h5 class="card-title"><?php echo $gula['nama'] ?></h5>
              <p class="card-text">jenis gula : <?php echo $gula['jenis_gula'] ?></p>
              <p class="card-text">Harga : Rp. <?php echo number_format($gula['harga']) ?></p>
              <p class="card-text">Stock : <?php echo $gula['stock'] ?></p>
              <div class="py-3">
                <!-- Form Pesanan -->
                <div class="col-lg-6">
                  <form action="" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['a_global']->id_user ?>">
                    <input type="hidden" name="id_gula" value="<?php echo $gula['id_gula'] ?>">
                    <div class="mb-3">
                      <label for="tanggal_pesanan" class="form-label">Tanggal Pesanan</label>
                      <input type="date" id="tanggal_pesanan" class="form-control" name="tanggal_pesanan" required>
                    </div>
                    <div class="mb-2">
                      <input type="number" id="jumlah_pesan" class="form-control" name="jumlah_pesan" placeholder="Jumlah Pesan" required>
                    </div>
                    <div class="mb-2">
                      <input type="number" id="no_handphone" class="form-control" name="no_handphone" placeholder="No. Handphone" required>
                    </div>
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" name="keterangan" value="0">
                    <div class="mb-2">
                      <div class="form-lable"><small>
                          <p>Silahkan masukkan alamat yang lengkap</p>
                        </small></div>
                      <div class="form-floating">
                        <textarea class="form-control" name="alamat_lengkap" required placeholder="Alamat lengkap" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Alamat lengkap</label>
                      </div>
                    </div>
                    <div>
                      <button class="btn btn-success" name="submit" type="submir">Pesan Sekarang</button>
                    </div>
                  </form>
                </div>
                <!-- End Form -->
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>


  <?php
  include 'footer.php';
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>