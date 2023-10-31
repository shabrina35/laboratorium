<?php 
include 'header.php'; 
include '../koneksi.php';
?>
<title>ORDER PEMERIKSAAN</title>

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
                      Data Pemeriksaan <b>berhasil</b> dihapus !!!
                    </div>								
                    <?php                    
                  }elseif($_GET['alert']=="gagal"){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i> GAGAL !!!</h4>
                      Pemeriksaan Sudah Terbayarkan!!
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
            <h3 class="box-title"><i class="fa fa-user"></i> DETAIL PASIEN</h3>
            <a href="pendaftaran.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-undo"></i>&nbsp Kembali</a>
            </div>
            
            <div class="box-body">
            <form action="#" method="post" enctype="multipart/form-data">
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
                    
            </form>
            </div>
        </div>
    </section>
</div>

<!-- PAKET URINALISIS-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp URINALISIS</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=5 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan URINALISIS ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            
            
<!-- paket DARAH RUTIN-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp DARAH RUTIN</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=2 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan DARAH RUTIN ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            
<!-- paket TIBC-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp TIBC</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=17 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan TIBC ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form> 
            
<!-- paket LEMAK-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp LEMAK</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=10 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan LEMAK ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form> 
            
<!-- paket FAAL GINJAL-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp FAAL GINJAL</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=11 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan FAAL GINJAL ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form> 
            
<!-- paket FEACES LENGKAP-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp FEACES LENGKAP</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=4 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan FEACES LENGKAP ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form> 
            
<!-- paket HEMATOLOGI-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp HEMATOLOGI</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=1 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan HEMATOLOGI ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form> 
            
<!-- paket WIDAL-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp WIDAL</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=6 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan WIDAL ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            
<!-- paket IgG & IgM-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp IgG & IgM</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=16 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan IgG & IgM ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            
<!-- SEDIMEN-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp SEDIMEN</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=31 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan SEDIMEN ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>             

<!-- DIFF-->
            <form action="paket_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="pemeriksaan11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp DIFF</h3></div>
                        </div>
                     
                    <div class="modal-body">
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

                                    <?php 
                                    include '../koneksi.php';
                                    $a = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan where klasifikasi_pemeriksaan=32 AND status='paket' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($a)){
                                    ?>
                                <input type="hidden" name="hasil[]" value="<?php echo $t['pemeriksaan_id'] ?>" class="form-control"> 
                               <?php } ?>
                               yakin menambah paket pemeriksaan DIFF ?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-lg-12 col-xs-12">
                        <center>
                        <button type="submit" name="oke" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            
<!-- kolom 2 -->
<div class="row">
<section class="col-lg-12">
<div class="box box-success">
            <div class="box-header bg-gray">
                <h4 class="box-title"><i class="fa fa-server"></i>&nbsp LIST PEMERIKSAAN</h4>
            </div>    
            <div class="box-body bg-gray">
                <div class="form-group col-lg-12">
                    <table class="table table-bordered table-striped">
                        <tr class=bg-gray>
                            <td class=text-center>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan1">URINALISIS</button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan2">DARAH RUTIN</button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan3">TIBC</button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan4">LEMAK</button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan5">FAAL GINJAL</button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan6">FEACES LENGKAP</button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan7">HEMATOLOGI</button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan8">WIDAL</button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pemeriksaan9">IgG & IgM</button>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#pemeriksaan10">SEDIMEN</button>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#pemeriksaan11">DIFF</button>
                            </td>
                        </tr>
                    </table>
                </div>
            
                            <form action="pasien_pemeriksaan.php" method="post" enctype="multipart/form-data">
                            <small>
                              <div class="modal-body">
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
                                  
                                  
<!-- LIST PEMERIKSAAN -->

<!-- PEMERIKSAAN 1-->                                
                                <div class="form-group col-lg-3 col-xs-6">
                                <table class="table table-bordered table-striped">
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>HEMATOLOGI</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='9' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
<!-- PEMERIKSAAN 5 -->                                 
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>FAAL HATI & PENCERNAAN</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='19' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>                                
                                </table>
                                </div>
                                
<!-- PEMERIKSAAN 2 -->                                
                                <div class="form-group col-lg-3 col-xs-6">
                                <table class="table table-bordered table-striped">
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>LEMAK</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='13' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
<!-- PEMERIKSAAN 6 -->                                
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>JANTUNG</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='20' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
<!-- PEMERIKSAAN 9 -->                                 
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>ELEKTROLIT</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='27' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>                                
<!-- PEMERIKSAAN 3 -->                                
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>FAAL GINJAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='14' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
<!-- PEMERIKSAAN 4 -->                                
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>GULA DARAH</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='18' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
<!-- PEMERIKSAAN 10 -->                                
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>LAIN - LAIN</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='28' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>                                 
                                </table>
                                </div>

