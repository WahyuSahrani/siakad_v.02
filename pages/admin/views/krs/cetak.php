<?php
include "../../../../config/fungsi.php";

$jadwal = mysqli_query($conn, "SELECT * FROM jadwal
           INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
           INNER JOIN dosen ON jadwal.nip = dosen.nip
           INNER JOIN semester ON jadwal.id_semester = semester.id_semester");

  $khs = mysqli_query($conn, "SELECT * FROM khs
           INNER JOIN jadwal ON khs.id_krs = jadwal.id_krs
           INNER JOIN mahasiswa ON khs.nim = mahasiswa.nim
           WHERE khs.id_krs = $id_krs");

$filename="Kartu Rencana Studi.pdf";
$content = ob_get_clean();
//<span style='font-size: 10pt;'>Jl. Sukarjo Wiryopranoto No. 97B Maphar, Kec. Taman Sari - Jakarta Barat 11160, Telp. (021) 6390363</span>
$content = '
<style type="text/css">
.tabel { border-collapse:collapse; }
.tabel th { padding:0 5px 0 5px; background-color:#f60; color:#fff; }
table { vertical-align:top; }
tr { vertical-align:top; }
td { vertical-align:top; }
img { width:50px; }
.container { width:100%; }
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
		<span style="font-size:15px;"><b>KARTU RENCANA STUDI <i>(KRS)</i></b></span>
	</div>

	<table>
		
		<tr>
			<td style="width:200px;">NAMA</td>
			<td>:</td>
			<td>'.$khs["nama"].'</td>
		</tr>
		<tr>
			<td style="width:200px;">NIM</td>
			<td>:</td>
			<td>5740113046</td>
		</tr>
		<tr>
			<td style="width:200px;">BIDANG STUDI</td>
			<td>:</td>
			<td>NON-REKAYASA</td>
		</tr>
		<tr>
			<td style="width:200px;">PROGRAM STUDI</td>
			<td>:</td>
			<td>MANAJEMEN INFORMATIKA</td>
		</tr>
		<tr>
			<td style="width:200px;">SEMESTER</td>
			<td>:</td>
			<td>2</td>
		</tr>
		<tr>
			<td style="width:200px;">KELAS</td>
			<td>:</td>
			<td>-</td>
		</tr>
		<tr>
			<td style="width:200px;">TAHUN AKADEMIK</td>
			<td>:</td>
			<td>2018/2019</td>
		</tr>
	</table><br>

	<table border="1px" class="tabel">		
		<tr>
			<th align="center" style="padding:0 10px 0 10px;">No</th>
			<th align="center" style="padding:0 20px 0 20px;">SANDI MK</th>
			<th align="center" style="padding:0 50px 0 50px;">MATA KULIAH</th>
			<th align="center" style="padding:0 10px 0 10px;">SKS</th>
			<th align="center" style="padding:0 20px 0 20px;">HARI</th>
			<th align="center" style="padding:0 60px 0 60px;">JAM</th>
		</tr>';
		$no = 1;
		while ($data = mysqli_num_rows($jadwal) > 0) {
		foreach ($jadwal as $row) {
			$content .= '
			<tr>
				<td align="center">'.$no++.'</td>
				<td align="center">'.$row["kode_mk"].'</td>
				<td>'.$row["nama_mk"].'</td>
				<td align="center">'.$row["sks"].'</td>
				<td>'.$row["hari"].'</td>
				<td>'.$row["jam_mulai"].' - '.$row["jam_selesai"].'</td>
			</tr>

			';
		}

$content .= '
		</table>
		<nobreak><br>
		<table cellspacing="0" border="0" style="width:100%; margin:0 auto;" >
			<tr>
				<td style="width:42%; text-align:center;">
					<p><b>Mengetahui / Menyetujui :</b>
					<br>PROGRAM STUDI MANAJEMEN INFORMATIKA <br><b> KETUA, </b></p> 
						<p>&nbsp;</p>
						ILHAN, SE., MM<br>
				</td>
				<td style="width:25%; text-align:center;">
					<p><b>Mengetahui :</b> <br>Dosen Wali</p> 
						<p>&nbsp;</p><br>
						ILHAN, SE., MM<br><br>
				</td>
				<td style="width:30%; text-align:center;">
					<p>Muara Teweh, '; 
					$content .=  date('d F Y');
					$content .= '<br><b>Mahasiswa yang bersangkutan,</b></p> 
						<p>&nbsp;</p><br>
						ILHAN, SE., MM<br>
				</td>
			</tr>
	</table>

		</nobreak>
		
</page>

';

require ("../../../../assets/html2pdf/html2pdf.class.php");
$html2pdf = new HTML2PDF('P','A4','en'); 
$html2pdf->WriteHTML($content);
$html2pdf->Output($filename);
}
?>