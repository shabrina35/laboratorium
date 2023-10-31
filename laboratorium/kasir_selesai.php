<?php include 'header.php'; ?>
<title>KASIR</title>
<div class="content-wrapper bg-gray">

<section class="content">
<?php 
$tgl= $_GET['tgl'];
?>  
<!-- Notifikasi -->      
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='success'){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i> success !</h4>
                      Data Pasien <b>berhasil</b> Tersimpan !!!
                    </div>								
                    <?php                    
                  }elseif($_GET['alert']=="batal"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Kunjungan Pasien Berhasil Dibatalkan !!
                    </div>
                    <?php   
                  }elseif($_GET['alert']=="gagal"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> GAGAL !!!</h4>
                      Pasien Sudah Didaftarkan Hasri Ini !!
                    </div>
                    <?php                     
                  }
                }
                ?> 
<!-- kolom 1 -->
<div class="row">
    <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header bg-green">
            <h3 class="box-title"><i class="fa fa-money"></i> &nbsp KASIR</h3>
              </div>
            <div class="box-body">
            <form method="get" action="">
                    <div class="row">
                        <div class="col-md-1">
                            <b><p align="left">Kasir</p></b>
                        </div>
                        <div class="col-md-2">
                            <p align="left">: <?php echo $_SESSION['nama']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <b><p align="right"></p></b>
                        </div>
                        <div class="col-md-3">
                            <label>Filter Tanggal</label>
                            <p align="left"><input autocomplete="on" type="date" value="<?php echo $_GET['tgl']; ?>" name="tgl" class="form-control bg-yellow" required="required" onchange="this.form.submit();"></p> 
                        </div>                        
                    </div><br>
            </div>
        </div>
    </section>
</div>
<!-- kolom 2 -->          
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
              
<nav class="navbar navbar-dark bg-dark">
                <?php 
                include '../koneksi.php';
                $filter= date("Y-m-d");
                if(isset($_GET['tgl'])){                  
                  $tgl= $_GET['tgl'];
                  $antrian = mysqli_query($koneksi,"SELECT * FROM visit WHERE visit_tanggal like '%$tgl%' AND (visit_status='BELUM BAYAR')");
                  $pulang = mysqli_query($koneksi,"SELECT * FROM visit WHERE visit_status='TERBAYARKAN' and visit_tanggal like '%$tgl%'");
                }else{
                    $antrian = mysqli_query($koneksi,"SELECT * FROM visit WHERE visit_tanggal='$filter' AND (visit_status='BELUM BAYAR')");
                    $pulang = mysqli_query($koneksi,"SELECT * FROM visit WHERE visit_status='TERBAYARKAN' and visit_tanggal='$filter'");
                }
                $jumlah_antrian = mysqli_num_rows($antrian);
                $jumlah_pulang = mysqli_num_rows($pulang);
                {
                ?>    
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" style="color: black;" href="kasir.php"><b>ANTRIAN PEMBAYARAN ( <?php echo $jumlah_antrian; ?> )</b></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" active" style="background-color: #7ffa84;" href="#"><b>SELESAI PEMBAYARAN ( <?php echo $jumlah_pulang; ?> )</b></a>
  </li>
</ul> 
</nav>

                  <?php 
                }
                ?>  
        <div class="box-body">
        <form method="get" action="">
        <div class="row">

          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr class=bg-green>
                    <th class="text-center">NO</th>
                    <th>TANGGAL KUNJUNG</th>
                    <th>NO RM</th>                    
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $nomor=1;
                  $filter= date("Y-m-d");
                if(isset($_GET['tgl'])){
                $tgl= $_GET['tgl'];
                $data = mysqli_query($koneksi,"SELECT * FROM visit WHERE visit_tanggal LIKE '%$tgl%' AND (visit_status='TERBAYARKAN') order by visit_id ASC");
                }else{
                $data = mysqli_query($koneksi,"SELECT * FROM visit WHERE visit_tanggal='$filter' AND (visit_status='TERBAYARKAN') order by visit_id ASC") ;
                    }
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $nomor++; ?></td>
                      <td><?php echo date("d-m-Y", strtotime($d['visit_tanggal'])); ?>
                        <?php echo date("h:i", strtotime($d['visit_jam'])); ?> WIB</td>                                              
                      <td><?php echo $d['visit_norm']; ?></td>
                      <td><?php echo $d['visit_nama']; ?></td>
                      <td><?php echo $d['visit_alamat']; ?></td>
                      <td class="text-center"><?php echo $d['visit_status']; ?></td>
                      <td class="text-center">
                          <a href="kasir_bayar.php?id=<?php echo $d['visit_id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-money"></i> &nbsp Bayar</a>
                        </td>                      
                    </tr>

                  <?php 
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        
                    
                    </div>
                    
                </form> 

      </div>
    </section>

</section>
</div>
<?php include 'footer.php'; ?>