<!-- PEMERIKSAAN 7 -->                                
                                <div class="form-group col-lg-3 col-xs-6">
                                <table class="table table-bordered table-striped">
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>IMUNOLOGI & SEROLOGI</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='21' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>                                
                                </table>
                                </div>

<!-- PEMERIKSAAN 8 -->                                  
                                <div class="form-group col-lg-3 col-xs-6">
                                <table class="table table-bordered table-striped">
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>HORMON</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='22' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody> 
<!-- PEMERIKSAAN 11 -->                                
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>URINE & FEACES</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='29' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
<!-- PEMERIKSAAN 12 -->                                
                                <thead>
                                <tr class=bg-green>
                                    <th colspan=2>RONTGENT</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no=1;
                                    $pemeriksaan = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi WHERE klasifikasi_pemeriksaan=klasifikasi_id AND klasifikasi_id='30' AND status='tidak' order by kode_urutan ASC");
                                    while($t = mysqli_fetch_array($pemeriksaan)){
                                    ?>
                                <tr>
                                    <td class=text-center><input type="checkbox" name="pilih[]" value="<?php echo $t['pemeriksaan_id']; ?>"></td>
                                    <td><?php echo $t['pemeriksaan']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>                                 
                                </table>
                                </div>
<!-- AKHIR PEMERIKSAAN -->                                
                                
                            </div>
                            </small>
                            
                                <div class="form-group col-lg-12">
                                <center>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>&nbsp Simpan</button>
                                <button type="reset" class="btn btn-warning"><i class="fa fa-trash"></i>&nbsp Reset</button>
                                <a href="pendaftaran.php" class="btn btn-success"><i class="fa fa-backward"></i>&nbsp Kembali</a>
                                </center>
                                </div>                             

                              <div class="modal-footer"></div>
                      </form>

<!-- baris 3 -->
        <div class="box box-success">                
        <div class="box-body">
        <div class="row">
          <div class="box-body">
            <div class="box box-success">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class=bg-green>
                    <th width="1%">NO</th>
                    <th width="8%" class="text-center">NO RM</th>
                    <th width="10%" class="text-center">TANGGAL</th>
                    <th class="text-center">NAMA</th>
                    <th class="text-center">PEMERIKSAAN</th>
                    <th width="10%" class="text-center">TARIF</th>
                    <th width="8%" class="text-center">OPSI</th>
                  </tr>
              <?php
              $cari = $d['visit_id'];
              $no=1;
              $kasir = mysqli_query($koneksi, "SELECT * FROM kasir_detail,ms_pemeriksaan WHERE detail_pemeriksaan=pemeriksaan_id AND visit_id='$cari'");
              while($k = mysqli_fetch_array($kasir))
              {

                ?>                  
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $k['pasien_norm']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($k['detail_tanggal'])); ?></td>
                        <td><?php echo $k['pasien_nama']; ?></td>
                        <td><?php echo $k['pemeriksaan']; ?></td>
                        <td><?php echo $k['tarif']; ?></td>
                        <td>
                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus_kasir_<?php echo $k['kasir_id']; ?>"><i class="fa fa-trash fa-xs mr-1"></i> hapus</a></button>
                      
<!-- modal hapus -->  
                    <form action="detail_hapus.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="hapus_kasir_<?php echo $k['kasir_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="hidden" name="id" value="<?php echo $k['detail_id']; ?>" readonly>
                            <input type="hidden" name="kembali" value="<?php echo $k['visit_id']; ?>" readonly>
                              <p>yakin ingin menghapus pemeriksaan ini?</p>

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
                        <?php $tot += $k['tarif'];}?>
                        <tr>
                            <th colspan="5" class="text-right">TOTAL BIAYA</th>
                            <td class="text-right"><b><?php echo "Rp. ".number_format($tot)." ,-"; ?></b></td>
                            <td><a href="kasir_bayar.php?id=<?php echo $d['visit_id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-money"></i> &nbsp Bayar</a></td>
                        </tr>
                </tbody>
            </table>
            </div>
            </div> 
    </div>
    </div>
</div>
</div>            
</div>        
</section>
</div>

<!-- kolom 2 akhir -->



</section>
</div>

<script type="text/javascript">
function total() {
   var kasir_biaya =  parseInt(document.getElementById('kasir_biaya').value);
   var kasir_terima =  parseInt(document.getElementById('kasir_terima').value);
   var kasir_kembali =  parseInt(document.getElementById('kasir_kembali').value);
   
   var kasir_terima =  parseInt(document.getElementById('kasir_terima').value);
   var kasir_kembali = kasir_biaya - kasir_terima;
    document.getElementById('kasir_kembali').value = kasir_kembali;
    document.getElementById("myCartNew").submit();
  }
</script>
<?php } ?>
<?php include 'footer.php'; ?>