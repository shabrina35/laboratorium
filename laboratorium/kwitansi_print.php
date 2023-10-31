<?php 
include '../koneksi.php';
session_start();
?>

 <html>
 <head>
 	<title>Kwitansi Pembayaran</title>
 </head>
 
<?php 
$visit = $_GET['visit_id'];
?> 

<table class=style1 width="1000" border="0" align="center">
  <tr>
    <td width="159"><span class="style1"><img src="../gambar/polos.png" width="10" height="15" /></span></td>
    <td width="661"><div align="center"><span class="style1">LABORATORIUM KLINIK DIAGNOSTIC</span><br/>
      <strong>Jl. A. Yani No. 177 Caruban Telp. (0351) 386228</strong><br/>
    Penanggung Jawab : dr. FELLA AVESIENA SUWARDI, Sp.Pk</div></td>
    <td width="166">&nbsp;</td>
  </tr>
</table>
<br>
<body>
<center>
<h3><b>KUITANSI PEMBAYARAN</b></h3>
</center>
</p>

<div class="row">
 					<?php 
 					include '../koneksi.php';
 					$visit_id=$_GET['id'];
                    $data = mysqli_query($koneksi,"SELECT * FROM kasir WHERE kasir_visit='$visit_id'");
                    $hasil = mysqli_query($koneksi,"SELECT * FROM kasir_detail,ms_pemeriksaan WHERE detail_pemeriksaan=pemeriksaan_id AND visit_id='$visit_id'");
                    while($h = mysqli_fetch_array($hasil))
                    while($d = mysqli_fetch_array($data)){
                    $nominal = $d['kasir_biaya'];
                    $uang = number_format($nominal, 0, ',','.') ."</br>";   
                    $terbilang = ucwords(''.Terbilang($nominal).'')." Rupiah";   
                    ?>
                    
 <table class=style2 width="1000" border="0" cellpadding="4" cellspacing="0" style="border: 0px solid #000;">  
 <tr>  
   <td rowspan="6" width="2" style="border-right:0px solid #000;"> </td>  
   <td width="268" valign="top" > No </td>  
   <td width="815" valign="top" > : <?php echo $d['kasir_kode']; ?> </td>  
 </tr>  
 <tr>  
   <td valign="top" > Telah Diterima Dari </td>  
   <td valign="top" > : <?php echo $d['kasir_nama']; ?> </td>  
 </tr>
 <tr>  
   <td valign="top" > Alamat </td>  
   <td valign="top" > : <?php echo $d['kasir_alamat']; ?> </td>  
 </tr> 
 <tr>  
   <td valign="top" > Uang Sejumlah </td>  
   <td valign="top" > : <b><?php echo $terbilang; ?></b></td>  
 </tr>  
 <tr>  
   <td valign="top" > Untuk Pembayaran </td>  
   <td valign="top" > :  <?php 
 					include '../koneksi.php';
 					$visit_id=$_GET['id'];
                    $periksa = mysqli_query($koneksi,"SELECT * FROM kasir_detail,ms_pemeriksaan WHERE detail_pemeriksaan=pemeriksaan_id AND visit_id='$visit_id' AND tarif>=1");
                    while($x = mysqli_fetch_array($periksa)){
                    ?>
                    <?php echo $x['pemeriksaan']; ?>,
                    <?php } ?>
                    </td>
 </tr>
 </table>

<br>

<table class=style2 width="270">  
<tr> 
<td rowspan="6" width="10"></td> 
<td class="text-center" rowspan="6" width="248" style="border:2px groove #000;"><?php echo "Rp. ".number_format($nominal)." ,-"; ?></td>
</tr> 
</table>
<?php } ?>

<!-- TANDA TANGAN -->

<table class=style3 width="1000" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td width="661">&nbsp;</td>
    <td width="166"><div align="center">Caruban, <?php echo date("d-m-Y"); ?><br>kasir<br>
    <br>
    <br><b>( <?php echo $_SESSION['nama']; ?> )</b></div></td>
    <td width="166"></td>    
  </tr>
</table>

</div>
        

<style type="text/css">
.style2 {
	font-size: 20px;
	color: black;
}
.style3 {
	font-size: 18px;
	color: black;
}
.style1 {
	font-size: 10px;
	font-weight: bold;
	color: white;
	text-align: center;
}
body {
	background-size: 8%;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-repeat: no-repeat;
	background-position: center;
}
</style>

        
 	<script>

 		window.print();
 		$(document).ready(function(){

 		});
 	</script>

 </body>
 </html>
 <?php  
 
 function Terbilang($x)   
 {   
  $bilangan = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");   
  if ($x < 12)   
   return " " . $bilangan[$x];   
  elseif ($x < 20)   
   return Terbilang($x - 10) . "belas";   
  elseif ($x < 100)   
   return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);   
  elseif ($x < 200)   
   return " seratus" . Terbilang($x - 100);   
  elseif ($x < 1000)   
   return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);   
  elseif ($x < 2000)   
   return " seribu" . Terbilang($x - 1000);   
  elseif ($x < 1000000)   
   return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);   
  elseif ($x < 1000000000)   
   return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);    
 }   
 ?> 