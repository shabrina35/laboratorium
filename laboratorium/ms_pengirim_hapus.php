<?php 
include '../koneksi.php';
$pengirim_id  = $_GET['id'];

mysqli_query($koneksi, "delete from ms_pengirim where pengirim_id='$pengirim_id'");
header("location:ms_pengirim.php?alert=hapus");