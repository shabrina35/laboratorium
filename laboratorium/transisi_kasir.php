<?php 
include '../koneksi.php';
$tgl  = $_GET['tgl'];

	if($tgl==""){
		header("location:kasir_selesai.php");
	}else{
		header("location:kasir_selesai.php?tgl=$tgl");
	}


