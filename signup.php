<?php error_reporting(0);session_start();if ($_SESSION['nama_member'] == NULL) { ?>
<html>
<head>
  <title>Jual Beli Online</title>
  <link rel="icon" type="image/png" href="img/favicon.png"/>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="sign">
<form action="form_simpanmember.php" method="post">
    <div class='header'>
        <a href ='keranjang_belanja.php'><input type='button' value='KERANJANG'></a>
        <a href ='index.php'><input type='button' value='DAFTAR BARANG'></a>
        <?php if ($_SESSION['nama_member'] != NULL) {echo"<a href ='logout.php'><input type='button' value='LOGOUT'></a>";}?>
        <a href ='login.php'><input type='button'value='LOGIN'></a>
     </div><br/>
     <table align="center">
    <tr>
        <th colspan="2">DAFTAR MEMBER</th>
    </tr>
    <tr>
        <th colspan="2"><hr/></th>
    </tr>
    <tr>
        <td>Username</td>
        <td> : <input type="text" name="nama_member" size='21' maxlenght='20' placeholder="Masukan Username Anda"></td>
    </tr>

    <tr>
        <td>Password</td>
        <td>: <input type='password' name='pass' size='21' maxlenght='20' placeholder="Masukan Password Anda"></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: <textarea name='alamat' rows='3'placeholder="Masukan Alamat Anda"></textarea></td>
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
<?php } 
else if ($_SESSION['nama_member'] == 'admin') {
header( "Location: login.php?msg=Anda Seorang Admin Untuk Apa Mendaftar Menjadi Member :)");
}
else {
header( "Location: login.php?msg=Anda Sudah Terdaftar Jadi Member");
}?>