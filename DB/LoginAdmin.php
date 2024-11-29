<?php
session_start();
$db_host = "localhost";
$db_user = "root";
$db_password = "root";
$db_name = "lab";
$my_tab = "login";

$link = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($link->connect_error) {
    die('Ошибка: ('.$mysqli->connect_error.')'.$mysqli->connect_error);
}
	$login="неопределено";

	if (isset($_POST["name"])) {
		$login = $_POST["name"];
		$password = $_POST["password"];
		$password = md5($password);
		$query = "SELECT * FROM login WHERE login='$login' AND password='$password'";
		$result = mysqli_query($link,$query);
		if($result->num_rows>0) {
			 $_SESSION["loginUser"] = $login;
			 $_SESSION["passwordUser"] = $password;

			 $query = "SELECT admin FROM login WHERE login='$login' AND password='$password' AND admin!='0'";
			 $result = mysqli_query($link,$query);
			 if ($result->num_rows>0){
				$_SESSION["admin"] = 'admin';
			 }
		if(file_exists('index.php'))
			{
			 header("Location: index.php?id=1");
			}
		}
		else{
			echo "Неправильный логин или пароль";
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
		<input type="password" name="password" required><br><br>
		<input type="submit">
	</div>
</form>
</body>
</html>