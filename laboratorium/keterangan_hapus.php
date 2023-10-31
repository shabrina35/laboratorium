<?php 
include '../koneksi.php';
$keterangan_id = $_POST['id'];
$kembali  = $_POST['kembali'];

mysqli_query($koneksi, "DELETE FROM keterangan WHERE keterangan_id='$keterangan_id'");
header("location:laboratorium_cekin.php?id=$kembali&alert=success");