<?php include 'header.php'; ?>

<div class="content-wrapper">
<title>UPDATE STOK</title>
<?php 
$idstok = $_GET['id'];
?>

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
      <section class="col-lg-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">TAMBAH BAHAN</h3>
          </div>
          <div class="box-body">
              
            <form method="POST" action="">
              <div class="row">
                <div class="col-md-3">

                  <div class="form-group">
                    <input autocomplete="off" type="text" name="bahan" class="form-control" placeholder="Masukkan Nama Bahan..." required="required">
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <input autocomplete="off" type="text" name="satuan" class="form-control" placeholder="Masukkan Nama Bahan..." required="required">
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <input type="submit" name="tambahbahan" value="TAMBAH BAHAN" class="btn btn-sm btn-success btn-block">
                  </div>

                </div>
                </form>
                
                <div class="col-md-3">

                  <div class="form-group">
                      <a href="stok.php" class="btn btn-sm btn-info btn-block"><i class="fa fa-backward"></i>&nbsp KEMBALI</a>
                  </div>

                </div>                 
            
<?php 
if(isset($_POST['tambahbahan'])){
$bahan = $_POST['bahan'];
$satuan = $_POST['satuan'];
$tambah1 = mysqli_query($koneksi, "insert into template_stok values (NULL,'$bahan','$satuan')");
header("location:stok_detail.php?id=$idstok");
}
?>

<!-- akhir -->             
            
          </div>
        </div>

        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">INPUT DATA STOK</h3>
          </div>
          <div class="box-body">
              
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr class=bg-green>
                      <th width="1%">NO</th>
                      <th class="text-center">NAMA BAHAN</th>
                      <th class="text-center">SPESIFIKASI BAHAN</th>
                      <th class="text-center">QTY AWAL</th>
                      <th class="text-center">QTY MASUK</th>
                      <th class="text-center">QTY AKHIR</th>
                      <th width="5%" class="text-center">OPSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;
                    $data = mysqli_query($koneksi,"SELECT * FROM template_stok");
                    while($d = mysqli_fetch_array($data)){
                      ?>
                      <form method="POST" action="">
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><input type="text" name="bahan[]" class="form-control" value="<?php echo $d['bahan']; ?>" readonly></td>
                        <td class="text-center"><input type="text" name="satuan[]" class="form-control" value="<?php echo $d['satuan']; ?>" readonly></td>
                        <td><input type="number" name="awal[]" class="form-control" placeholder="Masukkan Qty Awal"></td>
                        <td><input type="number" name="masuk[]" class="form-control" placeholder="Masukkan Qty Masuk"></td>
                        <td><input type="number" name="keluar[]" class="form-control" placeholder="Masukkan Qty Akhir"></td>
                        <td class=text-center>
                            <input type="hidden" name="idstok" value="<?php echo $d['stok_id']; ?>"> 
                            <input type="hidden" name="tid" value="<?php echo $d['template_id']; ?>">
                            <button type="submit" name="hapusstok" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></button>
                        </td>
                      </tr>
                      <?php 
                    }
                    ?>
                  </tbody>
                </table>
            <div class="form-group col-lg-12">
                <center>
                <button type="submit" name="simpanstok" class="btn btn-primary"><i class="fa fa-floppy-o"></i>&nbsp Simpan</button>
                <button type="reset" class="btn btn-warning"><i class="fa fa-trash"></i>&nbsp Reset</button>
                <a href="stok.php" class="btn btn-success"><i class="fa fa-backward"></i>&nbsp Kembali</a>
                </center>
            </div>
            </form>
                            <?php 
                            if(isset($_POST['simpanstok'])){
                            $bahan = $_POST['bahan'];
                            $satuan = $_POST['satuan'];
                            $masuk = $_POST['masuk'];
                            $keluar = $_POST['keluar'];
                            $awal = $_POST['awal'];
                            $jumlahdata = count($bahan);
                            mysqli_query($koneksi, "update stok set status='terisi' where stok_id='$idstok'");
                            
                            for
                            ($x=0;$x<$jumlahdata;$x++){
                            mysqli_query($koneksi, "insert into stok_detail values (NULL, '$bahan[$x]','$satuan[$x]','$masuk[$x]','$keluar[$x]','$idstok','$awal[$x]')")or die(mysqli_error($koneksi));
                            header("location:stok.php");
                            }
                            ?> 
                            
                            
                      <?php 
                    }
                    ?>      
                    
                            <?php 
                            if(isset($_POST['hapusstok'])){
                            $tid = $_POST['tid'];
                            mysqli_query($koneksi, "delete from template_stok where template_id='$tid'");
                            header("location:stok_detail.php?id=$idstok");
                            }
                            ?>  
                            

              </div>

          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>