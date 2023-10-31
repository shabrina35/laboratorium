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

$cek = mysqli_query($koneksi, "select * from pasien where pasien_nama='$pasien_nama'");
$data = mysqli_num_rows($cek);

if($data > 0){
    header("location:pendaftaran.php?alert=gagal");

}else{
mysqli_query($koneksi, "insert into pasien values (NULL, '$pasien_norm','$pasien_nama','$pasien_nik','$pasien_alamat','$pasien_lahir','$pasien_entry','$pasien_kelamin','$pasien_nohp','$pasien_status')")or die(mysqli_error($koneksi));
header("location:pendaftaran.php?norm=$pasien_norm&nama=$pasien_nama");
}