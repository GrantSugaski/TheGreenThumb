<?php

session_start();

if (isset($_SESSION['AUTH_TOKEN'])) {
	header("Location: home.php");
} else {
	header("Location: login.php");
}

?>
