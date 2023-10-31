<?php include 'header.php'; ?>
<title>DASHBOARD</title>
<div class="content-wrapper bg-gray">

        
<section class="content">
<!-- KOLOM 1 -->
<div class="row">
    <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-body">
            <center>
                        <img src="../logo.png" width="130"><p>
                        JL A. Yani, No.177, Bangunsari
                        <br>
                        Caruban, Madiun, Jawa Timur 63153
                        <br>
                        (0351) 386228 CARUBAN
            </center>                 
            </div>    
        </div>
    </section>
  
<!-- KOLOM 2 -->    
    <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header bg-green">
            <h3 class="box-title"><i class="fa fa-hospital-o" style="color: yellow;"></i> &nbsp Laboratorium Klinik Diagnostic</h3></div>
            <div class="box-body">
                         
<!-- MASTER PASIEN -->    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="pasien.php">
        <div class="well well-sm text-center bg-green">
            <img src="../gambar/menu/pasien.png" width="70">
            <!--<i class="fa fa-users fa-5x" style="color: white;"></i>-->
            <h4 style="font-weight: bolder">PASIEN</h4>
            master data pasien
        </div>
    </a>
</div>
        
<!-- PENDAFTARAN -->    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="pendaftaran.php">
        <div class="well well-sm text-center bg-green">
            <img src="../gambar/menu/daftar.png" width="70">
            <!--<i class="fa fa-hospital-o fa-5x" style="color: white;"></i>-->
            <h4 style="font-weight: bolder">PENDAFTARAN</h4>
            pendaftaran pasien
        </div>
    </a>
</div>
        
<!-- KASIR -->    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="kasir.php">
        <div class="well well-sm text-center bg-green">
            <img src="../gambar/menu/uang.png" width="70">
            <!--<i class="fa fa-money fa-5x" style="color: white;"></i>-->
            <h4 style="font-weight: bolder">KASIR</h4>
            pembayaran
        </div>
    </a>
</div>

<!-- PROFIL -->    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="profil.php">
        <div class="well well-sm text-center bg-green">
            <img src="../gambar/menu/profil.png" width="70">
            <!--<i class="fa fa-user-md fa-5x" style="color: white;"></i>-->
            <h4 style="font-weight: bolder">PROFIL</h4>
            edit profil
        </div>
    </a>
</div>

<!--GANTI PASSWORD -->                    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="gantipassword.php">
        <div class="well well-sm text-center bg-green">
            <img src="../gambar/menu/kunci.png" width="70">
            <!--<i class="fa fa-lock fa-5x" style="color: white;"></i>-->
            <h4 style="font-weight: bolder">PASSWORD</h4>
            ubah password
        </div>
    </a>
</div>
      
<!--LOGOUT -->                    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="logout.php">
        <div class="well well-sm text-center bg-green">
            <i class="fa fa-sign-out fa-5x" style="color: red;"></i>
            <h4 style="font-weight: bolder">LOGOUT</h4>
            keluar aplikasi
        </div>
    </a>
</div>

</div>
</div>
</section>





             
            
  </section>
</div>
<?php include 'footer.php'; ?>