<?php 
// KONEKSI KE DATABASE DBMONITOR SPT
	$conn = mysqli_connect("localhost", "root", "", "dbmonitorspt"); // koneksi Ke database
	
	function query($query){
		global $conn;
		$result = mysqli_query($conn,$query); //Menampilkan Table didalam Database
		$rows = []; //menyimpan data dalam array kosong
		while ($row = mysqli_fetch_assoc($result)){ //mengeluarkan isi data dari dalam array
			$rows []= $row;
		}
		return $rows;
	}
// MEMBUAT FUNCTION TAMBAH DATA KE DATABASE
	function input($data){
		global $conn;
		// menangkap data dari $_POST
		$npwp = $data["npwp"];
		$namaWP = htmlspecialchars(strtoupper($data["namaWP"]));
		$jenisWP = $data["jenisWP"];
		$pengembalian = $data["pengembalian"];
		$masapajak = $data["masapajak"];
		$tahunpajak = $data["tahunpajak"];
		$nominalLB = number_format($data["nominalLB"],'0',',','.');
		$saluran = $data["saluran"];
		$statusspt = $data["statusspt"];
		$tanggalspt = $data["tanggalspt"];
		$ndply = $data["ndply"];
		$seksi = $data["seksi"];
		$tanggalndply = $data["tanggalndply"];
		$kode_riksa = $data["kode_riksa"];
		$id_pemeriksaan = "".$npwp.$masapajak.$tahunpajak.$kode_riksa;

		$masukin = "INSERT INTO dbsptnd VALUES 
		('','$id_pemeriksaan','$npwp','$namaWP','$jenisWP','$pengembalian','$masapajak','$tahunpajak','$statusspt','$nominalLB','$saluran','$tanggalspt','$ndply','$seksi','$tanggalndply','Pelayanan','$ndply','$tanggalndply','','BELUM')";
		if (strlen($npwp) != 15) {
			echo "<script>
							alert('Data Gagal ditambahkan, NPWP harus 15 karakter')
						</script>";
			return false;
		}
		$cek_data = mysqli_query($conn, "SELECT * FROM dbsptnd WHERE id_pemeriksaan = '$id_pemeriksaan'");
		if (mysqli_num_rows($cek_data) === 1){
			echo "<script>
							alert('Data SPT Sudah Pernah diinput, Cek Kembali !!')
						</script>";
			return false;
		}
		mysqli_query($conn,$masukin);
		return mysqli_affected_rows($conn);

	}
	//MEMBUAT FUNGSI TERIMA
	function terima($terimaspt) {
		global $conn;
		$id = $terimaspt["id"];
		$seksipenerima = $terimaspt["seksipenerima"];
		$ndwaskon = htmlspecialchars(strtoupper($terimaspt["ndwaskon"]));
		$seksi2 = $terimaspt["seksi2"];
		$tglndwk = $terimaspt["tanggalndwk"];

		$terima = " UPDATE dbsptnd SET
								seksi = '$seksipenerima',
								ndwaskon = '$ndwaskon',
								seksi2 = '$seksi2',
								tanggalndwk = '$tglndwk' WHERE id=$id";
		mysqli_query($conn,$terima);
		return mysqli_affected_rows($conn);
	}
	//MEMBUAT FUNGSI EDIT
	function edit($databaru) {
		global $conn;
		$id = $databaru["id"];
		$npwp_baru = $databaru["npwp"];
		$namaWP_baru= htmlspecialchars(strtoupper($databaru["namaWP"]));
		$jenisWP_baru = $databaru["jeniswp"];
		$pengembalian_baru = $databaru["pengembalian"];
		$masapajak_baru = $databaru["masapajak"];
		$tahunpajak_baru = $databaru["tahunpajak"];
		$nominalLB_baru = number_format($databaru["nominalLB"],'0',',','.');
		$saluran_baru = $databaru["saluran"];
		$statusspt_baru = $databaru["statusspt"];
		$tglspt_baru = $databaru["tanggalspt"];
		$ndply_baru = htmlspecialchars(strtoupper($databaru["ndply"]));
		$seksi_baru = $databaru["seksi"];
		$tanggalndply_baru = $databaru["tanggalndply"];

		$edit = " UPDATE dbsptnd SET 
								npwp ='$npwp_baru',
								namaWP = '$namaWP_baru',
								jeniswp = '$jenisWP_baru',
								pengembalian = '$pengembalian_baru',
								masapajak = '$masapajak_baru',
								tahunpajak = '$tahunpajak_baru',
								statusspt = '$statusspt_baru',
								nominalLB = '$nominalLB_baru',
								saluran = '$saluran_baru',
								tanggalspt = '$tglspt_baru',
								ndply = '$ndply_baru',
								seksi = '$seksi_baru',
								tanggalndply = '$tanggalndply_baru' WHERE id=$id";
		mysqli_query($conn,$edit);
		return mysqli_affected_rows($conn);
	}
	//MEMBUAT FUNGSI UPDATE DI PMR
	function edit_pmr($data_pmr) {
		global $conn;
		$id = $data_pmr["id"];
		$npwp_pmr = $data_pmr["npwp"];
		$namaWP_pmr= htmlspecialchars(strtoupper($data_pmr["namaWP"]));
		$jenisWP_pmr = $data_pmr["jeniswp"];
		$pengembalian_pmr = $data_pmr["pengembalian"];
		$masapajak_pmr = $data_pmr["masapajak"];
		$tahunpajak_pmr = $data_pmr["tahunpajak"];
		$nominalLB_pmr = number_format($data_pmr["nominalLB"],'0',',','.');
		$saluran_pmr = $data_pmr["saluran"];
		$statusspt_pmr = $data_pmr["statusspt"];
		$tglspt_pmr = $data_pmr["tanggalspt"];
		$ndwaskon_pmr = htmlspecialchars(strtoupper($data_pmr["ndwaskon"]));
		$seksi2_pmr = $data_pmr["seksi2"];
		$tanggalndwk_pmr = $data_pmr["tanggalndwk"];

		$edit = " UPDATE dbsptnd SET 
								npwp ='$npwp_pmr',
								namaWP = '$namaWP_pmr',
								jeniswp = '$jenisWP_pmr',
								pengembalian = '$pengembalian_pmr',
								masapajak = '$masapajak_pmr',
								tahunpajak = '$tahunpajak_pmr',
								statusspt = '$statusspt_pmr',
								nominalLB = '$nominalLB_pmr',
								saluran = '$saluran_pmr',
								tanggalspt = '$tglspt_pmr',
								ndwaskon = '$ndwaskon_pmr',
								seksi2 = '$seksi2_pmr',
								tanggalndwk = '$tanggalndwk_pmr' WHERE id=$id";

		mysqli_query($conn,$edit);
		return mysqli_affected_rows($conn);
	}
	//MEMBUAT FUNGSI HAPUS
	function hapus($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM dbsptnd WHERE id=$id");
		return mysqli_affected_rows($conn);
	}
	//MEMBUAT FUNGSI PENCARIAN di seksi pemeriksaan
	function cari ($data_search){
		global $conn;
		$keyword = $data_search["keyword"];
		$query= "SELECT * FROM dbsptnd WHERE seksi='Pemeriksaan' AND status_riksa LIKE '%$keyword%' OR npwp LIKE '%$keyword%' ORDER BY tanggalspt";
		return query($query);

	}
	//MEMBUAT FUNGSI PENCARIAN di seksi Selesai
	function cari3 ($data_search3){
		global $conn;
		$keyword = $data_search3["keyword"];
		$kosong = [];
		if(strlen($keyword) < 6){
			return $kosong;
		}
		$query= "SELECT * FROM dbsptnd WHERE seksi='Selesai' AND namawp LIKE '%$keyword%' OR npwp LIKE '%$keyword%'";
		return query($query);

	}
	//MEMBUAT FUNGSI PENCARIAN DI SEKSI WASKON EKSTEN
	function cari2 ($data_search2){
		global $conn;
		$keyword = strtolower($data_search2["keyword"]);
		if($keyword === 'pemeriksaan'){
			$keyword = 'descamp';
		}
		$query= "SELECT * FROM dbsptnd WHERE seksi NOT IN ('Pemeriksaan', 'Selesai') AND npwp LIKE '%$keyword%' OR seksi LIKE '$keyword' ORDER BY tanggalndply";
		return query($query);
	}
	// MEMBUAT FUNGSI SELESAI
	function selesai($selesai){
		global $conn;
		$proses_selesai = $selesai["proses"];
		$id = $selesai["selesai_id"];
		$ket_selesai =strtoupper($selesai["alasan_selesai"]);

		$selesaikan = "UPDATE dbsptnd SET seksi = '$proses_selesai', ket_selesai = '$ket_selesai' WHERE id =$id";
		mysqli_query($conn, $selesaikan);
		return mysqli_affected_rows($conn);
	}
	// MEMBUAT FUNGSI INPUT DATA PEMERIKSA
	function input_pemeriksa($data_pmr){
		global $conn;
		$id = $data_pmr["id_pemeriksa"];
		$kelompok = $data_pmr["kelompok"];
		$spv = $data_pmr["spv"];
		$ketua_tim = $data_pmr["ketua_tim"];
		$anggota_1 = htmlspecialchars(strtoupper($data_pmr["anggota_1"]));
		$anggota_2 = htmlspecialchars(strtoupper($data_pmr["anggota_2"]));
		$kode_riksa = $data_pmr["kode_riksa"];
		$no_sp2 = $data_pmr["no_sp2"];
		$tgl_sp2 = $data_pmr["tgl_sp2"];
		if(empty($anggota_2)){
			$anggota_2='-';
		}
		$insert_dataPemeriksa = "INSERT INTO dbpemeriksa VALUES ('$id','$kelompok','$spv','$ketua_tim','$anggota_1','$anggota_2','$no_sp2','$tgl_sp2','$kode_riksa')";
		mysqli_query($conn, $insert_dataPemeriksa);
		$update_kelompok = "UPDATE dbsptnd SET status_riksa = '$kelompok' WHERE id=$id";
		mysqli_query($conn,$update_kelompok);
		return mysqli_affected_rows($conn);
	}
	//MEMBUAT FUNCTION EDIT DATA PEMERIKSA
	function edit_pemeriksa($data_edit){
		global $conn;
		$id = $data_edit["id_pemeriksa"];
		$kelompok = $data_edit["kelompok"];
		$spv = $data_edit["spv"];
		$ketua_tim = $data_edit["ketua_tim"];
		$anggota_1 = htmlspecialchars(strtoupper($data_edit["anggota_1"]));
		$anggota_2 = htmlspecialchars(strtoupper($data_edit["anggota_2"]));
		$no_sp2 = $data_edit["no_sp2"];
		$tgl_sp2 = $data_edit["tgl_sp2"];
		if(empty($anggota_2)){
			$anggota_2='-';
		}
		$upd_pemeriksa = "UPDATE dbpemeriksa SET 
												kelompok='$kelompok',
												nama_spv='$spv',
												nama_ketua='$ketua_tim',
												nama_anggota1='$anggota_1',
												nama_anggota2='$anggota_2',
												no_sp2='$no_sp2',
												tgl_sp2='$tgl_sp2' WHERE id=$id";
		$upd_dbsptnd = "UPDATE dbsptnd SET status_riksa = '$kelompok' WHERE id = $id";
		mysqli_query($conn,$upd_dbsptnd);
		mysqli_query($conn,$upd_pemeriksa);
		return mysqli_affected_rows($conn);
	}
?>