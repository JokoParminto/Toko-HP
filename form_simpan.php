<?php
error_reporting(0);
	$kode_kategori = $_POST['kode_kategori'];
	$kode_merk     = $_POST['kode_merk'];
	$tipe          = $_POST['type'];
	$dimensi       = $_POST['dimensi'];
	$berat         = $_POST['berat'];
	$layar         = $_POST['layar'];
	$ram           = $_POST['ram'];
	$harga         = $_POST['harga'];
	$deskripsi     = $_POST['deskripsi'];
	$foto          =$_FILES['foto']['name'];
	$tmpName       =$_FILES['foto']['tmp_name'];
	$size          =$_FILES['foto']['size'];
	$type          =$_FILES['foto']['type'];

	$maxsize = 2000000;
	$terima = array("image/jpeg", "image/png", "image/pjpeg");
	$dirFoto = "pict";
	if (!is_dir($dirFoto))
	mkdir($dirFoto);
	$TujuanFoto = $dirFoto."/".$foto;
	$dirThumb = "thumb";
	if (!is_dir($dirThumb))
	mkdir($dirThumb);
	$TujuanThumb = $dirThumb."/t_".$foto;

	$dataValid="YA";

	if ($size > 0){
		if ($size > $maxsize){
			echo "Ukuran File Terlalu Besar </br>";
			$dataValid="TIDAK";
		}
		if (!in_array($type, $terima)){
			echo "Type File Tidak Dikenal </br>";
			$dataValid = "TIDAK";
		}
	}

	if ($dataValid == "TIDAK"){
		echo "Masih Ada Kesalahan, Silahkan Perbaiki!<br/>";
		echo "<input type='button' value='kembali' onClick='self.history.back()'>";
		exit;
	}

	include "connect.php";
	$query=mysqli_query($connect, "insert into barang (kode_kategori, kode_merk, type, dimensi, berat, layar, ram, harga, deskripsi, foto)
						values('$kode_kategori','$kode_merk','$tipe','$dimensi','$berat','$layar',
		                '$ram','$harga','$deskripsi','$foto')"); 
	if(!$query) die(mysql_error());
	if ($size > 0){
		if (!move_uploaded_file($tmpName, $TujuanFoto)){
			echo "Gagal upload gambar <br/>";
			echo "<a href='index.php>Daftar Barang</a>";
			exit;
		}
		else{
			thumbnail($TujuanFoto, $TujuanThumb);
		}
	}
	echo "<br/>File sudah di upload. <br/>";

	function thumbnail($file_src, $file_dst){

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
	 		imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0,
								$w_dst, $h_dst, $w_src, $h_src);
	 		imagejpeg($img_dst, $file_dst);
	 		imagedestroy($img_src);
	 		imagedestroy($img_dst);
		}
		header("location: index.php");
?>
