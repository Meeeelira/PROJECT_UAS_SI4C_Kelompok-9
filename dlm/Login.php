<?php
    //ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];
    //cek data dari database
    include_once "DB.php";
    $query = mysqli_query($koneksi, "SELECT * FROM tb_user 
    WHERE username= '$username' AND password='$password'");

// cek privilege dan set session
if ($cek > 0) {
	$data = mysqli_fetch_assoc($login);

	if ($data['id_level']==1) {
		$_SESSION['nama_user'] = $data['nama_user'];
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['level'] = "Owner";
		header("location:../dashboard/index.php?dashboard");

	} elseif ($data['id_level']==2) {
		$_SESSION['nama_user'] = $data['nama_user'];
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['level'] = "Kasir";
		header("location:../dashboard/index.php?home");

	} elseif ($data['id_level']==3) {
		$_SESSION['nama_user'] = $data['nama_user'];
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['level'] = "Pelanggan";
		header("location:../dashboard/index.php?home");
	} else {
		header("location:index.php?pesan=gagal");
	}
} else {
	header("location:index.php?pesan=gagal");
}
?>