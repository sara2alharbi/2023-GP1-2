<?php
$mysqli = new mysqli("localhost", "root", "", "elmam");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Calculate the current minute
$currentMinute = date('i');

$queryTemperature = "SELECT * FROM temperature WHERE Date_today = ? AND Time_today >= ? AND temperature > 25";
$stmtTemperature = $mysqli->prepare($queryTemperature);

// Store the values in variables and pass them by reference to bind_param
date_default_timezone_set('Asia/Riyadh');
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

$stmtTemperature->bind_param("ss", $currentDate, $currentTime);
$stmtTemperature->execute();
$resultTemperature = $stmtTemperature->get_result();

if ($resultTemperature === false) {
    die("Error: " . $mysqli->error);
}

$queryAirQuality = "SELECT * FROM airquality WHERE Date_today = ? AND Time_today >= ? AND airquality = 0";
$stmtAirQuality = $mysqli->prepare($queryAirQuality);

$stmtAirQuality->bind_param("ss", $currentDate, $currentTime);
$stmtAirQuality->execute();
$resultAirQuality = $stmtAirQuality->get_result();

if ($resultAirQuality === false) {
    die("Error: " . $mysqli->error);
}

$temperatureAlerts = [];
$airQualityAlerts = [];

while ($row = $resultTemperature->fetch_assoc()) {
    $date = $row['Date_today'];
    $time = $row['Time_today'];
    $temperature = $row['temperature'];
    $ID = $row['microID'];

    if($ID == "ESP12F")
     $room = "G9";
    else
     $room = "G35";

    // Store the temperature alert message in an array
    $temperatureAlerts[] = [
        'type' => 'temperature',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'temperature' => $temperature,
    ];
}

while ($row = $resultAirQuality->fetch_assoc()) {
    $date = $row['Date_today'];
    $time = $row['Time_today'];
    $ID = $row['microID'];

    if($ID == "ESP12F")
        $room = "G9";
    else
        $room = "G35";

    // Store the air quality alert message in an array
    $airQualityAlerts[] = [
        'type' => 'air_quality',
        'date' => $date,
        'time' => $time,
        'room' => $room,
    ];
}

$stmtTemperature->close();
$stmtAirQuality->close();
$mysqli->close();

// Initialize an empty alert
$alert = [];

// Check if there are temperature alerts
if (!empty($temperatureAlerts) && !empty($airQualityAlerts)) {
    // Both temperature and air quality alerts are present, display combined alert
    $alert = [
        'type' => 'combined',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'temperature' => $temperature,
    ];
} elseif (!empty($temperatureAlerts)) {
    // If only temperature alerts, select it
    $alert = array_shift($temperatureAlerts);
} elseif (!empty($airQualityAlerts)) {
    // If only air quality alerts, select it
    $alert = array_shift($airQualityAlerts);
}

// Output the selected alert as JSON
header('Content-Type: application/json');
echo json_encode($alert);
?>
