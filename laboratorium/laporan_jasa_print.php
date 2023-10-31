<?php 
include '../koneksi.php';
?>

 <!DOCTYPE html>
 <html>
     
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Laporan Jumlah Pasien Dokter</title>
 	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
 </head>
 
 <body>
<table width="1000" border="0" align="center">
  <tr>
    <td width="159"><span class="style1"><img src="../gambar/polos.png" width="90" height="80" /></span></td>
    <td width="661"><div align="center"><span class="style1">LABORATORIUM KLINIK DIAGNOSTIC</span><br/>
      <strong>&nbsp;</strong></div></td>
    <td width="166">&nbsp;</td>
  </tr>
</table>
<hr align="center" width="1000" size="6" color="green"/>


<center><h4><b>LAPORAN RINCIAN PENDAPATAN</b></h4></center>

 	<?php 
 	if(isset($_GET['tanggal_dari']) && isset($_GET['tanggal_sampai']) && isset($_GET['pengirim'])){
 		$tanggal_dari = $_GET['tanggal_dari'];
        $tanggal_sampai = $_GET['tanggal_sampai'];
        $pengirim = $_GET['pengirim'];
 		?>

 		<div class="row">
 			<div class="col-lg-4">
 				<table border="0">
 				    <tr>
                      <th width="200">TANGGAL DARI</th>
                      <th width="50">:</th>
                      <td width="500"><?php echo date('d-m-Y', strtotime($tanggal_dari)); ?></td>
                    </tr>
                    <tr>
                      <th width="200">TANGGAL SAMPAI</th>
                      <th width="50">:</th>
                      <td width="500"><?php echo date('d-m-Y', strtotime($tanggal_sampai)); ?></td>                      
                    </tr>
                    <tr>
                      <th width="200">PENGIRIM</th>
                      <th width="50">:</th>
                      <td width="500">
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
</P>
 		<div class="table-responsive">
 			<table class="table1" border=1>
 				<thead bgcolor="#c6c9c5">
 				    <tr>
                        <th width="1%" rowspan="2">NO</th>
                        <th rowspan="2" class="text-center">TANGGAL</th>
                        <th rowspan="2" class="text-center">NO RM</th>
                        <th rowspan="2" class="text-center">PASIEN</th>
                        <th rowspan="2" class="text-center">PENGIRIM</th>
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
                    if($pengirim == "semua"){
                    $data = mysqli_query($koneksi,"SELECT * FROM kasir WHERE date(kasir_tanggal)>='$tanggal_dari' AND date(kasir_tanggal)<='$tanggal_sampai'");
                    }else{
                    $data = mysqli_query($koneksi,"SELECT * FROM kasir WHERE date(kasir_tanggal)>='$tanggal_dari' AND date(kasir_tanggal)<='$tanggal_sampai' AND kasir_pengirim='$pengirim'");
                    }
                    while($d = mysqli_fetch_array($data)){
                    $idpengirim = $d['kasir_pengirim'];
                    $tarif = $d['kasir_terbayarkan'];
                    $dibagi = $tarif * 25/100 ;
                    $total_pemasukan += $tarif ;
                    $total_jasa += $dibagi ;
                    
                      ?>				    
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($d['kasir_tanggal'])); ?></td>
                      <td class="text-center"><?php echo $d['kasir_norm']; ?></td>
                      <td><?php echo $d['kasir_nama']; ?></td>
                      <td>
                                            <?php 
                                            $idp = mysqli_query($koneksi,"SELECT * FROM ms_pengirim WHERE pengirim_id='$idpengirim'");
                                            while($k = mysqli_fetch_array($idp)){
                                            echo $k['pengirim']; 
                                                
                                            }
                                            ?>
                        </td>
                      <td class="text-center"><?php echo "".number_format($tarif).""; ?></td>
                      <td class="text-center"><?php echo "".number_format($dibagi).""; ?></td>
                    </tr>
<?php } ?>
<?php } ?>

                    <tr>
                      <th colspan="5" class="text-right">TOTAL</th>
                      <th class="text-center"><?php echo "Rp. ".number_format($total_pemasukan).""; ?></th>
                      <th class="text-center"><?php echo "Rp. ".number_format($total_jasa).""; ?></th>
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
                      <td colspan="2" class="text-center text-bold text-white bg-primary"><?php echo "Rp. ".number_format($total_jasa)." ,-"; ?></td>
                    </tr>                    
                    
                  </tbody>
 			</table>

<br>
<table width="1000" border="0" align="center">
  <tr>
    <td width="800"></td>
    <td class=text-center width="166"><b>PENERIMA</b></td>
  </tr>
    <tr>
    <td width="159"></td>
    <td width="166" height="50">&nbsp;</td>
  </tr>
    <tr>
    <td width="800"></td>
    <td class=text-center width="166"><b>____________</b></td>
  </tr>
</table>

 		</div>
 </body>
 </html>











<style type="text/css">
.style1 {
	font-size: 20px;
	font-weight: bold;
	color: white;
	text-align: center;
}
</style>

<style type="text/css">
.table1{
    font-family: sans-serif;
    border-collapse:collapse;
    font-size: 16px;
    border-bottom: 1px solid #000000;
    border-right: 1px solid #000000;
    border-left: 1px solid #000000;
    border-top: 1px solid #000000;
}
.table2{
    font-family: sans-serif;
    border-collapse:collapse;
    font-size: 16px;
}
th, td {
    padding: 3px;
     
}
</style>

<script>
window.print();
$(document).ready(function(){
});
</script>

