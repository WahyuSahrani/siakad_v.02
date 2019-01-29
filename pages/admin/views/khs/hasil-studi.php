<?php 

  include "../../config/fungsi.php";


  $jadwal = mysqli_query($conn, "SELECT * FROM jadwal
           INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
           INNER JOIN semester ON jadwal.id_semester = semester.id_semester");
 ?>

 <section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="#"> Dashboard</a></li>
    <li class="active"> Kelas Prodi</li>
  </ol>    
  </section>

  <section class="content">
       <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Tahun Semester</th>
                  <th>Semester</th>
                  <th>Kode MatKul</th>
                  <th>Nama MatKul</th>
                  <th>SKS</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($jadwal as $row) : ?>
                <tr>                  
                  <td><?= $row['nama_semester']?></td>
                  <td><?= $row['semester']?></td>
                  <td><?= $row['kode_mk']?></td>
                  <td><?= $row['nama_mk']?></td>
                  <td><?= $row['sks']?></td>
                
                  <td><a href="?page=khs&aksi=input&id_krs=<?= $row["id_krs"]; ?>"><span class="btn btn-success"><i class="fa fa-list">Lihat Peserta</i></span></a></td>
                </tr>      
                  <?php endforeach; ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>