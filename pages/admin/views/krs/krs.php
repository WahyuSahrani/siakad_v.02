  <?php 
  if (!isset($_SESSION))session_start();
 include "../../config/fungsi.php";

  
  
  $jadwal = mysqli_query($conn, "SELECT * FROM jadwal
           INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
           INNER JOIN dosen ON jadwal.nip = dosen.nip");


  $semester = mysqli_query($conn, "SELECT nama_semester FROM semester WHERE status = '1'");

  if(isset($_POST["submit"])){

    // var_dump($_POST); die();

  //cek apakah    data berhasil ditambahkan atau tidak
  if(tambah_krs($_POST) > 0 ){
    // echo "Error: " . $_POST . "<br>" . mysqli_error($conn);die();
    echo "
      <script>
        alert('data berhasil ditambahkan:');
        document.location.href = '?page=krs';
      </script>
    ";
   
  } else {
 //   echo "Error: " . $_POST . "<br>" . mysqli_error($conn);die();
    echo "
      <script>
        alert('data gagal ditambahkan:');
        document.location.href = '?page=krs';
      </script>
    ";
  }


}
  ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title></title>
   <script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#prodi').change(function() {
          var provinsi_id = $(this).val();

          $.ajax({
            type: 'POST',
            url: 'views/krs/nim.php',
            data: 'prov_id='+provinsi_id,
            success: function(response) {
              $('#nim').html(response);
            }
          });
        })
      });
    </script>
    <script>
    $(document).ready(function() {
        $('#nim').change(function() {
          var nim = $(this).val();

          $.ajax({
            type: 'POST',
            url: 'views/krs/semester.php',
            data: 'prov_id='+nim,
            success: function(response) {
              $('#smt1').html(response);
            }
          });
        })
      });
    </script>
  <!--     <script>
    $(document).ready(function() {
        $('#smt1').change(function() {
          var smt = $(this).val();

          $.ajax({
            type: 'POST',
            url: 'views/krs/jadwal_mk.php',
            data: 'prov_id='+smt, 
            success: function(response) {
              $('#jadwal').html(response);
            }
          });
        })
      });
    </script> -->
   
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
    <li class="active"> Rencana Studi</li>
  </ol>    
  </section>

<section class="content">
 <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Kartu Rencana Studi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <form action="" method="POST">
              <div class="form-group">
                <label>Program Studi</label>
                <?php 
                  $prodi = mysqli_query($conn, "SELECT * FROM jurusan");
                 ?>
                 <select class="form-control select2" id="prodi" style="width: 100%;">
                   <option value="">-Pilih Prodi-</option>
                   <?php while ($row = mysqli_fetch_array($prodi)) { ?>
                  <option value="<?php echo $row['id_jurusan'] ?>"><?php echo $row['nama_jurusan'] ?></option>
                   <?php } ?>
                </select>        
              </div>
              <div class="form-group">
                  <label>NIM</label>
                   <select class="form-control select2" id="nim" name="nim" style="width: 100%;">
                   
                    <option></option>
                  </select>
              </div>          
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <div class="form-group">
              <label>Tahun Akademik</label>
              <?php 
                $semester = mysqli_query($conn, "SELECT * FROM semester");
               ?>
               <select class="form-control select2" name="semester" id="semester" style="width: 100%;">
                 <?php while ($row = mysqli_fetch_array($semester)) { ?>
                <option value="<?php echo $row['id_semester'] ?>"><?php echo $row['nama_semester'] ?></option>
                <?php } ?>
              </select>

            </div>
            <div class="form-group">
             
              <label>Semester</label>
              <select class="form-control select2" id="smt1" name="smt1" style="width: 100%;">  
                   
                  <option value=""></option>                
              </select>
            </div>
              </div>
         
              <!-- /.form-group -->
            </div>
              <div class="form-group">
                <input type="text" class="form-control" value="Data Mata Kuliah Yang Akan Ditempuh" readonly="">
              </div>
            <!-- /.col -->
    <div class="row" id="jadwal">
       <div class='col-xs-12'>  
   <div class='box-body table-responsive no-padding'>  
   <caption><strong>SEMESTER 1</strong></caption> 
     <table class='table table-hover'> 
                <tr>
            <th>Pilih</th>
            <th>Kode MatKul</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Dosen</th>
            <th>Hari</th>
            <th>Jam</th>
          </tr>
          <?php 
              $jadwal = mysqli_query($conn, "SELECT * FROM jadwal
               INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
               INNER JOIN dosen ON jadwal.nip = dosen.nip
               WHERE mata_kuliah.semester = 1"); 
           ?>       
          <?php foreach ($jadwal as $row) : ?>
          <tr>
            <td><input type="checkbox" name="cek[]" value="<?php echo $row['id_krs']; echo $row['id_mk'] ;?> " ></td>           
            <td><?= $row['kode_mk'] ?></td>
            <td><?= $row['nama_mk'] ?></td>
            <td><?= $row['sks'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['hari'] ?></td>
            <td><?= $row["jam_mulai"].' - '.$row["jam_selesai"]; ?></td>            
          </tr>  
          <?php endforeach; ?>
        </table>

    <caption><strong>SEMESTER 2</strong></caption>
    <table class='table table-hover'>   
          <tr>
            <th>Pilih</th>
            <th>Kode MatKul</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Dosen</th>
            <th>Hari</th>
            <th>Jam</th>
          </tr>
          <?php 
              $jadwal = mysqli_query($conn, "SELECT * FROM jadwal
               INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
               INNER JOIN dosen ON jadwal.nip = dosen.nip
               WHERE mata_kuliah.semester = 2"); 
           ?>       
          <?php foreach ($jadwal as $row) : ?>
          <tr>
            <td><input type="checkbox" name="cek[]" value="<?php echo $row['id_krs']; ?> " ></td>           
            <td><?= $row['kode_mk'] ?></td>
            <td><?= $row['nama_mk'] ?></td>
            <td><?= $row['sks'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['hari'] ?></td>
            <td><?= $row["jam_mulai"].' - '.$row["jam_selesai"]; ?></td>            
          </tr>  
          <?php endforeach; ?>
        </table>
      </div>
     <button type="submit" name="submit" value="tambah" class="btn btn-success btn-ms"><span class="glyphicon glyphicon-plus"></span> Tambah</button>  
    <a href="views/krs/cetak.php" class="btn btn-success btn-ms" target="_blank"> <span class="glyphicon glyphicon-print"></span> Cetak </a>
     </form>
    </div>
    </div>
     </div>
  </section>

 </body>
 </html>



 