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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'navbar.php';
    ?>

    <div class="container-fluid bg-light">
        <div class="container">

            <div class="row py-4 text-center">
                <div class="col-lg-12">
                    <h3>DATA-DATA PELANGGAN</h3>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-lg-12 mb-4">
                    <a href="tambah_gula.php" class="btn btn-success btn-sm">Tambah data gula</a>
                </div>

                <div class="col-lg-2 mb-3">
                    <form action="print.php" method="get">
                        <label for="" class="form-label">Tanggal awal</label>
                        <input type="date" name="tanggal_awal" class="form-control">
                        <label for="" class="form-label">Tanggal akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control">
                        <button type="submit" name="submit" class=" btn btn-warning btn-sm mt-3">Print</button>
                    </form>
                </div>

            </div> -->

            <!-- Table -->
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="bg-success text-white">
                                    <th>No</th>
                                    <th>Nama panggilan</th>
                                    <th>Nama lengkap</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $user = mysqli_query($con, "SELECT * FROM tb_user");
                                if (mysqli_num_rows($user) > 0) {
                                    while ($data = mysqli_fetch_array($user)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no++ ?>
                                            </td>
                                            <td>
                                                <?php echo $data['nama_panggilan'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data['nama_lengkap'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data['alamat'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data['email'] ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="8" class="text-danger">Belum ada data pelanggan!</td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End table -->

        </div>
    </div>

    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>