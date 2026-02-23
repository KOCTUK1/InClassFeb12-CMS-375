<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<h2>Enter User and Pass</h2>

		<form method = "POST">
			Username: <input type = "text" name = "username" required><br><br>
			Password: <input type = "text" name = "password" required><br><br>\
			<button type = "submit">Login</button>
		</form>
		<p style = "color:red">
			<?php echo $message; ?>
		</p>
	</body>
</html>