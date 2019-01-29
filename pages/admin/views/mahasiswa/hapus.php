<?php 
include "../../config/fungsi.php";
$nim = $_GET["nim"];

if( hapus_mahasiswa($nim) > 0 ){
	echo "
			<script>
				alert('Berhasil di hapus');
				document.location.href = '?page=mahasiswa';
			</script>
		";

}else{
	echo "Error deleting record: " . mysqli_error($conn); die;
	// echo "
	// 		<script>
	// 			alert('Gagal di hapus');
	// 			document.location.href = '?page=mahasiswa';
	// 		</script>
	// 	";
}

 ?>