<html>
<head>
  <title>Jual Beli Online</title>
  <link rel="icon" type="image/png" href="img/favicon.png"/>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="barang">
  <?php
     error_reporting(0); 
     include "header.php";
     $type=$_GET['type'];
     $query="select b.type, m.nama_merk, b.dimensi, b.berat, b.layar, b.ram, b.deskripsi, b.harga, b.foto
                         from barang b, merk m
                         where b.kode_merk=m.kode_merk AND type='$type'";
     $hasil=mysqli_query($connect, $query); 
     echo "<h1 align='center'>DETAIL BARANG</h1><table align='center' border='1' width='1000px'>";  
      echo " <tr bgcolor='green'>
            <th width='150px'>Nama Barang</th>
            <th>Spesifikasi</th>
            </tr>";

     while ($data=mysqli_fetch_assoc($hasil)){
        $hrg = $data['harga'] ? $data['harga'] : 0;
        $formathrg = number_format($hrg,2,",",",");
        echo "<tr>";
        echo " <td style='text-align:center;padding:10px 10px;'>".$data['nama_merk']."<br/>".$data['type']."<br/><a href='gambar/{$data['foto']}'/>
                <img src='thumb/t_{$data['foto']}'width='100'/></a></td>
                <td style='text-align:justify;padding:10px 10px;'><b>Dimensi   : </b>".$data['dimensi']."<br/>
                    <b>Layar     : </b>".$data['layar']."<br/>
                    <b>Berat     : </b>".$data['berat']."<br/>
                    <b>Ram       : </b>".$data['ram']."<br/>
                    <b>Harga     : </b>Rp. ".$formathrg." ,-<br/>
                    <b>Deskripsi : </b>".$data['deskripsi']."
                    <a href='index.php'><input type='button' Value='Kembali'></a>
              </tr>";
        }
        echo "</table>";
  ?>
</body>
</html>