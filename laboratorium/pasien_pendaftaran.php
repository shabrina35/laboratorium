<?php 
include '../koneksi.php';
$pasien_id  = $_POST['id'];
$visit_idektp  = $_POST['idektp'];
$visit_norm  = $_POST['norm'];
$visit_nama  = $_POST['nama'];
$visit_nik  = $_POST['nik'];
$visit_alamat  = $_POST['alamat'];
$visit_lahir  = $_POST['lahir'];
$visit_kunjungan  = $_POST['kunjungan'];
$visit_jam  = $_POST['jam'];
$visit_kelamin  = $_POST['kelamin'];
$visit_nohp  = $_POST['nohp'];
$visit_nopenjamin  = $_POST['nopenjamin'];
$visit_tensi  = $_POST['tensi'];
$visit_keluhan  = $_POST['keluhan'];
$visit_dokter  = $_POST['dokter'];
$visit_status  = $_POST['status'];

$cek = mysqli_query($koneksi, "select * from visit where pasien_id='$pasien_id' and visit_kunjungan='$visit_kunjungan'");
$data = mysqli_num_rows($cek);


if($data > 0){
    header("location:pasien.php?alert=gagal1");

}else{
mysqli_query($koneksi, "insert into visit values (NULL,'$pasien_id','$visit_norm','$visit_nama','$visit_nik','$visit_alamat','$visit_lahir','$visit_kunjungan','$visit_kelamin','$visit_nohp','$visit_nopenjamin','$visit_tensi','$visit_keluhan','$visit_dokter', '$visit_idektp', '$visit_status', '$visit_jam')")or die(mysqli_error($koneksi));
header("location:pasien.php?alert=daftar");
}