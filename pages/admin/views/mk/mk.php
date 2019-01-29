<?php 
  include "../../config/fungsi.php";
  $mk = mysqli_query($conn, "SELECT * FROM mata_kuliah");

 ?>
 <section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="#"> Dashboard</a></li>
    <li class="active"> MK</li>
  </ol>    
  </section>

  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Mata Kuliah</h3>
               <a href="?page=mk&aksi=tambah" class="btn btn-success btn-ms"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
               <a href="views/mk/cetak.php" target="_blank" class="btn btn-success btn-ms"> <span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kode MK</th>
                  <th>Nama MK</th>
                  <th>SKS</th>
                  <th>Semester</th>                 
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($mk as $row) :  ?>   
                <tr>                                  
                  <td><?= $row["kode_mk"]; ?></td>
                  <td><?= $row["nama_mk"]; ?></td>
                  <td><?= $row["sks"]; ?></td>
                  <td><?= $row["semester"]; ?></td>
                 
                  <td style="text-align: center;">
                   <a href="?page=mk&aksi=ubah&id_mk=<?= $row["id_mk"]; ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
                   <a href="?page=mk&aksi=hapus&id_mk=<?= $row["id_mk"]; ?>"onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                  </td>
                  <?php $i++; ?>               
                  <?php endforeach; ?>
                </tr>                
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode MK</th>
                  <th>Nama MK</th>
                  <th>SKS</th>
                  <th>Semester</th>                 
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>          
    </section>

 <!-- jQuery 3 -->
