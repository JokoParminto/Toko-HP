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
<body id="tambah">
<?php error_reporting(0); include 'header.php'; ?>
<form action="form_simpan.php" method="post" enctype="multipart/form-data">
<table align="center">
	<tr>
		<td>Kode Kategori</td>
		<td> : <select name="kode_kategori">
					<?php
           $query = ("select * from kategori");
						$db =mysqli_query($connect, $query);
						while ($data=mysqli_fetch_assoc($connect, $db)){
  						echo "<option value='{$data['kode_kategori']}'>".$data['nama_kategori']."</option>";
  						}
  					?>
  			   </select>
		</td>
	</tr>
	<tr>
		<td>Kode Merk</td>
			<td> : <select name="kode_merk">
						<?php
							$query=mysqli_query($connect, "select * from merk");
							while ($data=mysqli_fetch_array($query, MYSQL_ASSOC)){
		  					echo "<option value='{$data['kode_merk']}'>".$data['nama_merk']."</option>";
		  					}
		  					?>
		  			</select>
			</td>
	</tr>
	<tr>
		<td>Type</td>
		<td> : <input type="text" name="type" size='8' maxlenght='7'></td>
	</tr>
	<tr>
		<td>Dimensi</td>
		<td>: <input type='text' name='dimensi' size='19' maxlenght='18'></td>
	</tr>
	<tr>
		<td>Berat</td>
		<td>: <input type='text' name='berat' size='8' maxlenght='7'></td>
	</tr>
	<tr>
		<td>Layar</td>
		<td>: <input type='text' name='layar' size='8' maxlenght='7'></td>
	</tr>
	<tr>
		<td>RAM</td>
		<td>: <input type='text' name='ram' size='8' maxlenght='7'></td>
	</tr>
	<tr>
		<td>Harga</td>
		<td>: <input type='text' name='harga' size='10' maxlenght='9'></td>
	</tr>
	<tr>
		<td>Deskripsi</td>
		<td>: <textarea name='deskripsi' rows='5'></textarea></td>
	</tr>
	<tr>
		<td>Gambar</td>
		<td> : <input type="file" name="foto"></td>
	</tr>
	<tr>
		<td colspan="2"><hr/></td>
	</tr>
	<tr>
		<td colspan="2"><input type='button' onclick='self.history.back()' value='BATAL'><input type="submit" value="SIMPAN"></td>
	</tr>
</table>
</form>
</body>
</html>
