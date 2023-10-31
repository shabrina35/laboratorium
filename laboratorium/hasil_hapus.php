<?php 
include '../koneksi.php';
$hasil_id = $_POST['id'];
$kembali  = $_POST['kembali'];

$cek = mysqli_query($koneksi, "select * from kasir where kasir_visit='$kembali'");
$data = mysqli_num_rows($cek);

if($data > 0){
header("location:laboratorium_cekin.php?id=$kembali&alert=gagal");
}else{
mysqli_query($koneksi, "DELETE FROM hasil_pemeriksaan WHERE hasil_id='$hasil_id'");
header("location:laboratorium_cekin.php?id=$kembali&alert=success");
}