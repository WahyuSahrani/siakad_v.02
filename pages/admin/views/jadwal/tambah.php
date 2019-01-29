<?php 
require "../../config/fungsi.php";
$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$semester = mysqli_query($conn, "SELECT * FROM semester");
$mk = mysqli_query($conn, "SELECT * FROM mata_kuliah");
//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])){

  //cek apakah    data berhasil ditambahkan atau tidak
  if(tambah_jadwal($_POST) > 0 ){
    echo "
      <script>
        alert('data berhasil ditambahkan:');
        document.location.href = '?page=jadwal';
      </script>
    ";
  } else {
    echo ("error ". mysqli_error($conn));
    die();
    echo "
      <script>
        alert('data gagal ditambahkan:');
        document.location.href = '?page=jadwal';
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
      <li class="active"> Tambah Jadwal</li>
  </ol> 
</section>

 <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Jadwal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="mk">Mata Kuliah</label>
                    <select name="mk" class="form-control" id="mk"> 
                      <option value="">- Pilih -</option> 
                        <?php foreach ($mk as $row): ?>
                          <?php echo '<option name="mk" value="'.$row["id_mk"].'">'.$row["nama_mk"].' | '.$row["semester"].'</option>'; ?>
                        <?php endforeach; ?>                    
                    </select>
                </div>
              <div class="form-group">
                <label for="dosen">Dosen</label>
                <select name="dosen" class="form-control" id="dosen">
                  <option value="">- Pilih -</option> 
                  <?php foreach ($dosen as $row): ?>
                    <?php echo '<option name="nip" value="'.$row["nip"].'">'.$row["nama"].'</option>'; ?>
                  <?php endforeach; ?>                    
                </select>
              </div>  
              <div class="form-group">
                <label for="semester">Semester</label>
                <select name="semester" class="form-control" id="semester">             
                  <option value="">- Pilih -</option> 
                  <?php foreach ($semester as $row): ?>
                    <?php echo '<option name="id_semester" value="'.$row["id_semester"].'">'.$row["nama_semester"].'</option>'; ?>
                  <?php endforeach; ?>                    
                </select>
              </div> 
              <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control" id="hari">
                  <option value="SENIN"> SENIN </option>
                  <option value="SELASA"> SELASA </option>
                  <option value="RABU"> RABU </option>
                  <option value="KAMIS"> KAMIS </option>
                  <option value="JUM'AT"> JUM'AT </option>
                  <option value="SABTU"> SABTU </option>
                </select>
              </div>
              <div class="form-group">
                  <label for="mulai">Jam Mulai</label>
                  <input type="time" class="form-control" name="mulai" id="mulai">
              </div> 
              <div class="form-group">
                  <label for="selesai">Jam Selesai</label>
                  <input type="time" class="form-control" name="selesai" id="selesai">
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