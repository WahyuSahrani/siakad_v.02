<?php 
session_start();
  include "../../../../config/fungsi.php";

$_SESSION['idsemester'] = $_POST['prov_id'];
$id_semester = $_SESSION['idsemester'];

$nim = $_SESSION['mahasiswa'];

// var_dump($id_semester ); die();
   $materi = mysqli_query($conn, "SELECT * FROM materi
          INNER JOIN mata_kuliah ON materi.id_mk = mata_kuliah.id_mk
          WHERE materi.id_mk = $id_semester ");
 ?>
         
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
                <table class='table table-hover'> 
            <tr>
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
               INNER JOIN khs ON jadwal.id_krs = khs.id_krs
               WHERE khs.nim = $nim AND khs.id_semester = $id_semester "); 
           ?>       
          <?php foreach ($jadwal as $row) : ?>
          <tr>                
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
            </div>
            <!-- /.box-body -->
          
          <!-- /.box -->
    </section>