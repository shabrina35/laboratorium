<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$tarif  = $_POST['tarif'];

mysqli_query($koneksi, "update ms_pemeriksaan set tarif='$tarif' where pemeriksaan_id='$id'");
header("location:ms_tarif_paket.php?alert=update");