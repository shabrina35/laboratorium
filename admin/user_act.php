<?php 
include '../koneksi.php';
$user_nama  = $_POST['nama'];
$user_username = $_POST['username'];
$user_password = $_POST['password'];
$user_level = $_POST['level'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

if($filename == ""){
	mysqli_query($koneksi, "insert into user values (NULL,'$user_nama','$user_username','$user_password','','$user_level','')");
	header("location:user.php");
}else{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(!in_array($ext,$allowed) ) {
		header("location:user.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);
		$file_gambar = $rand.'_'.$filename;
		mysqli_query($koneksi, "insert into user values (NULL,'$user_nama','$user_username','$user_password','$file_gambar','$user_level','')");
		header("location:user.php");
	}
}

