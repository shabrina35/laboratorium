<?php 
include '../koneksi.php';
$klasifikasi_pemeriksaan  = $_POST['klasifikasi'];
$sub_klasifikasi  = $_POST['sub_klasifikasi'];
$pemeriksaan  = $_POST['pemeriksaan'];
$stok  = $_POST['stok'];
$tarif  = $_POST['tarif'];
$nilainormal  = $_POST['nilainormal'];
$kode  = $_POST['kode'];
$status  = $_POST['status'];
$satuan  = $_POST['satuan'];

mysqli_query($koneksi, "insert into ms_pemeriksaan values (NULL, '$klasifikasi_pemeriksaan','$sub_klasifikasi','$kode','$pemeriksaan','$stok','$nilainormal','$tarif','$status','$satuan')")or die(mysqli_error($koneksi));
header("location:ms_pemeriksaan.php?alert=berhasil");
