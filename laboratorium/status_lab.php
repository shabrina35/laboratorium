<?php 
include '../koneksi.php';
$tgl = $_POST['masuk'];
$visit  = $_POST['id'];
$status = $_POST['status'];

if($tgl==""){
mysqli_query($koneksi, "UPDATE visit SET visit_lab='$status' WHERE visit_id='$visit'");
header("location:laboratorium.php");

}else{
mysqli_query($koneksi, "UPDATE visit SET visit_lab='$status' WHERE visit_id='$visit'");
header("location:laboratorium.php?tgl=$tgl");
}