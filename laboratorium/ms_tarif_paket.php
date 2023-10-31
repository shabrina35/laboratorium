<?php include 'header.php'; ?>
  <title>Tarif Paket</title>
<div class="content-wrapper">
<section class="content">

<!-- notifikasi -->      
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='gagal'){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i>Gagal ! DATA PEMERIKSAAN GANDA</h4>
                      Data Pemeriksaan Sudah Ada Di Master Pemeriksaan !!!
                    </div>								
                    <?php 
                  }elseif($_GET['alert']=="berhasil"){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Pemeriksaan Berhasil Disimpan
                    </div>
                    <?php
                  }elseif($_GET['alert']=="hapus"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Pemeriksaan Berhasil Dihapus
                    </div>
                    <?php
                  }elseif($_GET['alert']=="update"){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Pemeriksaan Berhasil Diupdate
                    </div>
                    <?php
                  }
                }
                ?>      
      
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header bg-green">
            <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Master Tarif Paket</h3>
            <a href="ms_pemeriksaan.php" class="btn btn-warning btn-sm pull-right">Kembali</a>
             </div>

          
          <div class="box-body">


            <form method="get" action="">
            <div class="table-responsive col-lg-12">
                <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr class=bg-olive>
                    <th width="1%" class=text-center>NO</th>
                    <th class=text-center>PAKET</th>
                    <th width="10%" class=text-center>TARIF</th>                     
                    <th class="text-center" width="5%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                    $data = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi where klasifikasi_id=klasifikasi_pemeriksaan and sub_klasifikasi='Paket'");
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class=text-center><?php echo $no++; ?></td>
                      <td><?php echo $d['klasifikasi']; ?></td>
                      <td><?php echo $d['tarif']; ?></td>                      
                      <td class="text-center">    
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_pemeriksaan_<?php echo $d['pemeriksaan_id'] ?>">
                        <i class="fa fa-pencil"></i>
                      </button>


<!-- modal edit -->
                      <form action="ms_tarif_paket_update.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="edit_pemeriksaan_<?php echo $d['pemeriksaan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              
                        <div class="box box-success">
                          <div class="box-header bg-gray">
                              <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Edit Data Paket - <?php echo $d['klasifikasi']; ?></h3></div>
                        </div>
                            
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $d['pemeriksaan_id'] ?>">

                      
                      <div class="form-group col-lg-12 col-xs-12">
                        <label>TARIF</label>
                            <input type="text" name="tarif" style="width:100%" class="form-control" required="required" value='<?php echo $d['tarif']; ?>'>
                      </div>

                      
                      <div class="form-group col-lg-12">
                          <label> </label>
                      </div>                       
                      
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
                      <div class="modal fade" id="hapus_pemeriksaan_<?php echo $d['pemeriksaan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-trash"></i> &nbsp Peringatan !!!</h3></div>
                        </div>
                            <div class="modal-body">

                              <p>yakin ingin menghapus <b><?php echo $d['pemeriksaan'] ?></b>?</p>

                            </div>
                            <div class="modal-footer">
                              <a href="ms_pemeriksaan_hapus.php?id=<?php echo $d['pemeriksaan_id'] ?>" class="btn btn-danger">Hapus</a>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div>

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