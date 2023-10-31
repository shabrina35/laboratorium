<?php include 'header.php'; ?>
<div class="content-wrapper">

        
<section class="content">
<!-- KOLOM 1 -->
<div class="row">
  
<!-- KOLOM 2 -->    
    <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header bg-green">
            <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Administrator</h3></div>
            <div class="box-body bg-gray">
                         
<!-- DASHBOARD -->    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="index.php">
        <div class="well well-sm text-center bg-orange">
            <i class="fa fa-dashboard fa-5x" style="color: white;"></i>
            <h4 style="font-weight: bolder">DASHBOARD</h4>
            dashboard
        </div>
    </a>
</div>

<!-- USER -->    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="user.php">
        <div class="well well-sm text-center bg-navy">
            <i class="fa fa-user-md fa-5x" style="color: white;"></i>
            <h4 style="font-weight: bolder">USER</h4>
            Data Pengguna
        </div>
    </a>
</div>

<!-- PROFIL -->    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="profil.php">
        <div class="well well-sm text-center bg-olive">
            <i class="fa fa-user fa-5x" style="color: white;"></i>
            <h4 style="font-weight: bolder">PROFIL</h4>
            profil pengguna
        </div>
    </a>
</div>

<!--GANTI PASSWORD -->                    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="gantipassword.php">
        <div class="well well-sm text-center bg-blue">
            <i class="fa fa-lock fa-5x" style="color: white;"></i>
            <h4 style="font-weight: bolder">PASSWORD</h4>
            Ubah Password
        </div>
    </a>
</div>
      
<!--LOGOUT -->                    
<div class="col-lg-2 col-xs-6">
    <a class="nav-link" href="logout.php">
        <div class="well well-sm text-center bg-green">
            <i class="fa fa-sign-out fa-5x" style="color: white;"></i>
            <h4 style="font-weight: bolder">LOGOUT</h4>
            Keluar Aplikasi
        </div>
    </a>
</div>

</div>
</div>
</section>





             
            
  </section>
</div>
<?php include 'footer.php'; ?>