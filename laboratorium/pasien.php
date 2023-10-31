<?php include 'header.php'; ?>
  <title>Master Data Pasien</title>
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
            <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Data Master Pasien</h3>
            
              <button type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Master Pasien
              </button>
              </div>

          
          <div class="box-body">

<!-- Modal tambah-->
            <form action="pasien_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-gray">
                              <h3 class="box-title"><i class="fa fa-user"></i> &nbsp Tambah Data Pasien</h3></div>
                        </div>
<?php 
$query = mysqli_query($koneksi, "SELECT max(pasien_norm) as normTerbesar FROM pasien");
$data = mysqli_fetch_array($query);
$pasiennorm = $data['normTerbesar'];
$urutan = (int) substr($pasiennorm, 6);
$urutan++;
$thn = date("Y");
$bln = date("m");
$pasiennorm = $thn.$bln. sprintf("%03s", $urutan);
?>                         
                    <div class="modal-body">
                        <input type="hidden" name="entry" class="form-control" value="<?php echo date("Y-m-d h:i:sa");?>" readonly>

                      <div class="form-group col-lg-6">
                        <label>NO RM</label>
                        <input type="text" name="norm" class="form-control" value="<?php echo $pasiennorm;?>" readonly>
                      </div>
                      
                      <div class="form-group col-lg-6">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control bg-yellow">
                      </div>
                      
                      <div class="form-group col-lg-12">
                        <label>NAMA</label>
                        <input type="text" name="nama" class="form-control" required="required" placeholder="Masukkan nama...">
                      </div>
                      
                      <div class="form-group col-lg-12">
                        <label>ALAMAT</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat...">
                      </div>
                      
                      <div class="form-group col-lg-6">
                        <label>TANGGAL LAHIR</label>
                        <input type="text" name="lahir" class="form-control datepicker2" placeholder="Tahun-Bulan-Tanggal">
                      </div>                      
                      
                      <div class="form-group col-lg-6">
                        <label>NO TLP/HP</label>
                        <input type="text" name="hp" class="form-control bg-orange">
                      </div>
                      
                      <div class="form-group col-lg-6">
                        <label>KELAMIN</label>
                        <select name="kelamin" class="form-control" required="required">
                          <option value="PEREMPUAN">PEREMPUAN</option>
                          <option value="LAKI - LAKI">LAKI - LAKI</option>
                        </select>
                      </div>                      
                      
                      <div class="form-group col-lg-6">
                        <label>STATUS</label>
                        <select name="status" class="form-control bg-gray" required="required">
                          <option value="AKTIF">AKTIF</option>
                          <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                        </select>
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
                    <th class=text-center>NO RM</th>
                    <th class=text-center>NAMA</th>
                    <th class=text-center>ALAMAT</th>
                    <th class=text-center>KELAMIN</th>
                    <th class=text-center width="12%">TANGGAL LAHIR</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center" width="12%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $nomor=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM pasien order by pasien_id DESC");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class=text-center><?php echo $nomor++; ?></td>
                      <td><?php echo $d['pasien_norm']; ?></td>
                      <td><?php echo $d['pasien_nama']; ?></td>
                      <td><?php echo $d['pasien_alamat']; ?></td>
                      <td><?php echo $d['pasien_kelamin']; ?></td>
                      <td class=text-center><?php echo date('d-m-Y', strtotime($d['pasien_lahir'])); ?></td>
                      <td class="text-center"><?php echo $d['pasien_status']; ?></td>
                      <td>    
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#daftar_pasien_<?php echo $d['pasien_id'] ?>">
                        <i class="fa fa-sign-in"></i>
                      </button>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_pasien_<?php echo $d['pasien_id'] ?>">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_pasien_<?php echo $d['pasien_id'] ?>">
                        <i class="fa fa-trash"></i>
                      </button>


