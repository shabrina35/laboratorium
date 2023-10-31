<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$kembali = $_POST['kembali'];
$isi = $_POST['isi'];
$nilai = $_POST['nilai'];
$satuan = $_POST['satuan'];

mysqli_query($koneksi, "update hasil_pemeriksaan set hasil_isi='$isi', hasil_nilainormal='$nilai', hasil_satuan='$satuan' where hasil_id='$id'");
header("location:laboratorium_cekin.php?id=$kembali&alert=success");