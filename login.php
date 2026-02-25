<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>


	<body>
		<h2>Enter User and Pass</h2>

		<form method = "POST">
			Username: <input type = "text" name = "username" required><br><br>
			Password: <input type = "text" name = "password" required><br><br>
			<button type = "submit">Login</button>
		</form>

		<?php
			$conn = new mysqli("localhost", "root","", "SocialMediaDB");
			$message  = "";

			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$username = $_POST["username"];
				$password = $_POST["password"];

				$sql = "select password from Users where username = '$username'";
				$result = $conn->query($sql);
    
				if (!$result) {
					$message = "Database error: " . $conn->error;
				}
				elseif($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$stored_hash = $row['password'];
        
					if(password_verify($password, $stored_hash)) {
						$message = "Login Successful";
					} else {
						$message = "Wrong password";
					}
				} else {
					$message = "User not found";
				}
			}
		?>

		<p style = "color:red">
			<?php echo $message; ?>
		</p>
	</body>

</html>
