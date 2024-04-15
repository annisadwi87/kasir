<?php
	@ob_start();
	session_start();
	if(isset($_POST['proses'])){
		require 'config.php';
			
		$user = strip_tags($_POST['user']);
		$pass = strip_tags($_POST['pass']);

		$sql = 'select member.*, login.user, login.pass
				from member inner join login on member.id_member = login.id_member
				where user =? and pass = md5(?)';
		$row = $config->prepare($sql);
		$row -> execute(array($user,$pass));
		$jum = $row -> rowCount();
		if($jum > 0){
			$hasil = $row -> fetch();
			$_SESSION['admin'] = $hasil;
			echo '<script>alert("Login Sukses");window.location="index.php"</script>';
		}else{
			echo '<script>alert("Login Gagal");window.location="index.php"</script>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="csslogin.css">
    <title>kasir</title>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <img src="login.png" alt="Avatar" class="avatar">
            <h1>Aplikasi Kasir UKK RPL 2024 - widitutor</h1>
							<form class="form-login" method="POST">
								<p>Username</p>
                <input type="text" placeholder="Masukkan Username" name="user" required>
                <p>Password</p>
                <input type="password" placeholder="Masukkan Password" name="pass" required>
                <input type="submit" value="Login"name="proses">
               
            </form>
							
</div>
    </div>
</body>
</html>
