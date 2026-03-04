<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>

	<?php
		$bodyColor = "white";
	?>


	<body style="background-color: <?php echo $bodyColor; ?>;">
		<h2 style = "color:blue">Enter User and Pass</h2>

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


//function to hash all unhashed data in the database, filtering unhashed data as that which is less than 40 characters
$sql = "select username, password from Users where password not like '\$2y\$%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newHash = password_hash($row["password"], PASSWORD_DEFAULT);
        $usame = $row["username"];
        $conn->query("update Users set password = '$newHash' where username = '$usame'");
    }
} else {
    echo "";
}

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
