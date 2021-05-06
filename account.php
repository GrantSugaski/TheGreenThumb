<html>
	<head>
		<title>Account - The Green Thumb</title>
		<link rel="stylesheet" type="text/css" href="styles/common.css">
	</head>
	<body>
		<?php include("navbar.php"); ?>

		<form class="account-form" action="controller/accountController.php" method="post">
			<label for="email">Email</label>
			<input type="email" name="email" placeholder="Email"/>
			
			<label for="password">Password</label>
			<input type="password" name="password" placeholder="Password"/>
			
			<label for="firstName">First Name</label>
			<input type="text" name="firstName" placeholder="First Name"/>

			<label for="lastName">Last Name</label>
			<input type="text" name="lastName" placeholder="Last Name"/>

			<label for="address1">Address 1</label>
			<input type="text" name="address1" placeholder="Address 1" />
			
			<label for="address2">Address 2</label>
			<input type="text" name="address2" placeholder="Address 2" />

			<label for="county">County</label>
			<input type="text" name="county" placeholder="County" />

			<label for="state">State</label>
			<input type="text" name="state" placeholder="State" />

			<label for="zipcode">Zip Code</label>
			<input type="text" name="zipcode" placeholder="Zip Code" />

			<button type="submit" name="request" value="Update">Update Account</button>
		</form>
	</body>
</html>
