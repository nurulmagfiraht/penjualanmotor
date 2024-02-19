<?php 
// cek jika belom login
session_start();
include '../koneksi.php';
if(!isset($_SESSION['login']))
{
    header("Location: admin_login.php");
    exit();
}
if(isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])){
  $tanggal_awal = $_GET['tanggal_awal'];
  $tanggal_akhir = $_GET['tanggal_akhir'];
  $no = 1;
  $gula = mysqli_query($con, "SELECT * FROM tb_produk WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' 
  ");
}

?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>DASHBOADR ADMIN</title>

    <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <sc>


    <div class="container-fluid">
      <div class="row">

        <div class="row py-3 text-center">
          <div class="col-lg-12">
            <h3>DATA BARANG</h3>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="table-responisve">
              <table class="table table-sm table-bordered table-success">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama barang</th>
                    <th>Harga barang</th>
                    <th>Stock barang</th>
                    <th>Jenis barang</th>
                    <th>Gambar barang</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                
                if(mysqli_num_rows($gula) > 0){
                  while($data = mysqli_fetch_array($gula)){
                ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td>Rp. <?php echo number_format($data['harga']) ?></td>
                    <td><?php echo $data['stock'] ?></td>
                    <td><?php echo $data['jenis_produk'] ?></td>
                    <td><a href="img/<?php echo $data['gambar'] ?>" target="_blank"> <img
                          src="img/<?php echo $data['gambar'] ?>" width="50"> </a></td>
                    <td><?php echo $data['tanggal'] ?></td>
                  </tr>
                  <?php }}else{
                  $gula = mysqli_query($con, "SELECT * FROM tb_produk"); 
                  while($data = mysqli_fetch_array($gula)){
                    ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td>Rp. <?php echo number_format($data['harga']) ?></td>
                    <td><?php echo $data['stock'] ?></td>
                    <td><?php echo $data['jenis_produk'] ?></td>
                    <td><a href="img/<?php echo $data['gambar'] ?>" target="_blank"> <img
                          src="img/<?php echo $data['gambar'] ?>" width="50"> </a></td>
                    <td><?php echo $data['tanggal'] ?></td>
                  </tr>
                  <?php
        }
    }
    ?></tbody>
              </table>

              <script>
                window.print();
              </script>

            </div>
          </div>
        </div>
      </div>
    </div>
    </body>

    </html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
      integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="js/dashboard.js"></script>