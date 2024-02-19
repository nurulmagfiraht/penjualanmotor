<?php

	include '../koneksi.php';

	if(isset($_GET['id'])){
		$delete = mysqli_query($con, "DELETE FROM tb_pesanan WHERE id = '".$_GET['id']."' ");
		echo '<script>window.location="pesanan.php"</script>';
	}

?>