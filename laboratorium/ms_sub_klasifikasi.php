<?php include 'header.php'; ?>
<title>Master Sub Klasifikasi Pemeriksaan</title>
<div class="content-wrapper">
<section class="content">

<!-- notifikasi -->      
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='gagal'){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i>Gagal ! DATA PASIEN GANDA</h4>
                      Data Pasien Sudah Ada Di Master Pasien !!!
                    </div>								
                    <?php 
                  }elseif($_GET['alert']=="gagal1"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> gagal !</h4>
                      Pasien sudah didaftarkan hari ini.
                    </div>
                    <?php                    
                  }elseif($_GET['alert']=="berhasil"){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Klasifikasi Berhasil Disimpan
                    </div>
                    <?php
                  }elseif($_GET['alert']=="hapus"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Pasien Berhasil Dihapus
                    </div>
                    <?php
                  }elseif($_GET['alert']=="update"){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Klasifikasi Berhasil Diupdate
                    </div>
                    <?php
                  }elseif($_GET['alert']=="daftar"){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Pasien Berhasil Didaftarkan, Silahkan Cek Form Pendaftaran !!!
                    </div>                    
                    <?php                      
                  }
                }
                ?>      
      
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header bg-green">
            <h3 class="box-title"><i class="fa fa-server"></i>&nbsp Sub Klasifikasi Pemeriksaan</h3>
            
              <button type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Sub Klasifikasi
              </button>
              </div>

          
          <div class="box-body">

<!-- Modal tambah-->
            <form id="myCartNew" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-gray">
                              <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Tambah Sub Klasifikasi</h3></div>
                        </div>
                        
                    <div class="modal-body">
                        
                    <div class="form-group col-lg-12">
                    <div class="form-group">
                        <?php 
                        $klasifikasi= mysqli_query($koneksi, "SELECT * FROM ms_klasifikasi");
                        ?>                        
                            <label>KLASIFIASI</label>
                            <input autocomplete="off" type="text" name="klasifikasi" id="klasifikasi" class="form-control" onchange="changeValue(this.value)" list="datalist1">
                            <datalist id="datalist1">
                            <?php  
                            if(mysqli_num_rows($klasifikasi)) {
                            while($k= mysqli_fetch_array($klasifikasi)) {?>
                            <option value="<?php echo $k["klasifikasi"]?>"> KODE : <?php echo $k["kode_klasifikasi"]?> 
                            <?php } ?>
                            <?php } ?>  
                            </datalist>  
                    </div>
                    </div> 
                    
                        <div class="form-group col-lg-6">
                            <label>KODE KLASIFIKASI</label>
                            <input type="number" value="<?php echo $k['kode_klasifikasi'] ?>" class="form-control form-control" id="kode_klasifikasi" name="kode_klasifikasi" onchange="total()" readonly>
                        </div>  
                      
                      <div class="form-group col-lg-6">
                        <label>KODE SUB KLASIFIKASI</label>
                        <input type="text" name="kodesubklasifikasi" class="form-control" placeholder="Masukkan Nama Kode Sub Klasifikasi..." required="required">
                      </div>
                      
                      <div class="form-group col-lg-12">
                        <label>NAMA SUB KLASIFIKASI</label>
                        <input type="text" name="klasifikasi" class="form-control" placeholder="Masukkan Nama Sub Klasifikasi..." required="required">
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

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr class=bg-olive>
                    <th width="1%" class=text-center>NO</th>
                    <th width="2%" class=text-center>KODE</th>
                    <th class=text-center>SUB KLASIFIKASI</th>
                    <th class="text-center" width="8%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM ms_sub_klasifikasi order by sub_klasifikasi_id DESC");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class=text-center><?php echo $no++; ?></td>
                      <td class=text-center><?php echo $d['kode_sub_klasifikasi']; ?></td>
                      <td><?php echo $d['sub_klasifikasi']; ?></td>
                      <td>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_klasifikasi_<?php echo $d['sub_klasifikasi_id'] ?>">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_klasifikasi<?php echo $d['sub_klasifikasi_id'] ?>">
                        <i class="fa fa-trash"></i>
                      </button>


<!-- modal edit -->
                      <form action="ms_sub_klasifikasi_update.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="edit_klasifikasi_<?php echo $d['sub_klasifikasi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              
                        <div class="box box-success">
                          <div class="box-header bg-gray">
                              <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Edit Klasifikasi</h3></div>
                        </div>
                            
                            <div class="modal-body">
                                <input type="hidden" style="width:100%" name="id" class="form-control" value="<?php echo $d['sub_klasifikasi_id'] ?>">
                                
                            <div class="form-group col-lg-12">
                                <label>KLASIFIASI</label>
                                <select name="subklasifikasi" style="width:100%" class="form-control">
                                <option value="<?php echo $d['subklasifikasi'] ?>"><?php echo $d['klasifikasi'] ?></option>
                                <?php 
                                $klasifikasi = mysqli_query($koneksi,"SELECT * FROM ms_klasifikasi");
                                while($k = mysqli_fetch_array($klasifikasi)){
                                ?>
                                <option <?php if(isset($_GET['klasifikasi'])){ if($_GET['klasifikasi'] == $k['klasifikasi_id']){echo "selected='selected'";}} ?>  value="<?php echo $k['klasifikasi_id']; ?>"><?php echo $k['klasifikasi']; ?></option>
                                <?php 
                                }
                                ?>
                                </select>
                            </div>
                            <br>
                                
                                <div class="form-group col-lg-6">
                                  <label>KODE KLASIFIKASI</label>
                                  <input type="text" style="width:100%" name="kode" class="form-control" value="" readonly>
                                </div>
                                
                                <div class="form-group col-lg-6">
                                  <label>KODE SUB KLASIFIKASI</label>
                                  <input type="text" style="width:100%" name="kodesubklasifikasi" class="form-control" value="<?php echo $d['kode_sub_klasifikasi'] ?>">
                                </div>
                                <br>
                                
                                <div class="form-group col-lg-12">
                                  <label>SUB KLASIFIKASI</label>
                                  <input type="text" style="width:100%" name="sub_klasifikasi" class="form-control" value="<?php echo $d['sub_klasifikasi'] ?>">
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
                      <div class="modal fade" id="hapus_klasifikasi<?php echo $d['sub_klasifikasi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-gray">
                              <h3 class="box-title"><i class="fa fa-trash"></i> &nbsp Peringatan !!!</h3></div>
                        </div>
                            <div class="modal-body">
                                <input type="hidden" style="width:100%" name="id" class="form-control" value="<?php echo $d['sub_klasifikasi_id'] ?>">
                              <p>yakin ingin menghapus <b><?php echo $d['sub_klasifikasi'] ?></b>?</p>

                            </div>
                            <div class="modal-footer">
                              <a href="ms_sub_klasifikasi_hapus.php?id=<?php echo $d['sub_klasifikasi_id'] ?>" class="btn btn-danger">Hapus</a>
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