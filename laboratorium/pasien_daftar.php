<?php 
include '../koneksi.php';
$pasien_id  = $_POST['id'];
$visit_norm  = $_POST['norm'];
$visit_nama  = $_POST['nama'];
$visit_alamat  = $_POST['alamat'];
$visit_lahir  = $_POST['lahir'];
$visit_kunjungan  = $_POST['kunjungan'];
$visit_kelamin  = $_POST['kelamin'];
$visit_pengirim  = $_POST['pengirim'];
$visit_status  = $_POST['status'];
$visit_jam  = $_POST['jam'];
$visit_lab  = $_POST['lab'];

$cek = mysqli_query($koneksi, "select * from visit where pasien_id='$pasien_id' and visit_kunjungan='$visit_kunjungan'");
$data = mysqli_num_rows($cek);


if($data > 0){
    header("location:pendaftaran.php?alert=gagal");

}else{
mysqli_query($koneksi, "insert into visit values (NULL,'$pasien_id','$visit_norm','$visit_nama','$visit_alamat','$visit_lahir','$visit_kunjungan','$visit_kelamin','$visit_pengirim', '$visit_status', '$visit_jam', '$visit_lab')")or die(mysqli_error($koneksi));
header("location:pendaftaran.php?alert=success");
}