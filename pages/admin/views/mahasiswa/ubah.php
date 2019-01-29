<?php 
  include "../../config/fungsi.php";

  $dosen = mysqli_query($conn, "SELECT * FROM dosen");
  $prodi = mysqli_query($conn, "SELECT * FROM jurusan");
  // ambil data di URL
  $nim = $_GET["nim"];

  $mahasiswa = query("SELECT * FROM mahasiswa WHERE nim = $nim")[0];

  if(isset($_POST["submit"])){
 
  // cek apakah  data berhasil diubah atau tidak
  if(ubah_mahasiswa($_POST) > 0 ){
    echo "
      <script>
        alert('data berhasil diubah:');
        document.location.href = '?page=mahasiswa';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('data gagal diubah:');
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
      <li class="active"> Ubah Mahasiswa</li>
  </ol> 
</section>

 <section class="content">
      <div class="row">
        <!-- left column -->

          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Mahasiswa</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <input type="hidden" name="fotoLama" value="<?= $mahasiswa["foto"]; ?>">
                  <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM" value="<?= $mahasiswa["nim"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama" id="nama" value="<?= $mahasiswa["nama"]; ?>" placeholder="Nama" required>
                  </div>
                   <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <input type="text" class="form-control" autocomplete="off" name="jk" id="jk" value="<?= $mahasiswa["jenis_kelamin"]; ?>" placeholder="Jenis Kelamin" required>
                  </div>
                   <div class="form-group">
                    <label for="tempat">Tempat Lahir</label>
                    <input type="text" class="form-control" autocomplete="off" name="tempat" value="<?= $mahasiswa["tempat_lahir"]; ?>" id="tempat" placeholder="Tempat Lahir" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal Lahir</label>
                    <input type="text" class="form-control" autocomplete="off" name="tanggal"  value="<?= $mahasiswa["tgl_lahir"]; ?>" placeholder="Tanggal Lahir" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" autocomplete="off" name="alamat" id="alamat" value="<?= $mahasiswa["alamat"]; ?>" placeholder="Alamat" required>
                  </div>
                   <div class="form-group">
                    <label for="telp">Telepon</label>
                    <input type="text" class="form-control" autocomplete="off" name="telp" id="telp" value="<?= $mahasiswa["telp"]; ?>" placeholder="Telepon" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" autocomplete="off" name="email" id="email"  value="<?= $mahasiswa["email"]; ?>"  required>
                  </div>
                  <div class="form-group">
                  <label for="agama">Agama</label>
                    <select name="agama" class="form-control" id="agama" value="<?= $mahasiswa["agama"]; ?>">     
                    <option value="">- Pilih -</option>
                    <option value="Islam">Islam</option> 
                    <option value="Kristen">Kristen</option> 
                    <option value="Katholik">Katholik</option> 
                    <option value="Hindu">Hindu</option> 
                    <option value="Budha">Budha</option>  
                    <option value="Konghucu">Konghucu</option>   
                    </select>
                   </div>
                   <div class="form-group">
                    <label for="foto">Foto</label>
                    <img src="../../assets/img/<?= $mahasiswa["foto"]; ?>" width="50px"><br>
                    <input type="file" class="form-control" name="foto" id="foto">
                  </div>
                  <div class="form-group">
                  <label for="ketua">Dosen Wali</label>
                    <select name="nip" class="form-control" id="nip" value="<?= $mahasiswa["nim"]; ?>">             
                    <option value="">- Pilih -</option> 
                    <?php foreach ($dosen as $mahasiswa): ?>
                      <?php echo '<option name="nip" value="'.$mahasiswa["nip"].'">'.$mahasiswa["nama"].'</option>'; ?>
                    <?php endforeach; ?>                    
                    </select>
                   </div>   

                  <div class="form-group">
                  <label for="prodi">Program Studi</label>
                    <select name="prodi" class="form-control" id="prodi" value="<?= $mahasiswa["nim"]; ?>">             
                    <option value="">- Pilih -</option> 
                    <?php foreach ($prodi as $mahasiswa): ?>
                      <?php echo '<option name="prodi" value="'.$mahasiswa["id_jurusan"].'">'.$mahasiswa["nama_jurusan"].'</option>'; ?>
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



