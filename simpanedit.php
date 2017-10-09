<?php
error_reporting(0);
include "connect.php";

if (isset($_POST['kode_barang'])) {
	$kode_barang = $_POST['kode_barang'];
	$foto_lama = $_POST['foto'];
	$simpan = "EDIT";
}
else {
	$simpan = "BARU";
}

$type = $_POST['type'];
$kategori = $_POST['kategori'];
$merk = $_POST['merk'];
$dimensi = $_POST['dimensi'];
$berat = $_POST['berat'];
$layar = $_POST['layar'];
$ram = $_POST['ram'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

$foto = $_FILES['foto']['name'];
$tmpName = $_FILES['foto']['tmp_name'];
$size = $_FILES['foto']['size'];
$type_f = $_FILES['foto']['type'];

$maxsize = 2000000;
$typeYgBoleh = array("image/jpeg", "image/png", "image/pjpeg");
$dirFoto = "pict";
if (!is_dir($dirFoto))
mkdir($dirFoto);
$fileTujuanFoto = $dirFoto."/".$foto;
$dirThumb = "thumb";
if (!is_dir($dirThumb))
mkdir($dirThumb);
$fileTujuanThumb = $dirThumb."/t_".$foto;

$dataValid="YA";

if ($size > 0){
	if ($size > $maxsize){
		echo "Ukuran File Terlalu Besar </br>";
		$dataValid="TIDAK";
	}
	if (!in_array($type_f, $typeYgBoleh)){
		echo "Type File Tidak Dikenal </br>";
		$dataValid = "TIDAK";
	}
}

if (strlen(trim($type))==0){
	echo "Nama barang harus diisi! <br/>";
	$dataValid = "TIDAK";
	}
if (strlen(trim($dimensi))==0){
	echo "Dimensi harus diisi! <br/>";
	$dataValid = "TIDAK";
	}
if (strlen(trim($berat))==0){
	echo "Berat harus diisi! <br/>";
	$dataValid = "TIDAK";
	}
if (strlen(trim($layar))==0){
	echo "Layar harus diisi! <br/>";
	$dataValid = "TIDAK";
	}
if (strlen(trim($harga))==0){
	echo "Harga harus diisi! <br/>";
	$dataValid = "TIDAK";
	}
if (strlen(trim($deskripsi))==0){
	echo "Deskripsi harus diisi! <br/>";
	$dataValid = "TIDAK";
	}
if ($dataValid == "TIDAK"){
	echo "Masih ada kesalahan, silahkan perbaiki !<br/>";
	echo "<input type='button' value='Kembali'
	onClick='self.history.back()'>";
	exit;
	}

if ($size > 0){
	if (!move_uploaded_file($tmpName, $fileTujuanFoto)){
		echo "Gagal upload gambar <br/>";
		echo "<a href='index.php>Daftar Barang</a>";
		exit;
	}
	else{
		buat_thumbnail($fileTujuanFoto, $fileTujuanThumb);
	}
}

function buat_thumbnail($file_src, $file_dst){

	list($w_src, $h_src, $type) = getimagesize($file_src);

	switch ($type) {
		case 1 :
			$img_src = imagecreatefromgif($file_src);
			break;
		case 2 :
			$img_src = imagecreatefromjpeg($file_src);
			break;
		case 3 :
			$img_src = imagecreatefrompng($file_src);
			break;
	}
	$thumb = 100;
	if ($w_src > $h_src) {
		$w_dst = $thumb ;
		$h_dst = round($thumb/$w_src*$h_src);
	}
	else {
			$w_dst = round($thumb/$h_src*$w_src);
			$h_dst = $thumb;
 		}

 		$img_dst = imagecreatetruecolor($w_dst, $h_dst);
 		imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $w_dst, $h_dst, $w_src, $h_src);
 		imagejpeg($img_dst, $file_dst);
 		//bersihkan
 		imagedestroy($img_src);
 		imagedestroy($img_dst);
} 
if ($simpan = 'EDIT') {
	if ($size == 0) {
		$foto = $foto_lama;
	}
	$query = " update barang set 
				type = '$type', 
				kode_kategori = $kategori, 
				kode_merk = $merk, 
				dimensi = '$dimensi', 
				berat = '$berat', 
				layar = '$layar', 
				RAM = '$ram', 
				harga = $harga, 
				deskripsi = '$deskripsi', 
				foto = '$foto' 
				where kode_barang = $kode_barang";
}
else {
	$query = "insert into barang (type, kode_kategori, kode_merk, dimensi, berat, layar, RAM, harga, deskripsi, foto) values 
 			('$type',$kategori, $merk,'$dimensi','$berat','$layar','$ram',$harga,'$deskripsi','$foto')";
}
 $hasil = mysqli_query($connect, $query);

 if (!$hasil) {
 	echo "Gagal Memasukan Data";
 }
 else {
 	header("Location: index.php");
 }
?>