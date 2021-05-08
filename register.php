<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="styles/common.css">
	</head>
	<body>
		<?php include("navbar.php"); ?>

		<form class="form register-form" action="controller/registerController.php" method="post">
			<label for="email">Email</label>
			<input type="email" name="email" placeholder="Email" required/>
			
			<label for="password">Password</label>
			<input type="password" name="password" placeholder="Password" required/>
			
			<label for="firstName">First Name</label>
			<input type="text" name="firstName" placeholder="First Name" required/>

			<label for="lastName">Last Name</label>
			<input type="text" name="lastName" placeholder="Last Name" required/>

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

			<label for="role">Account Role</label>
			<select name="role">
				<option value="Customer">Customer</option>
				<option value="Producer">Producer</option>
			</select>

			<button type="submit" name="request" value="Register">Register</button>
		</form>
	</body>
</html>
