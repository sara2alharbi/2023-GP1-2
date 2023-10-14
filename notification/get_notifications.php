<?php
$mysqli = new mysqli("localhost", "root", "", "elmam");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
session_start();
$user_email = $_SESSION['email'];
$query = "SELECT * FROM deleted_notifications WHERE user_email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $user_email);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $temperatureIds = array();
    $airIds = array();
    $temperatureIds[] = 0;
    $airIds[] = 0;
    while ($row = $result->fetch_assoc()) {
        $temperatureIds[] = $row['temperature_id'];
        $airIds[] = $row['airquality_id'];
    }

    $stmt->close();
}

// Calculate the current minute
$currentMinute = date('i');

$idList = implode(',', $temperatureIds); // Convert the array to a comma-separated string
$airIdList = implode(',', $airIds); // Convert the array to a comma-separated string
$currentDate = (string)date('Y-m-d');
$currentTime = (string)date('H:i:s');


$queryTemperature = "SELECT * FROM temperature WHERE Date_today = '$currentDate' AND temperature > 25 AND id NOT IN ($idList)";
$resultTemperature = $mysqli->query($queryTemperature);

if ($resultTemperature === false) {
    die("Error: " . $mysqli->error);
}

$all_alerts = [];
$temperature_alerts = [];
$air_alerts = [];
$mix_alerts = [];
while ($row = $resultTemperature->fetch_assoc()) {
    $date = $row['Date_today'];
    $time = $row['Time_today'];
    $temperature = $row['temperature'];
    $temperature_id = $row['id'];
    $ID = $row['microID'];

    if ($ID == "ESP12F")
        $room = "G9";
    else
        $room = "G35";
    $temperature_alerts[] = [
        'type' => 'temperature',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'temperature' => $temperature,
        'temperature_id' => $temperature_id];
}
$all_alerts['temperature_alerts'] = $temperature_alerts;

$queryAirQuality =
    "SELECT * FROM airquality WHERE Date_today = '$currentDate'  AND airquality = 0  AND id NOT IN ($airIdList)";

$resultAirQuality = $mysqli->query($queryAirQuality);

if ($resultAirQuality === false) {
    die("Error: " . $mysqli->error);
}

while ($row = $resultAirQuality->fetch_assoc()) {
    $date = $row['Date_today'];
    $time = $row['Time_today'];
    $air_id = $row['id'];
    $ID = $row['microID'];

    if ($ID == "ESP12F")
        $room = "G9";
    else
        $room = "G35";

    // Store the air quality alert message in an array
    $air_alerts[] = [
        'type' => 'air_quality',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'air_id' => $air_id,

    ];

}
foreach ($temperature_alerts as $tempAlert) {
    $tempTime = $tempAlert['time'];

    // Initialize a flag to keep track of whether a match was found
    $matched = false;

    // Loop through the air alerts
    foreach ($air_alerts as $key => $airAlert) {
        $airTime = $airAlert['time'];

        // Compare the time values
        if ($tempTime === $airTime) {
            $airAlert['type'] = 'combined';
            $airAlert['temperature_id'] = $tempAlert['temperature_id'];
            $airAlert['temperature'] = $tempAlert['temperature'];
            $mix_alerts[] = $airAlert;
            unset($air_alerts[$key]);
            $matched = true;
        }
    }

    // If no match was found, keep the temperature alert
    if (!$matched) {
        $remainingTemperatureAlerts[] = $tempAlert;
    }
}

// Add the remaining temperature alerts to the result
$all_alerts['temperature_alerts'] = isset($remainingTemperatureAlerts) ? $remainingTemperatureAlerts : [];

// Use array_values to remove keys from the remaining air alerts
$remainingAirAlerts = array_values($air_alerts) !== null ? array_values($air_alerts) : [];


$all_alerts['mix'] = $mix_alerts;
$all_alerts['air_alerts'] = $remainingAirAlerts;

$individualAlerts = [];

// Loop through the input array and merge the alerts into the new array
foreach ($all_alerts as $key => $alerts) {
    $individualAlerts = array_merge($individualAlerts, $alerts);
}
$outputArray = $individualAlerts;


header('Content-Type: application/json');
echo json_encode($outputArray);

?>