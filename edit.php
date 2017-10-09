<?php
session_start();
if (empty($_SESSION['nama_member']) || empty($_SESSION['pass'])) {
header( "Location: login.php?msg=Anda Harus Melakukan Login Sebagai Admin");
}
else if ($_SESSION['nama_member'] == 'admin') {

}
else {
header( "Location: login.php?msg=Anda Harus Melakukan Login Sebagai Admin");
}
?>
<html>
<head>
    <title>Jual Beli Online</title>
  	<link rel="icon" type="image/png" href="img/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
	error_reporting(0); 
	include 'header.php';
	if (isset($_SESSION['id_member'])){
	}
	$kode_barang='';
	if (isset($_GET['kode_barang'])) {
	$kode_barang = $_GET['kode_barang'];
	}
	$query = "select * from barang where kode_barang = $kode_barang";
	$hasil = mysqli_query($connect, $query);
		if (!$hasil) die ("Gagal Query");
	$data = mysqli_fetch_assoc($hasil);
	$kode_barang = $data['kode_barang'];
	$kategori = $data['kode_kategori'];
	$merk = $data['kode_merk'];
	$type = $data['type'];
	$dimensi = $data['dimensi'];
	$berat = $data['berat'];
	$layar = $data['layar'];
	$ram = $data['ram'];
	$deskripsi = $data['deskripsi'];
	$harga = $data['harga'];
    $foto = $data['foto'];
?>
<form id="edit" method='post' action='simpanedit.php' enctype="multipart/form-data">
<input type='hidden' name='kode_barang' value='<?php echo $kode_barang; ?>'>
<table align='center'>
	<tr><th class='judul' colspan='2'>EDIT DATA BARANG</th></tr>
	<tr><td colspan='2'><hr/></td></tr>
	<tr>
		<td>Nama Barang</td>
		<td>: <input type='text' name='type' size='19' maxlenght='18'value='<?php echo $type; ?>'></td>
	</tr>
	<tr>
		<td>Kategori</td>
		<td>:
			<select name='kategori' value='<?php echo $nama_kategori; ?>'>
				<?php
					$query="select * from kategori";
					$hasil=mysqli_query($connect, $query);
						while ($data=mysqli_fetch_array($hasil,MYSQL_ASSOC)) {
  						echo "<option value='{$data['kode_kategori']}'>".$data['nama_kategori']."</option>";
  						}
  				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Merk</td>
		<td> : 
			<select name='merk'>
				<?php
					$query="select * from merk";
					$hasil=mysqli_query($connect, $query);
						while ($data=mysqli_fetch_array($hasil,MYSQL_ASSOC)) {
  						echo "<option value='{$data['kode_merk']}'>".$data['nama_merk']."</option>";
  						}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Dimensi</td>
		<td>: <input type='text' name='dimensi' size='19' maxlenght='18'value='<?php echo $dimensi; ?>'></td>
	</tr>
	<tr>
		<td>Berat</td>
		<td>: <input type='text' name='berat' size='8' maxlenght='7' value='<?php echo $berat; ?>'></td>
	</tr>
	<tr>
		<td>Layar</td>
		<td>: <input type='text' name='layar' size='8' maxlenght='7' value='<?php echo $layar; ?>'></td>
	</tr>
	<tr>
		<td>RAM</td>
		<td>: <input type='text' name='ram' size='8' maxlenght='7' value='<?php echo $ram; ?>'></td>
	</tr>
	<tr>
		<td>Harga</td>
		<td>: <input type='text' name='harga' size='10' maxlenght='9'value='<?php echo $harga; ?>'></td>
	</tr>
	<tr>
		<td>Deskripsi</td>
		<td>: <textarea name='deskripsi' rows='5' value='<?php echo $deskripsi; ?>'></textarea></td>
	</tr>
	<tr>
		<td>Foto</td>
		<td>: <input type="file" name="foto"/> <br> <img src="<?php echo "thumb/t_".$foto; ?>" width='100px' /> </td>
	</tr>
	<tr>
		<td colspan='2'><input type='button' onclick='self.history.back()' value='TIDAK'><input type='submit' value="KIRIM"></td>
	</tr>
</table>
</form>
</body>
</html>
	