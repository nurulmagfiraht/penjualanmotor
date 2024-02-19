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

        <div class="row py-4 text-center">
            <div class="col-lg-12">
                <h3>DATA-DATA LAPORAN PENJUALAN</h3>
            </div>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="table-responsive">
                    <small>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="bg-success text-white">
                                    <th>No</th>
                                    <th>Pemesan</th>
                                    <th>Email</th>
                                    <th>Gambar</th>
                                    <th>Gula</th>
                                    <th>Harga</th>
                                    <th>tanggal pesanan</th>
                                    <th>Jumlah pesan</th>
                                    <th>Total harga</th>
                                    <th>No. Handphone</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <?php
                                $no = 1;
                                $pesanan = mysqli_query($con, "SELECT * FROM tb_pesanan
                            LEFT JOIN tb_gula ON tb_pesanan.id_gula = tb_gula.id_gula
                            LEFT JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user
                            WHERE status = '1'
                            ");
                                if (mysqli_num_rows($pesanan) > 0) {
                                    while ($row = mysqli_fetch_array($pesanan)) {
                                ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $row['nama_panggilan'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><a href="img/<?php echo $row['gambar'] ?>" target="_blank"> <img src="img/<?php echo $row['gambar'] ?>" width="100"></a></td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td>Rp. <?php echo number_format($row['harga']) ?></td>
                                            <td><?php echo $row['tanggal_pesanan'] ?></td>
                                            <td><?php echo $row['jumlah_pesan'] ?></td>
                                            <td>Rp. <?php echo number_format($row['total_harga']) ?></td>
                                            <td><?php echo $row['no_handphone'] ?></td>
                                            <td><?php echo $row['alamat_lengkap'] ?></td>
                                            <td>
                                                <a href="hapus_pesanan.php?id_pesanan=<?php echo $row['id_pesanan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('YAKIN INGIN HAPUS DATA PESANAN?')">Delete</a>
                                            </td>

                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="11" class="text-danger">Tidak ada data laporan penjualan</td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                            </tbody>
                        </table>
                    </small>
                </div>
            </div>
        </div>
        <!-- End table -->

    </div>

    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>