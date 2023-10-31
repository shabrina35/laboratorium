<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$username = $_POST['username'];
$pwd = $_POST['password'];
$password = $_POST['password'];
$rekening = $_POST['rekening'];
$level = $_POST['level'];


// cek gambar
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);


if($username=="" && $pwd=="" && $filename=="" && $nama==""){
		header("location:profil.php?alert=belum");
		
}elseif($pwd=="" && $filename=="" && $username==""){
	mysqli_query($koneksi, "update user set user_nama='$nama' where user_id='$id'");
		header("location:profil.php?alert=user");
		
}elseif($pwd=="" && $filename==""){
	mysqli_query($koneksi, "update user set user_username='$username' where user_id='$id'");
		header("location:profil.php?alert=user");
		
}elseif($username=="" && $filename==""){
	mysqli_query($koneksi, "update user set user_password='$password' where user_id='$id'");
		header("location:profil.php?alert=password");	
		
}elseif($username=="" && $pwd==""){
    	if(!in_array($ext,$allowed) ) {
		header("location:profil.php?alert=gagal");
    	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);
		$x = $rand.'_'.$filename;
		mysqli_query($koneksi, "update user set user_foto='$x' where user_id='$id'");		
		header("location:profil.php?alert=foto");
	}

}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);
		$x = $rand.'_'.$filename;
		mysqli_query($koneksi, "update user set user_nama='$nama', user_username='$username', user_password='$password', user_foto='$x', user_level='$level', user_rekening='$rekening' where user_id='$id'");		
		header("location:profil.php?alert=sukses");
	}

