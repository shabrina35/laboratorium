<?php 
include '../koneksi.php';
?>
<html>
<head>
<title>Cetak Kwitansi</title>
</head>

<?php 
$visit_id= $_GET['id'];
?>

<table width="1000" border="0" align="center">
  <tr>
    <td width="159"><span class="style1"><img src="../logo.png" width="90" height="80" /></span></td>
    <td width="661"><div align="center"><span class="style1">LABORATORIUM KLINIK DIAGNOSTIC</span><br/>
      <strong>Jl. A. Yani No. 177 Caruban Telp. (0351) 386228</strong><br/>
    Penanggung Jawab : Dr. IPUTU SUHARTA PUTRA Sp.PD</div></td>
    <td width="166">&nbsp;</td>
  </tr>
</table>
<hr align="center" width="1000" size="3" color="green"/>


<table width="1000" border="0" align="center">
    
<?php
$kasir = mysqli_query($koneksi, "select * from kasir where kasir_visit='$visit_id'");
$visit = mysqli_query($koneksi, "select * from visit,ms_pengirim where visit_pengirim=pengirim_id AND visit_id='$visit_id'");
$k = mysqli_fetch_array($kasir);
while($v = mysqli_fetch_array($visit))
{
?> 


 
  <tr>
    <td width="103"><div align="left">No</div></td>
    <td width="16"><div align="left">:</div></td>
    <td width="593"><?php echo $v['visit_nama']; ?></td>
    <td width="107">Tanggal</td>
    <td width="20">:</td>
    <td width="121"><?php echo date('d-m-Y', strtotime($v['visit_tanggal'])); ?></td>
  </tr>
  <tr>
    <td><div align="left">Telah Diterima Dari</div></td>
    <td><div align="left">:</div></td>
    <td>
<?php
$lahir = $v['visit_lahir'];
function hitung_umur($lahir){
$birthDate = new DateTime($lahir);
$today = new DateTime("today");
if ($birthDate > $today) { 
exit("0 tahun 0 bulan 0 hari");
}
$tahun = $today->diff($birthDate)->y;
$m = $today->diff($birthDate)->m;
$d = $today->diff($birthDate)->d;
return $tahun." tahun ".$m." bulan ".$d." hari";
}
echo hitung_umur("$lahir");
?>
    </td>
    <td>Dokter</td>
    <td>:</td>
    <td><?php echo $v['pengirim']; ?></td>
  </tr>
  <tr>
    <td><div align="left">Uang Sejumlah </div></td>
    <td><div align="left">:</div></td>
    <td><?php echo $v['visit_kelamin']; ?></td>
    <td>No. Kwitansi </td>
    <td>:</td>
    <td><?php echo $k['kasir_kode']; ?></td>
  </tr>
  <tr>
    <td>Untuk Pembayaran</td>
    <td>:</td>
    <td><?php echo $v['visit_alamat']; ?></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
 <?php } ?>

<table width="1000" border="1" align="center">
  <tr>
    <th width="272" scope="col">NAMA</th>
    <th width="427" scope="col">HASIL</th>
    <th width="279" scope="col">NILA NORMAL </th>
  </tr>
<?php
$no=1;
$hasil = mysqli_query($koneksi, "select * from hasil_pemeriksaan where visit_id='$visit_id' order by hasil_nilainormal ASC");
while($h = mysqli_fetch_array($hasil))
{
?> 
  <tr>
    <td><?php echo $h['hasil_pemeriksaan']; ?></td>
    <td><center><?php echo $h['hasil_isi']; ?></center></td>
    <td>&nbsp <?php echo $h['hasil_nilainormal']; ?></td>
  </tr>
  <?php } ?>
</table>

<p align="center"> 

</p>
<table width="1000" border="0" align="center">
  <tr>
    <td width="93">&nbsp;</td>
    <td width="608">&nbsp;</td>
    <td width="277"><div align="center">Caruban, <?php echo date("d-m-Y"); ?><br>pemeriksa</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
</table>



<style type="text/css">
.style1 {
	font-size: 30px;
	font-weight: bold;
	color: green;
	text-align: center;
}
body {
	background-image: url("../gambar/1.png");
	background-size: 18%;
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
