<?php
$mysqli = new mysqli("localhost", "your_username", "your_password", "your_database");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Function to fetch previous notifications from the database
function fetchPreviousNotifications($mysqli)
{
    $query = "SELECT * FROM previous_notifications ORDER BY timestamp DESC";
    $result = $mysqli->query($query);

    if ($result === false) {
        die("Error: " . $mysqli->error);
    }

    $notifications = [];
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    return $notifications;
}

// Function to display the table
function displayTable($notifications)
{
    echo '<table border="1">';
    echo '<tr><th>Time</th><th>Message</th><th>Room Number</th></tr>';

    foreach ($notifications as $notification) {
        echo '<tr>';
        echo '<td>' . $notification['timestamp'] . '</td>';
        echo '<td>' . $notification['message'] . '</td>';
        echo '<td>' . $notification['room_number'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}

// Fetch and display previous notifications
$previousNotifications = fetchPreviousNotifications($mysqli);
displayTable($previousNotifications);

// Close the database connection
$mysqli->close();
?>
