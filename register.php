<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Form Register</title>
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

  <div class="container">
    <div class="login-box">
      <center>
        <?php
        if (isset($_GET['alert'])) {
          if ($_GET['alert'] == "nik_gagal") {
            echo "<div class='alert alert-danger'>GAGAL<br>NIK tidak terdaftar di PRAKTEK<br>dr. Didik Suprayitno, Sp.OG!</div>";
          } else if ($_GET['alert'] == "success") {
            echo "<div class='alert alert-success'>AKUN BERHASIL DIBUAT<br>silahkan login ke form login</div>";
          } else if ($_GET['alert'] == "user_gagal") {
            echo "<div class='alert alert-warning'>USERNAME sudah digunakan<br>ganti USERNAME yang lain</div>";
          } else if ($_GET['alert'] == "nik_terdaftar") {
            echo "<div class='alert alert-warning'>NIK sudah terdaftar<br>Hub admin untuk cek user, no Admin di halaman bawah</div>";            
          }
        }
        ?>
      </center>
      
        <div class="login-box">
          <center><img src="logo.png" style="max-width:20%"></center>
          
          <span style="color: Black;">
            <center>
              <h4><B>dr. Didik Suprayitno, Sp.OG</B></h4>
            </center>
          </span></p>
          
          <form action="process-register.php" method="POST">
              
            <div class="form-group has-feedback">
                <label>Nama</label>
              <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama" required="required" autocomplete="off">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            
            <div class="form-group has-feedback">
                <label>Nik</label>
              <input type="text" class="form-control" placeholder="Masukkan NIK" name="nik" required="required" autocomplete="off">
              <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
            </div>
            
            <div class="form-group has-feedback">
                <label>Username</label>
              <input type="text" class="form-control" placeholder="username" name="username" required="required" autocomplete="off">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            
            <div class="form-group has-feedback">
                <label>Password</label>
              <input type="password" class="form-control" placeholder="password" name="password" required="required" autocomplete="off">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            
            <input type="hidden" class="form-control" placeholder="password" name="level" value="pasien" autocomplete="off">
            <input type="hidden" class="form-control" placeholder="password" name="foto" autocomplete="off">


<!-- tombol -->      
            <div class="row">
                <div class="col-xs-6 text-center">
                    <h5><a href="index.php"><u>Kembali</u></a></h5>
                </div>                  
                <div class="col-xs-6">
                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-plus"></i>&nbsp Daftar Akun</button>
                </div>
            </div>
            <br>
            <span style="color: black;">
                <center>
                <h5>Sudah punya akun? Login <a href="index.php"> DISINI!!! </a>, jika ada kendala login silahkan <a href="https://wa.me/6287758734682/?text=PRAKTEK dr. Didik Suprayitno, Sp.OG">Hub Admin</a></h5>
                </center>
            </span>            
            
          </form>
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