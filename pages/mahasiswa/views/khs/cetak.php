<?php
session_start();
include "../../../../config/fungsi.php";

$id_semester = $_SESSION['idsemester'];


$nim = $_SESSION['mahasiswa'];

$khs = mysqli_query($conn, "SELECT * FROM jadwal 
          INNER JOIN khs ON jadwal.id_krs = khs.id_krs
          INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
          WHERE khs.nim = $nim AND khs.id_semester = $id_semester"); 

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
			<td style="width:7%" rowspan="4"><img src="../../../../assets/img/Logo.jpg" width="40" height="40"></td>			
		</tr>
		<tr>
			<td style="width:78%; font-size:14px;"></td>
		</tr>
		<tr>
			<td style="width:78%; font-size:14px;">YAYASAN PENDIDIKAN PANGLIMA BATUR</td>
		</tr>
		<tr>
			<td style="font-size:14px; width:78%;">POLITEKNIK MUARA TEWEH</td>
		</tr>
		<br>
		<hr/>
	</table> 
	<div style="padding:5mm; border:0px;" align="center">
		<span style="font-size:15px;"><b>KARTU HASIL STUDI <i>(KHS)</i></b></span><br/>';
		while ($data = mysqli_num_rows($semester) > 0) {
		foreach ($semester as $row) {
		$content .= '
		<span style="font-size:13px;">Tahun Akademik '.$row['nama_semester'].'</span>';
	}
	$content .= '
	</div>

	<table>';
		while ($data = mysqli_num_rows($mahasiswa) > 0) {
		foreach ($mahasiswa as $row) {
		$content .= '
		
		<tr>
			<td style="width:110px; font-size:11px;">NAMA</td>
			<td style="font-size:11px;">:</td>
			<td style="font-size:11px; width:170px;">'.$row['nama'].'</td>
			<td rowspan="4" style="width:200px; text-align:right;"> <img style="width:80px;" src="https://siakadpolimat.000webhostapp.com/assets/img/'.$row["foto"].'">
		    </td>
		</tr>
		<tr>
			<td style="width:110px; font-size:11px;">NIM</td>
			<td style="font-size:11px;">:</td>
			<td style="font-size:11px;">'.$row['nim'].'</td>
		</tr>
		<tr>
			<td style="width:110px; font-size:11px;">BIDANG STUDI</td>
			<td style="font-size:11px;">:</td>
			<td style="font-size:11px;">'.$row['bidang_studi'].'</td>
		</tr>
		<tr>
			<td style="width:110px; font-size:11px;">PROGRAM STUDI</td>
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
	       <tr>
			   <td colspan="3" style="text-align:center; background-color:#f60; color:#fff;"><b>TOTAL SKS</b></td>
			   <td colspan="3" align="center">'.$total_sks.'</td>
			   <td></td>
			   <td></td>
		   </tr> 
		   <tr>
			   <td colspan="3" style="text-align:center; background-color:#f60; color:#fff;"><b>TOTAL N x K</b></td>
			   <td colspan="3" align="center">'.$tot_nk.'</td>
			   <td></td>
			   <td></td>
		   </tr> 
		   <tr>
			   <td colspan="3" style="text-align:center; background-color:#f60; color:#fff;"><b>INDEKS PRESTASI</b></td>
			   <td colspan="3" align="center">'.number_format($ips, 2, '.','').'</td>
			   <td></td>
			   <td></td>
		   </tr> 
		</table>
		<nobreak><br>
		<table cellspacing="0" border="0" style="width:100%; margin:0 auto;" >
			<tr>
				<td style="width:60%;"></td>
				<td style="width:40%;">
					<p>Muara Teweh, '; 
					$content .=  date('d F Y');
					$content .= '<br> Ketua Prodi Manajemen Informatika</p> 
						<p>&nbsp;</p>
						Herry Hermawan, S.Kom., M.Cs<hr/>
						NIDN. 1123097302
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
}}}

?>