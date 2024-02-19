<?php
session_start();
 include 'koneksi.php';
 if(!isset($_SESSION['login'])){
   header('Location: login.php');
 }

$id_user = $_SESSION['a_global']->id_user;
$user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = '$id_user' ");
$usr = mysqli_fetch_array($user);

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

      <div class="row text-center">
        <div class="col-lg-6 offset-lg-3 mt-5 mb-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>My Profile <?php echo $_SESSION['a_global']->nama_panggilan ?></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tale-striped">
                            <tbody>
                                <tr>
                                    <td>Nama panggilan</td>
                                    <td>:</td>
                                    <td><?php echo $usr['nama_panggilan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama lengkap</td>
                                    <td>:</td>
                                    <td><?php echo $usr['nama_lengkap'] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?php echo $usr['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?php echo $usr['email'] ?></td>
                                </tr>
                            </tbody>
                        </table>
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