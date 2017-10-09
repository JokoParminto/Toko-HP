<?php
	include "connect.php";
	session_start();
	$nama_member=htmlspecialchars($_POST['nama_member']);
	$pass=htmlspecialchars($_POST['pass']);

	$sql = "select * from member
			where nama_member = '$nama_member' and pass='$pass'";
	$hasil = mysqli_query($connect, $sql);
	if (mysqli_num_rows($hasil) == 0){?>
	<script>
		document.location.href='login.php?msg=User atau Password Salah';
	</script>
	<?php
		exit;
	}
	$data = mysqli_fetch_assoc($hasil);
	if ($data['nama_member'] == $nama_member and $data['pass']==$pass){
		if (($nama_member == "admin") and ($pass == "admin")) {
		$_SESSION['nama_member'] = $nama_member;
		$_SESSION['level'] = 1;
		} 
		//disini disimpan sessionnya
		$_SESSION['id_member']= $data['id_member'];
		$_SESSION['nama_member']= $data['nama_member'];
		$_SESSION['alamat']= $data['alamat'];
		$_SESSION['pass']= $data['pass'];
		?>
	<script>
		document.location.href='index.php';
	</script>
	<?php
	}
	if ($data['nama_member'] == $nama_member and $data['pass']==$pass){
		if (($nama_member == "member") and ($pass == "member")) {
		$_SESSION['nama_member'] = $nama_member;
		$_SESSION['level'] = 2;
		} 
		//disini disimpan sessionnya
		$_SESSION['id_member']= $data['id_member'];
		$_SESSION['nama_member']= $data['nama_member'];
		$_SESSION['alamat']= $data['alamat'];
		$_SESSION['pass']= $data['pass'];
		?>
	<script>
		document.location.href='index.php';
	</script>
	<?php
	}
	else { ?>
	<script>
		document.location.href='login.php?msg=User atau Password Salah';
	</script>
	<?php
	}
?>