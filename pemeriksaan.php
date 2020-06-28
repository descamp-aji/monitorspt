<?php 
require 'function.php';

$dataperHalaman = 20;
$total_data = count(query("SELECT * FROM dbsptnd WHERE seksi ='Pemeriksaan'"));
$jumlahHalaman = ceil($total_data/$dataperHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($dataperHalaman * $halamanAktif) - $dataperHalaman;
$dbsptnd = query("SELECT * FROM dbsptnd WHERE seksi = 'Pemeriksaan' ORDER BY status_riksa, tanggalspt ASC LIMIT $awalData, $dataperHalaman");

if(isset($_POST["search"])){
	$dbsptnd = cari($_POST);
	$jumlahrow = count($dbsptnd);
		if($jumlahrow < 1) {
			$notfound = True;
		}
}

if($total_data<1){
	$notfound = true;
}

if(isset($_POST["kirim"])){
	if(selesai($_POST)>0){
		echo "<script>
						alert('Proses SPT Telah Selesai');
						document.location.href= 'pemeriksaan.php';
					</script>";
	} else {
		 echo "<script>
						alert('Data Gagal Proses')
					</script>";
	}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="fontawesome-free\css\all.min.css">
		<style>
			.jumbotron-fluid {
				padding-top : 80px;
			}
			.table{
				font-size : 16px;
				width : 1450px;
			}
			@media print{
				.table{
					font-size : 11pt;
					width : 100%;
				}
				.aksi, .isi_aksi, .saluran, .isi_saluran, .pagination, .pengembalian, .isi_pengembalian,.asalspt,.isi_asalspt {
					display : none;
				}
				.footer {
					position : fixed;
					bottom : 0;
					margin-left : 240px;
				}
			}
		</style>
		<link rel="icon" type="icon/x-image" href="img\search-solid.svg">
    <title>Pemeriksaan</title>
  </head>
  <body>
		<!--Navigasi Bar-->
		<nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-lg">
    	<div class = "container page-scroll">
				<a class="navbar-brand" href="#">Monitor SPT LB</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
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
								<a class="dropdown-item" href="selesai.php">Selesai</a>
							</div>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0" action="" method="post">
						<input type="hidden" name ="posisi_SPT" value="Pemeriksaan">
						<input name="keyword" class="form-control mr-sm-2" type="search" placeholder="NPWP atau Kelompok" autocomplete="off" aria-label="Search" required>
						<button class="btn btn-outline-primary my-2 my-sm-0" name="search"type="submit">Search</button>
					</form>
				</div>
    	</div>
		</nav>
		<!--Akhir Navigasi Bar-->
		<!-- Jumbotron -->
		<div class = "container text-center" >
			<div class="jumbotron jumbotron-fluid" style = "height : 350px">
				<div class="container">
					<img src="img/4.png" width="100">
					<h1 class="display-5">Aplikasi Monitoring SPT LB</h1>
          <p>Tanggal Hari Ini : <b><?= date ('d-m-Y')?></b></p>
					<p class="lead">Daftar SPT LB yang sudah dikirimkan Ke <b>Seksi Pemeriksaan</b></p><br>
				</div>
			</div>
		</div>
		<!--Akhir Jumbotron -->
		<!--Modal selesai-->
		<div class="modal fade" id="selesai_pmr" tabindex="-1" role="dialog" aria-labelledby="selesaiLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="selesaiLabel">Isi Keterangan Selesai / NO LHP</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="" method="post">
						<input type="hidden" name="selesai_id" id="selesai_id">
						<input type="hidden" name="proses" id="proses" value="Selesai">
						<div class="modal-body">
							<div class="form-group">
								<label for="alasan_selesai" class="col-form-label">Keterangan :</label>
								<textarea name="alasan_selesai" class="form-control" id="alasan_selesai" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-secondary">Reset</button>
							<button type="submit" name="kirim" id="kirim" class="btn btn-success">Kirim</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--Akhir Modal selesai-->
		<!-- Table-->
		<div class="container">
			<div class = "table-responsive mx-auto mb-1">
				<table class="table table-striped text-center table-bordered">
					<thead class="thead-dark">
						<tr>
							<th scope="col">No.</th>
							<th style="display:none">id</th>
							<th scope="col">NPWP</th>
							<th scope="col">Nama Wajib Pajak</th>
							<th scope="col">Masa/Tahun</th>
							<th scope="col">Status SPT</th>
							<th class = "pengembalian" scope="col">Pengembalian</th>
							<th scope="col">Nominal LB</th>
							<th scope="col">Tanggal JT</th>
							<th scope="col">Kelompok</th>
							<th class ="asalspt" scope="col">Asal SPT</th>
							<th class = "aksi" scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;?>
						<?php foreach($dbsptnd as $row) :?>
						<tr>
							<th scope="row"><?=$i;?></th>
							<td style="display:none"><?=$row["id"]?></td>
							<td><?= $row["npwp"]?></td>
							<td><?=$row["namawp"]?></td>
							<td><?=$row["masapajak"]?>/<?=$row["tahunpajak"]?></td>
							<td><?=$row["statusspt"]?></td>
							<td class = "isi_pengembalian"><?=$row["pengembalian"]?></td>
							<td><?=$row["nominalLB"]?></td>
							<?php
								date_default_timezone_set('Asia/Jakarta');
								$tglspt = date('d-M-Y',strtotime($row["tanggalspt"]));
								$tgljt = date('d-M-Y',strtotime('+12 month', strtotime($tglspt)));
								?>
							<td><?=$tgljt?></td>
							<td><?=$row["status_riksa"]?></td>
							<td class="isi_asalspt"><?=$row["seksi2"]?></td>
							<td class = "isi_aksi">
								<a class="btn btn-primary btn-sm" href="editpmr.php?id=<?=$row["id"]?>" data-toggle="tooltip" data-placement="top" title="Edit SPT"><i class="far fa-edit"></i></a>
								<a class="btn btn-warning btn-sm" href="detail_pemeriksa.php?id=<?=$row["id"]?>" data-toggle="tooltip" data-placement="top" title="Tim Pemeriksa"><i class="fas fa-users"></i></a>
								<button type="button" class="btn btn-success btn-sm selesai_pmr" data-toggle="modal" data-target="#selesai_pmr"><i class="fas fa-flag-checkered" data-toggle="tooltip" data-placement="top" title="Selesai Proses"></i></button>
							</td>
						</tr>
						<?php $i++;?>
						<?php endforeach;?>
					</tbody>
				</table>
				<?php if(isset($notfound)) :?>
					<center><p>---Tidak Ada Data---</p></center>
				<?php endif;?>
			</div>
		</div>
		<!-- Akhir Table-->
		<!-- Pagination-->
		<div class="container">
			<div class="row justify-content-center">
				<nav class ="text-center" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item">
						<?php if ($halamanAktif > 1) :?>
							<a class="page-link" href="?halaman=<?=$halamanAktif - 1?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php endif; ?>
						</li>
						<?php for($i=1; $i<=$jumlahHalaman; $i++) :?>
							<?php if($i== $halamanAktif) :?>
								<li class="page-item active"><a class="page-link" href="?halaman=<?=$i;?>"><?=$i;?></a></li>
							<?php else :?>
								<li class="page-item"><a class="page-link" href="?halaman=<?=$i;?>"><?=$i;?></a></li>
							<?php endif;?>
						<?php endfor; ?>
						<li class="page-item">
						<?php if($halamanAktif < $jumlahHalaman) :?>
							<a class="page-link" href="?halaman=<?=$halamanAktif + 1?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<?php endif;?>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- Akhir Pagination-->
		<!--Footer-->
		<?php if(isset($_POST["search"]) || $total_data < 2) :?>
			<div class="footer fixed-bottom text-center text-white bg-dark pt-3 pb-1 mt-5">
				<footer>
					<P>Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a href="#">Seksi Pemeriksaan-411</a></P>
				</footer>
			</div>
			<?php else :?>
			<div class="footer text-center text-white bg-dark pt-3 pb-1 mt-5">
				<footer>
					<P>Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a href="#">Seksi Pemeriksaan-411</a></P>
				</footer>
			</div>
		<?php endif; ?>
		<!--Akhir Footer-->
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<!-- Akhir Optional JavaScript -->
		<!-- Akhir jQuery first, then Popper.js, then Bootstrap JS -->
		<!--Console Table-->
		<script>
			$(document).ready(function() {
					$('.selesai_pmr').on('click', function (){
						$('#selesai_pmr').modal('show');
							$tr = $(this).closest('tr');
							var data = $tr.children('td').map(function() {
								return $(this).text();
							}).get();
							console.log(data);
							$('#selesai_id').val(data[0]);
					})
				})
		</script>
		<!--Akhir Console Table-->
		<!--Data Toggle Jquery-->
		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
		</script>
		<!--Akhir Data Toggle Jquery-->
	</body>
</html>