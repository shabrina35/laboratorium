<?php 
include '../koneksi.php';
$sub_klasifikasi_id  = $_GET['id'];

mysqli_query($koneksi, "delete from ms_sub_klasifikasi where sub_klasifikasi_id='$sub_klasifikasi_id'");
header("location:ms_sub_klasifikasi.php?alert=hapus");