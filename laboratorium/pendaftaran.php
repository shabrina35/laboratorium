<?php include 'header.php'; ?>
<title>PENDAFTARAN</title>
<div class="content-wrapper">
<?php 
$tgl= $_GET['tgl'];
$nama= $_GET['nama'];
$norm= $_GET['norm'];
?>  
  <section class="content bg-gray">
      
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
                  }elseif($_GET['alert']=="successhapus"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data kunjungan berhasil dihapus !!
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
                  }elseif($_GET['alert']=="gagalhapus"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i> GAGAL</h4>
                      Pasian dalam proses pelayanan !!
                    </div>
                    <?php                    
                  }elseif($_GET['alert']=="gagal"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> GAGAL !!!</h4>
                      Pasien Sudah Didaftarkan Hari Ini !!
                    </div>
                    <?php
                  }elseif($_GET['alert']=="gagalprint"){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i>GAGAL !</h4>
                      Cetak Hasil GAGAL. Harap Pilih Jenis Printer
                    </div>
                    <?php                     
                  }
                }
                ?>   
<!-- kolom 1 -->
    <div class="row">
        <section class="col-lg-6">
        <div class="box box-success">
            <div class="box-header bg-green">
            <b><i class="fa fa-search"></i> &nbsp PENCARIAN PASIEN</b>
              <!--<button type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i>&nbsp Pasien Baru
              </button>-->            
              </div>
              
            <div class="box-body"> 
            
            <form action="pasien1_act.php" method="post" enctype="multipart/form-data">
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
$urutan = (int) substr($pasiennorm, 4, 4);
$urutan++;
$huruf = "2023";
$pasiennorm = $huruf . sprintf("%04s", $urutan);
?>                         
                    <div class="modal-body">
                        <input type="hidden" name="entry" class="form-control" value="<?php echo date("Y-m-d");?>" readonly>

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
            
            <form method="get" action="">
              <div class="row">
                  
                <div class="col-md-6">
                  <div class="form-group">
                    <label>NO RM</label>
                    <input autocomplete="off" type="text" value="<?php echo $norm; ?>" name="norm" class="form-control" placeholder="Masukkan NORM" onchange="this.form.submit();">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>NAMA PASIEN</label>
                    <input autocomplete="off" type="text" value="<?php echo $nama; ?>" name="nama" class="form-control" placeholder="Nama Pasien" onchange="this.form.submit();">
                  </div>
                </div>
                
              </div>
            </form>
            
                </div>
            </div>
        </section>

<!-- kolom 2 -->
        <section class="col-lg-6">
            <div class="box box-success">
                <div class="box-header bg-green">
                    <i class="fa fa-search-plus"></i> &nbsp<b>HASIL PENCARIAN PASIEN</b></div>
                    <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class=bg-olive>
                    <th class="text-center">NO</th>
                    <th class="text-center">NO RM</th>
                    <th class="text-center">NAMA</th>
                    <th class="text-center">ALAMAT</th>
                    <th class="text-center">TANGGAL LAHIR</th>
                    <th class="text-center">OPSI</th>
                  </tr>
                <?php 
                  include '../koneksi.php';
                    $no=1;
                    if(isset($_GET['norm']) && isset($_GET['nama'])){
                    $norm = $_GET['norm'];
                    $nama = $_GET['nama'];
                    $data = mysqli_query($koneksi,"SELECT * FROM pasien WHERE pasien_nama like '%$nama%' or pasien_norm='$norm' limit 2");
                    }else{
                        $data = cari ;
                    }
                  while($d = mysqli_fetch_array($data)){
                ?>                  
                </thead>
                <tbody>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td><?php echo $d['pasien_norm']; ?></td>
                      <td><?php echo $d['pasien_nama']; ?></td>
                      <td><?php echo $d['pasien_alamat']; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['pasien_lahir'])); ?></td>
                      <td>    
                      <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#list_pasien_<?php echo $d['pasien_id'] ?>">
                        <i class="fa fa-sign-in"></i> Daftar
                      </button>

