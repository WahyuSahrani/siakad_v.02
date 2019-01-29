<?php
session_start();
include "../../../../config/fungsi.php";

$nim = $_SESSION['mahasiswa'];

$khs = mysqli_query($conn, "SELECT * FROM jadwal 
          INNER JOIN khs ON jadwal.id_krs = khs.id_krs
          INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
          WHERE khs.nim = $nim"); 

$mahasiswa = mysqli_query($conn, "SELECT * FROM jurusan
				INNER JOIN mahasiswa ON jurusan.id_jurusan = mahasiswa.id_jurusan
				WHERE mahasiswa.nim = $nim");

$semester = mysqli_query($conn, "SELECT DISTINCT semester.id_semester, nama_semester FROM semester
            INNER JOIN khs ON semester.id_semester = khs.id_semester
            WHERE khs.nim = $nim AND khs.id_semester = $id_semester");

$filename="Kartu Hasil Studi.pdf";
$content = ob_get_clean();
//<span style='font-size: 10pt;'>Jl. Sukarjo Wiryopranoto No. 97B Maphar, Kec. Taman Sari - Jakarta Barat 11160, Telp. (021) 6390363</span>
$content = '
<style type="text/css">
.tabel { border-collapse:collapse; }
.tabel th { padding:0 5px 0 5px; background-color:#f60; color:#fff; }
table { vertical-align:top; }
tr { vertical-align:top; }
td { vertical-align:top; font-size:11px;}
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
		<span style="font-size:15px;"><b>TRANSKRIP NILAI SEMENTARA</b></span><br/>
	</div>

	<table>';
		while ($data = mysqli_num_rows($mahasiswa) > 0) {
		foreach ($mahasiswa as $row) {
		$content .= '
		
		<tr>
			<td style="width:150px; font-size:11px;">N a m a</td>
			<td style="font-size:11px;">:</td>
			<td style="font-size:11px; width:170px;">'.$row['nama'].'</td>
		</tr>
		<tr>
			<td style="width:150px; font-size:11px;">Tempat dan Tanggal Lahir</td>
			<td style="font-size:11px;">:</td>
			<td style="font-size:11px;">'.$row['tempat_lahir'].','.$row['tgl_lahir'].'</td>
		</tr>
		<tr>
			<td style="width:150px; font-size:11px;">Nomor Induk Mahasiswa</td>
			<td style="font-size:11px;">:</td>
			<td style="font-size:11px;">'.$row['nim'].'</td>
		</tr>
		<tr>
			<td style="width:150px; font-size:11px;">Program Studi</td>
			<td style="font-size:11px;">:</td>
			<td style="font-size:11px;">'.$row['nama_jurusan'].'</td>
		</tr>';
	}
	$content .= '
	</table><br>

	<table border="1px" class="tabel">		
		<tr>
	      <th rowspan="2">No</th>
          <th rowspan="2" style="padding: 0px 10px 0px 10px;">Kode MK</th>
          <th rowspan="2" style="padding: 0px 67px 0px 67px;">Mata Kuliah</th>
          <th rowspan="2"> K </th>
          <th colspan="2">Nilai</th>
          <th rowspan="2"> N x K </th>
          <th rowspan="2"> Keterangan </th>
		</tr>
		<tr>
		 <th> N </th>
         <th> H </th>
		</tr>';
		$no = 1; $total_sks = 0; $tot_nk = 0; $ips = 0;
		while ($data = mysqli_num_rows($khs) > 0) {
		foreach ($khs as $row) {
			 $bobot = 0;
			
              if ($row['nilai_huruf'] == 'A') {
                $bobot = 4;
              } elseif ($row['nilai_huruf'] == 'B') {
                $bobot = 3;
              } elseif ($row['nilai_huruf'] == 'C') {
                $bobot = 2;
              } elseif ($row['nilai_huruf'] == 'D') {
                $bobot = 1;
              } elseif ($row['nilai_huruf'] == 'D') {
                $bobot;
              } elseif ($row['nilai_huruf'] == 'E') {
                $bobot;
              } 

              if ($row['nilai_huruf'] == "A") {
                $kriteria = "LULUS";
              } elseif ($row['nilai_huruf'] == "B") {
              	$kriteria = "LULUS";
              } elseif ($row['nilai_huruf'] == "C") {
              	$kriteria = "LULUS";
              } elseif ($row['nilai_huruf'] == "D") {
              	$kriteria = "TIDAK LULUS";
              } elseif ($row['nilai_huruf'] == "E") {
              	$kriteria = "TIDAK LULUS";
              } else {
              	$kriteria = "TIDAK LULUS";
              }
			$content .= '
			<tr>
				<td align="center">'.$no++.'</td>
				<td align="center">'.$row["kode_mk"].'</td>
				<td>'.$row["nama_mk"].'</td>
				<td align="center">'.$row["sks"].'</td>
				<td align="center">'.$bobot.'</td>
				<td align="center">'.$row["nilai_huruf"].'</td>
				<td align="center">'.$bobot * $row['sks'].'</td>
				<td align="center">'.$kriteria.'</td>
			</tr>

			';
			    $total_sks = $total_sks + $row["sks"];  
                $tot_nk = $tot_nk + ($bobot * $row['sks']); 
                $ips = $tot_nk / $total_sks;
		}
		 $content .='
	     
		</table><br>
		<table style="border: 1px solid black; width:100%;">
			<tr>
				<td style="padding: 3px;">Indeks Prestasi Kumulatif (IPK)</td>
				<td style="padding: 3px;">:</td>
				<td style="padding: 3px; width: 10%;">'.number_format($ips,2 ,'.','').'</td>
				<td style="padding: 3px;">Keterangan</td>
				<td style="padding: 3px;">:</td>
				<td>N-Nilai (A=4, B=3, C=2, D=1, E=0)</td>
			</tr>
			<tr>
				<td style="padding: 3px;">Jumlah Kredit Kumulatif</td>
				<td style="padding: 3px;">:</td>
				<td style="padding: 3px; width: 10%;">'.$tot_nk.'</td>
				<td style="padding: 3px;">Predikat Kelulusan</td>
				<td style="padding: 3px;">:</td>
				<td style="padding: 3px;"></td>
			</tr>
		</table><br>
		<table style="border: 1px solid black; width:98%; height:100%;">
			<tr>
				<td style="width:100%;">Karya Tulis</td>				
			</tr>
			<tr>
				<td></td>				
			</tr>
		</table>
		<nobreak><br>
		<table cellspacing="0" border="0" style="width:100%; margin:0 auto;" >
			<tr>
				<td style="width:35%; text-align:center;">
				    <br> <p>Ketua Program Studi</p> 
						<p>&nbsp;</p>
						Herry Hermawan, S.Kom., M.Cs<hr/>
						NIDN. 1123097302
				</td>
				<td style="width:30%;"></td>
				<td style="width:33%; text-align:center;">
					<p>Muara Teweh, '; 
					$content .=  date('d F Y');
					$content .= '<br> Direktur,</p>
						<p>&nbsp;</p>
						NOOR IDEAL, SE., MM<br><hr/>
						NUPN. 9911004567
				</td>
			</tr>

	</table>

		</nobreak>
		
</page>

';

require ("../../../../assets/html2pdf/html2pdf.class.php");
$html2pdf = new HTML2PDF('P','A5','en'); 
$html2pdf->WriteHTML($content);
$html2pdf->Output($filename);
}}

?>