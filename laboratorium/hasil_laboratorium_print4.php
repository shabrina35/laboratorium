<?php 
include '../koneksi.php';
?>
<html>
<head>
<title>Cetak Hasil Pemeriksaan</title>
</head>

<?php 
$visit_id= $_GET['id'];
$jamterima= $_GET['terima'];
$jamhasil= $_GET['hasil'];
$diagnosa= $_GET['diagnosa'];
?>

<table width="1000" border="0" align="center">
  <tr>
    <td width="159"><span class="style1"><img src="../logo.png" width="90" height="80" /></span></td>
    <td width="661"><div align="center"><span class="style1">LABORATORIUM KLINIK DIAGNOSTIC</span><br/>
      <strong>Jl. A. Yani No. 177 Caruban Telp. (0351) 386228</strong></div></td>
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
    <td width="203"><div align="left">No.RM</div></td>
    <td width="16"><div align="left">:</div></td>
    <td width="593"><?php echo $v['visit_norm']; ?></td>
    <td width="207">Pengirim</td>
    <td width="20">:</td>
    <td width="221"><?php echo $v['pengirim']; ?></td>
  </tr> 
  <tr>
    <td width="103"><div align="left">Nama</div></td>
    <td width="16"><div align="left">:</div></td>
    <td width="593"><?php echo $v['visit_nama']; ?></td>
    <td width="107">Tanggal</td>
    <td width="20">:</td>
    <td width="121"><?php echo date('d-m-Y', strtotime($v['visit_tanggal'])); ?></td>
  </tr>
  <tr>
    <td width="103"><div align="left">Tanggal Lahir</div></td>
    <td width="16"><div align="left">:</div></td>
    <td width="593"><?php echo date('d-m-Y', strtotime($v['visit_lahir'])); ?></td>
    <td width="107">Jam Terima</td>
    <td width="20">:</td>
    <td width="121"><?php echo $jamterima; ?></td>
  </tr>  
  <tr>
    <td><div align="left">Usia / Jenis Kelamin</div></td>
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
?> ( <?php echo $v['visit_kelamin']; ?> )
    </td>
    <td>Jam Hasil</td>
    <td>:</td>
    <td><?php echo $jamhasil; ?></td>
  </tr>
  <tr>
    <td><div align="left">Alamat </div></td>
    <td><div align="left">:</div></td>
    <td><?php echo $v['visit_alamat']; ?></td>
    <td>Diagnosa </td>
    <td>:</td>
    <td><?php echo $diagnosa; ?></td>
  </tr>
  <!--<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>No. Kwitansi</td>
    <td>:</td>
    <td><?php echo $k['kasir_kode']; ?></td>
  </tr>-->
</table>
<br>
 <?php } ?>

<table class=table1 width="1000" border="1" align="center">
  <tr bgcolor="#c6c9c5">
    <th width="272" scope="col">PEMERIKSAAN</th>
    <th width="427" scope="col">HASIL</th>
    <th width="139" scope="col">SATUAN </th>
    <th width="279" scope="col">NILAI RUJUKAN </th>
  </tr>
<?php
$no=1;
$hasil = mysqli_query($koneksi, "select * from hasil_pemeriksaan where visit_id='$visit_id' order by hasil_id ASC");
while($h = mysqli_fetch_array($hasil))
{
?> 
  <tr>
      <td>
        <?php 
        if ($h['hasil_nilainormal'] == "-"){ ?>
        <b><?php echo $h['hasil_pemeriksaan']; ?></b>
        <?php
        }else if($h['hasil_pemeriksaan'] == "Laju Endap Darah"){ ?>
        <b><?php echo $h['hasil_pemeriksaan']; ?></b> 
        
        <?php
        }else if($h['hasil_nilainormal'] != "-"){ ?>
        <?php echo $h['hasil_pemeriksaan']; ?>
        <?php } ?>          
      </td>
    <td><center><?php echo $h['hasil_isi']; ?></center></td>
    <td>&nbsp <?php echo $h['hasil_satuan']; ?></td>
    <td>&nbsp <?php echo $h['hasil_nilainormal']; ?></td>
  </tr>
  <?php } ?>
</table>

<p align="center"> 
</p>
<table width="1000" border="0" align="center">
              <?php
              $keterangan = mysqli_query($koneksi, "SELECT * FROM keterangan WHERE keterangan_visit='$visit_id'");
              while($ket = mysqli_fetch_array($keterangan))
              {
                ?>     
  <tr>
    <td width="10"><b>Keterangan  :</b></td>
    <td width="608"><b><?php echo $ket['keterangan']; ?></b></td>
  </tr>
  <?php } ?>
</table>

<table width="1000" border="0" align="center">
  <tr>
    <td width="300"><center>Dokter Penanggung Jawab</center></td>
    <td width="608">&nbsp;</td>
    <td width="277"><div align="center">Caruban, <?php echo date("d-m-Y"); ?><br>pemeriksa</div></td>
  </tr>
  <tr>
    <td><center>
    <img src="../gambar/ttd.png" width="100" height="100" />
    </center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><center><h5>dr. Fella Avesiena Suwardi, Sp.PK</h5></center></td>
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

	background-size: 18%;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-repeat: no-repeat;
	background-position: center;
}

table{
    border-collapse:collapse;
    font-family: Arial;
    border-collapse:collapse;
    font-size: 16px;    
}
.table1{
    font-family: sans-serif;
    border-collapse:collapse;
    font-size: 16px;
    border-bottom: 1px solid #000000;
    border-right: 1px solid #000000;
    border-left: 1px solid #000000;
    border-top: 1px solid #000000;
}
th, td {
    padding: 3px;
</style>


<script>
window.print();
$(document).ready(function(){
});
</script>

</body>
</html>
