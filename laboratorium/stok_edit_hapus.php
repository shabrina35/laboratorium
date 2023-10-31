<?php 
include '../koneksi.php';
$id = $_GET['id'];
$kembali = $_GET['kembali'];

mysqli_query($koneksi, "delete from stok_detail where stokdetail_id='$id'");
header("location:stok_edit.php?id=$kembali");