<?php
session_start();
unset($_SESSION["loginUser"]);
unset($_SESSION["passwordUser"]);
if (isset($_SESSION['admin'])) {
	unset($_SESSION['admin']);
}
header("Location: index.php?id=1");
?>