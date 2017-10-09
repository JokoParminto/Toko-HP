<?php
error_reporting(0);
include "connect.php";
session_start();
if (empty($_SESSION['nama_member']) || empty($_SESSION['pass'])) {
header( "Location: login.php?msg=Anda Harus Melakukan Login Sebagai Member");
}
else if ($_SESSION['nama_member'] != 'admin') {

}
else {
header( "Location: login.php?msg=Anda Harus Melakukan Login Sebagai Member");
}
?>
<html>
<head>
    <title>Jual Beli Online</title>
	<link rel="icon" type="image/png" href="img/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="bukti">
<?php
	$idhjual = $_GET["idhjual"];
	$sqlhjual = "select * from hjual where idhjual = $idhjual ";
	$hasilhjual = mysqli_query($connect, $sqlhjual);
	$rowhjual = mysqli_fetch_assoc($hasilhjual);

	echo "<pre>";
	echo "<h2>BUKTI PEMBELIAN</h2>";
	echo "NO. NOTA : ".date("Ymd").$rowhjual['idhjual']."<br/>";
	echo "TANGGAL  : ".$rowhjual['tanggal']."<br/>";
	echo "NAMA     : ".$rowhjual['nama']."<br/>";
    echo "ALAMAT   : ".$rowhjual['alamat']."<br/>";
	echo "NO. TELP : ".$rowhjual['notelp']."<br/>";
	$sqldjual = "select merk.nama_merk, barang.type, djual.harga, djual.qty, 
				(djual.harga * djual.qty) as jumlah from 
				djual inner join barang on djual.kode_barang = barang.kode_barang
				inner join merk on merk.kode_merk = barang.kode_merk
				where djual.idhjual = $idhjual";
	$hasildjual = mysqli_query($connect, $sqldjual);
	echo "<table boreder='1' cellpadding='10' cellspacing='0'>";
	echo "<tr bgcolor='gray'>";
	echo "<th> Nama Barang</th>";
	echo "<th>Quantity</th>";
	echo "<th>Harga</th>";
	echo "<th style='border-right:1px solid transparent;'>Jumlah</th>";
	echo "</tr>";
	
	$totalharga = 0;
	while ($rowdjual = mysqli_fetch_assoc($hasildjual)){
		$hrg = $rowdjual['harga'] ? $rowdjual['harga'] : 0;
		$formathrg = number_format($hrg,2,",",",");
		$jml = $rowdjual['jumlah'] ? $rowdjual['jumlah'] : 0;
		$formatjml = number_format($jml,2,",",",");
		echo "<tr>";
		echo "<td>".$rowdjual['nama_merk']." ".$rowdjual['type']."</td>";
		echo "<td align='right'> ".$rowdjual['qty']."</td>";
		echo "<td align='right'> ".$formathrg."</td>";
		echo "<td style='border-right: 1px solid transparent;' align='right'> ".$formatjml."</td>";
		echo "</tr>";
		$totalharga = $totalharga + $rowdjual['jumlah'];
	}
	$total = $totalharga ? $totalharga : 0;
	$format = number_format($total,2,",",",");
	
	echo "<tr>";
	echo "<td style='border-top: 1px solid #222;' colspan='3' align='right'>";
	echo "<strong>Total Jumlah</strong> </td>";
	echo "<td style='border-top: 1px solid #222;border-right: 1px solid transparent;' align='right'><strong>Rp. $format ,-</strong></td>";
	echo "</tr>";
	echo "</table>";
	echo "<br/>";
	?>
<div class="tombol" align="right"><input type="button" value="Beli Lagi"onClick="window.location.assign('index.php')"> <input type="button" value="Print"onclick="window.print()"></div>
<?php echo "</pre>";
?>
</body>
</html>