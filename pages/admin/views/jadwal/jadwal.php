<?php 
  include "../../config/fungsi.php";
  $jadwal = mysqli_query($conn, "SELECT * FROM jadwal
           INNER JOIN mata_kuliah ON jadwal.id_mk = mata_kuliah.id_mk
           INNER JOIN dosen ON jadwal.nip = dosen.nip");

 ?>


 <section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="#"> Dashboard</a></li>
    <li class="active"> Jadwal</li>
  </ol>    
  </section>

  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Jadwal Kuliah</h3>
               <a href="?page=jadwal&aksi=tambah" class="btn btn-success btn-ms"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
               <a href="views/jadwal/cetak.php" target="_blank" class="btn btn-success btn-ms"> <span class="glyphicon glyphicon-print"></span> Cetak </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Mata Kuliah</th>
                  <th>Semester</th>
                  <th>Hari</th>    
                  <th>Jam</th>
                  <th>Dosen</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($jadwal as $row) :  ?>   
                <tr>                                  
                  <td><?= $i; ?></td>
                  <td><?= $row["nama_mk"]; ?></td>
                  <td><?= $row["semester"]; ?></td>   
                  <td><?= $row["hari"]; ?></td> 
                  <td><?= $row["jam_mulai"].' - '.$row["jam_selesai"]; ?></td> 
                  <td><?= $row["nama"]; ?></td>              
                  <td style="text-align: center;">
                   <a href="?page=jadwal&aksi=ubah&id_krs=<?= $row["id_krs"]; ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
                   <a href="?page=jadwal&aksi=hapus&id_jadwal=<?= $row["id_jadwal"]; ?>"onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                  </td>
                  <?php $i++; ?>               
                  <?php endforeach; ?>
                </tr>                
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Mata Kuliah</th>
                  <th>Semester</th>
                  <th>Hari</th>    
                  <th>Jam</th>
                  <th>Dosen</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>          
    </section>

 <!-- jQuery 3 -->
