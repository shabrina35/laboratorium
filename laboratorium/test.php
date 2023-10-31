

<?php
include '../koneksi.php';

$perintah=sprintf("SELECT * FROM kasir"); //perintah untuk memilih tabel

$query= mysqli_query($koneksi,"SELECT * FROM kasir");//query dengan varibel yang ada di $perintah


?>

<html>

<head>

<title>kasir</title>

</head>

<body>

<table width="600" border="1" align="center">

<tr>

<td colspan="5" align="center">Data Kasir</td>

</tr>

<tr>

<th width="8" align="left">NO</th>

<th width="30" align="left">Nama Pasien</th>

<th width="10" align="left">Pengirim</th>

<th width="10" align="left">Nominal(RP)</th>

</tr>

<?php //ngambil data dan memecahnya ke array

while($data=mysqli_fetch_array($query)) {

?>

<tr>

<td><?php echo $data['kasir_id'];?></td>

<td><?php echo $data['kasir_nama'];?></td>

<td><?php echo $data['kasir_pengirim'];?></td>

<td><?php echo $data['kasir_biaya'];?></td>

</tr>


<?php }?>

<tr>

<td colspan="3" align="center">JUMLAH</td>


<td><?php

$jumlahkan = "SELECT SUM(kasir_biaya) AS jumlah_total FROM kasir"; //perintah untuk menjumlahkan

$hasil =@mysqli_query($jumlahkan) or die (mysql_error());//melakukan query dengan varibel $jumlahkan

$t = mysqli_fetch_array($hasil); //menyimpan hasil query ke variabel $t

echo "<b>" . number_format($t['jumlah_total']) . " </b>";//menampilkaan hasil penjumlahan

?></td>

</tr>

</table>

</body>