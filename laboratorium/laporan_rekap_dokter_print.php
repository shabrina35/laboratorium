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
    <td width="159"><span class="style1"><img src="../logo.png" width="90" height="80" /></span></td>
    <td width="661"><div align="center"><span class="style1">LABORATORIUM KLINIK DIAGNOSTIC</span><br/>
      <strong>Jl. A. Yani No. 177 Caruban Telp. (0351) 386228</strong>
    <td width="166">&nbsp;</td>
  </tr>
</table>
<hr align="center" width="1000" size="6" color="green"/>


<center><h4><b>LAPORAN JUMLAH PASIEN</b></h4></center>

 	<?php 
 	if(isset($_GET['tanggal_dari']) && isset($_GET['tanggal_sampai'])){
 		$tanggal_dari = $_GET['tanggal_dari'];
        $tanggal_sampai = $_GET['tanggal_sampai'];
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
 				</table>
 			</div>
 		</div>
</P>
 		<div class="table-responsive">
 			<table class="table1" border=1>
 				<thead>
 				    <tr>
                    <th width="1%">NO</th>
                    <th class="text-center">Nama Dokter</th>
                    <th class="text-center">Jml Pasien</th>
                    <th class="text-center">Total Bruto</th>
                    <th class="text-center">Jasa Dokter</th>
                    <th class="text-center">Total Neto</th>
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
                      <th class="text-center"><?php echo $totalpx; ?></td>
                      <th class="text-center"><?php echo "Rp. ".number_format($total_pemasukan).""; ?></th>
                      <th class="text-center"><?php echo "Rp. ".number_format($total_dokter).""; ?></th>
                      <th class="text-center"><?php echo "Rp. ".number_format($total_neto).""; ?></th>
                    </tr>
                    
                  </tbody>
 			</table>


 		</div>
 </body>
 </html>











<style type="text/css">
.style1 {
	font-size: 20px;
	font-weight: bold;
	color: green;
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

