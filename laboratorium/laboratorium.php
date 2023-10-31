<?php include 'header.php'; ?>
  <title>Pelayanan Laboratorium</title>
  
<?php 
$tgl= $_GET['tgl'];
?>    

<div class="content-wrapper">
<section class="content">

<!-- notifikasi -->      
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='gagal'){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i>Gagal !</h4>
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
                      Data Pasien Berhasil Disimpan
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
                      Data Pasien Berhasil Diupdate
                    </div>
                    <?php
                  }elseif($_GET['alert']=="daftar"){
                    ?>
                    <div class="alert alert-info alert-dismissible">
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
            <h3 class="box-title"><i class="fa fa-flask"></i>&nbsp Pelayanan Laboratorium</h3>
            </div>

          
          <div class="box-body">
              
                <form method="get" action="">
                <div class="form-group">
                    <label>Filter Tanggal</label>
                    <input autocomplete="off" type="date" value="<?php echo $_GET['tgl']; ?>" name="tgl" class="form-control" style="width:20%" onchange="this.form.submit();">   
                </div>
                </form>
                
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr class=bg-olive>
                    <th width="1%" class=text-center>NO</th>
                    <th class=text-center width="10%">TANGGAL</th>
                    <th class=text-center width="7%">NO RM</th>
                    <th class=text-center>NAMA</th>
                    <th class=text-center>ALAMAT</th>
                    <th class=text-center>STATUS</th>
                    <th class="text-center" width="7%"></th>
                    <th class="text-center" width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    include '../koneksi.php';
                    $nomor=1;
                    $filter= date("Y-m-d");
                    if(isset($_GET['tgl'])){
                    $tgl= $_GET['tgl'];
                    
                    $data = mysqli_query($koneksi,"SELECT * FROM visit WHERE visit_tanggal LIKE '%$tgl%' order by visit_id ASC");
                    }else{
                    $data = mysqli_query($koneksi,"SELECT * FROM visit WHERE visit_tanggal='$filter' order by visit_id ASC") ;
                    }
                    while($d = mysqli_fetch_array($data)){
                    ?> 
                    <tr>
                      <td class=text-center><?php echo $nomor++; ?></td>
                      <td class=text-center><?php echo date('d-m-Y', strtotime($d['visit_tanggal'])); ?></td>
                      <td><?php echo $d['visit_norm']; ?></td>
                      <td><?php echo $d['visit_nama']; ?></td>
                      <td><?php echo $d['visit_alamat']; ?></td>
                      <td class=text-center><?php echo $d['visit_lab']; ?></td>
                      <td class="text-center"><a href="laboratorium_cekin.php?id=<?php echo $d['visit_id'] ?>" class="btn btn-sm btn-info">ISI HASIL</a></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#print_hasil<?php echo $d['visit_id'] ?>">
                        <i class="fa fa-print"></i>
                        </button>                          
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#status_berkas_<?php echo $d['visit_id'] ?>">
                        <i class="fa fa-sign-in"></i>
                        </button>
                        <!--<a href="hasil_laboratorium_print.php?id=<?php echo $d['visit_id']; ?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>
                        <a href="hasil_laboratorium_print2.php?id=<?php echo $d['visit_id']; ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i></a>-->
<!-- modal print -->
                      <form action="transisi_print.php" method="POST" enctype="multipart/form-data">
                      <div class="modal fade" id="print_hasil<?php echo $d['visit_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-olive">
                              <h4 class="modal-title" id="exampleModalLabel"><center>Cetak Hasil Pemeriksaan</center></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                
                                <input type="hidden" name="id" class="form-control" value="<?php echo $d['visit_id'] ?>">
                                
                                <div class="form-group col-lg-6">
                                <label>Jam Terima</label>
                                <input type="text" style="width:100%" name="terima" class="form-control" placeholder="Masukkan Jam Terima...">
                                </div>
                                <div class="form-group col-lg-6">
                                <label>Jam Hasil</label>
                                <input type="text" style="width:100%" name="hasil" class="form-control" placeholder="Masukkan Jam Hasil...">
                                </div>
                                <div class="form-group col-lg-12">
                                <label>Diagnosa</label>
                                <input type="text" style="width:100%" name="diagnosa" class="form-control" placeholder="Masukkan Diagnosa...">
                                </div>
                                
                                <div class="form-group col-lg-12">
                                    <label> </label>
                                    </div>
                                    
                                <div class="form-group col-lg-6">
                                    <div class="form-check form-check-inline text-center">
                                    <input class="form-check-input" type="radio" name="print" id="inlineRadio1" value="tanpa">
                                    <label class="form-check-label" for="inlineRadio1"><i class="fa fa-print"></i>&nbsp PRINT TANPA KOP</label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="form-check form-check-inline text-center">
                                    <input class="form-check-input" type="radio" name="print" id="inlineRadio2" value="dengan" required="required">
                                    <label class="form-check-label" for="inlineRadio2"><i class="fa fa-print"></i>&nbsp PRINT DENGAN KOP</label>
                                    </div>
                                </div>
                                
                                <div class="form-group col-lg-12">
                                    <label> </label>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <center>
                                <button type="sumbit" class="btn btn-warning"><i class="fa fa-print"></i>&nbsp PRINT</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i>&nbsp Tutup</button>
                                </center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>                        

<!-- status berkas -->
                      <form action="status_lab.php" method="post">
                        <div class="modal fade" id="status_berkas_<?php echo $d['visit_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="box box-success">
                                <div class="box-header bg-gray">
                                <h3 class="box-title"><i class="fa fa-file"></i>&nbsp STATUS BERKAS HASIL LABORATORIUM</h3>
                                </div>                                

                              <div class="modal-body">
                                    <input type="hidden" name="id" class="form-control" value="<?php echo $d['visit_id'] ?>">
                                    <input type="hidden" name="masuk" class="form-control" value="<?php echo $_GET['tgl']; ?>">
                                    
                                <div class="form-group col-lg-12">
                                    <label>Status Berkas</label>
                                    <select name="status" class="form-control" style="width:100%" required="required">
                                    <option value="PROSES">PROSES</option>
                                    <option value="DITERIMA">DITERIMA PASIEN</option>
                                    <option value="TERSIMPAN">TERSIMPAN</option>
                                    <option value="HILANG">HILANG</option>
                                    ?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-lg-12">
                                    <label> </label>
                                </div>                                
                                
                            </div>
                              <div class="modal-footer">
                                <center>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                </center>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>


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