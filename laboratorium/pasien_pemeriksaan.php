<?php 
include '../koneksi.php';
$visit_id  = $_POST['id'];
$pasien_id  = $_POST['px'];
$pasien_norm  = $_POST['norm'];
$pasien_nama  = $_POST['nama'];
$pasien_alamat  = $_POST['alamat'];
$detail_tanggal  = $_POST['kunjungan'];
$detail_pemeriksaan  = $_POST['pilih'];
$status = $_POST['lab'];
$update= mysqli_query($koneksi, "UPDATE visit SET visit_lab='$status' WHERE visit_id='$visit_id'");
$jumlah_dipilih = count($detail_pemeriksaan);

for($x=0;$x<$jumlah_dipilih;$x++){
mysqli_query($koneksi, "insert into kasir_detail values (NULL, '$visit_id','$pasien_id','$pasien_norm','$pasien_nama','$pasien_alamat','$detail_tanggal','$detail_pemeriksaan[$x]')")or die(mysqli_error($koneksi));
}

header("location:order_pemeriksaan.php?id=$visit_id");