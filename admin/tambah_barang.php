<?php
// cek jika belom login
session_start();
include '../koneksi.php';
if (!isset($_SESSION['login'])) {
    header("Location: admin_login.php");
    exit;
}


// Proses tamabh data produk
if (isset($_POST['submit'])) {

    // print_r($_FILES['gambar']);
    // menampung inputan dari form
    $nama     = $_POST['nama'];
    $harga          = $_POST['harga'];
    $stock         = $_POST['stock'];
    $jenis_produk = $_POST['jenis_produk'];
    $tanggal = $_POST['tanggal'];
    // menampung data file yang diupload
    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    $type1 = explode('.', $filename);
    $type2 = $type1[1];

    $newname = 'produk' . time() . '.' . $type2;

    // menampung data format data yang diizinkan
    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'JPG', 'gif');

    // validasi format file
    if (!in_array($type2, $tipe_diizinkan)) {
        // jika format file tidak ada di dalam tipe diizinkan
        echo '<script>alert("Format file tidak diizinkan")</script>';
    } else {
        // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
        // proses upload file sekaligus insert ke databse
        move_uploaded_file($tmp_name, './img/' . $newname);

        $insert = mysqli_query($con, 
            "INSERT INTO tb_produk 
            VALUES(0, '$nama', '$harga', '$stock', '$jenis_produk', '$newname', '$tanggal')"
        );

        if ($insert) {
            echo '<script>alert("Tambah data barang success")</script>';
            echo '<script>window.location="barang.php"</script>';
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
                    <h3>FORM TAMBAH DATA BARANG</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2 mb-4">
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama barang</label>
                            <input type="text" class="form-control" name="nama" autofocus id="nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga barang</label>
                            <input type="number" class="form-control" name="harga" id="harga" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock barang</label>
                            <input type="number" class="form-control" name="stock" id="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_produk" class="form-label">Jenis barang</label>
                            <input type="text" class="form-control" name="jenis_produk" autofocus id="jenis_produk" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Gambar barang</label>
                            <input type="file" class="form-control" name="gambar" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" autofocus id="tanggal" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-50" name="submit">SUBMIT</button>
                            <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                        </div>

                    </form>
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