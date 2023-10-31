<?php 
include 'header.php'; 
include '../koneksi.php';
?>
<title>Pelayanan Laboratorium</title>

<?php 
$visit = $_GET['visit_id'];
?>
 		
<div class="content-wrapper">

<section class="content">
<!-- Notifikasi -->      
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='success'){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> success !</h4>
                      Data Pemeriksaan <b>berhasil</b> Tersimpan !!!
                    </div>								
                    <?php                    
                  }elseif($_GET['alert']=="gagal"){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i> GAGAL !!!</h4>
                      Pasien Sudah Terbayarkan Hari Ini !!
                    </div>
                    <?php                     
                  }
                }
                ?> 
<!-- kolom 1 -->
<div class="row">
    <section class="col-lg-12">
        <div class="box">
            <div class="box-header bg-green">
            <h4><i class="fa fa-flask"></i> Pelayanan Laboratorium
            <a href="laboratorium.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-undo"></i>&nbsp Kembali</a>
            </div>
            
            <div class="box-body">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "select * from visit,ms_pengirim where visit_pengirim=pengirim_id and visit_id='$id'");
              while($d = mysqli_fetch_array($data))
              {
                ?>

                    <div class="row">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table">                        
                                <thead>
                                    <tr>
                                        <th>NO RM</th>
                                        <th>: <i><?php echo $d['visit_norm']; ?></i></th>
                                        <th></th>
                                        <th>ALAMAT</th>
                                        <th>: <i><?php echo $d['visit_alamat']; ?></i></th>
                                        <th></th>
                                        <th>STATUS LAB</th>
                                        <th>: <i><?php echo $d['visit_lab']; ?></i></th>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <th>: <i><?php echo $d['visit_nama']; ?></i></th>
                                        <th></th>
                                        <th>PENGIRIM</th>
                                        <th>: <i><?php echo $d['pengirim']; ?></i></th>
                                        <th></th>
                                        <th>Tgl Kunjung</th>
                                        <th>: <i><?php echo date('d-m-Y', strtotime($d['visit_tanggal'])); ?></i></th>                                        
                                    </tr>
                                </thead>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>

<!-- kolom 2 -->
<div class="row">
<section class="col-lg-12">
<div class="box box-success">
<center><h4>Form Pengisian Hasil Laboratorium</h4></center>


        <form action="laboratorium_act.php" method="post" enctype="multipart/form-data">
        <div class="box-body">
                <input type="hidden" name="id" class="form-control" value="<?php echo $d['visit_id'] ?>" readonly>
                <input type="hidden" name="px" class="form-control" value="<?php echo $d['pasien_id'] ?>" readonly>
                <input type="hidden" name="norm" class="form-control" value="<?php echo $d['visit_norm'] ?>" readonly>
                <input type="hidden" name="nama" class="form-control" value="<?php echo $d['visit_nama'] ?>">
                <input type="hidden" name="alamat" class="form-control" value="<?php echo $d['visit_alamat'] ?>">
                <input type="hidden" value="<?php echo $d['visit_lahir'] ?>" name="lahir" class="form-control">
                <input type="hidden" value="<?php echo date("Y-m-d");?>" name="kunjungan" class="form-control">
                <input type="hidden" value="<?php echo $d['visit_kelamin'] ?>" name="kelamin" class="form-control">
                <input type="hidden" value="BELUM BAYAR" name="status" class="form-control">
                <input type="hidden" value="
                                    <?php 
                                    date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
                                    echo date('h:i:s a'); // menampilkan jam sekarang
                                    ?>
                                " name="jam" class="form-control">
                <input autocomplete="off" type="hidden" value="TERISI" name="lab" class="form-control">
                                  
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                  <tr class=bg-green>
                    <th width="1%">NO</th>
                    <th width="25%" class=text-center>PEMERIKSAAN</th>
                    <th class=text-center>HASIL</th>
                    <th width="15%" class=text-center>SATUAN</th>
                    <th width="20%" class=text-center>NILAI RUJUKAN</th>
                  </tr>
              <?php
              $cari = $d['visit_id'];
              $no=1;
              $input = mysqli_query($koneksi, "SELECT * FROM kasir_detail,ms_pemeriksaan WHERE detail_pemeriksaan=pemeriksaan_id AND visit_id='$cari'");
              while($k = mysqli_fetch_array($input))
              {

                ?>                  
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><input type="text" name="pemeriksaan[]" class="form-control" value="<?php echo $k['pemeriksaan']; ?>" readonly></td>
                        <td><textarea name="hasil[]" class="form-control" rows="2" placeholder="Masukkan Hasil Pemeriksaan"></textarea></td>
                        <td><textarea name="satuan[]" class="form-control" rows="2"><?php echo $k['satuan']; ?></textarea></td>
                        <td><textarea name="nilainormal[]" class="form-control" rows="2"><?php echo $k['nilai_normal']; ?></textarea></td>
                    </tr>
                    <?php }?>
                </tbody>
                </table>

            <div class="form-group col-lg-12">
                <label>Keterangan :</label>
                <textarea name="keterangan" class="form-control" rows="2" placeholder="Masukkan Keterangan.."></textarea>
            </div>

            <div class="form-group col-lg-12">
                <center>
                <button type="submit" class="btn btn-secondary"><i class="fa fa-floppy-o"></i>&nbsp Simpan</button>
                <button type="reset" class="btn btn-secondary"><i class="fa fa-trash"></i>&nbsp Reset</button>
                <a href="laboratorium.php" class="btn btn-warning"><i class="fa fa-backward"></i>&nbsp Kembali</a>
                <!--<a href="hasil_laboratorium_print.php?id=<?php echo $d['visit_id']; ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"> &nbsp Print</i></a>
                <a href="hasil_laboratorium_print2.php?id=<?php echo $d['visit_id']; ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"> &nbsp Print</i></a>
                </center>-->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#print_hasil<?php echo $d['visit_id'] ?>"><i class="fa fa-print"></i>&nbsp Print</button>                
            </div>  
              
            </div>
        </div>
        </form>  

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
        
</div>        
</section>
</div>

<!-- kolom 3 -->

<div class="row">
    <section class="col-lg-12">
        <div class="box">
            <div class="box-header bg-green">
            <h5><i class="fa fa-flask"></i> Hasil Pemeriksaan</h5>
            </div>
            
            <div class="box-body">


            <div class="row">
            <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                  <tr class=bg-green>
                    <th width="1%">NO</th>
                    <th width="30%" class=text-center>PEMERIKSAAN</th>
                    <th class=text-center>HASIL</th>
                    <th class=text-center>SATUAN</th>
                    <th class=text-center>NILAI NORMAL</th>
                    <th width="8%" class=text-center>OPSI</th>
                  </tr>
              <?php
              $cari = $d['visit_id'];
              $nomor=1;
              $hasil = mysqli_query($koneksi, "SELECT * FROM hasil_pemeriksaan WHERE visit_id='$cari'");
              while($h = mysqli_fetch_array($hasil))
              {

                ?>                  
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $nomor++ ?></td>
                        <td><input type="text" name="pemeriksaan[]" class="form-control" value="<?php echo $h['hasil_pemeriksaan']; ?>" readonly></td>
                        <td><textarea name="hasil[]" class="form-control" rows="2" readonly><?php echo $h['hasil_isi']; ?></textarea></td>
                        <td><textarea name="satuan[]" class="form-control" rows="2" readonly><?php echo $h['hasil_satuan']; ?></textarea></td>
                        <td><textarea name="nilainormal[]" class="form-control" rows="2" readonly><?php echo $h['hasil_nilainormal']; ?></textarea></td>
                        <td><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_hasil_<?php echo $h['hasil_id']; ?>"><i class="fa fa-pencil"></i></a></button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus_hasil_<?php echo $h['hasil_id']; ?>"><i class="fa fa-trash"></i></a></button>
 
<!-- modal hapus -->  
                    <form action="hasil_hapus.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="hapus_hasil_<?php echo $h['hasil_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="box box-success">
                            <div class="box-header bg-green">
                            <h3 class="box-title"><i class="fa fa-exclamation-triangle"></i> PERINGATAN</h3></div>
            
                            <div class="box-body">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                            
                            <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $h['hasil_id']; ?>" readonly>
                            <input type="hidden" name="kembali" value="<?php echo $h['visit_id']; ?>" readonly>
                              <p>yakin ingin menghapus pemeriksaan <?php echo $h['hasil_pemeriksaan']; ?>?</p>

                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-danger">Hapus</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                          </div>
                        </div>
                      </div>
                     </form>                        
                        
                        </td>
                    </tr>
<!-- modal edit -->  
                    <form action="hasil_edit.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="edit_hasil_<?php echo $h['hasil_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="box box-success">
                            <div class="box-header bg-green">
                            <h3 class="box-title"><i class="fa fa-pencil"></i> Edit Pemeriksaan</h3></div>
            
                            <div class="box-body">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                            
                            <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $h['hasil_id']; ?>" readonly>
                            <input type="hidden" name="kembali" value="<?php echo $h['visit_id']; ?>" readonly>
                              

                                <div class="form-group col-lg-12">
                                    <label>Nama Pemeriksaan : <?php echo $h['hasil_pemeriksaan']; ?></label>
                                </div>
                                
                                <div class="form-group col-lg-12">
                                    <label>HASIL PEMERIKSAAN</label>
                                    <textarea name="isi" class="form-control" rows="2"><?php echo $h['hasil_isi']; ?></textarea>
                                </div>                                
                                
                                <div class="form-group col-lg-12">
                                    <label>SATUAN</label>
                                    <textarea name="satuan" class="form-control" rows="2"><?php echo $h['hasil_satuan']; ?></textarea>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>NILAI NORMAL</label>
                                    <textarea name="nilai" class="form-control" rows="2"><?php echo $h['hasil_nilainormal']; ?></textarea>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <center>
                              <button type="submit" class="btn btn-info">Simpan</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              </center>
                            </div>
                          </div>
                        </div>
                      </div>
                     </form>                    
                    <?php }?>
                </tbody>
                </table>
            </div>

                        </div>
                    </div>
                    
            <div class="row">
            <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                  <tr class=bg-green>
                    <th width="1%">NO</th>
                    <th width="30%" class=text-center>KETERANGAN</th>
                    <th width="2%" class=text-center>OPSI</th>
                  </tr>
                <thead>
              <?php
              $idket = $d['visit_id'];
              $no=1;
              $keterangan = mysqli_query($koneksi, "SELECT * FROM keterangan WHERE keterangan_visit='$idket'");
              while($ket = mysqli_fetch_array($keterangan))
              {

                ?>                     
                <tbody>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><textarea name="keterangan" class="form-control" rows="2" readonly><?php echo $ket['keterangan']; ?></textarea></td>
                        <td><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_keterangan_<?php echo $ket['keterangan_id']; ?>"><i class="fa fa-pencil"></i></a></button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus_keterangan_<?php echo $ket['keterangan_id']; ?>"><i class="fa fa-trash"></i></a></button>
<!-- modal edit keterangan -->  
                    <form action="keterangan_edit.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="edit_keterangan_<?php echo $ket['keterangan_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="box box-success">
                            <div class="box-header bg-green">
                            <h3 class="box-title"><i class="fa fa-pencil"></i> Edit Keterangan</h3></div>
            
                            <div class="box-body">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                            
                            <div class="modal-body">
                            <input type="hidden" name="kembali" value="<?php echo $ket['keterangan_visit']; ?>" readonly>
                            <input type="hidden" name="id" value="<?php echo $ket['keterangan_id']; ?>" readonly>
                                
                                <div class="form-group col-lg-12">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="2"><?php echo $ket['keterangan']; ?></textarea>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <center>
                              <button type="submit" class="btn btn-info">Simpan</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              </center>
                            </div>
                          </div>
                        </div>
                      </div>
                     </form>
                        
                        </td>
                    </tr>
                </tbody>
                </table>

<!-- modal hapus -->  
                    <form action="keterangan_hapus.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="hapus_keterangan_<?php echo $ket['keterangan_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="box box-success">
                            <div class="box-header bg-green">
                            <h3 class="box-title"><i class="fa fa-exclamation-triangle"></i> PERINGATAN</h3></div>
            
                            <div class="box-body">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                            
                            <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $ket['keterangan_id']; ?>" readonly>
                            <input type="hidden" name="kembali" value="<?php echo $ket['keterangan_visit']; ?>" readonly>
                              <p>yakin ingin menghapus pemeriksaan <?php echo $ket['keterangan']; ?>?</p>

                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-danger">Hapus</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                          </div>
                        </div>
                      </div>
                     </form>
                
                <?php }?>
            </div>
            </div>
            </div>
            
            
            </div>
        </div>
    </section>
</div>
<?php }?>

</section>
</div>

<?php include 'footer.php'; ?>