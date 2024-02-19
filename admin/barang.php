<?php
// cek jika belom login
session_start();
include '../koneksi.php';
if (!isset($_SESSION['login'])) {
    header("Location: admin_login.php");
    exit;
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DASHBOADR ADMIN</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'navbar.php';
    ?>

    <div class="container-fluid bg-light">
        <div class="container">

            <div class="row py-4 text-center">
                <div class="col-lg-12">
                    <h3>Data Alat-Alat Motor Kawasaki</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <a href="tambah_barang.php" class="btn btn-success btn-sm">Tambah data Barang</a>
                </div>

                    <div class="col-lg-2 mb-3">
                        <form action="" method="POST">
                            <label for="" class="form-label">Tanggal awal</label>
                            <input type="date" name="tanggal_awal" class="form-control">
                            <label for="" class="form-label">Tanggal akhir</label>
                            <input type="date" name="tanggal_akhir" class="form-control">
                            <button type="submit" name="submit" class=" btn btn-warning btn-sm mt-3">Filter</button>

                        </form>

                    </div>

                </div>

            <!-- Table -->
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="bg-success text-white">
                                    <th>No</th>
                                    <th>Nama barang</th>
                                    <th>Harga barang</th>
                                    <th>Stock barang</th>
                                    <th>Jenis barang</th>
                                    <th>Gambar barang</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (isset($_POST['submit'])) {
                                    $tanggal_awal = mysqli_real_escape_string($con, $_POST['tanggal_awal']);
                                    $tanggal_akhir = mysqli_real_escape_string($con, $_POST['tanggal_akhir']);
                                    $produk = mysqli_query($con, "SELECT * FROM tb_produk WHERE
                                tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
                                } else {
                                    $produk = mysqli_query($con, "SELECT * FROM tb_produk");
                                }

                                if (mysqli_num_rows($produk) > 0) {
                                    while ($data = mysqli_fetch_array($produk)) {
                                ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data['nama'] ?></td>
                                            <td>Rp. <?php echo number_format($data['harga']) ?></td>
                                            <td><?php echo $data['stock'] ?></td>
                                            <td><?php echo $data['jenis_produk'] ?></td>
                                            <td><a href="img/<?php echo $data['gambar'] ?>" target="_blank"> <img src="img/<?php echo $data['gambar'] ?>" width="50"> </a></td>
                                            <td><?php echo $data['tanggal'] ?></td>
                                            <td>
                                                <a href="ubah_barang.php?id=<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Ubah</a>
                                                <a href="hapus_barang.php?id=<?php echo $data['id'] ?>" onclick="return confirm('Yakin ingin hapus data gula?')" class="btn btn-danger btn-sm">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="8" class="text-danger">Belum ada data barang!</td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                        <a class=" btn btn-warning btn-sm mt-3" href="print.php?tanggal_awal=<?php echo $tanggal_awal ?>&tanggal_akhir=<?php echo $tanggal_akhir ?>" target="_blank">CETAK DATA BARANG</a>
                    </div>
                </div>
            </div>
            <!-- End table -->

        </div>
    </div>

    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>