<?php
require 'function.php';


if(isset($_POST["submit"])){
	if (input($_POST) > 0) {
		echo "<script>
						alert ('Data Berhasil Ditambahkan');
						document.location.href='index.php';
					</script>";
	} else {
		echo mysqli_error ($conn);
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
			<title>Input Data</title>
	</head>
	<body>
	<!--Navigasi Bar-->
		<nav class="navbar fixed-top navbar-dark bg-danger navbar-expand-lg">
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
          <h3>FORM INPUT DATA</h3>
        </div>
			</div>
			<div class="row text-center mb-2">
				<div class="col">
          <h5>Input Data SPT</h5>
        </div>
			</div>
			<div class = "row justify-content-center mb-3">
				<div class = "col-sm-6">
					<form action ="" method = "post">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="npwp">NPWP</label>
								<input type="text" class="form-control" onkeypress="return event.charCode >=48 && event.charCode <=57" name = "npwp" id="npwp" placeholder= "NPWP 15 Digit"autocomplete="off" autofocus required>
							</div>
							<div class="form-group col-md-5">
								<label for="namaWP">Nama Wajib Pajak</label>
								<input type="text" class="form-control" name = "namaWP" id="namaWP" autocomplete="off" required>
							</div>
							<div class="form-group col-md-3">
								<label for="jenisWP">Jenis WP</label>
								<select id="JenisWP" name = "jenisWP" class="form-control">
									<option selected>Badan</option>
									<option selected>Orang Pribadi</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="pengembalian">Pengembalian</label>
								<select id="pengembalian" name = "pengembalian"class="form-control">
									<option selected>Restitusi</option>
									<option>Kompensasi</option>
									<option>Pendahuluan</option>
									<option>Tidak Memilih</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="kode_riksa">Kode Riksa</label>
								<input type="text" class="form-control" onkeypress="return event.charCode >=48 && event.charCode <=57" name = "kode_riksa" id="kode_riksa" placeholder= "Kode Riksa" required>
							</div>
							<div class="form-group col-md-3">
								<label for="masapajak"><b>Masa Pajak*</b></label>
								<select id="masapajak" name = "masapajak" class="form-control">
									<option selected>Tahunan</option>
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
								<select id="tahunpajak" name = "tahunpajak" class="form-control">
									<option selected>2020</option>
									<option>2019</option>
									<option>2018</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="nominalLB">Nominal LB</label>
								<input type="text" onkeypress="return event.charCode >=48 && event.charCode <=57" class="form-control" id="nominalLB" name = "nominalLB" autocomplete="off" placeholder="Number Only" required>
							</div>
							<div class="form-group col-md-2">
								<label for="saluran">Saluran</label>
								<select id="saluran"  name = "saluran" class="form-control">
									<option selected>E-filling</option>
									<option>Manual</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="statusspt">Status SPT</label>
								<select id="statusspt" name = "statusspt" class="form-control">
									<option selected>Normal</option>
									<option>Pemb-1</option>
									<option>Pemb-2</option>
									<option>Pemb-3</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="tanggalspt">TGL SPT</label>
								<input type="date" class="form-control" id="tanggalspt" name ="tanggalspt" value = "<?=date('Y-m-d')?>">
							</div>
						</div>
						<div class="row mb-1">
							<div class="col">
								<p><b>*Pilih jika SPT Masa</b></p>
							</div>
						</div>
						<div class="row text-center mt-1 mb-1">
							<div class="col">
								<h5>Input Data ND PLY</h5>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-5">
								<label for="ndply">No. ND PLY</label>
								<input type="text" class="form-control" id="ndply" name = "ndply" value="ND-/WPJ.08/KP.0303/2020">
							</div>
							<div class="form-group col-md-3">
								<label for="seksi">Seksi Tujuan</label>
								<select id="seksi" name = "seksi" class="form-control">
									<option selected>Waskon 1</option>
									<option>Waskon 2</option>
									<option>Waskon 3</option>
									<option>Waskon 4</option>
									<option>Ekstensifikasi</option>
									<option>Pemeriksaan</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="tanggalndply">TGL ND</label>
								<input type="date" class="form-control" id="tanggalndply" name = "tanggalndply" value = "<?=date('Y-m-d')?>">
							</div>
						</div>
						<div class = "row text-center">
							<div class= "col">
								<button type="submit" name = "submit" class="btn btn-danger float-right">Submit</button>
							</div>
							<div class= "col">
								<input class="btn btn-secondary float-left" type="button" value="Kembali" onclick="history.back(-1)"/>
							</div>
						</div>
					</form>
				</div>
			</div>
    </div>
		<div class="footer fixed-bottom text-center text-white bg-danger pt-3 pb-1 mt-2">
      <footer>
        <P>Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a style="color:black" href="#">Seksi Pemeriksaan-411</a></P>
      </footer>
    </div>
		<!--Optional Java script-->
    <script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>