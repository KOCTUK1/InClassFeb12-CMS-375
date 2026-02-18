<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
</head>
<body>

<h2>Student Database Viewer</h2>

<form method="post">
    <button type="submit" name="showData">Show All Students</button>
</form>

<?php
if(isset($_POST['showData'])) {

    // Database connection
    $conn = new mysqli("localhost", "root", "", "OnlineCourseDB");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query
    $sql = "SELECT * FROM Students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "<table border='1'>";
        echo "<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Major</th>
              </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["student_id"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["major"]."</td>
                  </tr>";
        }

        echo "</table>";

    } else {
        echo "No records found.";
    }

    // while($row = $result->fetch_assoc()) {
    // print_r($row);
    // }
    $conn->close();
}
?>

</body>
</html>
