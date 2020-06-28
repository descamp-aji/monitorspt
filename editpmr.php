<?php 
require 'function.php';

$id= $_GET["id"];
$dataedit = query("SELECT * FROM dbsptnd WHERE id= $id")[0];

if(isset($_POST["edit"])) {
	if(edit_pmr($_POST)>0){
		echo "<script>
						alert('Data Berhasil diubah');
						document.location.href= 'pemeriksaan.php';
					</script>";
	} else {
		echo mysqli_error($conn);die;
		echo "<script>
						alert('Data Gagal diubah')
					</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
			<link rel="icon" type="icon/x-image" href="img\search-solid.svg">
			<title>Ubah Data</title>
	</head>
	<body>
	<!--Navigasi Bar-->
		<nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-lg navbar-light bg-light">
			<div class = "container page-scroll">
				<a class="navbar-brand" href="#">Monitor SPT LB</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!--Formulir Input data-->
    <div class = "container ">
			<div class="row text-center pt-3 mb-2 mt-5">
				<div class="col">
          <h2>FORM UBAH DATA</h2>
        </div>
			</div>
			<div class="row text-center mb-2">
				<div class="col">
          <h5>Input Perubahan Data SPT</h5>
        </div>
			</div>
			<div class = "row justify-content-center mb-3">
				<div class = "col-sm-6">
					<form action="" method="POST">
						<input type="hidden" name=id value="<?=$dataedit["id"]?>">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="npwp">NPWP</label>
								<input type="text" name ="npwp"class="form-control" onkeypress="return event.charCode >=48 && event.charCode <=57" id="npwp" value = "<?=$dataedit["npwp"]?>" required autocomplete="off">
							</div>
							<div class="form-group col-md-5">
								<label for="namaWP">Nama Wajib Pajak</label>
								<input type="text" name="namaWP"class="form-control" id="namaWP" value = "<?=$dataedit["namawp"]?>"required autocomplete="off">
							</div>
							<div class="form-group col-md-3">
								<label for="jeniswp">Jenis WP</label>
								<select id="jeniswp" name="jeniswp"class="form-control" value>
									<option selected><?=$dataedit["jeniswp"]?></option>
									<option >Badan</option>
									<option >Orang Pribadi</option>
								</select>
							</div>
						</div>
						<div class="form-row">
						<div class="form-group col-md-6">
								<label for="pengembalian">Pilihan Pengembalian</label>
								<select id="pengembalian" name="pengembalian" class="form-control">
									<option selected><?=$dataedit["pengembalian"]?></option>
									<option>Restitusi</option>
									<option>Kompensasi</option>
									<option>Pendahuluan</option>
									<option>Tidak Memilih</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="masapajak"><b>Masa Pajak*</b></label>
								<select id="masapajak" name="masapajak"class="form-control">
									<option selected><?=$dataedit["masapajak"]?></option>
									<option>Tahunan</option>
									<option>Januari</option>
									<option>Februari</option>
									<option>Maret</option>
									<option>April</option>
									<option>Mei</option>
									<option>Juni</option>
									<option>Juli</option>
									<option>Agustus</option>
									<option>September</option>
									<option>Oktober</option>
									<option>November</option>
									<option>Desember</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="tahunpajak">Tahun Pajak</label>
								<select id="tahunpajak" name="tahunpajak"class="form-control">
									<option selected><?=$dataedit["tahunpajak"]?></option>
									<option>2020</option>
									<option>2019</option>
									<option>2018</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="nominalLB">Nominal LB</label>
								<input type="text" class="form-control" onkeypress="return event.charCode >=48 && event.charCode <=57" name="nominalLB" id="nominalLB" value ="<?=preg_replace("/[^0-9]/","",$dataedit["nominalLB"]);?>" autocomplete="off" required>
							</div>
							<div class="form-group col-md-2">
								<label for="saluran">Saluran</label>
								<select id="saluran" name="saluran" class="form-control">
									<option selected><?=$dataedit["saluran"]?></option>
									<option>E-filling</option>
									<option>Manual</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="statusspt">Status SPT</label>
								<select id="statusspt" name="statusspt" class="form-control">
									<option selected><?=$dataedit["statusspt"]?></option>
									<option>Normal</option>
									<option>Pemb-1</option>
									<option>Pemb-2</option>
									<option>Pemb-3</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="tanggalspt">TGL SPT</label>
								<?php 
									$tglinput = $dataedit["tanggalspt"];
								?>
								<input type="date" class="form-control" name="tanggalspt" id="tanggalspt" value = "<?=$tglinput?>">
							</div>
						</div>
						<div class="row mb-1">
							<div class="col">
								<p><b>*Pilih jika SPT Masa</b></p>
							</div>
						</div>
						<div class="row text-center mt-1 mb-1">
							<div class="col">
								<h5>Input Perubahan Data Nota Dinas</h5>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-5">
								<label for="ndwaskon">No. Nota Dinas</label>
								<input type="text" class="form-control" name="ndwaskon" id="ndwaskon" value="<?=$dataedit["ndwaskon"]?>">
							</div>
							<div class="form-group col-md-3">
								<label for="seksi2">Seksi Pengirim</label>
								<select name="seksi2" id="seksi2" class="form-control">
									<option selected><?=$dataedit["seksi2"]?></option>
									<option>Waskon 1</option>
									<option>Waskon 2</option>
									<option>Waskon 3</option>
									<option>Waskon 4</option>
									<option>Ekstensifikasi</option>
									<option>Pemeriksaan</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="tanggalndwk">TGL Nota Dinas</label>
								<?php 
									$tglinput = $dataedit["tanggalndwk"];
								?>
								<input type="date" class="form-control" name="tanggalndwk" id="tanggalndwk" value = "<?=$tglinput?>">
							</div>
						</div>
						<div class = "row text-center">
							<div class= "col">
								<button type="submit" name="edit"class="btn btn-success float-right">Ubah</button>
							</div>
							<div class= "col">
								<input class="btn btn-secondary float-left" type="button" value="Kembali" onclick="history.back(-1)"/>
							</div>
						</div>
					</form>
				</div>
			</div>
    </div>
		<div class="footer fixed-bottom text-center text-white bg-dark pt-3 pb-1 mt-2">
      <footer>
        <P>Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a href="#">Seksi Pemeriksaan-411</a></P>
      </footer>
    </div>
		<!--Optional Java script-->
    <script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>