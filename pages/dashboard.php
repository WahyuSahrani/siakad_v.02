 <section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="callout callout-info">
    <h4>Selamat Datang  
      <?php 
      if (isset($_SESSION['admin'])) {
      //  echo $_SESSION['admin']; 
        echo $_SESSION['nama'];
      }else if (isset($_SESSION['dosen'])) { 
        echo $_SESSION['nama'];
      }else if (isset($_SESSION['mahasiswa'])) { 
        echo $_SESSION['nama'];
      } 
      ?> di sistem informasi akademik.</h4>

  
     Sistem informasi akademik adalah sistem yang memungkinkan para civitas akademik POLITEKNIK MUARA TEWEH untuk menerima informasi dengan lebih cepat malalui internet. Sistem ini diharapkan dapat memberikan kemudahan setiap civitas akademia untuk melakukan aktivitas-aktivitas akademik dan proses belajar mengajar. Selamat menggunakan fasilitas ini.</p>
  </div>
</section>

 