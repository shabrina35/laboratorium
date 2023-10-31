<?php 
include 'header.php'; 
include '../koneksi.php';
?>
<title>PEMBAYARAN KASIR</title>

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
                      Data Pembayaran <b>berhasil</b> Tersimpan !!!
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
        <div class="box box-success">
            <div class="box-header bg-green">
            <h3 class="box-title"><i class="fa fa-money"></i> PEMBAYARAN PELAYANAN LABORATORIUM</h3>
            <a href="kasir.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-undo"></i>&nbsp Kembali</a>
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

<!-- kolom 2 -->
<div class="row">
<section class="col-lg-12">
<div class="box box-success">
    
        <form method="post" enctype="multipart/form-data">    
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                  <tr class=bg-green>
                    <th width="1%">NO</th>
                    <th width="8%">NO RM</th>
                    <th width="10%">TANGGAL</th>
                    <th>NAMA</th>
                    <th>PEMERIKSAAN</th>
                    <th width="14%" class="text-center">TARIF</th>
                  </tr>
              <?php
              $cari = $d['visit_id'];
              $no=1;
              $kasir = mysqli_query($koneksi, "SELECT * FROM kasir_detail,ms_pemeriksaan WHERE detail_pemeriksaan=pemeriksaan_id AND visit_id='$cari' AND tarif>=1");
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
                        <td class="text-right"><?php echo $k['tarif']; ?></td>
                    </tr>
                        <?php $tot += $k['tarif'];}?>
                        <tr>
                            <th colspan="5" class="text-right">TOTAL BIAYA</th>
                            <td class="text-right"><b><?php echo "Rp. ".number_format($tot)." ,-"; ?></b></td>
                        </tr>                    
                </tbody>
                </table>
                    <?php 
                    $query = mysqli_query($koneksi, "SELECT max(kasir_kode) as kodeTerbesar FROM kasir");
                    $ksr = mysqli_fetch_array($query);
                    $buatkode = $ksr['kodeTerbesar'];
                    $urutan = (int) substr($buatkode, 9);
                    $urutan++;
                    $thn = date("Y");
                    $bln = date("m");
                    $huruf = "KSR";
                    $buatkode = $huruf.$thn.$bln. sprintf("%03s", $urutan);
                    ?> 
                    

                            <div class="col-md-4 print-none">
                                <div class="form-group">
                                <label>Total Biaya</label>
                                <input type="number" class="form-control form-control-sm text-bold bg-yellow" id="kasir_biaya" name="kasir_biaya"  placeholder="0" value="<?php echo $tot; ?>">
                                </div>  
                            </div>
                            
                            <input type="hidden" name="kasir_visit" value="<?php echo $d['visit_id']; ?>" readonly>
                            <input type="hidden" name="kasir_pasien" value="<?php echo $d['pasien_id']; ?>" readonly>
                            <input type="hidden" name="kasir_tanggal" value="<?php echo date("Y-m-d"); ?>" readonly>
                            <input type="hidden" name="kasir_nama" value="<?php echo $d['visit_nama']; ?>" readonly>
                            <input type="hidden" name="kasir_alamat" value="<?php echo $d['visit_alamat']; ?>" readonly>
                            <input type="hidden" name="kasir_pengirim" value="<?php echo $d['visit_pengirim']; ?>" readonly>
                            <input type="hidden" name="kasir_status" value="TERBAYARKAN" readonly>
                            <input type="hidden" name="kasir_petugas" value="<?php echo $_SESSION['nama']; ?>" readonly>
                            <input type="hidden" name="kasir_kode" value="<?php echo $buatkode; ?>" readonly>
                            <input type="hidden" name="kasir_norm" value="<?php echo $d['visit_norm']; ?>" readonly>

                            
                            <div class="col-md-4 print-none">
                                <div class="form-group">
                                <label>Uang Diterima</label>
                                <input type="number" class="form-control form-control-sm bg-silver" id="kasir_terima" name="kasir_terima"  placeholder="0" onchange="total()">
                                </div>  
                            </div>
                            
                            <div class="col-md-4 print-none">
                                <div class="form-group">
                                <label>Kembalian</label>
                                <input type="number" class="form-control form-control-sm" id="kasir_kembali" name="kasir_kembali"  placeholder="0" required onchange="total()" readonly>
                                </div>  
                            </div>
                            </div>
                            
                            <div class="modal-footer">
                               <button type="submit" class="btn btn-warning"><i class="fa fa-money"></i>&nbsp Bayar</button>
                              <button type="reset" class="btn btn-dangger" data-dismiss="modal"><i class="fa fa-trash"></i>&nbsp Reset</button>
                            </div>            
            
            </div>
        </div>
        </form>       


                                <?php
                                    if(isset($_POST['kasir_terima'])){
                                    $kasir_visit  = $_POST['kasir_visit'];
                                    $kasir_pasien  = $_POST['kasir_pasien'];
                                    $kasir_tanggal = $_POST['kasir_tanggal'];
                                    $kasir_nama = $_POST['kasir_nama'];
                                    $kasir_alamat  = $_POST['kasir_alamat'];
                                    $kasir_pengirim  = $_POST['kasir_pengirim'];
                                    $kasir_biaya  = $_POST['kasir_biaya'];
                                    $kasir_terima  = $_POST['kasir_biaya'];
                                    $kasir_selisih  = 0;
                                    $kasir_status  = $_POST['kasir_status'];
                                    $kasir_petugas  = $_POST['kasir_petugas'];
                                    $kasir_kode  = $_POST['kasir_kode'];
                                    $kasir_norm = $_POST['kasir_norm'];
                                    $cek = mysqli_query($koneksi, "select * from kasir where kasir_visit='$kasir_visit'");
                                    $hasil = mysqli_num_rows($cek);
                                {
                                    if($hasil > 0){
                                     header("location:kasir_bayar.php?id=$kasir_visit&alert=gagal");
                                    }else{
                                    $update= mysqli_query($koneksi, "UPDATE visit SET visit_status='$kasir_status' WHERE visit_id='$kasir_visit'");
                                    $tambah= mysqli_query($koneksi, "insert into kasir values (NULL,'$kasir_visit','$kasir_pasien','$kasir_tanggal','$kasir_nama','$kasir_alamat','$kasir_pengirim','$kasir_biaya','$kasir_terima','$kasir_selisih','$kasir_status', '$kasir_petugas', '$kasir_kode', '$kasir_norm')");
                                    $data = mysqli_num_rows($tambah);
                                    header("location:kasir_bayar.php?id=$kasir_visit&alert=success");
                                }    
                                ?>
                                <?php } ?>
                                
<!-- baris 3 -->
<?php }?>
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
                    <th>KODE</th>
                    <th>TANGGAL</th>
                    <th>NO RM</th>
                    <th>NAMA</th>
                    <th>NOMINAL</th>
                    <th>PETUGAS</th>
                    <th width="15%" class="text-center">OPSI</th>
                  </tr>
              <?php
              $cari = $d['visit_id'];
              $no=1;
              $kasir = mysqli_query($koneksi, "select * from kasir where kasir_visit='$cari'");
              while($k = mysqli_fetch_array($kasir))
              {

                ?>                  
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $k['kasir_kode']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($k['kasir_tanggal'])); ?></td>
                        <td><?php echo $k['kasir_norm']; ?></td>
                        <td><?php echo $k['kasir_nama']; ?></td>
                        <td><?php echo $k['kasir_terbayarkan']; ?></td>
                        <td><?php echo $k['kasir_petugas']; ?></td>
                        <td>
                            <a href="kwitansi_print.php?id=<?php echo $k['kasir_visit']; ?>" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-print fa-xs mr-1"></i> &nbsp PRINT</a>
                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus_kasir_<?php echo $k['kasir_id']; ?>"><i class="fa fa-trash fa-xs mr-1"></i> &nbsp Hapus</a></button>
                      
<!-- modal hapus -->  
                    <form action="kasir_hapus.php" method="post" enctype="multipart/form-data">
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
                            <input type="hidden" name="id" value="<?php echo $k['kasir_id']; ?>" readonly>
                            <input type="hidden" name="kembali" value="<?php echo $k['kasir_visit']; ?>" readonly>
                              <p>yakin ingin menghapus pembayaran ini?</p>

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
                    
                    <?php }?>
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
<?php }?>
<!-- kolom 2 akhir -->


</section>


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


<?php include 'footer.php'; ?>