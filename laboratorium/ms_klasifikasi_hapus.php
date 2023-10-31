<?php 
include '../koneksi.php';
$klasifikasi_id  = $_GET['id'];

mysqli_query($koneksi, "delete from ms_klasifikasi where klasifikasi_id='$klasifikasi_id'");
header("location:ms_klasifikasi.php?alert=hapus");