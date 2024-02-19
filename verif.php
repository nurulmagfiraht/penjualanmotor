<?php
$code = $_GET['code'];

include 'koneksi.php';

if(isset($code)){
    $qry = $con->query("SELECT * FROM tb_user WHERE verifikasi_code = '$code'");
    $result = $qry->fetch_assoc();

    if($result) { // Memastikan ada hasil dari kueri SELECT
        $id = $result['id_user']; // Mengambil nilai ID dari hasil kueri

        $con->query("UPDATE tb_user SET is_verif=1 WHERE id_user='$id'");
        echo "<script>alert('Verifikasi Berhasil, Login Sudah');window.location='login.php'</script>";
    } else {
        echo "<script>alert('Kode Verifikasi tidak valid');window.location='login.php'</script>";
    }
}