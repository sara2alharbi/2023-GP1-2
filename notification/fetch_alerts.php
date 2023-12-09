<?php
$mysqli = new mysqli("localhost", "u169182990_elmam", "E123l123", "u169182990_elmam");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT * FROM alerts WHERE date = CURDATE() ORDER BY time DESC";
$result = $mysqli->query($query);

$alerts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alerts[] = $row;
    }
}

echo json_encode($alerts);

$mysqli->close();
?>
