<?php 
include "koneksi.php";


// CRUD PRODI
function tambah_prodi($data){
	global $conn;
	//ambil data dari tiap elemen dalam form
	$kode    = htmlspecialchars($data["kode"]);
	$nama    = htmlspecialchars($data["nama"]);
	$bidang  = htmlspecialchars($data["bidang"]);
	$nip     = $data["nip"];	

	//tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO jurusan VALUES ('', '$kode', '$nama', '$bidang', '$nip')");
	return mysqli_affected_rows($conn);
}

function hapus_prodi($id) {
 	global $conn;
 	mysqli_query($conn, "DELETE FROM jurusan WHERE id_jurusan = '$id'");
 	return mysqli_affected_rows($conn);
}

function ubah_prodi($data) {
	global $conn;
	$id      = htmlspecialchars($data["id"]);
	$kode    = htmlspecialchars($data["kode"]);
	$nama    = htmlspecialchars($data["nama"]);
	$bidang  = htmlspecialchars($data["bidang"]);
	$nip     = $data["nip"];

	$query = "UPDATE jurusan SET
				id_jurusan      = '$id',
				kode_jurusan 	= '$kode',
				nama_jurusan    = '$nama',
				bidang_studi    = '$bidang',
				nip			    = '$ketua'
				WHERE id_jurusan = $id";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// CRUD DOSEN
function tambah_dosen($data) {
	global $conn;
	$nip     = htmlspecialchars($data["nip"]);
	$nama    = htmlspecialchars($data["nama"]);
	$jk  	 = htmlspecialchars($data["jk"]);
	$tgl     = htmlspecialchars($data["tanggal"]);
	$alamat  = htmlspecialchars($data["alamat"]);
	$telp  	 = htmlspecialchars($data["telp"]);
	$email   = htmlspecialchars($data["email"]);
	$didik   = htmlspecialchars($data["pendidikan"]);
	$pass    = mysqli_real_escape_string($conn, $data["password"]);
	$pass1   = mysqli_real_escape_string($conn, $data["password1"]);


	//cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT nip FROM dosen WHERE nip = '$nip'");

	if(mysqli_fetch_assoc($result)){
		echo "<script>
				alert('nip sudah terdaftar!');
			  </script>";	
		return false;
	}

	//cek konf irmasi password
	if ($pass !== $pass1){
		echo "<script>
				alert('konfirmasi password tidak sesuai');
			  </script>";
		return false;
	}

	//enkripsi password
	$pass = password_hash($pass, PASSWORD_DEFAULT);
	
	// Upload gambar
	$gambar = upload();
	if(!$gambar){
		return false;
	}

	$query = "INSERT INTO dosen	VALUES 
				('$nip', '$nama','$jk','$tgl','$alamat','$telp','$email','$didik','$gambar','$pass')";

	mysqli_query($conn, $query);
 
	return mysqli_affected_rows($conn);
}

// UPLOAD FOTO
function upload() {
	$namaFile   = $_FILES['foto']['name'];
	$ukuranFile = $_FILES['foto']['size'];
	$error 		= $_FILES['foto']['error'];
	$tmpName 	= $_FILES['foto']['tmp_name']; 

	// Cek apakah tidak ada gambar yang diupload
	// tidak ada gambar yang di upload
	if ($error === 4) { 
		$namaFile = "avatar.png";
		return $namaFile;
	}

	//cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg','jpeg','png','gif'];
	//ambil ekstensi file
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
			alert('yang anda upload bukan gambar');
			</script>";
		return false;
	}

	//cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
			alert('Ukuran gambar terlalu besar');
			</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../../assets/img/'. $namaFileBaru);
	return $namaFileBaru;
}

function hapus_dosen($nip){
	global $conn;
	mysqli_query($conn, "DELETE FROM dosen WHERE nip = $nip");
	return mysqli_affected_rows($conn);
}

