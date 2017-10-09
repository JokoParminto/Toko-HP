<?php
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
<form action="simpanbeli.php" method="post">
	<table align="center">
	<tr>
		<th colspan='2'>DATA PEMBELI</th>
	</tr>
	<tr>
			<td>Nama</td>
			<td>: <input type="text" name="nama" size="27" maxlength="25"/></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>: <input type="email" name="email"size="27" maxlength="25"/></td>
		</tr>
		<tr>
			<td>No. Telp</td>
			<td>: <input type="text" name="notelp"size="14" maxlength="12"/></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>: <textarea name="alamat" rows="4" cols="29"/></textarea></td>
		</tr>
		<tr>
			<td colspan='2'><hr/></td>
		</tr>
		<tr>
			<th colspan='2' align="right"><input type="submit" value="BELI">
			<input type="button" onClick="self.history.back()" value="BATAL"></th>
		</tr>
<?php
include_once("keranjang.php"); 
?>
	</table>
</form>  