<!-- modal daftar -->
                      <form action="pasien_daftar.php" method="post">
                        <div class="modal fade" id="list_pasien_<?php echo $d['pasien_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                  <input type="hidden" value="<?php echo date("Y-m-d h:i:sa");?>" name="kunjungan" class="form-control">
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
                                    <select name="pengirim" class="form-control" required="required">
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
 
<!-- kolom 3 -->          
    <div class="row">
      <section class="col-lg-12">
           <div class="box box-success">
            <div class="box-header bg-green">
            <i class="fa fa-server"></i> &nbsp<b>LIST KUNJUNGAN PASIEN</b></div>
            <div class="box-body">
       
            <form method="get" action="">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>FILTER TANGGAL</label>
                    <input autocomplete="off" type="date" value="<?php echo $tgl; ?>" name="tgl" class="form-control bg-gray" onchange="this.form.submit();">
                  </div>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr class=bg-olive>
                    <th width="1%" class="text-center">NO</th>
                    <th class="text-center">NO RM</th>
                    <th class="text-center">NAMA</th>
                    <th class="text-center">ALAMAT</th>
                    <th class="text-center">PENGIRIM</th>                    
                    <th class="text-center">WAKTU DAFTAR</th>
                    <th class="text-center">KASIR</th>
                    <th class="text-center">DATA</th>
                    <th class="text-center">PEMERIKSAAN</th>
                    <th width="10%" class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
<?php 
include '../koneksi.php';
$no=1;
$filter= date('Y-m-d');
if(isset($_GET['tgl'])){                  
$tgl= $_GET['tgl'];
$data = mysqli_query($koneksi,"SELECT * FROM visit,ms_pengirim WHERE visit_pengirim=pengirim_id AND visit_tanggal like '%$tgl%' order by visit_id DESC limit 50");
}else{
$data = mysqli_query($koneksi,"SELECT * FROM visit,ms_pengirim WHERE visit_pengirim=pengirim_id AND visit_tanggal='$filter' order by visit_id DESC") ;
}                  
while($d = mysqli_fetch_array($data)){
?>                    
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td><?php echo $d['visit_norm']; ?></td>                      
                      <td><?php echo $d['visit_nama']; ?></td>
                      <td><?php echo $d['visit_alamat']; ?></td>
                      <td><?php echo $d['pengirim']; ?></td>                      
                      <td class="text-center">
                                              <?php echo date("d-m-Y", strtotime($d['visit_tanggal'])); ?><br>
                                              <small><?php echo date("h:i", strtotime($d['visit_jam'])); ?> WIB</small>
                                              </td>
                      <td class=text-center><?php echo $d['visit_status']; ?></td>
                      <td class=text-center><?php echo $d['visit_lab']; ?></td>
                      <td class=text-center>
                          <a href="order_pemeriksaan.php?id=<?php echo $d['visit_id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-server"></i>&nbsp Pemeriksaan</a>
                      </td>
                      <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#print_hasil<?php echo $d['visit_id'] ?>">
                        <i class="fa fa-print"></i>
                        </button>                          
                        <!--<a href="hasil_laboratorium_print.php?id=<?php echo $d['visit_id']; ?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>
                        <a href="hasil_laboratorium_print2.php?id=<?php echo $d['visit_id']; ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i></a>-->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_daftar<?php echo $d['visit_id'] ?>">
                        <i class="fa fa-trash"></i>
                        </button>
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
<!-- modal hapus -->
                      <form action="pendaftaran_hapus.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="hapus_daftar<?php echo $d['visit_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-red">
                              <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" class="form-control" value="<?php echo $d['visit_id'] ?>">

                              <p>yakin ingin menghapus kunjungan pasien <?php echo $d['visit_nama']?> ?</p>

                            </div>
                            <div class="modal-footer">
                               <button type="submit" class="btn btn-primary">Hapus</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

 </div>  
</section>
</div>
<?php include 'footer.php'; ?>