function ubah_dosen($data){
	global $conn;
	//ambil data dari tiap elemen dalam form
	$nip     = htmlspecialchars($data["nip"]);
	$nama    = htmlspecialchars($data["nama"]);
	$jk  	 = htmlspecialchars($data["jk"]);
	$tgl     = htmlspecialchars($data["tanggal"]);
	$alamat  = htmlspecialchars($data["alamat"]);
	$telp  	 = htmlspecialchars($data["telp"]);
	$email   = htmlspecialchars($data["email"]);
	$didik   = htmlspecialchars($data["pendidikan"]);
	$pass    = mysqli_real_escape_string($conn, $data["password"]);
	$pass1   = mysqli_real_escape_string($conn, $data["password1"]);
	$fotoLama = htmlspecialchars($data["fotoLama"]);

	if ($pass !== $pass1){
		echo "<script>
				alert('konfirmasi password tidak sesuai');
			  </script>";
		return false;
	}

	//enkripsi password
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	//CEK apakah user pilih gambar baru atau tidak
	if($_FILES['foto']['error'] === 4){
		$foto = $fotoLama;
	}else{
		$foto = upload();
	}

	//query insert data
	$query = "UPDATE dosen SET
				nip 	= '$nip',
				nama 	= '$nama',
				jenis_kelamin 	= '$jk',
				tanggal_lahir = '$tgl',
				alamat	= '$alamat',
				telp	= '$telp',
				email  	= '$email',
				pendidikan_terakhir = '$didik',
				foto  = '$foto',
				password = '$pass'
				WHERE nip = $nip";


	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// CRUD MAHASISWA
function tambah_mahasiswa($data) {
	global $conn;
	$nim     = htmlspecialchars($data["nim"]);
	$nama    = htmlspecialchars($data["nama"]);
	$jk  	 = htmlspecialchars($data["jk"]);
	$tgl     = htmlspecialchars($data["tanggal"]);
	$tempat	 = htmlspecialchars($data["tempat"]);
	$alamat  = htmlspecialchars($data["alamat"]);
	$telp  	 = htmlspecialchars($data["telp"]);
	$email   = htmlspecialchars($data["email"]);
	$agama   = $_POST["agama"];
	$nip     = $data["nip"];
	$prodi   = $data["prodi"];
	$pass    = mysqli_real_escape_string($conn, $data["password"]);
	$pass1   = mysqli_real_escape_string($conn, $data["password1"]);


	//cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT nim FROM mahasiwa WHERE nim = '$nim'");

	if(mysqli_fetch_assoc($result)){
		echo "<script>
				alert('nim sudah terdaftar!');
			  </script>";	
		return false;
	}

	//cek konf irmasi password
	if ($pass !== $pass1){
		echo "<script>
				alert('konfirmasi password tidak sesuai');
			  </script>";
		return false;
	}

	//enkripsi password
	$pass = password_hash($pass, PASSWORD_DEFAULT);
	
	// Upload gambar
	$gambar = upload();
	if(!$gambar){
		return false;
	}

	$query = "INSERT INTO mahasiswa	VALUES 
				('$nim','$nama','$jk','$tempat','$tgl','$alamat','$telp','$email','$agama','$gambar','$pass','$nip','$prodi')";

	mysqli_query($conn, $query);
 
	return mysqli_affected_rows($conn);

}

function hapus_mahasiswa($nim){
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim = $nim");
	return mysqli_affected_rows($conn);
}

function ubah_mahasiswa($data){
	global $conn;
	//ambil data dari tiap elemen dalam form
	global $conn;
	$nim     = htmlspecialchars($data["nim"]);
	$nama    = htmlspecialchars($data["nama"]);
	$jk  	 = htmlspecialchars($data["jk"]);
	$tgl     = htmlspecialchars($data["tanggal"]);
	$tempat	 = htmlspecialchars($data["tempat"]);
	$alamat  = htmlspecialchars($data["alamat"]);
	$telp  	 = htmlspecialchars($data["telp"]);
	$email   = htmlspecialchars($data["email"]);
	$agama   = $_POST["agama"];
	$nip     = $data["nip"];
	$prodi   = $data["prodi"];
	$pass    = mysqli_real_escape_string($conn, $data["password"]);
	$pass1   = mysqli_real_escape_string($conn, $data["password1"]);
	$fotoLama = htmlspecialchars($data["fotoLama"]);

	if ($pass !== $pass1){
		echo "<script>
				alert('konfirmasi password tidak sesuai');
			  </script>";
		return false;
	}

	//enkripsi password
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	//CEK apakah user pilih gambar baru atau tidak
	if($_FILES['foto']['error'] === 4){
		$foto = $fotoLama;
	}else{
		$foto = upload();
	}

	//query insert data
	$query = "UPDATE mahasiswa SET
				nim 			= '$nim',
				nama 			= '$nama',
				jenis_kelamin 	= '$jk',
				tempat_lahir	= '$tempat',
				tgl_lahir 		= '$tgl',
				alamat			= '$alamat',
				telp			= '$telp',
				email  			= '$email',
				agama 			= '$agama',
				foto  			= '$foto',
				password 		= '$pass',
				nip   			= '$nip',
				id_jurusan 		= '$prodi'
				WHERE nim 		= $nim";


	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// CRUD JADWAL
function tambah_jadwal($data){
	global $conn;
	//ambil data dari tiap elemen dalam form
	$mk      = htmlspecialchars($data["mk"]);
	$dosen   = htmlspecialchars($data["dosen"]);
	$sem  	 = htmlspecialchars($data["semester"]);
	$hari    = $data["hari"];
	$mulai   = $data["mulai"];
	$selesai = $data["selesai"];

	//tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO jadwal VALUES ('', '$mk', '$dosen', '$sem', '$hari','$mulai','$selesai')");
	return mysqli_affected_rows($conn);
}

function hapus_jadwal($id) {
 	global $conn;
 	mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = '$id'");
 	return mysqli_affected_rows($conn);
}

function ubah_jadwal($data) {
	global $conn;
	$id 	 = $data["id"];
	$mk      = htmlspecialchars($data["mk"]);
	$dosen   = htmlspecialchars($data["dosen"]);
	$sem  	 = htmlspecialchars($data["semester"]);
	$hari    = $data["hari"];
	$mulai   = $data["mulai"];
	$selesai = $data["selesai"];

	$query = "UPDATE jadwal SET
				id_krs	= '$id',
				id_mk       = '$mk',
				nip 		= '$dosen',
				id_semester = '$sem',
				hari 		= '$hari',
				jam_mulai	= '$mulai',
				jam_selesai	= '$selesai'
				WHERE id_krs = $id";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// CRUD MATA KULIAH
function tambah_mk($data){
	global $conn;
	//ambil data dari tiap elemen dalam form
	$kode   = htmlspecialchars($data["kode"]);
	$nama   = htmlspecialchars($data["nama"]);
	$sks    =htmlspecialchars($data["sks"]);
	$sem    = $data["sem"];


	//tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO jadwal VALUES ('', '$kode', '$nama', '$sks','$sem')");
	return mysqli_affected_rows($conn);
}

function hapus_mk($id) {
 	global $conn;
 	mysqli_query($conn, "DELETE FROM mata_kuliah WHERE id_mk = '$id'");
 	return mysqli_affected_rows($conn);
}

function ubah_mk($data) {
	global $conn;
	$id      = htmlspecialchars($_POST["id"]);
	$kode    = htmlspecialchars($_POST["kode"]);
	$nama    = htmlspecialchars($_POST["nama"]);
	$sks  	 = htmlspecialchars($_POST["sks"]);	
	$sem  	 = htmlspecialchars($_POST["sem"]);

	$query = "UPDATE mata_kuliah SET
				id_mk   = '$id',
				kode_mk = '$kode',
				nama_mk = '$nama',
				sks   	= '$sks',
				semester= '$sem'
				WHERE id_mk = $id";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// FUNGSI UNTUK KRS 
function tambah_krs($data){
	global $conn;
	//ambil data dari tiap elemen dalam form
	$jumlah = count($_POST["cek"]);
	for ($i = 0; $i < $jumlah; $i++) { 		
		$nim    = $_POST["nim"];
		$smt 	= $_POST["semester"];
		$paket  = $_POST["smt1"];
		// $id_mk	= $_POST["kode_mk"][$i];
		$kd 	= $_POST["cek"][$i];	

		
		//tambahkan user baru ke database
		mysqli_query($conn, "INSERT INTO khs VALUES ('','$nim','$kd','$paket','$smt','','','','','')");

		
	}return mysqli_affected_rows($conn);

}

function tambah_materi($data) {
	global $conn;
	
	$kode_mk = htmlspecialchars($data["mk"]);
	$judul   = htmlspecialchars($data["Judul"]);
	// var_dump($kode_smt); die();
	// Upload gambar
	$file = materi();
	if(!$file){
		return false;
	}

	$query = "INSERT INTO materi VALUES 
				('', '$kode_mk','$judul','$file')";

	mysqli_query($conn, $query);
 
	return mysqli_affected_rows($conn);
}

function materi() {
	$namaFile   = $_FILES['file']['name'];
	$ukuranFile = $_FILES['file']['size'];
	$error 		= $_FILES['file']['error'];
	$tmpName 	= $_FILES['file']['tmp_name']; 

	// Cek apakah tidak ada gambar yang diupload
	// tidak ada gambar yang di upload
	if ($error === 4) { 
		echo "<script>
			alert('pilih dokumen terlebih dahulu');
			</script>";
		return false;
	}

	//cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['pdf','doc','docx','pptx','ppt'];
	//ambil ekstensi file
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
			alert('yang anda upload bukan dokumen');
			</script>";
		return false;
	}

	//cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
			alert('Ukuran dokumen terlalu besar');
			</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= $namaFile;
	

	move_uploaded_file($tmpName, '../../assets/materi/'. $namaFileBaru);
	return $namaFileBaru;
}


function hapus_materi($id_materi) {
 	global $conn;

 	$file = query("SELECT * FROM materi WHERE id_materi = $id_materi")[0];
 	$materi = $file['file'];

 	unlink('../../assets/materi/'.$materi);
 	// var_dump($materi); die();
 	mysqli_query($conn, "DELETE FROM materi WHERE id_materi = '$id_materi'");
 	return mysqli_affected_rows($conn);
}