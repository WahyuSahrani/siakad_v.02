<?php 
session_start();
if (isset($_SESSION["admin"])) {
  header("location: pages/admin/index.php");
  exit;
}else if(isset($_SESSION["dosen"])) {
  header("location: pages/dosen/index.php");
  exit;
}else if(isset($_SESSION["mahasiswa"])) {
  header("location: pages/mahasiswa/index.php");
  exit;
}

include 'config/koneksi.php';

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

  //cek username
  if (mysqli_num_rows($result) === 1) {
   
    //cek password
    $row = mysqli_fetch_assoc($result); 

    if(sha1($password) == $row["password"]){
    $_SESSION["admin"] = $username;
    $_SESSION["nama"]  = $row['nama'];

    header("location: pages/admin/index.php");
      exit;
    }
  }
   $result = mysqli_query($conn, "SELECT * FROM dosen WHERE nip = '$username'");

  //cek username
  if (mysqli_num_rows($result) === 1) {
   
    //cek password
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row["password"])){
    $_SESSION["dosen"] = $username;
    $_SESSION["nama"]  = $row['nama'];
    $_SESSION["nip"]   = $row['nip'];
    header("location: pages/dosen/index.php");
      exit;
    }
  }
  $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$username'");

  //cek username
  if (mysqli_num_rows($result) === 1) {
   
    //cek password
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row["password"])){
    $_SESSION["mahasiswa"] = $username;
    $_SESSION["nama"]      = $row['nama'];
    $_SESSION["nim"]       = $row['nim'];   
    header("location: pages/mahasiswa/index.php");
      exit;
    }
  }
  $error = true;
  
}

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
   
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>SIAKAD</b> POLIMAT</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    
    <!-- warning username dan password salah -->
    <?php if(isset($error)): ?>
    <div class="callout callout-danger">
          <h4>Warning!</h4>

          <p>Username atau Password Salah</p>
    </div>
    <?php endif; ?>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
               <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>

</body>
</html>
