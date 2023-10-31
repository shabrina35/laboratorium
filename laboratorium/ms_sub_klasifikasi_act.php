<?php 
include '../koneksi.php';
$klasifikasi  = $_POST['klasifikasi'];
$subklasifikasi  = $_POST['subklasifikasi'];

mysqli_query($koneksi, "insert into ms_sub_klasifikasi values (NULL, '$subklasifikasi','$klasifikasi')")or die(mysqli_error($koneksi));
header("location:ms_sub_klasifikasi.php?alert=berhasil");
