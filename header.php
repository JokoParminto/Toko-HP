<link rel="stylesheet" type="text/css" href="css/style.css">
  <?php 
  include "connect.php";
  session_start();
  if (empty($_SESSION['nama_member']) || empty($_SESSION['pass'])) {
  ?>
  <form action="barang_cari.php" method="post">
  <div id='header'>
        <a class="img"><img src="img/search.png" width="31px" align="left">
        <input type="text" name="nama_brg" placeholder="Cari Barang...."> <input type="submit" value="CARI"></a></form>
        <a href ='keranjang_belanja.php'><input type='button' value='KERANJANG'></a>
        <a href ='index.php'><input type='button' value='DAFTAR BARANG'></a>
        <a href ='login.php'><input type='button' value='LOGIN'></a>
        <a href ='signup.php'><input type='button' value='SIGN UP'></a>
        <?php if (!empty($_SESSION['nama_member']) || !empty($_SESSION['pass'])) { ?>
        <a class="sbg"><?php echo "Login sebagai : <i><u>".$_SESSION['nama_member']."</u></i>"; ?></a></div>
        <?php } ?> 
  <?php
  }
  else{
    if (!empty($_SESSION['nama_member']) || !empty($_SESSION['pass'])) {
  ?>
  <form action="barang_cari.php" method="post">
  <div id='header'>
    <a class="img"><img src="img/search.png" width="31px" align="left">
        <input type="text" name="nama_brg" placeholder="Cari Barang...."> <input type="submit" value="CARI"></a></form>
        <?php if ($_SESSION['level'] == 1) { 
          echo "<a href ='Form Isi.php'><input type='button' value='TAMBAH DATA'></a>";
        } ?>
        <?php if ($_SESSION['level'] != 1) { 
          echo "<a href ='keranjang_belanja.php'><input type='button' value='KERANJANG'></a>";
        } ?>
        <a href ='index.php'><input type='button' value='DAFTAR BARANG'></a>
        <a href ='logout.php'><input type='button' value='LOGOUT'></a>
        <a class="sbg">
          <?php if ($_SESSION[level] == 1 ){
            echo "<img src='img/key.gif' width='25px' align='left'>"; 
          }
          if ($_SESSION[level] != 1 ){
            echo "<img src='img/user.png' width='25px' align='left'>"; 
          }
        echo "Login sebagai : <i><u>".$_SESSION['nama_member']."</u></i>"; ?></a></div> 
  <?php
  }
  }
  ?>
</div>