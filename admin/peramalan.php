<?php
// cek jika belom login
session_start();
include '../koneksi.php';
if (!isset($_SESSION['login'])) {
    header("Location: admin_login.php");
    exit;
}

function queryPesanan($id, $con) {
    $pesanan = mysqli_query($con, "SELECT jumlah_pesan as jumlah, YEAR(tanggal_pesanan) as tahun, 
    MONTH(tanggal_pesanan) as bulan FROM tb_pesanan WHERE id_produk = $id
    GROUP BY YEAR(tanggal_pesanan), MONTH(tanggal_pesanan) ORDER BY tanggal_pesanan DESC LIMIT 24");

    return $pesanan;
}

function hitungDes($pesanan) {
    if (mysqli_num_rows($pesanan) < 3) {return [0];}

    $arrJumlahPesanan = [];
    $smoothing1 = [];
    $smoothing2 = [];
    $konstatnta = [];
    $slope = [];
    $alpha = [];
    $dataramal = [];

    while($row=mysqli_fetch_array($pesanan)){
        array_push($arrJumlahPesanan,$row['jumlah']); 
    }

    $dataramal = [0, $arrJumlahPesanan[0]];
    $smoothing1 = [0, $arrJumlahPesanan[0]];
    $smoothing2 = [0, $arrJumlahPesanan[0]];
    $konstatnta = [0, $arrJumlahPesanan[0]];
    $alpha = 0.9;
    $slope = [0, (($alpha/(1-$alpha))*($smoothing1[1]-$smoothing2[1]))];
    $dataramal = [0, [$konstatnta[1]+$slope[1]*1]];

    $hitungRamal = $arrJumlahPesanan[0];

    for($i=2;$i<=count($arrJumlahPesanan);$i++){
        $x1=$arrJumlahPesanan[$i-1];  //mendapatkan nilai penjualan bulan 3 dan seterusnya
        // smoothing sebelumnya
        $s1 = $smoothing1[$i-1];
        $s2 = $smoothing2[$i-1];

        // hitung smoothin 1
        $hitungSmoothing1 = ($x1*$alpha) + ((1-$alpha) * $s1);
        array_push($smoothing1, $hitungSmoothing1);
        
        // hitung smoothing 2
        $hitungSmoothing2 = ($hitungSmoothing1*$alpha) + ((1-$alpha) * $s2);
        array_push($smoothing2, $hitungSmoothing2);
        
        // hitung konstanta
        $hitungKonstanta = (2*$hitungSmoothing1) - $hitungSmoothing2;
        array_push($konstatnta, $hitungKonstanta);

        // hitung slope
        $hitungSlope = ($alpha/(1-$alpha))*($hitungSmoothing1-$hitungSmoothing2);
        array_push($slope, $hitungSlope);

        $hitungRamal= $hitungKonstanta + $hitungSlope; // perhitungan nilai peramalan bulan 3 dan seterusnya berdasarkan metode

        array_push($dataramal,$hitungRamal); //simpan data peramalan ke array
    }
    return $dataramal;
}


function hitungSes($pesanan) {
    if (mysqli_num_rows($pesanan) < 3) {return [0];}

    $arrJumlahPesanan = [];
    $alpha = 0.9;

    while($row=mysqli_fetch_array($pesanan)){
        array_push($arrJumlahPesanan,$row['jumlah']); 
    }
    $dataramal = [0, $arrJumlahPesanan[0]];
    $hitungRamal = $arrJumlahPesanan[0];

    for($i=2;$i<=count($arrJumlahPesanan);$i++){
        $x1=$arrJumlahPesanan[$i-1];  //mendapatkan nilai penjualan bulan 3 dan seterusnya
        $hitungRamal=$alpha*$x1+(1-$alpha)*$hitungRamal; // perhitungan nilai peramalan bulan 3 dan seterusnya berdasarkan metode
        array_push($dataramal,$hitungRamal); //simpan data peramalan ke array
    }
    return $dataramal;
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
                <h3>DATA-DATA PEERAMALAN</h3>
            </div>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-lg-6 mb-2">
                <div class="table-responsive">
                    <small>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="bg-success text-white">
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Gambar</th>
                                    <th>SES</th>
                                    <th>DES</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <?php
                                $no = 1;
                                $barang = mysqli_query($con, "SELECT * FROM tb_produk");
                                if (mysqli_num_rows($barang) > 0) {
                                    while ($row = mysqli_fetch_array($barang)) {
                                        $pesanan = queryPesanan($row['id'], $con);
                                        $dataramalSes = hitungSes($pesanan);
                                        $pesanan = queryPesanan($row['id'], $con);
                                        $dataramalDes = hitungDes($pesanan);
                                ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><a href="img/<?php echo $row['gambar'] ?>" target="_blank"> <img src="img/<?php echo $row['gambar'] ?>" width="100"></a></td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td>
                                                  <?= $dataramalSes[count($dataramalSes)-1] ?>
                                            </td>
                                            <td>
                                                  <?= $dataramalDes[count($dataramalDes)-1] ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="11" class="text-danger">Tidak ada data Pesanan</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </tbody>
                        </table>
                        
                    </small>
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