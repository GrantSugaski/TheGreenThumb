<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="styles/common.css">
	</head>
	<body>
		<?php include("navbar.php"); ?>

		<form class="login-form" action="authenticate.php" method="post">
			<input type="text" name="username" placeholder="User Name" required/>
			<input type="password" name="password" placeholder="Password" required/>
			<button type="submit">Login</button>
		</form>
	</body>
</html>
