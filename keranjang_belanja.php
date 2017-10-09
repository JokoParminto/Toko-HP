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
<html>
<head>
  <title>Jual Beli Online</title>
  <link rel="icon" type="image/png" href="img/favicon.png"/>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="index">
  <?php
     error_reporting(0); 
     include "header.php";
     $barang_pilih=0;
      if(isset($_COOKIE['keranjang'])){
        $barang_pilih=$_COOKIE['keranjang'];
      }
      if(isset($_GET['kode_barang'])){
        $kode_barang=$_GET['kode_barang'];
        $barang_pilih=$barang_pilih=str_replace((",".$kode_barang),"",$barang_pilih);
        setcookie('keranjang',$barang_pilih,time()+3600);
      }
     $query="select b.kode_barang, b.type, m.nama_merk, b.dimensi, b.layar, b.deskripsi, b.foto
                         from barang b, merk m
                         where b.kode_merk=m.kode_merk and b.kode_barang in (".$barang_pilih.") order by b.kode_barang desc";
     $hasil=mysqli_query($connect, $query); 
      echo "<table align='center' border='1' width='1000px'>";  
      echo "<tr height='60px'>
            <th colspan='4' style='font-size:30px;'>KERANJANG BELANJA</th>
            </tr>
            <tr bgcolor='green'>
            <th width='150px'>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Operasi</th>";
            echo"</tr>";
    $no=0;
    while ($data=mysqli_fetch_assoc($hasil)){
        echo "<tr>";
        echo "  <td style='text-align:center;padding:10px 10px;'>".$data['nama_merk']."<br/>".$data['type']."<br/><a href='gambar/{$data['foto']}'/>
                <img src='thumb/t_{$data['foto']}'width='100'/></a></td>
                <td style='text-align:justify;padding:10px 10px;'><b>Dimensi   : </b>".$data['dimensi']."<br/>
                    <b>Layar     : </b>".$data['layar']."<br/>
                    <b>Deskripsi : </b>".substr($data['deskripsi'],0,200)." ......"."
                    <a href='barang.php?type={$data['type']}'>Detail Barang</a></td>";
        echo "<td align='center'><a href='".$_SERVER['PHP_SELF']."?kode_barang=".$data['kode_barang']."'><input type='submit' value='BATAL'></a></td>";  
        echo "</tr>";
        } 
        echo "<tr><td colspan='2'></td><td align='center'><a href='beli.php'><input type='submit' Value='BELI'></a></td></tr>";
        echo "</table>";
  ?>
</body>
</html>