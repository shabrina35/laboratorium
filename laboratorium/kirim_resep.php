<?php 
include '../koneksi.php';
$resep_tanggal  = date("Y-m-d h:i:sa");
$resep_kode  = $_POST['id'];
$resep_visit  = $_POST['vid'];
$resep_pasien_id  = $_POST['pid'];
$resep_nama  = $_POST['vna'];
$resep_alamat  = $_POST['val'];
$nik  = $_POST['nik'];
$nohp  = $_POST['nohp'];
$resep_dokter  = $_POST['vdok'];
$resep_penerima  = "Apotek Metro";
$resep_status  = "Terkirim";



$cek = mysqli_query($koneksi, "select * from resep where resep_visit='$resep_visit'");
$data = mysqli_num_rows($cek);


if($data > 0){
    header("location:pelayanan_resep.php?id=$resep_visit?alert=kirimgagal");

}else{
mysqli_query($koneksi, "insert into resep values (NULL,'$resep_tanggal','$resep_kode','$resep_visit','$resep_pasien_id','$resep_nama','$resep_alamat','$nik','$nohp','$resep_dokter','$resep_penerima','$resep_status')")or die(mysqli_error($koneksi));
header("location:pelayanan_resep.php?id=$resep_visit");
}