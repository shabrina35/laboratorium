<?php include 'header.php'; ?>

<div class="content-wrapper">
<title>EDIT STOK</title>
<?php 
$idstok = $_GET['id'];
$idtgl = $_GET['tgl'];
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
                    <input autocomplete="off" type="text" name="satuan" class="form-control" placeholder="Masukkan Spesifikasi Bahan..." required="required">
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
$tambah1 = mysqli_query($koneksi, "insert into stok_detail values (NULL,'$bahan','$satuan', '', '', '$idstok')");
header("location:stok_edit.php?id=$idstok");
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
                      <th width="12%" class="text-center">OPSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;
                    $data = mysqli_query($koneksi,"SELECT * FROM stok_detail WHERE id_stok='$idstok' order by stokdetail_id ASC");
                    while($d = mysqli_fetch_array($data)){
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><input type="text" name="bahan" class="form-control" value="<?php echo $d['stok_bahan']; ?>" readonly></td>
                        <td class="text-center"><input type="text" name="satuan" class="form-control" value="<?php echo $d['stok_satuan']; ?>" readonly></td>
                        <td><input type="text" name="awal" class="form-control" value="<?php echo $d['awal']; ?>" readonly></td>
                        <td><input type="text" name="masuk" class="form-control" value="<?php echo $d['masuk']; ?>" readonly></td>
                        <td><input type="text" name="keluar" class="form-control" value="<?php echo $d['keluar']; ?>" readonly></td>
                        <td class=text-center>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_stok_<?php echo $d['stokdetail_id'] ?>">EDIT</button>                            
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_stok_<?php echo $d['stokdetail_id'] ?>">HAPUS</button>
                        </td>
                      </tr>
<!-- modal edit -->
                      <form action="stok_edit_update.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="edit_stok_<?php echo $d['stokdetail_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              
                        <div class="box box-success">
                          <div class="box-header">
                              <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Edit Data Stok</h3></div>
                        </div>
                            
                            <div class="modal-body">
                                <input type="hidden" style="width:100%" name="id" class="form-control" value="<?php echo $d['stokdetail_id'] ?>">
                                <input type="hidden" style="width:100%" name="idstok" class="form-control" value="<?php echo $d['id_stok'] ?>">
                                
                                <div class="form-group col-lg-6">
                                  <label>NAMA BAHAN</label>
                                  <input type="text" style="width:100%" name="bahan" class="form-control" value="<?php echo $d['stok_bahan'] ?>">
                                </div>  
                                <div class="form-group col-lg-6">
                                  <label>SPESIFIKASI BAHAN</label>
                                  <input type="text" style="width:100%" name="satuan" class="form-control" value="<?php echo $d['stok_satuan'] ?>">
                                </div> 
                                <div class="form-group col-lg-4">
                                  <label>QTY AWAL</label>
                                  <input type="number" style="width:100%" name="awal" class="form-control" value="<?php echo $d['awal'] ?>">
                                </div>                                
                                <div class="form-group col-lg-4">
                                  <label>QTY MASUK</label>
                                  <input type="number" style="width:100%" name="masuk" class="form-control" value="<?php echo $d['masuk'] ?>">
                                </div> 
                                <div class="form-group col-lg-4">
                                  <label>QTY AKHIR</label>
                                  <input type="number" style="width:100%" name="keluar" class="form-control" value="<?php echo $d['keluar'] ?>">
                                </div>                                 
                                
                            </div>
                                <div class="form-group col-lg-12">
                                    <label> </label>
                                </div>
                                
                            <div class="modal-footer">
                                <center>
                               <button type="submit" class="btn btn-success">Simpan</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              </center>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </form>  
<!-- modal hapus -->
                      <div class="modal fade" id="hapus_stok_<?php echo $d['stokdetail_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header">
                              <h3 class="box-title"><i class="fa fa-trash"></i> &nbsp Peringatan !!!</h3></div>
                        </div>
                            <div class="modal-body">

                              <p>yakin ingin menghapus data ini?</p>

                            </div>
                            <div class="modal-footer">
                              <a href="stok_edit_hapus.php?id=<?php echo $d['stokdetail_id'] ?>&kembali=<?php echo $d['id_stok'] ?>" class="btn btn-danger">Hapus</a>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div>                    
                    
                      <?php 
                    }
                    ?>
                  </tbody>
                </table>
            <div class="form-group col-lg-12">
                <center>
                <a href="stok.php" class="btn btn-success"><i class="fa fa-backward"></i>&nbsp Kembali</a>
                <a href="stok_print.php?id=<?php echo $idstok ?>&tgl=<?php echo $idtgl ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"> &nbsp Print</i></a>
                </center>
            </div>

              </div>

          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>