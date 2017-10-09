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
<body id="hapus">
<?php
    error_reporting(0); 
    include_once 'header.php';
    if (isset($_SESSION['id_member'])){
    }
    $kode_barang="";
    if (isset($_GET['kode_barang']))
    $kode_barang = $_GET['kode_barang'];
    $query = "select b. kode_barang, k.nama_kategori, b.type, b.layar, 
              b.dimensi, b.berat, b.RAM, b.deskripsi, b.harga, m.nama_merk, 
              b.foto
              from barang b, merk m, kategori k 
              where b.kode_merk = m.kode_merk and 
              k.kode_kategori=b.kode_kategori
              and kode_barang = $kode_barang ";
    $hasil = mysqli_query($connect, $query);
        if (!$hasil) die ("Gagal Query");
    $data = mysqli_fetch_assoc($hasil);
    $kode_barang = $data['kode_barang'];
    $kategori = $data['nama_kategori'];
    $merk = $data['nama_merk'];
    $type = $data['type'];
    $dimensi = $data['dimensi'];
    $berat = $data['berat'];
    $layar = $data['layar'];
    $ram = $data['RAM'];
    $deskripsi = $data['deskripsi'];
    $harga = $data['harga'];
    $foto = $data['foto'];

    $hrg = $harga ? $harga : 0;
    $formathrg = number_format($hrg,2,",",",");
    echo "<table align='center'>";
    echo "<tr><th colspan='2' class='judul'>KONFIRMASI HAPUS</th></tr><tr>";
    echo "<td colspan='2'><hr/></td></tr><tr><td>Type HP </td>";
    echo "<td> : $type </td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> Kategori HP </td>";
    echo "<td> : $kategori </td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> Merk HP </td>";
    echo "<td> : $merk </td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> Harga HP </td>";
    echo "<td> : Rp. $formathrg ,-</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> Type HP </td>";
    echo "<td> <img src='thumb/t_".$foto."' width='100px' /></td>";
    echo "</tr>";
    echo "<th class='setuju' colspan='2'><br>APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI!!!<br/><br/>";
    echo "<a class='link' href='hapus.php?kode_barang=$kode_barang&hapus=1' onClick='return confirm(\"Yakin AKan Menghapus \\n {$data['nama_merk']} {$data['type']} ?\")'><input type='submit' value='YA'></a> &nbsp;&nbsp;&nbsp;";
    echo "<a class='link' href='index.php'><input type='submit' value='TIDAK'></a></th>";

    if (isset($_GET['hapus'])) {
        $sql = "delete from barang where kode_barang = $kode_barang";
        $hasil = mysqli_query($connect, $sql);
        if (!$hasil) {
            echo "Gagal Hapus Data HP !";
            echo "<input type='button' onclick='self.history.back()' Value='Kembali'>";
        }
        else {
            $pict ="pict/$foto";
            if (file_exists($pict)) imagedestroy($pict);
            $pict ="thumb/t_$foto";
            if (file_exists($pict)) imagedestroy($pict);
            header("location: index.php");
        }
    }
?>
</body>
</html>