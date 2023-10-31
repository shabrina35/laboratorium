<?php include 'header.php'; ?>

<div class="content-wrapper">
<title>Jumlah Pasien Dokter</title>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
          <div class="box-header bg-green">
            <h3 class="box-title">PERINCIAN PASIEN DOKTER</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-4">

                  <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if(isset($_GET['tanggal_dari'])){echo $_GET['tanggal_dari'];}else{echo "";} ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if(isset($_GET['tanggal_sampai'])){echo $_GET['tanggal_sampai'];}else{echo "";} ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <br/>
                    <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-success btn-block">
                  </div>

                </div>
              </div>
            </form>
          </div>


        <div class="box box-success">
          <div class="box-body">

            <?php 
            if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])){
              $tanggal_dari = $_GET['tanggal_dari'];
              $tanggal_sampai = $_GET['tanggal_sampai'];
              ?>

              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">DARI TANGGAL</th>
                      <th width="1%">:</th>
                      <td><?php echo date('d-m-Y', strtotime($tanggal_dari)); ?></td>
                    </tr>
                    <tr>
                      <th>SAMPAI TANGGAL</th>
                      <th>:</th>
                      <td><?php echo date('d-m-Y', strtotime($tanggal_sampai)); ?></td>
                    </tr>
                  </table>
                  
                </div>
              </div>

              <a href="laporan_rekap_dokter_print.php?tanggal_dari=<?php echo $tanggal_dari ?>&tanggal_sampai=<?php echo $tanggal_sampai ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="1%" rowspan="2">NO</th>
                      <th rowspan="2" class="text-center">PENGIRIM</th>
                      <th rowspan="2" class="text-center">JUMLAH PASIEN</th>
                      <th colspan="3" class="text-center">NOMINAL</th>
                    </tr>
                    <tr>
                      <th class="text-center">BRUTO</th>
                      <th class="text-center">DITERIMA PENGIRIM</th>
                      <th class="text-center">NETO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;
                    $data = mysqli_query($koneksi,"SELECT * FROM kasir,ms_pengirim WHERE kasir_pengirim=pengirim_id AND date(kasir_tanggal)>='$tanggal_dari' AND date(kasir_tanggal)<='$tanggal_sampai' group by kasir_pengirim");
                    while($d = mysqli_fetch_array($data)){
                        $px = $d['kasir_pengirim'];
                        $bruto[]= $d['kasir_terbayarkan'] ;
                        $brutonya = array_sum($bruto);
                        ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><?php echo $d['pengirim']; ?></td>
                        <td class="text-center">
                            <?php
                            $jumlahpasien = mysqli_query($koneksi,"SELECT * FROM kasir WHERE kasir_pengirim='$px' AND date(kasir_tanggal)>='$tanggal_dari' AND date(kasir_tanggal)<='$tanggal_sampai'");
                            $jumlahpx = mysqli_num_rows($jumlahpasien);
                            $totalpx += $jumlahpx;
                            echo $jumlahpx ;
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            $bruto=mysqli_fetch_array(mysqli_query($koneksi,"select sum(kasir_biaya) 
                            as total from kasir where kasir_pengirim='$px' AND date(kasir_tanggal)>='$tanggal_dari' AND date(kasir_tanggal)<='$tanggal_sampai'"));
                            $bruto1 = $bruto['total'] ;
                            $jasa = $bruto1 * 25/100 ;
                            $neto = $bruto1 - $jasa ;
                            $total_pemasukan += $bruto1;
                            $total_dokter += $jasa;
                            $total_neto += $neto;
                            echo number_format ($bruto['total'],0,',','.');
                            
                            ?>
                        </td>
                        <td class="text-center"><?php echo number_format ($jasa,0,',','.'); ?></td>
                        <td class="text-center"><?php echo number_format ($neto,0,',','.'); ?></td>
                      </tr>
<?php } ?> 
<?php } ?> 

 
  

                    <tr>
                      <th colspan="2" class="text-right">TOTAL</th>
                      <td class="text-center text-bold text-success"><?php echo $totalpx; ?></td>
                      <td class="text-center text-bold text-success"><?php echo "Rp. ".number_format($total_pemasukan)." ,-"; ?></td>
                      <td class="text-center text-bold text-danger"><?php echo "Rp. ".number_format($total_dokter)." ,-"; ?></td>
                      <td class="text-center text-bold text-danger"><?php echo "Rp. ".number_format($total_neto)." ,-"; ?></td>
                    </tr>
                  </tbody>
                    
                </table>
              
              </div>

              <?php
              ?>

          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>