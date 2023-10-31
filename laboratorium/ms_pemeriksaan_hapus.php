<?php 
include '../koneksi.php';
$pemeriksaan_id  = $_GET['id'];

mysqli_query($koneksi, "delete from ms_pemeriksaan where pemeriksaan_id='$pemeriksaan_id'");
header("location:ms_pemeriksaan.php?alert=hapus");