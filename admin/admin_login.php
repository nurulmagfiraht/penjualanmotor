<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: admin/index.php");
  exit;
}


if (isset($_POST['submit'])) {
  include '../koneksi.php';

  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  $cek = mysqli_query($con, "SELECT * FROM tb_admin WHERE email = '" . $email . "' AND password = '" . $password . "'");
  if (mysqli_num_rows($cek) > 0) {
    $d = mysqli_fetch_object($cek);
    $_SESSION['status_admin'] = true;
    $_SESSION['a_global'] = $d;
    $_SESSION['id_admin'] = $d->id_admin;
    $_SESSION['level'] = $d->level;
    $_SESSION['login'] = true;
    echo '<script>window.location="index.php"</script>';
  } else {
    echo '<script>alert("Username atau password Anda salah!")</script>';
  }
}



?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penjualan Motor & Alat-Alat Motor Kawasaki</title>
  <!-- Link Style Css -->
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

  <?php
  include 'navbar.php';
  ?>


  <div class="container-fluid bg-light">
    <div class="container">

      <div class="row py-5 justify-content-center">
        <div class="col-lg-6">
          <!-- Form Login  -->
          <form action="" method="post">
            <div class="card p-3">
              <div class="card-header">
                <h3 class="text-center">FORM LOGIN ADMIN & PIMPINAN</h3>
              </div>
              <div class="car-body p-5">
                <div class="mb-2">
                  <div class="form-label">Email</div>
                  <input type="email" class="form-control form-control-lg" name="email" autofocus id="email">
                </div>
                <div class="mb-2">
                  <div class="form-label">Password</div>
                  <input type="password" class="form-control form-control-lg" name="password" autofocus id="password">
                </div>

                <div class="mb-3">
                  <button class="btn btn-primary btn-lg w-100" type="submit" name="submit">LOGIN</button>
                </div>

                <div class="text-center mt-5">
                  <small>
                    <p>Login User <a href="../login.php" class="text-decoration-none">Login user</a></p>
                  </small>
                </div>

              </div>
            </div>
          </form>
          <!-- End form -->
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