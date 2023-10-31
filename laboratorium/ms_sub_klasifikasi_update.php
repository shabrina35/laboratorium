<?php 
include '../koneksi.php';
$subklasifikasi  = $_POST['subklasifikasi'];
$sub_klasifikasi  = $_POST['sub_klasifikasi'];
$kid  = $_POST['id'];


mysqli_query($koneksi, "update ms_sub_klasifikasi set subklasifikasi='$subklasifikasi', sub_klasifikasi='$sub_klasifikasi' where sub_klasifikasi_id='$kid'");
    header("location:ms_sub_klasifikasi.php?alert=update");





