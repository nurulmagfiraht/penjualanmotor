<?php
session_start();
 include 'koneksi.php';
 if(!isset($_SESSION['login'])){
   header('Location: login.php');
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
        <div class="col-lg-12 mt-5">
            <h3>Motor dan Alat-Alat Motor yang Tersedia</h3>
        </div>
      </div>

      <div class="row gx-0 mt-5">
            <?php 
							$no = 1;
							$gula = mysqli_query($con, "SELECT * FROM tb_gula
                            ");
							if(mysqli_num_rows($gula) > 0){
							while($row = mysqli_fetch_array($gula)){
				?>
                <div class="col-4 mb-5">
                <div class="card mb-3"  style="width: 18rem;" data-aos="flip-left"  data-aos-duration="2000">
                <img src="admin/img/<?php echo $row['gambar'] ?>" class="card-img-top" height="200">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nama'] ?></h5>
                    <p class="card-text">Harga : Rp. <?php echo number_format($row['harga']) ?></p>
                    <p class="card-text">Stock : <?php echo $row['stock'] ?></p>
                    <p class="card-text">Jenis motor: <?php echo $row['jenis_gula'] ?></p>
                    <div class="py-1">
                        <a href="pesanan.php?id_gula=<?php echo $row['id_gula'] ?>" class="btn btn-success">Pesan Sekarang</a>
                    </div>
                
                </div>
                </div>
                </div>
                <?php }}else{ ?>
							<tr>
								<td colspan="8" class="text-danger">Tidak ada data motor</td>
							</tr>

				<?php } ?>
            </div>

</div>
    </div>

    
<?php 
    include 'footer.php';
?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>