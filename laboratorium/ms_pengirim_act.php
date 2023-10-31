<?php 
include '../koneksi.php';
$pengirim  = $_POST['pengirim'];


$cek = mysqli_query($koneksi, "select * from ms_pengirim where pengirim='$pengirim'");
$data = mysqli_num_rows($cek);

if($data > 0){
    header("location:ms_pengirim.php?alert=gagal");

}else{
mysqli_query($koneksi, "insert into ms_pengirim values (NULL, '$pengirim')")or die(mysqli_error($koneksi));
header("location:ms_pengirim.php?alert=berhasil");
}