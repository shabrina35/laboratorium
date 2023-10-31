<?php 
include '../koneksi.php';
$kode  = $_POST['kode'];
$klasifikasi  = $_POST['klasifikasi'];

mysqli_query($koneksi, "insert into ms_klasifikasi values (NULL, '$kode', '$klasifikasi')")or die(mysqli_error($koneksi));
header("location:ms_klasifikasi.php?alert=berhasil");
