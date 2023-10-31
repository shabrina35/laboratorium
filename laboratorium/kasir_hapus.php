<?php 
include '../koneksi.php';
$kasir_id  = $_POST['id'];
$kembali  = $_POST['kembali'];
$kasir_status = "BELUM BAYAR";

$update= mysqli_query($koneksi, "UPDATE visit SET visit_status='$kasir_status' WHERE visit_id='$kembali'");
mysqli_query($koneksi, "DELETE FROM kasir WHERE kasir_id='$kasir_id'");
header("location:kasir_bayar.php?id=$kembali");