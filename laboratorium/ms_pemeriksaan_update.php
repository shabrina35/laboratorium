<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$klasifikasi_pemeriksaan  = $_POST['klasifikasi'];
$sub_klasifikasi  = $_POST['sub_klasifikasi'];
$pemeriksaan  = $_POST['pemeriksaan'];
$stok  = $_POST['stok'];
$tarif  = $_POST['tarif'];
$nilainormal  = $_POST['nilainormal'];
$kode  = $_POST['kode'];
$status  = $_POST['status'];
$satuan  = $_POST['satuan'];


mysqli_query($koneksi, "update ms_pemeriksaan set klasifikasi_pemeriksaan='$klasifikasi_pemeriksaan', sub_klasifikasi='$sub_klasifikasi', pemeriksaan='$pemeriksaan', stok='$stok', nilai_normal='$nilainormal', tarif='$tarif', kode_urutan='$kode', status='$status', satuan='$satuan' where pemeriksaan_id='$id'");
    header("location:ms_pemeriksaan.php?alert=update");