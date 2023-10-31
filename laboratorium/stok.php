<?php include 'header.php'; ?>

<div class="content-wrapper">
<title>DATA STOK</title>


  <section class="content">
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='success'){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> success !</h4>
                      Data Stok <b>berhasil</b> Dibuat !!!
                    </div>								
                    <?php                    
                  }elseif($_GET['alert']=="hapus"){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i> success !</h4>
                      Data Stok Berhasil Dihapus !!!
                    </div>
                    <?php                     
                  }
                }
                ?> 
                
    <div class="row">
    <form method="get" action="">
      <section class="col-lg-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Data Stok</h3>
          </div>
          <div class="box-body">
              
              <div class="row">
                <div class="col-md-3">

                  <div class="form-group">
                    <input autocomplete="off" type="text" value="<?php if(isset($_GET['tanggal_dari'])){echo $_GET['tanggal_dari'];}else{echo "";} ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <input autocomplete="off" type="text" value="<?php if(isset($_GET['tanggal_sampai'])){echo $_GET['tanggal_sampai'];}else{echo "";} ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <input type="submit" value="TAMPILKAN DATA" class="btn btn-sm btn-success btn-block">
                  </div>

                </div>
                </form>
                
<!-- input stok baru -->                
                <form method="POST" action="">
                <div class="col-md-3">
                    <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d");?>">
                    <input type="hidden" name="judul" value="Laporan Data Stok">
                    <input type="hidden" name="petugas" value="<?php echo $_SESSION['nama']; ?>">
                    <input type="hidden" name="status" value="kosong">
                  <div class="form-group">
                      <button type="submit" name="start" class="btn btn-sm btn-warning btn-block"><i class="fa fa-plus-square"></i>&nbsp STOK BARU</a></button>
                  </div>

                </div>                
              </div>
            </form>
            
<?php 
if(isset($_POST['start'])){
$tanggal = $_POST['tanggal'];
$judul = $_POST['judul'];
$petugas = $_POST['petugas'];
$status = $_POST['status'];
$tambah = mysqli_query($koneksi, "insert into stok values (NULL,'$tanggal','$judul','$petugas','$status')");
header("location:stok.php");
}
?>

<!-- akhir -->             
            
          </div>
        </div>

        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Laporan Stok</h3>
          </div>
          <div class="box-body">

              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">DARI TANGGAL</th>
                      <th width="1%">:</th>
                      <td><?php if(isset($_GET['tanggal_dari'])){echo $_GET['tanggal_dari'];}else{echo date("M-Y");} ?></td>
                    </tr>
                    <tr>
                      <th>SAMPAI TANGGAL</th>
                      <th>:</th>
                      <td><?php if(isset($_GET['tanggal_sampai'])){echo $_GET['tanggal_sampai'];}else{echo date("M-Y");} ?></td>
                    </tr>
                  </table>
                  
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr class=bg-green>
                      <th width="1%">NO</th>
                      <th width="10%" class="text-center">TANGGAL</th>
                      <th class="text-center">NAMA</th>
                      <th class="text-center">PETUGAS</th>
                      <th width="10%" class="text-center">OPSI</th>
                      <th width="5%" class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;
                    $sekarang = date("Y-m");
                    $tgl_dari = $_GET['tanggal_dari'];
                    $tgl_sampai = $_GET['tanggal_sampai'];
                    if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])){
                    $data = mysqli_query($koneksi,"SELECT * FROM stok WHERE date(tanggal)>='$tgl_dari' and date(tanggal)<='$tgl_sampai'");
                    }else{
                    $data = mysqli_query($koneksi,"SELECT * FROM stok WHERE tanggal LIKE '%$sekarang%' order by stok_id desc");
                    }
                    while($d = mysqli_fetch_array($data)){
                      ?>
                      
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                        <td><?php echo $d['judul']; ?></td>
                        <td><?php echo $d['petugas']; ?></td>
                        <td class=text-center>
                        <?php 
                        if ($d['status'] == "kosong"){ ?>
                        <a href="stok_detail.php?id=<?php echo $d['stok_id'] ?>" class="btn btn-sm btn-success">ISI STOK</a>
                        
                        <?php
                        }else if($d['status'] == "terisi"){ ?>
                        <a href="stok_edit.php?id=<?php echo $d['stok_id'] ?>&tgl=<?php echo $d['tanggal'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="stok_print.php?id=<?php echo $d['stok_id'] ?>&tgl=<?php echo $d['tanggal'] ?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>
                        <?php } ?>
                        </td>
                        <td>
                            <form method="POST" action="">
                             <input type="hidden" name="idstok" value="<?php echo $d['stok_id']; ?>">   
                            <button type="submit" name="hapusstok" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></button>
                            </form>
                            <?php 
                            if(isset($_POST['hapusstok'])){
                            $idstok = $_POST['idstok'];
                            $hapusstok = mysqli_query($koneksi, "DELETE FROM stok WHERE stok_id='$idstok'");
                            $hapusdetail = mysqli_query($koneksi, "DELETE FROM stok_detail WHERE id_stok='$idstok'");
                            header("location:stok.php?alert=hapus");
                            }
                            ?>                            
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
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>