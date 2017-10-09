<html>
<head>
  <title>Jual Beli Online</title>
  <link rel="icon" type="image/png" href="img/favicon.png"/>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="login">
<table align="center">
<form action="cek_login.php" method="post">
	<div class='header'>
        <?php error_reporting(0);session_start(); if ($_SESSION['level'] == 1) { 
          echo "<a href ='Form Isi.php'><input type='button' value='TAMBAH DATA'></a>";
        } ?>
        <?php if ($_SESSION['level'] != 1) { 
          echo "<a href ='keranjang_belanja.php'><input type='button' value='KERANJANG'></a>";
        } ?>
        <a href ='index.php'><input type='button' value='DAFTAR BARANG'></a>
        <?php if ($_SESSION['nama_member'] != NULL) {echo"<a href ='logout.php'><input type='button' value='LOGOUT'></a>";}?>
        <a href ='signup.php'><input type='button'value='SIGN UP'></a>
     </div> 
	<tr>
		<td>Username</td><td> : <input type="text" name="nama_member" placeholder="Username" required/></td>
	</tr>
	<tr>
		</td><td>Password</td><td> : <input type="password" name="pass" placeholder="Password" required/></td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" value="LOGIN"</td>
	</tr>
</table>
		<div class="msg" colspan="2"><?php
				if (isset($_GET['msg'])){
					echo $_GET['msg'];
				}
			?>
		</div>
</form>
</body>
</html>