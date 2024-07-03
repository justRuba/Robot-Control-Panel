<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "robot_control";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT direction FROM movement ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$last_direction = "";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_direction = $row['direction'];
} else {
    $last_direction = "No data";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Last Movement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            margin: 0;
        }
        .container {
            margin-top: 50px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Last Movement Direction</h1>
    <div class="container">
        <h2><?php echo $last_direction; ?></h2>
        <a href="index.php">Go Back</a>
    </div>
</body>
</html>
>
