<?php 
include '../koneksi.php';
$pasien_id  = $_POST['id'];
$pasien_norm  = $_POST['norm'];
$pasien_nama  = $_POST['nama'];
$pasien_nik  = $_POST['nik'];
$pasien_alamat  = $_POST['alamat'];
$pasien_lahir  = $_POST['lahir'];
$pasien_entry  = $_POST['entry'];
$pasien_kelamin  = $_POST['kelamin'];
$pasien_nohp  = $_POST['hp'];
$pasien_status  = $_POST['status'];

mysqli_query($koneksi, "update pasien set pasien_norm='$pasien_norm', pasien_nama='$pasien_nama', pasien_nik='$pasien_nik', pasien_alamat='$pasien_alamat', pasien_lahir='$pasien_lahir', pasien_entry='$pasien_entry', pasien_kelamin='$pasien_kelamin', pasien_nohp='$pasien_nohp', pasien_status='$pasien_status' where pasien_id='$pasien_id'");
    header("location:pasien.php?alert=update");





