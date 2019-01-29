 <?php 
  include "../../config/fungsi.php";
  $mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa");

 ?>

 <section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="#"> Dashboard</a></li>
    <li class="active"> Mahasiswa</li>
  </ol>    
  </section>

  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Mahasiswa</h3>
               <a href="?page=mahasiswa&aksi=tambah" class="btn btn-success btn-ms"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
               <a href="views/mahasiswa/cetak.php" class="btn btn-success btn-ms"><span class="glyphicon glyphicon-print"></span>  Cetak</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th> 
                  <th>Email</th>
                  <th>Agama</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($mahasiswa as $row) :  ?>   

                <tr>
                  <td><?= $row["nim"]; ?></td>
                  <td><?= $row["nama"]; ?></td>
                  <td><?= $row["jenis_kelamin"]; ?></td>
                  <td><?= $row["alamat"]; ?></td>
                  <td><?= $row["email"]; ?></td>
                  <td><?= $row["agama"]; ?></td>
                  <td style="text-align: center;">
                   <a href="?page=mahasiswa&aksi=ubah&nim=<?= $row["nim"]; ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                   <a href="?page=mahasiswa&aksi=hapus&nim=<?= $row["nim"]; ?>"onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                  <?php $i++; ?>               
                  <?php endforeach; ?>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Jenis Kemlamin</th>
                  <th>Alamat</th> 
                  <th>Email</th>
                  <th>Agama</th>
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
