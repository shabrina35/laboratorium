<?php 
include '../koneksi.php';
$pasien_id  = $_GET['id'];

mysqli_query($koneksi, "delete from pasien where pasien_id='$pasien_id'");
header("location:pasien.php?alert=hapus");