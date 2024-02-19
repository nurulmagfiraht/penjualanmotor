<?php
					if(isset($_POST['submit'])){
                        include 'koneksi.php';

						$nama_panggilan 		= $_POST['nama_panggilan'];
						$nama_lengkap 		= $_POST['nama_lengkap'];
                        $alamat 		= $_POST['alamat'];
						$email 		= $_POST['email'];
						$password 		= $_POST['password'];

                        $insert = mysqli_query($con, "INSERT INTO tb_user VALUES (
                            '',
                            '".$nama_panggilan."',
                            '".$nama_lengkap."',
                            '".$alamat."',
                            '".$email."',
                            '".$password."'
                                )");


							if($insert){
								echo '<script>alert("Registrasi success!")</script>';
								echo '<script>window.location="login.php"</script>';
							}else{
								echo 'Gagal'.mysqli_error($con);
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
    <link rel="stylesheet" href="css/style.css">
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
            <form action="proses.php" method="post">
            <div class="card p-3">
              <div class="card-header">
                  <h3 class="text-center">FORM REGISTRATION USER</h3>
              </div>
              <div class="car-body p-5">

                <div class="mb-2">
                  <div class="form-label">Nama panggilan</div>
                  <input type="text" class="form-control form-control-lg" name="nama_panggilan" autofocus id="nama_panggilan">
                </div>

                <div class="mb-2">
                  <div class="form-label">Nama Lengkap</div>
                  <input type="text" class="form-control form-control-lg" name="nama_lengkap" autofocus id="nama_lengkap">
                </div>

                <div class="mb-2">
                  <div class="form-label">Alamat</div>
                  <input type="text" class="form-control form-control-lg" name="alamat" autofocus id="alamat">
                </div>

                <div class="mb-2">
                  <div class="form-label">Email</div>
                  <input type="email" class="form-control form-control-lg" name="email" autofocus id="email">
                </div>

                <div class="mb-3">
                  <div class="form-label">Password</div>
                  <input type="password" class="form-control form-control-lg" name="password" autofocus id="password">
                </div>

                <div class="mb-3">
                <button class="btn btn-primary btn-lg w-100" type="submit" name="submit">REGISTRATION</button>
                </div>

                <div class="text-center mt-5">
                <small><p>already have an account? <a href="login.php" class="text-decoration-none">Login</a></p></small>
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