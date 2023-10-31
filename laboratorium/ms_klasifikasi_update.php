<?php 
include '../koneksi.php';
$kode  = $_POST['kode'];
$klasifikasi  = $_POST['klasifikasi'];
$kid  = $_POST['id'];

mysqli_query($koneksi, "update ms_klasifikasi set klasifikasi='$klasifikasi', kode_klasifikasi='$kode' where klasifikasi_id='$kid'");
header("location:ms_klasifikasi.php?alert=update");





