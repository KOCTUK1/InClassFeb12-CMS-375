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

//function to get all of the tabes returned by queries for feb 25 bonus
//NATURAL JOIN
$dataResult = $conn->query("select * from Users natural join UserDetails");
	while ($dataRow = $dataResult->fetch_assoc()) {
		$natural[] = $dataRow;
	}

//INNER JOIN
$dataResult = $conn->query("select * from Users inner join UserDetails on Users.username = UserDetails.username");
	while ($dataRow = $dataResult->fetch_assoc()) {
		$inner[] = $dataRow;
	}

//LEFT JOIN
$dataResult = $conn->query("select * from Users left join UserDetails on Users.username = UserDetails.username");
	while ($dataRow = $dataResult->fetch_assoc()) {
		$left[] = $dataRow;
	}

//RIGHT JOIN
$dataResult = $conn->query("select * from Users right join UserDetails on Users.username = UserDetails.username");
	while ($dataRow = $dataResult->fetch_assoc()) {
		$right[] = $dataRow;
	}

//FULL JOIN
$dataResult = $conn->query("select * from Users left join UserDetails on Users.username = UserDetails.username union select * from Users right join UserDetails on Users.Username = UserDetails.Username");
	while ($dataRow = $dataResult->fetch_assoc()) {
		$full[] = $dataRow;
	}
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

<?php //function to show all of the tables returned by queries for feb 25 bonus ?>
<?php if (!empty($natural)): ?>
<?php echo "NATURAL JOIN" ?>
	<table border="1">
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th>Full Name</th>
		<th>Email</th>
		<th>City</th>
		<th>Created At</th>
	</tr>
	
	<?php foreach ($natural as $row): ?>
	<tr>
		<td><?php echo htmlspecialchars($row["username"]); ?></td>
		<td><?php echo htmlspecialchars($row["password"]); ?></td>
		<td><?php echo htmlspecialchars($row["full_name"]); ?></td>
		<td><?php echo htmlspecialchars($row["email"]); ?></td>
		<td><?php echo htmlspecialchars($row["city"]); ?></td>
		<td><?php echo htmlspecialchars($row["created_at"]); ?></td>
		
	</tr>
	<?php endforeach; ?>

	</table>
<?php endif; ?>

<?php if (!empty($inner)): ?>
<?php echo "INNER JOIN" ?>
	<table border="1">
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th>Full Name</th>
		<th>Email</th>
		<th>City</th>
		<th>Created At</th>
	</tr>
	
	<?php foreach ($natural as $row): ?>
	<tr>
		<td><?php echo htmlspecialchars($row["username"]); ?></td>
		<td><?php echo htmlspecialchars($row["password"]); ?></td>
		<td><?php echo htmlspecialchars($row["full_name"]); ?></td>
		<td><?php echo htmlspecialchars($row["email"]); ?></td>
		<td><?php echo htmlspecialchars($row["city"]); ?></td>
		<td><?php echo htmlspecialchars($row["created_at"]); ?></td>
		
	</tr>
	<?php endforeach; ?>

	</table>
<?php endif; ?>

<?php if (!empty($left)): ?>
<?php echo "LEFT JOIN" ?>
	<table border="1">
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th>Full Name</th>
		<th>Email</th>
		<th>City</th>
		<th>Created At</th>
	</tr>
	
	<?php foreach ($natural as $row): ?>
	<tr>
		<td><?php echo htmlspecialchars($row["username"]); ?></td>
		<td><?php echo htmlspecialchars($row["password"]); ?></td>
		<td><?php echo htmlspecialchars($row["full_name"]); ?></td>
		<td><?php echo htmlspecialchars($row["email"]); ?></td>
		<td><?php echo htmlspecialchars($row["city"]); ?></td>
		<td><?php echo htmlspecialchars($row["created_at"]); ?></td>
		
	</tr>
	<?php endforeach; ?>

	</table>
<?php endif; ?>

<?php if (!empty($right)): ?>
<?php echo "RIGHT JOIN" ?>
	<table border="1">
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th>Full Name</th>
		<th>Email</th>
		<th>City</th>
		<th>Created At</th>
	</tr>
	
	<?php foreach ($natural as $row): ?>
	<tr>
		<td><?php echo htmlspecialchars($row["username"]); ?></td>
		<td><?php echo htmlspecialchars($row["password"]); ?></td>
		<td><?php echo htmlspecialchars($row["full_name"]); ?></td>
		<td><?php echo htmlspecialchars($row["email"]); ?></td>
		<td><?php echo htmlspecialchars($row["city"]); ?></td>
		<td><?php echo htmlspecialchars($row["created_at"]); ?></td>
		
	</tr>
	<?php endforeach; ?>

	</table>
<?php endif; ?>

<?php if (!empty($full)): ?>
<?php echo "FULL JOIN" ?>
	<table border="1">
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th>Full Name</th>
		<th>Email</th>
		<th>City</th>
		<th>Created At</th>
	</tr>
	
	<?php foreach ($natural as $row): ?>
	<tr>
		<td><?php echo htmlspecialchars($row["username"]); ?></td>
		<td><?php echo htmlspecialchars($row["password"]); ?></td>
		<td><?php echo htmlspecialchars($row["full_name"]); ?></td>
		<td><?php echo htmlspecialchars($row["email"]); ?></td>
		<td><?php echo htmlspecialchars($row["city"]); ?></td>
		<td><?php echo htmlspecialchars($row["created_at"]); ?></td>
		
	</tr>
	<?php endforeach; ?>

	</table>
<?php endif; ?>

	</body>

</html>
