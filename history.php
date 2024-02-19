<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

$id_user = $_SESSION['a_global']->id_user;
$user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = '$id_user'");
$usr = mysqli_fetch_array($user);

// Proses CheckOut
if (isset($_POST['submit'])) {
    $status = $_POST['status'];

    $update = mysqli_query($con, "UPDATE tb_pesanan SET 
                            status = '" . $status . "'
                            WHERE id_pesanan = '" . $_POST['id_pesanan'] . "' ");

    if ($update) {
        echo '<script>alert("CHECKOUT SUCCESS")</script>';
        echo '<script>window.location=""</script>';
    } else {
        echo 'Gagal' . mysqli_error($conn);
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
                    <h3>History pemesanan motor<?php echo $_SESSION['a_global']->nama_panggilan ?></h3>
                </div>
            </div>

            <div class="row">
                <?php
                $id_user = $_SESSION['a_global']->id_user;
                $hstory = mysqli_query($con, "SELECT * FROM tb_pesanan
                            LEFT JOIN tb_gula ON tb_pesanan.id_gula = tb_gula.id_gula
                            WHERE id_user  = '$id_user'
                            ");
                if (mysqli_num_rows($hstory) > 0) {
                    while ($his = mysqli_fetch_array($hstory)) {
                ?>
                        <div class="col-lg-6 mb-5">
                            <div class="card p-5">
                                <img src="admin/img/<?php echo $his['gambar'] ?>" alt="" height="200">
                                <small class="d-block"><?php echo $his['nama'] ?></small>
                                <small class="d-block">Harga : Rp. <?php echo number_format($his['harga']) ?></small>
                                <small class="d-block"> Tanggal Pesanan : <?php echo $his['tanggal_pesanan'] ?></small>
                                <small class="d-block">Jumlah Pesan : <?php echo $his['jumlah_pesan'] ?></small>
                                <small class="d-block">No. Handphone : <?php echo $his['no_handphone'] ?></small>
                                <small class="d-block">Total Harga : Rp. <?php echo number_format($his['total_harga']) ?></small>
                                <small class="d-block">Alamat : <?php echo $his['alamat_lengkap'] ?></small>
                                <strong class="d-block mt-3">
                                    <p>Keterangan : </p>
                                </strong>
                                <?php if ($his['status'] == '0') { ?>
                                    <strong>
                                        <p class="text-danger d-block">Pesanan Belum Di Checkout!</p>
                                    </strong>
                                <?php } else { ?>
                                    <strong>
                                        <p class="text-success d-block">Pesanan Sudah Di Checkout!</p>
                                    </strong>
                                <?php } ?>
                                <?php if ($his['status'] == '0') { ?>
<!-- Form CheckOut -->
                                    <form action="" method="post">
                                        <input type="hidden" name="id_pesanan" value="<?php echo $his['id_pesanan'] ?>">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" name="submit" class="btn btn-success" onclick="return confirm('YAKIN INGIN CHECKOUT?')">CHECKOUT</button>
                                    </form>
                                    <hr>
                                    <br><br><br>
                                    <!-- End Form -->
                                <?php } else { ?>
                                    <strong>
                                        <p class="text-success d-block">Anda Sudah checkout!</p>
                                    </strong>
                                    <div class="mb-1">
                                        <p>Anda berhasil melakukan checkout pemesanan gula aren, Untuk tahap berikutnya silahkan lakukan pembayaran secara COD pada saat menerima barang sebesar : <strong>Rp. <?php echo number_format($his['total_harga']) ?></strong></p>
                                    </div>

                                    <hr>
                                    <br><br><br>
                                <?php } ?>
                            </div>
                        </div>
                <?php
                    }
                } else {
                ?>
                    <div class="col-lg-12">
                        <center>
                            <p class="text-danger d-block">Anda belum memiliki history pemesanan!</p>
                        </center>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

