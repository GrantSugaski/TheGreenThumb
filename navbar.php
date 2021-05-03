<div class="navbar">
	<a href="./index.php">The Green Thumb</a>
	
	<?php
		if (isset($_SESSION["USER_AUTH"])) {
			if ($_SESSION["USER_PERMISISON"] == "Customer") {
				echo '<a href="./customer/home.php">Home</a>';
			} else if ($_SESSION["USER_PERMISSION"] == "Farmer") {
				echo '<a href="./farmer/home.php">Home</a>';
			}			

			echo '<a href="./account.php">Account</a>';
		} else {
			echo '<a href="./login.php">Login</a>';
		}
	?>
</div>
