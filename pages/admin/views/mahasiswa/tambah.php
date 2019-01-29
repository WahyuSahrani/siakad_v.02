<?php 
require "../../config/fungsi.php";

$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$prodi = mysqli_query($conn, "SELECT * FROM jurusan");

//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])){

	//cek apakah    data berhasil ditambahkan atau tidak
	if(tambah_mahasiswa($_POST) > 0 ){
		echo "
			<script>
				alert('data berhasil ditambahkan:');
				document.location.href = '?page=mahasiswa';
			</script>
		";
	} else {
		echo ("error ". mysqli_error($conn));
    die;
		echo "
		 	<script>
				alert('data gagal ditambahkan:');
				document.location.href = '?page=mahasiswa';
			</script>
		";
	}

}
?>


<section class="content-header">
  <h1>
    Dashboard
     <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="#"> Dashboard</a></li>
      <li class="active"> tambah dosen</li>
  </ol> 
</section>

 <section class="content">
      <div class="row">
        <!-- left column -->

          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Dosen</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama" id="nama" placeholder="Nama" required>
                  </div>
                   <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk" class="form-control" id="jk">     
                      <option value="">- Pilih -</option>
                      <option value="Perempuan">Perempuan</option> 
                      <option value="Laki-Laki">Laki-Laki</option> 
                    </select>
                  </div>
                   <div class="form-group">
                    <label for="tempat">Tempat Lahir</label>
                    <input type="text" class="form-control" autocomplete="off" name="tempat" id="tempat" placeholder="Tempat Lahir" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal Lahir</label>
                    <input type="text" class="form-control" autocomplete="off" name="tanggal" id="tanggal" placeholder="Tanggal Lahir" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" autocomplete="off" name="alamat" id="alamat" placeholder="Alamat" required>
                  </div>
                   <div class="form-group">
                    <label for="telp">Telepon</label>
                    <input type="text" class="form-control" autocomplete="off" name="telp" id="telp" placeholder="Telepon" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" autocomplete="off" name="email" id="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                  <label for="agama">Agama</label>
                    <select name="agama" class="form-control" id="agama">     
                    <option value="">- Pilih -</option>
                    <option value="ISLAM">Islam</option> 
                    <option value="KRISTEN">Kristen</option> 
                    <option value="KATHOLIK">Katholik</option> 
                    <option value="HINDU">Hindu</option> 
                    <option value="BUDHA">Budha</option>  
                    <option value="KONGHUCU">Konghucu</option>   
                    </select>
                   </div>
                   <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" name="foto" id="foto">
                  </div>
                  <div class="form-group">
                  <label for="ketua">Dosen Wali</label>
                    <select name="nip" class="form-control" id="nip">             
                    <option value="">- Pilih -</option> 
                    <?php foreach ($dosen as $row): ?>
                      <?php echo '<option name="nip" value="'.$row["nip"].'">'.$row["nama"].'</option>'; ?>
                    <?php endforeach; ?>                    
                    </select>
                   </div>   

                  <div class="form-group">
                  <label for="prodi">Program Studi</label>
                    <select name="prodi" class="form-control" id="prodi">             
                    <option value="">- Pilih -</option> 
                    <?php foreach ($prodi as $row): ?>
                      <?php echo '<option name="prodi" value="'.$row["id_jurusan"].'">'.$row["nama_jurusan"].'</option>'; ?>
                    <?php endforeach; ?>                    
                    </select>
                   </div>  
                   <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                  </div>
                   <div class="form-group">
                    <label for="password1">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password1" id="password1" placeholder="Konfirmasi Password" required>
                  </div>   
                  <div class="box-footer">
                  <button type="submit" name="submit" value="tambah" class="btn btn-primary">Simpan</button>
                  </div>          
                </div>
              <!-- /.box-body -->            
             
            </form>
          </div>      
     </div>
    </section>



