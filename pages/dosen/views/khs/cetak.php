<?php
session_start();

include "../../../../config/fungsi.php";

  $id_krs = $_SESSION['id_krs'];

  $khs = mysqli_query($conn, "SELECT * FROM khs
           INNER JOIN jadwal ON khs.id_krs = jadwal.id_krs
           INNER JOIN mahasiswa ON khs.nim = mahasiswa.nim
           WHERE khs.id_krs = $id_krs");

  $jadwal = mysqli_query($conn, "SELECT * FROM jadwal
  			INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
  			INNER JOIN dosen ON jadwal.nip = dosen.nip
  			WHERE jadwal.id_krs = $id_krs");


$filename="Rekapitulasi Nilai.pdf";
$content = ob_get_clean();
//<span style='font-size: 10pt;'>Jl. Sukarjo Wiryopranoto No. 97B Maphar, Kec. Taman Sari - Jakarta Barat 11160, Telp. (021) 6390363</span>
$content = '
<style type="text/css">
.tabel { border-collapse:collapse; }
.tabel th { padding:0px 10px 0px 10px; background-color:#f60; color:#fff; }
table { vertical-align:top; }
tr { vertical-align:top; }
td { vertical-align:top; }
</style>
';
							
$content .= '
<page>
	<table style="width:100%; text-align:center;">
		<tr>
			<td style="width:7%" rowspan="7"><img src="../../../../assets/img/Logo.jpg" width="80" height="80"></td>			
		</tr>
		<tr>
			<td style="width:78%; font-size:15px;">YAYASAN PENDIDIKAN PANGLIMA BATUR</td>
		</tr>
		<tr>
			<td style="font-size:15px; width:78%;">POLITEKNIK MUARA TEWEH</td>
		</tr>
		<tr>
			<td style="font-size:12px; width:78%;">SK MENDIKNAS NO : 126/0/0/2008</td>
		</tr>
		<tr>
			<td style="font-size:12px; width:78%;">STATUS TERAKREDITASI Nomor : 805/BAN-PT/Akred/PT/VIII/2015</td>
		</tr>
		<tr>
			<td style="font-size:10px; width:78%;">Jln Negara KM 7,5 Muara Teweh - Banjarmasin </td>
		</tr>
		<tr>
			<td style="font-size:10px; width:78%;">Telp. 085821334750</td>
		</tr><br>
		<hr/>
	</table> 


	<div style="padding:5mm; border:0px;" align="center">
		<span style="font-size:15px;"><u>REKAPITULASI NILAI</u></span>
	</div>
	<table>';
		while ($data = mysqli_num_rows($jadwal) > 0) {
		foreach ($jadwal as $baris) {
		$content .= '
		
		<tr>
			<td style="width:110px; font-size:12px;">MATA KULIAH</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px; width:170px;">'.$baris['nama_mk'].'</td>
		</tr>
		<tr>
			<td style="width:110px; font-size:12px;">SEMESTER</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;">'.$baris['semester'].'</td>
		</tr>
		<tr>
			<td style="width:110px; font-size:12px;">PROGRAM STUDI</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;">Manajemen Informatika</td>
		</tr>';
	}
	$content .= '
	</table><br>

	<table border="1px" class="tabel" >
		<tr>
		  <th>No.</th>
		  <th align="center" style="padding:0px 30px 0px 30px;">NIM</th>
          <th style="padding:0px 60px 0px 60px;">Nama</th>
          <th>Nilai Tugas</th>
          <th>Nilai UTS</th>
          <th>Nilai UAS</th>
          <th>Nilai Akhir</th>
          <th>Nilai Huruf</th>
		</tr>';
		$no = 1;
		while ($data = mysqli_num_rows($khs) > 0) {
		foreach ($khs as $row) {
			$content .= '
			<tr>
			  <td align="center">'.$no++.'</td>
			  <td align="center">'.$row["nim"].'</td>
              <td>'.$row["nama"].' </td>
              <td align="center">'.$row["nilai_tgs"].' </td>
              <td align="center">'.$row["nilai_uts"].' </td>
              <td align="center">'.$row["nilai_uas"].' </td>
              <td align="center">'.$row["nilai_akhir"].' </td>
              <td align="center">'.$row["nilai_huruf"].' </td>
			</tr>
			';
		}
$content .= '
		</table>
		<nobreak><br>
		<table cellspacing="0" style="width:100%; text-align:left;">';
		while ($data = mysqli_num_rows($jadwal) > 0) {
		foreach ($jadwal as $baris) {
		$content .= '
			<tr>
				<td style="width:70%;"></td>
				<td style="width:30%;">
					<p>Muara Teweh, '; 
					$content .=  date('d F Y');
					$content .= '<br> Dosen Pengampu</p> 
						<p>&nbsp;</p>
						'.$baris['nama'].'<br><hr/>
						'.$baris['nip'].'
				</td>
			</tr>';
		}
		$content .= '</table>
		</nobreak>
</page>

';

require ("../../../../assets/html2pdf/html2pdf.class.php");
$html2pdf = new HTML2PDF('P','A4','en'); 
$html2pdf->WriteHTML($content);
$html2pdf->Output($filename);
}}}
?>