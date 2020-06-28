<?php 
require 'function.php';

$id = $_GET["id"];
$detailspt = query("SELECT * FROM dbsptnd WHERE id = $id")[0];


if(isset($_POST["kirim"])){
	if(terima($_POST) > 0){
		echo "<script>
						alert ('Data Berhasil Diterima ke Seksi Pemeriksaan');
						document.location.href='index.php';
					</script>";
	} else {
		echo "<script>
        alert ('Data Gagal Diterima')
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
			<title>Kirim SPT</title>
	</head>
	<body>
	<!-- Navigasi Bar-->
		<nav class="navbar fixed-top navbar-dark bg-primary navbar-expand-lg">
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
						<li class="nav-item">
							<a class="nav-link" href="inputspt.php">Input SPT LB</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>  
	<!-- Akhir Navigasi Bar-->
	<!-- Detail SPT-->
		<div class = "container">
			<div class="row text-center pt-3 mt-5">
				<div class="col">
					<h2>DETAIL SPT</h2>
				</div>
			</div>
			<div class="row justify-content-center">
        <div class="col-sm-4">
          <div class="card text-white bg-primary">
            <div class="card-body text-center">
              <h5 class="card-title">Profil Wajib Pajak</h5>
              <p class="card-text"><?=$detailspt["namawp"]?></p>
            </div>
          </div>
						<ul class="list-group text-center">
							<li class="list-group-item"> NPWP : <?= $detailspt["npwp"]?></li>
							<li class="list-group-item"> Jenis WP : <?= $detailspt["jeniswp"]?></li>
							<li class="list-group-item"><h5>Posisi SPT : <?= $detailspt["seksi"]?></h5></li>
						</ul>
        </div>
			</div>
	<!-- Akhir Detail SPT-->
	<!-- Tabel SPT-->
			<div class="row justify-content-center mt-4">
				<div class="col">
					<div class = "mx-auto"style = "width : 100%">
						<table class="table bg-primary text-center">
							<thead>
								<tr class="text-white">
									<th scope="col">Status</th>
									<th scope="col">Nominal LB</th>
									<th scope="col">Pilihan Pengembalian</th>
									<th scope="col">Masa Pajak</th>
									<th scope="col">Tahun Pajak</th>
									<th scope="col">Saluran</th>
									<th scope="col">Tanggal Terima</th>
									<th scope="col">Tanggal JT SPT</th>
								</tr>
								<tr class="table bg-light">
									<td><?=$detailspt["statusspt"]?></td>
									<td><?=$detailspt["nominalLB"]?></td>
									<td><?=$detailspt["pengembalian"]?></td>
									<td><?=$detailspt["masapajak"]?></td>
									<td><?=$detailspt["tahunpajak"]?></td>
									<td><?=$detailspt["saluran"]?></td>
									<?php 
										date_default_timezone_set('Asia/Jakarta');
										$tglspt = date('d-M-Y',strtotime($detailspt["tanggalspt"]));
									?>
									<td><?=$tglspt?></td>
									<?php
										$tglJt = date('d-M-Y', strtotime('+12 month',strtotime($tglspt)));
									?>
									<td><?=$tglJt?></td>
								</tr>
							</thead>
						</table>
					</div>	
				</div>		
			</div>
	<!-- AKhir Tabel SPT-->
	<!--FORM Terima SPT-->
			<div class = "row justify-content-center">
				<form action ="" method="post">
					<input type="hidden" name= "id" value="<?=$detailspt["id"]?>">
					<input type="hidden" name="seksipenerima" value ="Pemeriksaan">
					<div class="form-row">
						<div class="form-group col-md-5">
							<label for="ndwaskon">No. ND Waskon/Eksten</label>
							<input type="text" class="form-control" id="ndwaskon" name = "ndwaskon" value="ND-/WPJ.08/KP.03/2020" autofocus>
						</div>
						<div class="form-group col-md-3">
							<label for="seksi2">Seksi Pengirim</label>
							<select id="seksi2" name = "seksi2" class="form-control">
								<option selected><?=$detailspt["seksi"]?></option>
								<option>Waskon 1</option>
								<option>Waskon 2</option>
								<option>Waskon 3</option>
								<option>Waskon 4</option>
								<option>Ekstensifikasi</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="tanggalndwk">Tgl Nota Dinas</label>
							<input type="date" class="form-control" id="tanggalndwk" name = "tanggalndwk" value = "<?=date('Y-m-d')?>">
						</div>
					</div>
					<div class = "row justify-content-center">
						<div class = "col-sm-1 float-right">
							<button type="submit" name ="kirim" class="btn btn-success float-right">Kirim</button>
						</div>
						<div class = "col-sm-1 float-left">
							<input class="btn btn-secondary float-left" type="button" value="Kembali" onclick="history.back(-1)"/>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="footer text-center text-white bg-primary pt-3 pb-1 mt-5">
			<footer>
				<P>Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a style ="color : black" href="#">Seksi Pemeriksaan-411</a></P>
			</footer>
		</div>
		<!-- Akhir Detail SPT-->
		<!--Optional JavaScript-->
		<!--Optional Java script-->
		<script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
	</body>
</html>