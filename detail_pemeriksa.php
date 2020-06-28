<?php 
require 'function.php';
$id = $_GET["id"];
$db_spt = query("SELECT * FROM dbsptnd WHERE id = $id");
$db_pemeriksa = query("SELECT * FROM dbpemeriksa WHERE id = $id");

$data_spt = count($db_spt);
$data_pemeriksa = count($db_pemeriksa);

if( $data_pemeriksa != 1 || $data_spt != 1 ){
  $not_found = True;
}

if(isset($_POST["submit"])){
  if(input_pemeriksa($_POST)>0){
		echo "<script>
						alert('Data Berhasil ditambahkan');
						document.location.href= 'pemeriksaan.php';
					</script>";
	} else {
		 echo "<script>
						alert('Data Gagal ditambahkan')
					</script>";
	}

}
if(isset($_POST["edit"])){
  if(edit_pemeriksa($_POST)>0){
		echo "<script>
						alert('Data Berhasil diubah');
						document.location.href='detail_pemeriksa.php?id=$id';
					</script>";
	} else {
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
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fontawesome-free\css\all.min.css">
  <link rel="icon" type="icon/x-image" href="img/users-solid.svg">
  <title>Detail Tim Pemeriksa</title>
  <style>
    .table{
      font-size:11pt;
    }
    .error {
      margin-top : 100px;
    }
  </style>
</head>
<body>
<!-- Navigasi Bar-->
  <nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-lg">
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
<!-- Akhir Navigasi Bar-->
<!--Not Found -->
<?php if(isset($not_found)) :?>
  <!--Modal pemeriksa-->
    <div class="modal fade" id="pemeriksa" tabindex="-1" role="dialog" aria-labelledby="pemeriksaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pemeriksaLabel">Isi Data Tim Pemeriksa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="post">
            <input type="hidden" name="id_pemeriksa" id="id_pemeriksa" value="<?=$id?>">
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="kelompok">Kelompok :</label>
                  <select id="kelompok" name="kelompok" class="form-control">
                    <option selected>Kel-1</option>
                    <option>Kel-2</option>
                    <option>Kel-3</option>
                    <option>Kel-4</option>
                  </select>
                </div>
                <div class="form-group col-md-5">
                  <label for="spv">Supervisor :</label>
                  <select id="spv" name ="spv" class="form-control">
                    <option selected>-</option>
                    <option>CONRADUS SIGIT T</option>
                    <option>SURYADI</option>
                    <option>ANDRY THOMAS</option>
                    <option>DENI ACHMAD NURULAEN</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="ketua_tim">Ketua Tim :</label>
                  <select id="ketua_tim" name="ketua_tim" class="form-control">
                    <option selected>-</option>
                    <option>RUKMADI</option>
                    <option>ROHMAT</option>
                    <option>DEDE RAHMAT</option>
                    <option>DASRIZAL</option>
                    <option>SUWANTO</option>
                    <option>HARIYANTO</option>
                    <option>AGUS SABRANI</option>
                    <option>GUNAWAN</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-5">
                <label for="anggota_1" class="col-form-label">Anggota Tim 1 :</label>
                  <input type="text" name="anggota_1" class="form-control" id="anggota_1" autocomplete="off" required></input>
                </div>
                <div class="form-group col-md-4">
                <label for="anggota_2" class="col-form-label">Anggota Tim 2 :</label>
                  <input type="text" name="anggota_2" class="form-control" id="anggota_2" autocomplete="off"></input>
                </div>
                <div class="form-group col-md-3">
                <label for="kode_riksa" class="col-form-label">Kode Riksa :</label>
                  <input type="text" name="kode_riksa" class="form-control" id="kode_riksa" autocomplete="off" required></input>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-7">
                  <label for="no_sp2" class="col-form-label">No SP2 :</label>
                  <input type="text" name="no_sp2" class="form-control" id="no_sp2" value="PRIN-/WPJ.08/KP.0305/RIK.SIS/2020" required></input>
                </div>
                <div class="form-group col-md-5">
                  <label for="tgl_sp2" class="col-form-label">No SP2 :</label>
                  <input type="date" name="tgl_sp2" class="form-control" id="tgl_sp2" required></input>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" name="reset" id="reset" class="btn btn-secondary">Reset</button>
              <button type="submit" name="submit" id="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <!--Akhir Modal pemeriksa-->
  <div class="error container">
    <div class="row">
      <div class="col">
        <h4><?=$db_spt[0]["namawp"]?></h4>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h5>Belum Ada Data Tim Pemeriksa</h5>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-sm-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pemeriksa" ><i class="fas fa-plus"></i> Input Data</button>
      </div>
      <div class="col-sm-2">
        <a class="btn btn-secondary" href="pemeriksaan.php">Kembali</a>
      </div>
    </div>
  </div>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <?php die;?>
<?php endif;?>
<!--akhir Not Found -->
<!--Card Tim Pemeriksa-->
<div class = "container">
  <div class="row text-center pt-3 mt-5">
    <div class="col">
      <h2>Detail Tim Pemeriksa</h2>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-sm-4">
      <div class="card text-white bg-dark">
        <div class="card-body text-center">
          <h5 class="card-title">Profil Wajib Pajak</h5>
          <p class="card-text"><?=$db_spt[0]["namawp"]?></p>
        </div>
      </div>
      <ul class="list-group text-center">
        <li class="list-group-item"> NPWP : <?=$db_spt[0]["npwp"]?></li>
        <li class="list-group-item"> Kode Riksa : <?=$db_pemeriksa[0]["kode_riksa"]?></li>
        <li class="list-group-item"><h5>Kelompok Pemeriksa : <?=$db_pemeriksa[0]["kelompok"]?></h5></li>
      </ul>
    </div>
  </div>
</div>
<!--Akhir Card Tim Pemeriksa-->
<!--Tabel Tim Pemeriksa-->
<div class="container">
  <div class="table-responsive mt-4">
      <table class="table table-bordered bg-dark text-center">
        <thead>
          <tr class="text-white">
            <th scope="col">Supervisor</th>
            <th scope="col">Ketua Tim</th>
            <th scope="col">Anggota 1</th>
            <th scope="col">Anggota 2</th>
            <th scope="col">Nomor SP2</th>
            <th scope="col">Tanggal SP2</th>
          </tr>
          <tr class="table bg-light">
            <td><?=$db_pemeriksa[0]["nama_spv"]?></td>
            <td><?=$db_pemeriksa[0]["nama_ketua"]?></td>
            <td><?=$db_pemeriksa[0]["nama_anggota1"]?></td>
            <td><?=$db_pemeriksa[0]["nama_anggota2"]?></td>
            <td><?=$db_pemeriksa[0]["no_sp2"]?></td>
            <?php
              $tgl_sp2 = date('d-M-Y',strtotime($db_pemeriksa[0]["tgl_sp2"]));
            ?>
            <td><?=$tgl_sp2?></td>
          </tr>
        </thead>
      </table>
  </div>
</div>
<!--Akhir Tabel Tim Pemeriksa-->
<!--modal edit pemeriksa-->
<div class="modal fade" id="edit_pemeriksa" tabindex="-1" role="dialog" aria-labelledby="edit_pemeriksaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit_pemeriksaLabel">Edit Data Tim Pemeriksa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <input type="hidden" name="id_pemeriksa" id="id_pemeriksa" value="<?=$id?>">
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="kelompok">Kelompok :</label>
              <select id="kelompok" name="kelompok" class="form-control">
                <option selected><?=$db_pemeriksa[0]["kelompok"]?></option>
                <option >Kel-1</option>
                <option>Kel-2</option>
                <option>Kel-3</option>
                <option>Kel-4</option>
              </select>
            </div>
            <div class="form-group col-md-5">
              <label for="spv">Supervisor :</label>
              <select id="spv" name ="spv" class="form-control">
                <option selected><?=$db_pemeriksa[0]["nama_spv"]?></option>
                <option>CONRADUS SIGIT T</option>
                <option>SURYADI</option>
                <option>ANDRY THOMAS</option>
                <option>DENI ACHMAD NURULAEN</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="ketua_tim">Ketua Tim :</label>
              <select id="ketua_tim" name="ketua_tim" class="form-control">
                <option selected><?=$db_pemeriksa[0]["nama_ketua"]?></option>
                <option>RUKMADI</option>
                <option>ROHMAT</option>
                <option>DEDE RAHMAT</option>
                <option>DASRIZAL</option>
                <option>SUWANTO</option>
                <option>HARIYANTO</option>
                <option>AGUS SABRANI</option>
                <option>GUNAWAN</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
            <label for="anggota_1" class="col-form-label">Anggota Tim 1 :</label>
              <input type="text" name="anggota_1" class="form-control" id="anggota_1" value="<?=$db_pemeriksa[0]["nama_anggota1"]?>" autocomplete="off" required></input>
            </div>
            <div class="form-group col-md-6">
            <label for="anggota_2" class="col-form-label">Anggota Tim 2 :</label>
              <input type="text" name="anggota_2" class="form-control" id="anggota_2" value="<?=$db_pemeriksa[0]["nama_anggota2"]?>" autocomplete="off"></input>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-7">
              <label for="no_sp2" class="col-form-label">No SP2 :</label>
              <input type="text" name="no_sp2" class="form-control" id="no_sp2" value="<?=$db_pemeriksa[0]["no_sp2"]?>" required></input>
            </div>
            <div class="form-group col-md-5">
              <label for="tgl_sp2" class="col-form-label">No SP2 :</label>
              <input type="date" name="tgl_sp2" class="form-control" id="tgl_sp2" value="<?=$db_pemeriksa[0]["tgl_sp2"]?>" required></input>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="edit" id="edit" class="btn btn-success">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Akhi modal edit pemeriksa-->
<div class="container mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-2 float-right">
      <button class="btn btn-success" data-toggle="modal" data-target="#edit_pemeriksa" ><i class="fas fa-pencil-alt"></i> Edit</button>
    </div>
    <div class="col-sm-1">
      <a class="btn btn-secondary" href="pemeriksaan.php">Kembali</a>
    </div>
  </div>
</div>
<div class="footer fixed-bottom text-center text-white bg-dark pt-3 pb-1 mt-3">
  <footer>
    <P>Seksi Pemeriksaan &copy;KPPPratamaSerpong2020, Created by <a href="#">Seksi Pemeriksaan-411</a></P>
  </footer>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>