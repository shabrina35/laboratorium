<?php 
include '../koneksi.php';
$pasien_norm  = $_POST['norm'];
$pasien_nama  = $_POST['nama'];
$pasien_nik  = $_POST['nik'];
$pasien_alamat  = $_POST['alamat'];
$pasien_lahir  = $_POST['lahir'];
$pasien_entry  = $_POST['entry'];
$pasien_kelamin  = $_POST['kelamin'];
$pasien_nohp  = $_POST['hp'];
$pasien_status  = $_POST['status'];


mysqli_query($koneksi, "insert into pasien values (NULL, '$pasien_norm','$pasien_nama','$pasien_nik','$pasien_alamat','$pasien_lahir','$pasien_entry','$pasien_kelamin','$pasien_nohp','$pasien_status')")or die(mysqli_error($koneksi));
header("location:pasien.php?alert=berhasil");