<!-- modal edit -->
                      <form action="pasien_update.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="edit_pasien_<?php echo $d['pasien_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              
                        <div class="box box-success">
                          <div class="box-header bg-gray">
                              <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Edit Data Pasien</h3></div>
                        </div>
                            
                            <div class="modal-body">
                                <input type="hidden" style="width:100%" name="entry" class="form-control" value="<?php echo $d['pasien_entry'] ?>">
                                
                                <div class="form-group col-lg-6">
                                  <label>NO RM</label>
                                  <input type="text" style="width:100%" name="norm" class="form-control" value="<?php echo $d['pasien_norm'] ?>" readonly>
                                </div>                                
                                
                                <div class="form-group col-lg-6">
                                  <label>NIK</label>
                                  <input type="hidden" name="id" value="<?php echo $d['pasien_id'] ?>">
                                  <input type="text" style="width:100%" name="nik" class="form-control bg-orange" value="<?php echo $d['pasien_nik'] ?>">
                                </div>
                                
                                <div class="form-group col-lg-12">
                                  <label>NAMA</label>
                                  <input type="text" style="width:100%" name="nama" class="form-control" value="<?php echo $d['pasien_nama'] ?>">
                                </div>
                                
                                <div class="form-group col-lg-12">
                                  <label>ALAMAT</label>
                                  <input type="text" style="width:100%" name="alamat" class="form-control" value="<?php echo $d['pasien_alamat'] ?>">
                                </div>                                
                                
                                <div class="form-group col-lg-6">
                                  <label>TANGGAL LAHIR</label>
                                  <input type="date" style="width:100%" name="lahir" class="form-control datepicker2" value="<?php echo $d['pasien_lahir'] ?>">
                                </div>
                                
                                <div class="form-group col-lg-6">
                                  <label>NO HP</label>
                                  <input type="text" style="width:100%" name="nohp" class="form-control bg-orange" value="<?php echo $d['pasien_nohp'] ?>">
                                </div>                                
                                
                                <div class="form-group col-lg-6">
                                    <label>KELAMIN</label>
                                    <select style="width:100%" name="kelamin" class="form-control" value="<?php echo $d['pasien_kelamin'] ?>">
                                        <option value="PEREMPUAN">PEREMPUAN</option>
                                        <option value="LAKI - LAKI">LAKI - LAKI</option>
                                        </select>
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label>STATUS</label>
                                    <select style="width:100%" name="status" class="form-control bg-gray" value="<?php echo $d['pasien_status'] ?>">
                                        <option value="AKTIF">AKTIF</option>
                                        <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                                        </select>
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

<!-- modal daftar -->
                      <form action="pasien_daftar1.php" method="post">
                        <div class="modal fade" id="daftar_pasien_<?php echo $d['pasien_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="box box-success">
                                <div class="box-header bg-gray">
                                <h3 class="box-title"><?php echo $d['pasien_nama'] ?></h3>
                                </div>                                

                              <div class="modal-body">
                                  <input type="hidden" name="id" class="form-control" value="<?php echo $d['pasien_id'] ?>" readonly>
                                  <input type="hidden" name="norm" class="form-control" value="<?php echo $d['pasien_norm'] ?>" readonly>
                                  <input type="hidden" name="nama" class="form-control" value="<?php echo $d['pasien_nama'] ?>">
                                  <input type="hidden" name="alamat" class="form-control" value="<?php echo $d['pasien_alamat'] ?>">
                                  <input type="hidden" value="<?php echo $d['pasien_lahir'] ?>" name="lahir" class="form-control">
                                  <input type="hidden" value="<?php echo date("Y-m-d");?>" name="kunjungan" class="form-control">
                                  <input type="hidden" value="<?php echo $d['pasien_kelamin'] ?>" name="kelamin" class="form-control">
                                  <input type="hidden" value="BELUM BAYAR" name="status" class="form-control">
                                  <input type="hidden" value="
                                    <?php 
                                    date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
                                    echo date('h:i:s a'); // menampilkan jam sekarang
                                    ?>
                                " name="jam" class="form-control">
                                  <input autocomplete="off" type="hidden" value="KOSONG" name="lab" class="form-control">                                

                                <div class="form-group col-lg-12">
                                    <label>PENGIRIM</label>
                                    <select name="pengirim" class="form-control" style="width:100%" required="required">
                                    <option value="">- Pilih Pengirim -</option>
                                    <?php 
                                    $pengirim = mysqli_query($koneksi,"SELECT * FROM ms_pengirim");
                                    while($k = mysqli_fetch_array($pengirim)){
                                    ?>
                                    <option <?php if(isset($_GET['pengirim'])){ if($_GET['pengirim'] == $k['pengirim_id']){echo "selected='selected'";}} ?>  value="<?php echo $k['pengirim_id']; ?>"><?php echo $k['pengirim']; ?></option>
                                    <?php 
                                    }
                                    ?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-lg-12">
                                    <label> </label>
                                </div>                                
                                
                            </div>
                              <div class="modal-footer">
                                <center>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                </center>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>

<!-- modal hapus -->
                      <div class="modal fade" id="hapus_pasien_<?php echo $d['pasien_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-gray">
                              <h3 class="box-title"><i class="fa fa-trash"></i> &nbsp Peringatan !!!</h3></div>
                        </div>
                            <div class="modal-body">

                              <p>yakin ingin menghapus <b><?php echo $d['pasien_nama'] ?></b>?</p>

                            </div>
                            <div class="modal-footer">
                              <a href="pasien_hapus.php?id=<?php echo $d['pasien_id'] ?>" class="btn btn-danger">Hapus</a>
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