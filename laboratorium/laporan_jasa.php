<?php include 'header.php'; ?>

<div class="content-wrapper">
<title>Rincian Jasa Dokter</title>
  <section class="content-header">
    <h1>
      LAPORAN
      <small>Data Laporan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Filter Laporan</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-3">

                  <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if(isset($_GET['tanggal_dari'])){echo $_GET['tanggal_dari'];}else{echo "";} ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if(isset($_GET['tanggal_sampai'])){echo $_GET['tanggal_sampai'];}else{echo "";} ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <label>NAMA DOKTER</label>
                    <select name="pengirim" class="form-control" required="required">
                      <option value="semua">- Semua Dokter -</option>
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

                <div class="col-md-3">

                  <div class="form-group">
                    <br/>
                    <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-success btn-block">
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Laporan Pendapatan Jasa</h3>
          </div>
          <div class="box-body">

            <?php 
            if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['pengirim'])){
              $tgl_dari = $_GET['tanggal_dari'];
              $tgl_sampai = $_GET['tanggal_sampai'];
              $pengirim = $_GET['pengirim'];
              ?>

              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">DARI TANGGAL</th>
                      <th width="1%">:</th>
                      <td><?php echo $tgl_dari; ?></td>
                    </tr>
                    <tr>
                      <th>SAMPAI TANGGAL</th>
                      <th>:</th>
                      <td><?php echo $tgl_sampai; ?></td>
                    </tr>
                    <tr>
                      <th>NAMA DOKTER</th>
                      <th>:</th>
                      <td>
                        <?php 
                        if($pengirim == "semua"){
                          echo "SEMUA DOKTER";
                        }else{
                          $k = mysqli_query($koneksi,"select * from ms_pengirim where pengirim_id='$pengirim'");
                          $kk = mysqli_fetch_assoc($k);
                          echo $kk['pengirim'];
                        }
                        ?>

                      </td>
                    </tr>
                  </table>
                  
                </div>
              </div>

              <a href="laporan_jasa_print.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&pengirim=<?php echo $pengirim ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp LAPORAN RINCIAN</a>
              <!--<a href="laporan_rekap_dokter_print.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&pengirim=<?php echo $pengirim ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> &nbsp LAPORAN REKAP</a>-->
              <p>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="1%" rowspan="2">NO</th>
                      <th width="10%" rowspan="2" class="text-center">TANGGAL</th>
                      <th rowspan="2" class="text-center">NO RM</th>
                      <th rowspan="2" class="text-center">PASIEN</th>
                      <th rowspan="2" class="text-center">NAMA DOKTER</th>
                      <th colspan="2" class="text-center">NOMINAL</th>
                    </tr>
                    <tr>
                      <th class="text-center">TARIF</th>
                      <th class="text-center">25%</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;
                    $total_pemasukan=0;
                    $total_pengeluaran=0;
                    if($pengirim == "semua"){
                      $data = mysqli_query($koneksi,"SELECT * FROM kasir,ms_pengirim where kasir_pengirim=pengirim_id and date(kasir_tanggal)>='$tgl_dari' and date(kasir_tanggal)<='$tgl_sampai'");
                    }else{
                      $data = mysqli_query($koneksi,"SELECT * FROM kasir,ms_pengirim where kasir_pengirim=pengirim_id and pengirim_id='$pengirim' and date(kasir_tanggal)>='$tgl_dari' and date(kasir_tanggal)<='$tgl_sampai'");
                    }
                    while($d = mysqli_fetch_array($data)){
                    $total_pemasukan += $d['kasir_biaya'];
                    $pendapatan_dokter = $d['kasir_biaya'] * 25/100 ;
                    $total_dokter += $pendapatan_dokter ;
                      ?>
                      
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo date('d-m-Y', strtotime($d['kasir_tanggal'])); ?></td>
                        <td><?php echo $d['kasir_norm']; ?></td>
                        <td><?php echo $d['kasir_nama']; ?></td>
                        <td><?php echo $d['pengirim']; ?></td>
                        <td class="text-center"><?php echo "Rp. ".number_format($d['kasir_biaya'])." ,-"; ?></td>
                        <td class="text-center"><?php echo "Rp. ".number_format($pendapatan_dokter)." ,-"; ?></td>
                      </tr>
                      <?php 
                    }
                    ?>
                    <tr>
                      <th colspan="5" class="text-right">TOTAL</th>
                      <td class="text-center text-bold text-success"><?php echo "Rp. ".number_format($total_pemasukan)." ,-"; ?></td>
                      <td class="text-center text-bold text-danger"><?php echo "Rp. ".number_format($total_dokter)." ,-"; ?></td>
                    </tr>
                    <tr>
                      <th colspan="5" class="text-right">PENDAPATAN 
                        <?php 
                        if($pengirim == "semua"){
                          echo "SEMUA DOKTER";
                        }else{
                          $k = mysqli_query($koneksi,"select * from ms_pengirim where pengirim_id='$pengirim'");
                          $kk = mysqli_fetch_assoc($k);
                          echo $kk['pengirim'];
                        }
                        ?>                      
                      </th>
                      <td colspan="2" class="text-center text-bold text-white bg-primary"><?php echo "Rp. ".number_format($total_dokter)." ,-"; ?></td>
                    </tr>
                  </tbody>
                </table>



              </div>

              <?php 
            }else{
              ?>

              <div class="alert alert-info text-center">
                Silahkan Filter Laporan Terlebih Dulu.
              </div>

              <?php
            }
            ?>

          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>