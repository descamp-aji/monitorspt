<?php 
require 'function.php';

$data_table= query("SELECT * FROM dbsptnd WHERE seksi = 'Selesai'");

$dataperHalaman = 20;
$total_data = count($data_table);
$jumlahHalaman = ceil($total_data/$dataperHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

if($total_data < 1){
  $no_data = True;
}

if(isset($_POST["search"])){
  $data_table = cari3($_POST);
  $jumlahrow = count($data_table);
		if($jumlahrow < 1) {
			$no_data = True;
		}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPT LB Selesai</title>
  <link rel="icon" type="icon/x-image" href="img/flag-checkered-solid.svg">
  <link rel ="stylesheet" type="text/css" href="css\bootstrap.min.css">
  <link rel ="stylesheet" type="text/css" href="fontawesome-free\css\all.min.css">
  <style>
    .table{
      width : 1200px;
    }
  </style>
</head>
<body>
  <!--Navigasi Bar-->
    <nav class="navbar fixed-top navbar-dark bg-success navbar-expand-lg">
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
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								PROSES
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="waskonekst.php">Waskon & Eksten</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="pemeriksaan.php">Pemeriksaan</a>
							</div>
						</li>
					</ul>
          <form class="form-inline my-2 my-lg-0" action="" method="post">
						<input type="hidden" name ="posisi_SPT" value="Pemeriksaan">
						<input name="keyword" class="form-control mr-sm-2" type="search" placeholder="NPWP atau Nama WP" autocomplete="off" aria-label="Search" required>
						<button class="btn btn-outline-light my-2 my-sm-0" name="search"type="submit">Search</button>
					</form>
				</div>
    	</div>
		</nav>
  <!--Akhir Navigasi Bar-->
  <!-- Jumbotron -->
  <div class = "container text-center mt-3" >
    <div class="jumbotron jumbotron-fluid" style = "height : 350px">
      <div class="container">
        <img src="img/4.png" width="100">
        <h1 class="display-5">Aplikasi Monitoring SPT LB</h1>
        <p>Tanggal Hari Ini : <b><?= date ('d-m-Y')?></b></p>
        <p class="lead">Daftar SPT LB yang sudah <b>Selesai Proses</b></p><br>
      </div>
    </div>
  </div>
  <!--Akhir Jumbotron-->
  <!--Table-->
  <div class="container">
    <div class="table-responsive">
      <table class="table bg-success table-striped table-bordered text-center">
        <thead class="thead-success text-white">
          <tr>
            <th>No.</th>
            <th>NPWP</th>
            <th>Nama WP</th>
            <th>Masa Pajak</th>
            <th>Status SPT</th>
            <th>Status</th>
            <th>Asal SPT</th>
            <th>Keterangan Selesai</th>
            <th>Aksi</th>
          </tr>
          <?php $i = 1;?>
          <?php foreach ($data_table as $data) :?>
          <tr class="table bg-light">
            <td><b><?=$i?></b></td>
            <td><?=$data["npwp"]?></td>
            <td><?=$data["namawp"]?></td>
            <td><?=$data["masapajak"]?>/<?=$data["tahunpajak"]?></td>
            <td><?=$data["statusspt"]?></td>
            <td><?=$data["seksi"]?></td>
            <td><?=$data["seksi2"]?></td>
            <td><?=$data["ket_selesai"]?></td>
            <td>
              <a class="btn btn-danger btn-sm" href="hapus.php?id=<?=$data["id"]?>" onclick="return confirm('Apakah Anda Yakin ?')" data-toggle="tooltip" data-placement="top" title="Hapus Data"><i class="far fa-trash-alt"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </thead>
      </table>
      <?php if(isset($no_data)) :?>
        <center>
          <p>----Tidak Ada Data----</p>
        </center>
      <?php endif; ?>
    </div>
  </div>
  <!--Akhir Table-->
  <!--Pagination-->
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
  <!--Akhir Pagination-->
  <!--Footer-->
  <?php if(isset($_POST["search"])) :?>
    <div class="footer fixed-bottom text-center text-white bg-success pt-3 pb-1 mt-5">
      <footer>
        <P>Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a href="#" style="color:black">Seksi Pemeriksaan-411</a></P>
      </footer>
    </div>
    <?php else :?>
    <div class="footer text-center text-white bg-success pt-3 pb-1 mt-5">
      <footer>
        <P>Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a href="#" style="color:black">Seksi Pemeriksaan-411</a></P>
      </footer>
    </div>
  <?php endif; ?>
  <!--Akhir Footer-->
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
		</script>
</body>
</html>