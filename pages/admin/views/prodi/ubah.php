<?php 
require "../../config/fungsi.php";

// ambil data di URL
$id = @$_GET["id_jurusan"];

// query data mahasiswa berdasarkan id
$jurusan = query("SELECT * FROM jurusan 
	INNER JOIN dosen ON jurusan.nip = dosen.nip
	WHERE jurusan.id_jurusan = $id")[0];

$dosen = query("SELECT * FROM dosen");
// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {
 
  // cek apakah  data berhasil diubah atau tidak
  if(ubah_prodi($_POST) > 0 ){
    echo "
      <script>
        alert('data berhasil diubah:');
        document.location.href = '?page=prodi';
      </script>
    ";
  } else {
    echo ("error ". mysqli_error($conn));
    var_dump($_POST);
    // echo "
    //   <script>
    //     alert('data gagal diubah:');
    //     document.location.href = '?page=prodi';
    //   </script>
    // ";
  }

}

 ?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
<section class="content-header">
  <h1>
    Dashboard
     <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="#"> Dashboard</a></li>
      <li class="active"> Ubah Prodi</li>
  </ol> 
</section>

 <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Prodi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="">
              <div class="box-body">
              	<div class="form-group">
                  <label for="id">ID Prodi</label>
                  <input type="text" class="form-control" name="id" id="id" readonly="true" value="<?= $jurusan["id_jurusan"]; ?>">
                </div>
                <div class="form-group">
                  <label for="kode">Kode Prodi</label>
                  <input type="text" class="form-control" name="kode" id="kode" value="<?= $jurusan["kode_jurusan"]; ?>">
                </div>
                <div class="form-group">
                  <label for="nama">Nama Prodi</label>
                  <input type="text" class="form-control" name="prodi" id="nama" value="<?= $jurusan["nama_jurusan"]; ?>">
                </div>
                 <div class="form-group">
                  <label for="bidang">Bidang Studi</label>
                  <input type="text" class="form-control" name="bidang" id="bidang" value="<?= $jurusan["bidang_studi"]; ?>">
                </div>
	            <div class="form-group">
                  <label for="ketua">Ketua Prodi</label>
                  <select name="nama" class="form-control" id="nim">          		
	      				<?php echo '<option name="nip" value="'.$jurusan["nip"].'">'.$jurusan["nama"].'</option>'; ?>
	      			<?php foreach ($dosen as $row): ?>
	      				<?php echo '<option name="nip" value="'.$row["nip"].'">'.$row["nama"].'</option>'; ?>
	      			<?php endforeach; ?>       	         		
	          	</select>
                </div>                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" value="tambah" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>           
       </div>
    </section>