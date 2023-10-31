<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='$username' AND user_password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['user_id'];
	$_SESSION['nama'] = $data['user_nama'];
	$_SESSION['username'] = $data['user_username'];
	$_SESSION['level'] = $data['user_level'];
	$_SESSION['password'] = $data['user_password'];
	$_SESSION['nik'] = $data['user_rekening'];
		
	if($data['user_level'] == "admin"){
		$_SESSION['status'] = "admin_logedin";
		header("location:admin/");
		
	}else if($data['user_level'] == "dokter"){
		$_SESSION['status'] = "dokter_logedin";
		header("location:dokter/");
		
	}else if($data['user_level'] == "laboratorium"){
		$_SESSION['status'] = "laboratorium_logedin";
		header("location:laboratorium/");
		
	}else if($data['user_level'] == "apotek"){
		$_SESSION['status'] = "apotek_logedin";
		header("location:apotek/");	
		
	}else if($data['user_level'] == "pasien"){
		$_SESSION['status'] = "pasien_logedin";
		header("location:pasien/");
		
	}else{
		header("location:index.php?alert=gagal");
	}
}else{
	header("location:index.php?alert=gagal");
}


