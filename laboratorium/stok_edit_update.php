<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$kembali  = $_POST['idstok'];
$bahan  = $_POST['bahan'];
$satuan  = $_POST['satuan'];
$masuk  = $_POST['masuk'];
$keluar  = $_POST['keluar'];
$awal  = $_POST['awal'];

mysqli_query($koneksi, "update stok_detail set stok_bahan='$bahan', stok_satuan='$satuan', masuk='$masuk', keluar='$keluar', awal='$awal' where stokdetail_id='$id'");
header("location:stok_edit.php?id=$kembali");