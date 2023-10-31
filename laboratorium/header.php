<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="../gambar/favicon.png">
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="../assets/dist/css/skins/skin-green.min.css">
  <link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <?php 
  include '../koneksi.php';
  session_start();
  if($_SESSION['status'] != "laboratorium_logedin"){
    header("location:../index.php?alert=belum_login");
  }
  ?>

</head>
<body class="hold-transition skin-green sidebar-mini">

  <style>
    #table-datatable {
      width: 100% !important;
    }
    #table-datatable .sorting_disabled{
      border: 1px solid #f4f4f4;
    }
  </style>
  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><b><i class="fa fa-server"></i></b> </span>
        <img src="../gambar/logoatas.png" width="130">
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="profil.php">
                <?php 
                $id_user = $_SESSION['id'];
                $profil = mysqli_query($koneksi,"select * from user where user_id='$id_user'");
                $profil = mysqli_fetch_assoc($profil);
                if($profil['user_foto'] == ""){ 
                  ?>
                  <img src="../gambar/sistem/user.png" class="user-image">
                <?php }else{ ?>
                  <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="user-image">
                <?php } ?>
                <span class="hidden-xs"><?php echo $_SESSION['nama']; ?></span>
              </a>
            </li>
            <li>
              <a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <?php 
            $id_user = $_SESSION['id'];
            $profil = mysqli_query($koneksi,"select * from user where user_id='$id_user'");
            $profil = mysqli_fetch_assoc($profil);
            if($profil['user_foto'] == ""){ 
              ?>
              <img src="../gambar/sistem/user.png" class="img-circle">
            <?php }else{ ?>
              <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="img-circle" style="max-height:45px">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        
<!-- MAIN NAVIGASI -->

<ul class="sidebar-menu" data-widget="tree">
<li class="header bg-olive">MAIN NAVIGASI</li>

          <li>
            <a href="index.php">
              <i class="fa fa-dashboard" style="color: yellow;"></i> <span>DASHBOARD</span>
            </a>
          </li>          
          <li>
            <a href="pasien.php">
              <i class="fa fa-users" style="color: yellow;"></i> <span>MASTER PASIEN</span>
            </a>
          </li> 
          <li>
            <a href="pendaftaran.php">
              <i class="fa fa-hospital-o" style="color: yellow;"></i> <span>PENDAFTARAN</span>
            </a>
          </li>
          <li>
            <a href="laboratorium.php">
              <i class="fa fa-flask" style="color: yellow;"></i> <span>LABORATORIUM</span>
            </a>
          </li>          
          <li>
            <a href="kasir.php">
              <i class="fa fa-money" style="color: yellow;"></i> <span>KASIR</span>
            </a>
          </li>
          <li>
            <a href="stok.php">
              <i class="fa fa-server" style="color: yellow;"></i> <span>DATA STOK</span>
            </a>
          </li>          
          <li class="treeview">
            <a href="#">
              <i class="fa fa-gear" style="color: yellow;"></i>
              <span>MASTER</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="ms_klasifikasi.php"><i class="fa fa-circle-o"></i> MASTER KLASIFIKASI</a></li>
                <li><a href="ms_pemeriksaan.php"><i class="fa fa-circle-o"></i> MASTER PEMERIKSAAN</a></li>
                <li><a href="ms_pengirim.php"><i class="fa fa-circle-o"></i> MASTER PENGIRIM</a></li>
                <li><a href="ms_sub_klasifikasi.php"><i class="fa fa-circle-o"></i> MASTER SUB KLASIFIKASI</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-file" style="color: yellow;"></i>
              <span>LAPORAN</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="laporan_rekap_dokter.php"><i class="fa fa-circle-o"></i> JUMLAH PASIEN DOKTER</a></li>
                <li><a href="laporan_jasa.php"><i class="fa fa-circle-o"></i> RINCIAN JASA DOKTER</a></li>
            </ul>
          </li>          
          <li>
            <a href="profil.php">
              <i class="fa fa-user" style="color: yellow;"></i> <span>PROFIL</span>
            </a>
          </li> 
          <li>
            <a href="gantipassword.php">
              <i class="fa fa-lock" style="color: yellow;"></i> <span>GANTI PASSWORD</span>
            </a>
          </li>
          <li>
            <a href="logout.php">
              <i class="fa fa-sign-out" style="color: yellow;"></i> <span>LOGOUT</span>
            </a>
          </li>
        </ul>
        </li>
        </ul>
        </li>          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
