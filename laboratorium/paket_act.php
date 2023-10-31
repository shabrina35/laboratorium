<?php 
include '../koneksi.php';
$visit_id  = $_POST['id'];
$pasien_id  = $_POST['px'];
$pasien_norm  = $_POST['norm'];
$pasien_nama  = $_POST['nama'];
$pasien_alamat  = $_POST['alamat'];
$detail_tanggal  = $_POST['kunjungan'];
$paket  = $_POST['pilih'];
$status = $_POST['lab'];
$hasil = $_POST['hasil'];

$jumlah_dipilih = count($hasil);

for($x=0;$x<$jumlah_dipilih;$x++){
mysqli_query($koneksi, "insert into kasir_detail values (NULL, '$visit_id','$pasien_id','$pasien_norm','$pasien_nama','$pasien_alamat','$detail_tanggal','$hasil[$x]')")or die(mysqli_error($koneksi));
}
header("location:order_pemeriksaan.php?id=$visit_id");
