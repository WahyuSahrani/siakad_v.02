<?php 
session_start();
include "../../../../config/koneksi.php";
$prov_id = $_POST['prov_id'];


// $nim	= $_POST['nim'];

$jadwal = mysqli_query($conn, "SELECT * FROM jadwal
           INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
           INNER JOIN dosen ON jadwal.nip = dosen.nip
           WHERE mata_kuliah.semester = $prov_id");

if(isset($_POST["submit"])){

	//cek apakah    data berhasil ditambahkan atau tidak
	if(tambah_krs($_POST) > 0 ){
		// echo "Error: " . $_POST . "<br>" . mysqli_error($conn);die();
		echo "
			<script>
				alert('data berhasil ditambahkan:');
				document.location.href = '?page=krs';
			</script>
		";
	} else {
		echo ("error ". mysqli_error($conn)); die;
		echo "
		 	<script>
				alert('data gagal ditambahkan:');
				document.location.href = '?page=krs';
			</script>
		";
	}

}
?>
<div class='col-xs-12'> 	
	 <div class='box-body table-responsive no-padding'>   
	  <form  action="" method="POST">
	 	<table class='table table-hover'>   
	        <tr>
	          <th>Pilih</th>
	          <th>No</th>
	          <th>Kode MatKul</th>
	          <th>Mata Kuliah</th>
	          <th>SKS</th>
	          <th>Dosen</th>
	          <th>Hari</th>
	          <th>Jam</th>
	        </tr>

	        <?php $i = 1; ?>
	        <?php foreach ($jadwal as $row) : ?>
	        <tr>
	          <td><input type="checkbox" name="cek[]"  value="<?php echo $row['id_krs']; ?> "></td>        
	          <td><?= $i; ?></td>
	          <td><?= $row['kode_mk'] ?></td>
	          <td><?= $row['nama_mk'] ?></td>
	          <td><?= $row['sks'] ?></td>
	          <td><?= $row['nama'] ?></td>
	          <td><?= $row['hari'] ?></td>
	          <td><?= $row["jam_mulai"].' - '.$row["jam_selesai"]; ?></td>
	          <?php $i++; ?>
	          <?php endforeach; ?>
	        </tr>  
	      </table>

    <button type="submit" name="submit" value="tambah" class="btn btn-success btn-ms"><span class="glyphicon glyphicon-plus"></span> Tambah</button>  
    <a href="views/krs/cetak.php" class="btn btn-success btn-ms" target="_blank"> <span class="glyphicon glyphicon-print"></span> Cetak </a>
    </form>
    </div>
	</div>

  


