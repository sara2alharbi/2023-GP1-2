<?php
$mysqli = new mysqli("localhost", "u169182990_elmam", "E123l123", "u169182990_elmam");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $time = $_POST["time"];
    $date = $_POST["date"];
    $room = $_POST["room"];
    $notification = $_POST["notification"];

    // Check if an alert with the same time and date already exists
    $checkStmt = $mysqli->prepare("SELECT COUNT(*) FROM alerts WHERE time = ? AND date = ?");
    $checkStmt->bind_param("ss", $time, $date);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        echo "Alert with the same time and date already exists. Not storing duplicate.";
    } else {
        // If no alert with the same time and date, insert the new alert
        $insertStmt = $mysqli->prepare("INSERT INTO alerts (time, date, room, notification) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssss", $time, $date, $room, $notification);

        if ($insertStmt->execute()) {
            echo "Alert stored successfully.";
        } else {
            echo "Error storing alert: " . $insertStmt->error;
        }

        $insertStmt->close();
    }
}

$mysqli->close();
?>
