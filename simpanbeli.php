<?php
	$nama			    = $_POST['nama'];
	$email				= $_POST['email'];
	$notelp				= $_POST['notelp'];
	$alamat             = $_POST['alamat'];
	$tanggal			= date ("y-m-d");
	$barang_pilih		= '';
	$qty				= 1;

$dataValid	="YA";

if (strlen(trim($nama))==0){
		echo "Nama Harus Diisi.. <br/>";
		$dataValid="Tidak";
	}
if (strlen(trim($email))==0){
		echo "Email Harus Diisi.. <br/>";
		$dataValid="Tidak";
	}
if (strlen(trim($notelp))==0){
		echo "No. Telfon Harus Diisi.. <br/>";
		$dataValid="Tidak";
	}
if (strlen(trim($alamat))==0){
		echo "Alamat Harus Diisi.. <br/>";
		$dataValid="Tidak";
	}
	if(isset($_COOKIE['keranjang'])){
			$barang_pilih = $_COOKIE['keranjang'];
		}else{
				echo "Keranjang Belanja Kosong <br/>";
				$dataValid="Tidak";
	}
if ($dataValid == "Tidak") {
			echo "Masih Ada Kesalahan, silahkan perbaiki! </br>";
			echo "<input type='button' value='Kembali';
				onClick='self.history.back()'>";
				exit;
	}
	include "connect.php";
	
	$simpan = true ;
	
	$query = " insert into hjual (tanggal, nama, email, notelp, alamat)
	values
			('$tanggal','$nama','$email','$notelp','$alamat')";
	$hasil = mysqli_query ($connect, $query);
	if (!$hasil) {
		echo " Data Costumer Tidak Ada <br/>";
		$simpan = false;
	}
	$idhjual = mysqli_insert_id($connect);
	if ($idhjual == 0){
		echo " Data Costumer Tidak Ada <br/> " ;
		$simpan = false ;
	}
	
	$barang_array = explode(",",$barang_pilih);
	$jumlah = count ($barang_array);
	if($jumlah <=1){
		echo " Tidak Ada Barang Yang Dipilih <br/>";
		$simpan = false;
	}else{
		foreach($barang_array as $kode_barang){
			if ($kode_barang == 0){
				continue ;
		}
		$query = "select * from barang where kode_barang = $kode_barang ";
		$hasil = mysqli_query($connect, $query);
		if(!$hasil){
			echo "Barang Tidak Ada <br/>";$simpan = false ;
			break;
		}else{
				$row = mysqli_fetch_assoc($hasil);		
				$harga = $row['harga'];
		}
		$query = "insert into djual (idhjual,kode_barang,qty,harga)
		values
			('$idhjual','$kode_barang','$qty','$harga')";
			$hasil = mysqli_query($connect, $query);
			if(!$hasil){
				echo"Detail Jual Gagal Simpan <br/>";
				$simpan = false;
				break;
			}
		}
	}
if($simpan){
	$komit = mysqli_commit($connect);
}else{
	$rollback = mysqli_rollback($connect);
	echo "Pembelian Gagal <br/>
		<input type='button' value='Kembali' onClick='self.history.back()'>";
	exit;
}
	header("Location: bukti_beli.php?idhjual=$idhjual");
	setcookie('keranjang',$barang_pilih,time()-3600);
?>