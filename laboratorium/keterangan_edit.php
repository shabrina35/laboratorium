<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$kembali = $_POST['kembali'];
$keterangan = $_POST['keterangan'];

mysqli_query($koneksi, "update keterangan set keterangan='$keterangan' where keterangan_id='$id'");
header("location:laboratorium_cekin.php?id=$kembali&alert=success");