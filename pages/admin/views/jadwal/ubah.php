<?php 
require "../../config/fungsi.php";

$id = @$_GET["id_krs"];

$jadwal = query("SELECT * FROM jadwal
    INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
    INNER JOIN dosen ON jadwal.nip = dosen.nip
    INNER JOIN semester ON jadwal.id_semester = semester.id_semester
    WHERE jadwal.id_krs = $id")[0];

$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$semester = mysqli_query($conn, "SELECT * FROM semester");
$mk = mysqli_query($conn, "SELECT * FROM mata_kuliah");
//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])){

  //cek apakah    data berhasil ditambahkan atau tidak
  if(ubah_jadwal($_POST) > 0 ){
    echo "
      <script>
        alert('data berhasil diubah:');
        document.location.href = '?page=jadwal';
      </script>
    ";
  } else {
    echo ("error ". mysqli_error($conn));
    var_dump($_POST);die();
    echo "
      <script>
        alert('data gagal diubah:');
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
      <li class="active">  Ubah Jadwal</li>
  </ol> 
</section>

 <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Ubah Jadwal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="id">ID Jadwal</label>
                  <input type="text" class="form-control" name="id" id="id"  value="<?= $jadwal["id_krs"]; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="mk">Mata Kuliah</label>
                    <select name="mk" class="form-control" id="mk"> 
                      <?php echo '<option name="mk" value="'.$jadwal["id_mk"].'">'.$jadwal["nama_mk"].' | '.$jadwal["semester"].'</option>'; ?>
                    <?php foreach ($mk as $row): ?>                                     
                        <?php echo '<option name="mk" value="'.$row["id_mk"].'">'.$row["nama_mk"].' | '.$row["semester"].'</option>'; ?>
                        <?php endforeach; ?>                    
                    </select>
                </div>
              <div class="form-group">
                <label for="dosen">Dosen</label>
                <select name="dosen" class="form-control" id="dosen">
                  <?php echo '<option name="mk" value="'.$jadwal["nip"].'">'.$jadwal["nama"].'</option>'; ?>
                  <?php foreach ($dosen as $row): ?>
                    <?php echo '<option name="nip" value="'.$row["nip"].'">'.$row["nama"].'</option>'; ?>
                  <?php endforeach; ?>                    
                </select>
              </div>  
              <div class="form-group">
                <label for="semester">Semester</label>
                <select name="semester" class="form-control" id="semester">             
                  <?php echo '<option name="mk" value="'.$jadwal["id_semester"].'">'.$jadwal["nama_semester"].'</option>'; ?> 
                  <?php foreach ($semester as $row): ?>
                    <?php echo '<option name="id_semester" value="'.$row["id_semester"].'">'.$row["nama_semester"].'</option>'; ?>
                  <?php endforeach; ?>                    
                </select>
              </div> 
              <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control" id="hari">
                  <?php echo '<option name="mk" value="'.$jadwal["hari"].'">'.$jadwal["hari"].'</option>'; ?> 
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
                  <input type="time" class="form-control" name="mulai" id="mulai" value="<?= $jadwal["jam_mulai"];?>">
              </div> 
              <div class="form-group">
                  <label for="selesai">Jam Selesai</label>
                  <input type="time" class="form-control" name="selesai" id="selesai" value="<?= $jadwal["jam_selesai"];?>">
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