<?php 
  include "../../config/fungsi.php";
  $semester = mysqli_query($conn, "SELECT * FROM semester");

 ?>


 <section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="#"> Dashboard</a></li>
    <li class="active"> Semester</li>
  </ol>    
  </section>

  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Semester</h3>
               <a href="?page=semester&aksi=tambah" class="btn btn-success btn-ms"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
               <a href="views/semester/cetak.php" class="btn btn-success btn-ms"> <span class="glyphicon glyphicon-print"></span>Cetak </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID Semester</th>
                  <th>Nama Semester</th>
                  <th>Status</th>    
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($semester as $row) :  ?>   
                <tr>                                  
                  <td><?= $row["id_semester"]; ?></td>
                  <td><?= $row["nama_semester"]; ?></td>
                  <td><?= $row["status"]; ?></td>              
                  <td style="text-align: center;">
                   <a href="?page=semester&aksi=status&id_semester=<?= $row["id_semester"]; ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> 
                    <?php if($row['status'] == '1'){ 
                      echo "Nonaktif";
                    } else 
                      echo "Aktifkan"; 
                    ?>
                  </a>
                   <a href="?page=semester&aksi=hapus&id_semester=<?= $row["id_semester"]; ?>"onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                  </td>
                  <?php $i++; ?>               
                  <?php endforeach; ?>
                </tr>                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID Semester</th>
                  <th>Nama Semester</th>
                  <th>Status</th>    
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
