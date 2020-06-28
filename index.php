<?php
require 'function.php';

function jumlah_spt($posisi){
	$total_spt = count(query("SELECT * FROM dbsptnd WHERE seksi = '$posisi'"));
	return $total_spt;
}
$jumlahwk1 = jumlah_spt('Waskon 1');
$jumlahwk2 = jumlah_spt('Waskon 2');
$jumlahwk3 = jumlah_spt('Waskon 3');
$jumlahwk4 = jumlah_spt('Waskon 4');
$jumlahekst = jumlah_spt('Ekstensifikasi');
$jumlahprk = jumlah_spt('Pemeriksaan');
$selesai = jumlah_spt('Selesai');
$totalspt = count(query("SELECT * FROM dbsptnd"));


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<style>
			.jumbotron-fluid {
				padding-top : 80px;
			}
		</style>
		<link rel="icon" type="icon/x-image" href="img\search-solid.svg">
    <title>Dashboard</title>
  </head>
  <body>
		<nav class="navbar fixed-top navbar-light bg-warning navbar-expand-lg">
    	<div class = "container page-scroll">
				<a class="navbar-brand" href="#">Monitor SPT LB</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="inputspt.php">Input SPT LB</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								PROSES
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="waskonekst.php">Waskon & Eksten</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="pemeriksaan.php">Pemeriksaan</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="selesai.php">Selesai</a>
							</div>
						</li>
					</ul>
				</div>
    	</div>
		</nav>
		<!-- Jumbotron -->
		<div class = "container text-center" >
			<div class="jumbotron jumbotron-fluid mb-4" style ="background-color: ;height : 320px">
				<div class="container">
					<img src="img/4.png" width="100">
					<h1 class="display-5">Aplikasi Monitoring SPT LB</h1>
					<p class="lead">Aplikasi yang bertujuan untuk melakukan pengawasan terhadap <b>alur proses SPT LB</b></p><br>
					<p>Tanggal Hari Ini : <b><?= date('d-M-Y')?></b></p>
				</div>
			</div>
		</div>

    <!--Dashboard-->
		<div class="container">
			<center>
				<h3>Rangkuman Posisi SPT LB</h3>
				<table class="table bg-warning table-striped table-bordered text-center mt-4">
					<thead>
						<tr>
							<th>Waskon 1</th>
							<th>Waskon 2</th>
							<th>Waskon 3</th>
							<th>Waskon 4</th>
							<th>Ekstensifikasi</th>
							<th>Pemeriksaan</th>
							<th>Selesai</th>
							<th>Total SPT LB</th>
						</tr>
						<tr class="table bg-light">
							<td><b><?=$jumlahwk1?></b> SPT</td>
							<td><b><?=$jumlahwk2?></b> SPT</td>
							<td><b><?=$jumlahwk3?></b> SPT</td>
							<td><b><?=$jumlahwk4?></b> SPT</td>
							<td><b><?=$jumlahekst?></b> SPT</td>
							<td><b><?=$jumlahprk?></b> SPT</td>
							<td><b><?=$selesai?></b> SPT</td>
							<td><b><?=$totalspt?></b> SPT</b></td>
						</tr>
					</thead>
				</table>
			</center>
		</div>

    <!--Footer-->
		<div class="fixed-bottom footer text-center text-white bg-warning pt-4 pb-1">
			<footer>
				<P class ="text-dark">Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a style="color : white"href="#">Seksi Pemeriksaan-411</a></P>
			</footer>
		</div>
		
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>