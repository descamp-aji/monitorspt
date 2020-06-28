<?php 
		require 'function.php';
		
		$id=$_GET["id"];

		if(hapus($id) > 0) {
			echo "<script>
							alert('Data Berhasil Dihapus');
							document.location.href='selesai.php';
						</script>";
		} else {
			echo "<script>
							alert('Data Gagal Dihapus');
						</script>";
		}
?>