<?php 
include '../koneksi.php';
$pengirim  = $_POST['pengirim'];
$pid  = $_POST['id'];

mysqli_query($koneksi, "update ms_pengirim set pengirim='$pengirim' where pengirim_id='$pid'");
header("location:ms_pengirim.php?alert=update");