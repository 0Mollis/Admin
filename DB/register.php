<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_password = "root";
$db_name = "lab";
$my_tab = "login";

$link = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($link->connect_error) {die('Ошибка: ('.$mysqli->connect_error.')'.$mysqli->connect_error);}
	$login="неопределено";

	if (isset($_POST["name"])) {
		$login = $_POST["name"];
		$password = $_POST["password"];
		$password2 = $_POST["password2"];
		if ($password == $password2) {
			if (preg_match('/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',$password)) {
				$password = md5($password);
				$query = "SELECT * FROM login WHERE login='$login' AND password='$password'";
				$result = mysqli_query($link,$query);
				if($result->num_rows == 0) 
				{
						$query = "INSERT INTO login (login, password) VALUES ('".$login."', '".$password."')";
						$result = mysqli_query($link,$query);
						$_SESSION["loginUser"] = $login;
						$_SESSION["passwordUser"] = $password;
					if(file_exists('index.php')){
						header("Location: index.php?id=1");
					}
				}
			}
			else{
				echo "Неправильный логин или пароль";
			}
		}	
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST">
	<div class="divs">
		<p>Логин:</p>
		<input type="text" name="name" required>
		<p>Пароль:</p>
		<input type="password" name="password" required>
		<p>Повторите пароль:</p>
		<input type="password" name="password2" required><br>
		<p>Пароль должен быть минимум 6 символов одну заглавную и цифру</p>
		<br>
		<input type="submit">
	</div>
</form>
</body>
</html>