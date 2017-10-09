<?php
    $host="localhost"; 
    $user="root";   
    $password="";   
    $database="toko";  
    $connect=mysqli_connect($host,$user,$password,$database); 
    if(!$connect) die(mysqli_connect_error());

$sqlTabelHJual="create table if not exists hjual(
				idhjual int auto_increment not null primary key,
				tanggal date not null,
				nama varchar(40) not null,
				email varchar(50) not null default '',
				notelp varchar(20) not null default'',
				alamat varchar(50) not null)";	
mysqli_query($connect,$sqlTabelHJual) or die("Gagal buat tabel header jual");
$sqlTabelDJual="create table if not exists djual(
				iddjual int auto_increment not null primary key,
				idhjual int not null,
				kode_barang int not null,
				qty int not null,
				harga int not null)";
mysqli_query($connect,$sqlTabelDJual) or die("Gagal buat tabel detail jual");
?>
