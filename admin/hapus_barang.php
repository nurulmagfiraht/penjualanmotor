<?php

include '../koneksi.php';

	if(isset($_GET['id'])){
		$produk = mysqli_query($con, "SELECT gambar FROM tb_produk WHERE id = '".$_GET['id']."'");
		$row = mysqli_fetch_array($produk);

		unlink('img/'.$row['gambar']);

		$delete = mysqli_query($con, "DELETE FROM tb_produk WHERE id = '".$_GET['id']."' ");
		echo '<script>window.location="barang.php"</script>';
	}

?>