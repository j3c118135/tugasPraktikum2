<?php
include('koneksi.php');

if(isset($_GET['id'])){
	$id = $_GET['id'];
	
	$cek = mysqli_query($kon, "SELECT * FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));
	
	if(mysqli_num_rows($cek) > 0){
		$del = mysqli_query($kon, "DELETE FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));
		if($del){
			$brs=mysqli_fetch_assoc($cek);
			unlink("file/$brs[nama_file]");
			echo '<script>alert("Berhasil menghapus data."); document.location="index.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="index.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="index.php";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="index.php";</script>';
}

?>