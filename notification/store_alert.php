<?php
$mysqli = new mysqli("localhost", "u169182990_elmam", "E123l123", "u169182990_elmam");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Assuming you have a table named 'alerts' with columns: id, time, date, room, notification
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $time = $_POST["time"];
    $date = $_POST["date"];
    $room = $_POST["room"];
    $notification = $_POST["notification"];

    $stmt = $mysqli->prepare("INSERT INTO alerts (time, date, room, notification) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $time, $date, $room, $notification);

    if ($stmt->execute()) {
        echo "Alert stored successfully.";
    } else {
        echo "Error storing alert: " . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
