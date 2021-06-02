
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/login.css">
	<title>Pengaduan Masyarakat</title>
</head>
<body>
	<div class="row">
		<div class="container">
		<p>Silahkan Login</p>
		<form action="" method="post">
				
				<label for="username">username</label>
				<input type="text" name="username" id="username" placeholder="Masukkan Username" class="login" autocomplete="off">
			
				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="Masukan Password" class="login ">

				<button class="submit" name="login">Login</button>
			
				
		</form>
		</div>
	</div>   
	</body>
</html>
<?php 
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi, md5($_POST['password']));
	
		$sql = mysqli_query($koneksi,"SELECT * FROM siswa WHERE username='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);
	
		$sql2 = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
		$cek2 = mysqli_num_rows($sql2);
		$data2 = mysqli_fetch_assoc($sql2);

		if($cek>0){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['level']='siswa';
			header('location:siswa/');
		}
		elseif($cek2>0){
			if($data2['level']=="admin"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:admin/');
			}
			elseif($data2['level']=="petugas"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:petugas/');
			}
		}
		else{
			echo "<script>alert('username/password salah')</script>";
		}

	}
 ?>