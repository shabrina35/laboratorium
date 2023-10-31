<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$terima  = $_POST['terima'];
$hasil  = $_POST['hasil'];
$diagnosa  = $_POST['diagnosa'];
$print  = $_POST['print'];

	if($print=="tanpa"){
		header("location:hasil_laboratorium_print3.php?id=$id&terima=$terima&hasil=$hasil&diagnosa=$diagnosa");
	}elseif($print=="dengan"){
		header("location:hasil_laboratorium_print4.php?id=$id&terima=$terima&hasil=$hasil&diagnosa=$diagnosa");
	}


