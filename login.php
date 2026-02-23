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

		<?php
			$conn = new mysqli("localhost","root","","SocialMediaDB");
			$message  = "";
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$username = $_POST["username"];
				$password = $_POST["password"];

				$sql = "select * from Users where username = '$username' and password = '$password'";
				
				$result = $conn->query($sql);

				if($result->num_rows>0){
					$message = "Login Successfull"
				}
				else{
					$message = "Login not Successfull"
				}
			}
		?>

		<p style = "color:red">
			<?php echo $message; ?>
		</p>
	</body>

</html>