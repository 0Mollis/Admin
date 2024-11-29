<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>главная</title>
	<script type="text/javascript">
	</script>
</head>
<body>
<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "root";
$db_name = "lab";
$my_tab = "lab2";

$link = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($mysqli->connect_error) {
    die('Ошибка: ('.$mysqli->connect_errno.')'.$mysqli->connect_error);
}

$id = "не определено";
if (isset($_GET["id"])) {
	$id = $_GET["id"];

	$query = "SELECT * FROM lab2 WHERE id =".$id;
	$result = mysqli_query($link,$query);
	while ($rows = mysqli_fetch_array($result)) {
		echo $rows["text"];
	}
	if (isset($_SESSION["admin"])) {
		echo '<a href=update.php> Изменить</a><br><br><a href="exit.php">Выйти</a>';
	}
	else if(isset($_SESSION['loginUser'])){
		echo '<a href="exit.php">Выйти</a>';
	}
	else{
		echo '<a href="LoginAdmin.php">Войти </a><a href="register.php">Зарегистрироватся</a><br><br>';
	}
}
?>
</body>
</html>