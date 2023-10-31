<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LABORATORIUM KLINIK DIAGNOSTIK</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="gambar/favicon.png">
</head>

<body class=" bg-primary">
  <div class="container">
    <div class="login-box">
      <center>
        <!--<h3><b>Karya Digital</b></h3>-->
        <br />
        
<!-- NOTOFIKASI-->
        <?php
        if (isset($_GET['alert'])) {
          if ($_GET['alert'] == "gagal") {
            echo "<div class='alert alert-danger'>LOGIN GAGAL! USERNAME DAN PASSWORD SALAH!</div>";
          } else if ($_GET['alert'] == "logout") {
            echo "<div class='alert alert-success'>ANDA TELAH BERHASIL LOGOUT</div>";
          } else if ($_GET['alert'] == "belum_login") {
            echo "<div class='alert alert-warning'>ANDA HARUS LOGIN UNTUK MENGAKSES DASHBOARD</div>";
          } else if ($_GET['alert'] == "login") {
            echo "<div class='alert alert-success'>SUCCESS !!!<br> akun berhasil dibuat<br>silahkan login pada form dibawah ini</div>";            
          }
        }
        ?>
      </center>

      <div class="login-box-body">
          <center><img src="logo.png" style="max-width:30%"><br>
          <b>LABORATORIUM KLINIK<br>
          <span style="color: green;">
              DIAGNOSTIC</b>
            </center>
          </span></p>

          <form action="periksa_login.php" method="POST">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="username" name="username" required="required" autocomplete="off">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="password" name="password" required="required" autocomplete="off">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <br>

<!-- tombol -->      
            <div class="row">
                <div class="col-xs-6">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-sign-in"></i>&nbsp Login</button>    
                </div>
                <div class="col-xs-6">
                    <button type="reset" class="btn btn-warning btn-block"><i class="fa fa-trash"></i>&nbspReset</button>
                </div>
            </div>
            <br>
            <span style="color: black;">
                <center>
                <h5>jika ada kendala login silahkan <a href="#">Hub Admin</a></h5><br>
                </center>
            </span>
            
          </form>
          <br>
        </div>
      </div>
    </div>
    
    <span style="color: black;">
      <center>
        <h5>copyright 2023 @pujiwinarko</h5>
      </center>
    </span></p>

    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>