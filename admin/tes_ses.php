<?php

include '../koneksi.php';

$pesanan = mysqli_query($con, "SELECT jumlah_pesan as jumlah, YEAR(tanggal_pesanan) as tahun, 
                                MONTH(tanggal_pesanan) as bulan FROM tb_pesanan WHERE id_produk = 11 
                                GROUP BY YEAR(tanggal_pesanan), MONTH(tanggal_pesanan) ORDER BY tanggal_pesanan DESC LIMIT 12");

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

var_dump($dataramal);

?>