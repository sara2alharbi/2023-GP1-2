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
    $temperatureIds[]=0;
    $airIds[]=0;
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
$currentDate =(string) date('Y-m-d');
$currentTime =(string) date('H:i:s');



$queryTemperature = "SELECT * FROM temperature WHERE Date_today = '$currentDate' AND Time_today >= '$currentTime' AND temperature > 25 AND id NOT IN ($idList)";
// Store the values in variables and pass them by reference to bind_param
date_default_timezone_set('Asia/Riyadh');



/*echo "Time ". $currentTime;
echo "\n";
echo "Date ". $currentDate;
echo "\n";*/


$resultTemperature = $mysqli->query($queryTemperature);;

if ($resultTemperature === false) {
    die("Error: " . $mysqli->error);
}
//echo json_encode($resultTemperature);

$queryAirQuality =
    "SELECT * FROM airquality WHERE Date_today = '$currentDate' AND Time_today >= '$currentTime' AND airquality = 0  AND id NOT IN ($airIdList)";

$resultAirQuality = $mysqli->query($queryAirQuality);;

if ($resultTemperature === false) {
    die("Error: " . $mysqli->error);
}

if ($resultAirQuality === false) {
    die("Error: " . $mysqli->error);
}


$temperatureAlerts = [];
$airQualityAlerts = [];

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

    // Store the temperature alert message in an array
    $temperatureAlerts[] = [
        'type' => 'temperature',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'temperature' => $temperature,
        'temperature_id' => $temperature_id,

    ];
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
    $airQualityAlerts[] = [
        'type' => 'air_quality',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'air_id' => $air_id,

    ];
}

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
        'temperature_id' => $temperature_id,
        'air_id' => $air_id,
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
