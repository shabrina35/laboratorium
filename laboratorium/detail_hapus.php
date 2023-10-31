<?php 
include '../koneksi.php';
$detail_id = $_POST['id'];
$kembali  = $_POST['kembali'];

$cek = mysqli_query($koneksi, "select * from kasir where kasir_visit='$kembali'");
$data = mysqli_num_rows($cek);

if($data > 0){
header("location:order_pemeriksaan.php?id=$kembali&alert=gagal");
}else{
mysqli_query($koneksi, "DELETE FROM kasir_detail WHERE detail_id='$detail_id'");
header("location:order_pemeriksaan.php?id=$kembali&alert=success");
}