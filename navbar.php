<?php session_start(); ?>

<div class="navbar">
	<a href="index.php">The Green Thumb</a>
	
	<?php
		if (isset($_SESSION["AUTH_TOKEN"])) {
			echo '<a href="home.php">Home</a>';
			echo '<a href="account.php">Account</a>';
			echo '<a href="logout.php">Logout</a>';
		} else {
			echo '<a href="login.php">Login</a>';
			echo '<a href="register.php">Register</a>';
		}
	?>
</div>

<?php 

if (isset($_SESSION['SESSION_INFO'])) {
	echo '<div class="info-msg">'.$_SESSION['SESSION_INFO'].'</div>';
	unset($_SESSION['SESSION_INFO']);
}

if (isset($_SESSION['SESSION_ERROR'])) {
	echo '<div class="error-msg">'.$_SESSION['SESSION_ERROR'].'</div>';
	unset($_SESSION['SESSION_ERROR']);
}

?>
