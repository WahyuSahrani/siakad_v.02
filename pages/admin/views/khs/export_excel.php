<?php 
 if (!isset($_SESSION))session_start();
include "../../../../config/fungsi.php";
  
  $id_krs = @$_SESSION['id_krs'];

  $khs = mysqli_query($conn, "SELECT * FROM khs
           INNER JOIN jadwal ON khs.id_krs = jadwal.id_krs
           INNER JOIN mahasiswa ON khs.nim = mahasiswa.nim
           WHERE khs.id_krs = $id_krs"); 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Kelas Peserta.xlsx");
	?>
	
	<table border="1">
		    <tr>
          <th>No.</th>
          <th hidden="true">Id KHS</th>		      
          <th>NIM</th>
          <th>Nama</th>
          <th>Nilai Tugas</th>
          <th>Nilai UTS</th>
          <th>Nilai UAS</th>
          <th>Nilai Akhir</th>
          <th>Nilai Huruf</th>
		    </tr>
        <?php $no = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($khs)) { ?>
        <tr>  
          <td align="center"><?= $no; ?></td>        
          <td align="center"><?= $row["id_khs"] ?></td>          
          <td align="center"><?= $row["nim"] ?></td>
          <td align="center"><?= $row["nama"] ?></td>
          <td align="center"><?= $row["nilai_tgs"] ?></td>
          <td align="center"><?= $row["nilai_uts"] ?></td>
          <td align="center"><?= $row["nilai_uas"] ?></td>
          <td align="center"><?= $row["nilai_akhir"] ?></td>
          <td align="center"><?= $row["nilai_huruf"] ?></td>
        </tr>  
        <?php $no++; ?>
        <?php } ?>
	</table>
</body>
</html>