<?php
error_reporting(0);
	$nama_member = $_POST['nama_member'];
	$pass        = $_POST['pass'];
	$alamat      = $_POST['alamat'];

$dataValid	="YA";

if (strlen(trim($nama_member))==0){
		echo "Nama Harus Diisi.. <br/>";
		$dataValid="Tidak";
	}
if (strlen(trim($pass))==0){
		echo "Password Harus Diisi.. <br/>";
		$dataValid="Tidak";
	}
if (strlen(trim($alamat))==0){
		echo "Alamat Harus Diisi.. <br/>";
		$dataValid="Tidak";
	}
if ($dataValid == "Tidak") {
			echo "Masih Ada Kesalahan, silahkan perbaiki! </br>";
			echo "<input type='button' value='Kembali';
				onClick='self.history.back()'>";
				exit;
	}

	include "connect.php";
	$query=mysqli_query($connect, "insert into member (nama_member, pass, alamat)
						values('$nama_member','$pass','$alamat')"); 
	if(!$query) die(mysql_error());
	header("Location: login.php?msg=Registrasi Akun Anda Sukses, Silahkan Login");
?>
