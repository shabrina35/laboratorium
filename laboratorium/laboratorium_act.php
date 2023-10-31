<?php 
include '../koneksi.php';
$visit_id  = $_POST['id'];
$pasien_id  = $_POST['px'];
$pasien_norm  = $_POST['norm'];
$pasien_nama  = $_POST['nama'];
$pasien_alamat  = $_POST['alamat'];
$detail_tanggal  = $_POST['kunjungan'];
$nama_pemeriksaan  = $_POST['pemeriksaan'];
$hasil_pemeriksaan  = $_POST['hasil'];
$keterangan  = $_POST['keterangan'];
$nilainormal  = $_POST['nilainormal'];
$satuan  = $_POST['satuan'];
$jumlah_hasil = count($hasil_pemeriksaan);
mysqli_query($koneksi, "update visit set visit_lab='SELESAI' where visit_id='$visit_id'");
mysqli_query($koneksi, "insert into keterangan value (NULL, '$visit_id', '$keterangan')");

for
($x=0;$x<$jumlah_hasil;$x++){
mysqli_query($koneksi, "insert into hasil_pemeriksaan values (NULL, '$visit_id','$pasien_id','$pasien_norm','$pasien_nama','$pasien_alamat','$detail_tanggal','$nama_pemeriksaan[$x]','$hasil_pemeriksaan[$x]','$nilainormal[$x]','$satuan[$x]')")or die(mysqli_error($koneksi));
header("location:laboratorium_cekin.php?id=$visit_id");
}