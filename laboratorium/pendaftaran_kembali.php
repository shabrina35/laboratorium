<?php 
include '../koneksi.php';
$visit_id  = $_POST['id'];
$visit_status  = $_POST['status'];

        mysqli_query($koneksi, "update visit set visit_status='$visit_status' where visit_id='$visit_id'");
        header("location:pendaftaran.php?alert=success");





