<?php 
include '../koneksi.php';
$visit_id  = $_POST['id'];

$cek = mysqli_query($koneksi, "select * from kasir_detail where visit_id='$visit_id'");
$data = mysqli_num_rows($cek);

if($data > 0){
    header("location:pendaftaran.php?alert=gagalhapus");

}else{
mysqli_query($koneksi, "delete from visit where visit_id='$visit_id'");
header("location:pendaftaran.php?alert=successhapus");
}