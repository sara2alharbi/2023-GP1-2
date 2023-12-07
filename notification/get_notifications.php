<?php
$mysqli = new mysqli("localhost", "u169182990_elmam", "E123l123", "u169182990_elmam");

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
    $temperatureIds = [];
    $airIds = [];
    $temperatureIds[] = 0;
    $airIds[] = 0;
    while ($row = $result->fetch_assoc()) {
        $temperatureIds[] = $row['temperature_id'];
        $airIds[] = $row['airquality_id'];
    }

    $stmt->close();
}

date_default_timezone_set('Asia/Riyadh');

// Calculate the current minute
$currentMinute = date('i');

$idList = implode(',', $temperatureIds); // Convert the array to a comma-separated string
$airIdList = implode(',', $airIds); // Convert the array to a comma-separated string
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

$windowStart = date('H:i:s', strtotime("$currentTime -60 minutes"));
$windowEnd = $currentTime;

$queryTemperature = "SELECT * FROM temperature WHERE Date_today = '$currentDate'
                            AND temperature > 25
                            AND id NOT IN ($idList)
                                AND Time_Today BETWEEN '$windowStart' AND '$windowEnd'";
$resultTemperature = $mysqli->query($queryTemperature);

if ($resultTemperature === false) {
    die("Error: " . $mysqli->error);
}

$temperature_alerts = [];

while ($row = $resultTemperature->fetch_assoc()) {
    $date = $row['Date_today'];
    $time = $row['Time_today'];
    $temperature = $row['temperature'];
    $temperature_id = $row['id'];
    $ID = $row['microID'];

    if ($ID == "ESP12F") {
        $room = "G9";
    } else {
        $room = "G35";
    }

    $temperature_alerts[] = [
        'type' => 'temperature',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'temperature' => $temperature,
        'temperature_id' => $temperature_id
    ];
}

$airToDelete = [];
$selectedData = []; // Array to store the selected data
$lastMinute = null; // Variable to track the last selected minute

foreach ($temperature_alerts as $row) {
    $timeParts = explode(":", $row["time"]);
    $minute = isset($timeParts[1]) ? (int)$timeParts[1] : null;

    if ($minute !== $lastMinute) {
        $selectedData[] = $row;
        $lastMinute = $minute;
    } else {
        $airToDelete[] = $row['temperature_id'];
    }
}

$temperature_alerts = $selectedData;

$queryAirQuality = "SELECT * FROM airquality WHERE Date_today = '$currentDate' 
                           AND airquality = 0 
                           AND id NOT IN ($airIdList)
                              AND Time_Today BETWEEN '$windowStart' AND '$windowEnd'";

$resultAirQuality = $mysqli->query($queryAirQuality);

if ($resultAirQuality === false) {
    die("Error: " . $mysqli->error);
}

$air_alerts = [];

while ($row = $resultAirQuality->fetch_assoc()) {
    $date = $row['Date_today'];
    $time = $row['Time_today'];
    $air_id = $row['id'];
    $ID = $row['microID'];

    if ($ID == "ESP12F") {
        $room = "G9";
    } else {
        $room = "G35";
    }

    // Store the air quality alert message in an array
    $air_alerts[] = [
        'type' => 'air_quality',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'air_id' => $air_id
    ];
}

$airToDelete = [];
$selectedData = []; // Array to store the selected data
$lastMinute = null; // Variable to track the last selected minute

foreach ($air_alerts as $row) {
    $timeParts = explode(":", $row["time"]);
    $minute = isset($timeParts[1]) ? (int)$timeParts[1] : null;

    if ($minute !== $lastMinute) {
        $selectedData[] = $row;
        $lastMinute = $minute;
    } else {
        $airToDelete[] = $row['air_id'];
    }
}
$air_alerts = $selectedData;

$mix_alerts = [];

foreach ($temperature_alerts as $tempAlert) {
    $tempTime = $tempAlert['time'];
    $time = strtotime($tempTime);
    $tempTimeWithoutSeconds = date("H:i", $time);

    // Initialize a flag to keep track of whether a match was found
    $matched = false;

    // Loop through the air alerts
    foreach ($air_alerts as $key => $airAlert) {
        $airTime = $airAlert['time'];
        $time2 = strtotime($airTime);
        $airTimeWithoutSeconds = date("H:i", $time2);

        // Compare the time
        if ($tempTimeWithoutSeconds === $airTimeWithoutSeconds) {
            if ($airAlert['room'] !== $tempAlert['room']) {
                return;
            }
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
$temperature_alerts = isset($remainingTemperatureAlerts) ? $remainingTemperatureAlerts : [];

$all_alerts = [];

foreach ($temperature_alerts as $entry) {
    $all_alerts[] = $entry;
}

foreach ($air_alerts as $entry) {
    $all_alerts[] = $entry;
}

foreach ($mix_alerts as $entry) {
    $all_alerts[] = $entry;
}

$outputArray = [];

// Filter out duplicate alerts based on timestamp and type
$uniqueAlerts = [];
foreach ($all_alerts as $alert) {
    $key = $alert['type'] . '-' . $alert['date'] . ' ' . $alert['time'] . '-' . $alert['room'];
    if (!isset($uniqueAlerts[$key])) {
        $uniqueAlerts[$key] = $alert;
        $outputArray[] = $alert;
    }
}

// Sort the array using the custom comparison function
usort($outputArray, 'compareByTimeDesc');

// Insert new notifications into the table
foreach ($outputArray as $alert) {
    $timestamp = $alert['date'] . ' ' . $alert['time'];
    $message = getMessageFromAlert($alert);
    $roomNumber = $alert['room'];

    $insertQuery = "INSERT INTO previous_notifications (timestamp, message, room_number) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($insertQuery);
    $stmt->bind_param("sss", $timestamp, $message, $roomNumber);
    $stmt->execute();
    $stmt->close();
}

function getMessageFromAlert($alert)
{
    // Your custom logic to generate a message based on the alert type
    $type = $alert['type'];
    $room = $alert['room'];
    $timestamp = $alert['date'] . ' ' . $alert['time'];

    // Initialize the temperature variable
    $temperature = isset($alert['temperature']) ? $alert['temperature'] : null;

    switch ($type) {
        case 'temperature':
            return "درجة الحرارة مرتفعة";
        case 'air_quality':
            return "جودة الهواء منخفضة";
        case 'combined':
            return "درجة الحرارة مرتفعة و جودة الهواء منخفضة";
        // Add more cases if you have other alert types
        default:
            return "لم يحدد";
    }
}

header('Content-Type: application/json');
echo json_encode($outputArray);
?>
