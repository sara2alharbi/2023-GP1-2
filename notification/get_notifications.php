<?php

// Start the session at the beginning of the script
session_start();

$mysqli = new mysqli("localhost", "u169182990_elmam", "E123l123", "u169182990_elmam");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$user_email = $_SESSION['email'];
// Clear all entries from the deleted_notifications table
$clearDeletedNotificationsQuery = "DELETE FROM deleted_notifications WHERE user_email = ?";
$clearDeletedNotificationsStmt = $mysqli->prepare($clearDeletedNotificationsQuery);
$clearDeletedNotificationsStmt->bind_param("s", $user_email);
$clearDeletedNotificationsStmt->execute();
$clearDeletedNotificationsStmt->close();

date_default_timezone_set('Asia/Riyadh');

// Calculate the current minute
$currentMinute = date('i');

$idList = implode(',', $temperatureIds); // Convert the array to a comma-separated string
$airIdList = implode(',', $airIds); // Convert the array to a comma-separated string
$currentDate = (string) date('Y-m-d');
$currentTime = (string) date('H:i:s');

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

    $room = ($ID == "ESP12F") ? "G9" : "G35";

    $temperature_alerts[] = [
        'type' => 'temperature',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'temperature' => $temperature,
        'temperature_id' => $temperature_id,
    ];
}

$temperatureToDelete = [0];
$selectedData = [];
$lastMinute = null;

foreach ($temperature_alerts as $row) {
    $timeParts = explode(":", $row["time"]);
    $minute = isset($timeParts[1]) ? (int) $timeParts[1] : null;

    if ($minute !== $lastMinute) {
        $selectedData[] = $row;
        $lastMinute = $minute;
    } else {
        $temperatureToDelete[] = $row['temperature_id'];
    }
}

$temperature_alerts = $selectedData;
$all_alerts['temperature_alerts'] = $temperature_alerts;

$queryAirQuality = "SELECT * FROM airquality WHERE Date_today = '$currentDate' 
                           AND airquality = 0 
                           AND id NOT IN ($airIdList)
                              AND Time_Today BETWEEN '$windowStart' AND '$windowEnd'";

$resultAirQuality = $mysqli->query($queryAirQuality);

if ($resultAirQuality === false) {
    die("Error: " . $mysqli->error);
}

while ($row = $resultAirQuality->fetch_assoc()) {
    $date = $row['Date_today'];
    $time = $row['Time_today'];
    $air_id = $row['id'];
    $ID = $row['microID'];

    $room = ($ID == "ESP12F") ? "G9" : "G35";

    $air_alerts[] = [
        'type' => 'air_quality',
        'date' => $date,
        'time' => $time,
        'room' => $room,
        'air_id' => $air_id,
    ];
}

$airToDelete = [0];
$selectedData = [];
$lastMinute = null;

foreach ($air_alerts as $row) {
    $timeParts = explode(":", $row["time"]);
    $minute = isset($timeParts[1]) ? (int) $timeParts[1] : null;

    if ($minute !== $lastMinute) {
        $selectedData[] = $row;
        $lastMinute = $minute;
    } else {
        $airToDelete[] = $row['air_id'];
    }
}

$air_alerts = $selectedData;

foreach ($temperature_alerts as $tempAlert) {
    $tempTime = $tempAlert['time'];
    $time = strtotime($tempTime);
    $tempTimeWithoutSeconds = date("H:i", $time);

    $matched = false;

    foreach ($air_alerts as $key => $airAlert) {
        $airTime = $airAlert['time'];
        $time2 = strtotime($airTime);
        $airTimeWithoutSeconds = date("H:i", $time2);

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

    if (!$matched) {
        $remainingTemperatureAlerts[] = $tempAlert;
    }
}

$all_alerts['temperature_alerts'] = isset($remainingTemperatureAlerts) ? $remainingTemperatureAlerts : [];
$remainingAirAlerts = array_values($air_alerts) !== null ? array_values($air_alerts) : [];

$all_alerts['mix'] = $mix_alerts;
$all_alerts['air_alerts'] = $remainingAirAlerts;

$result = [];
$lastTimestamp = null;

foreach ($all_alerts['temperature_alerts'] as $entry) {
    $currentTimestamp = strtotime($entry['date'] . ' ' . $entry['time']);

    if ($lastTimestamp === null || $currentTimestamp - $lastTimestamp >= 300) {
        $result[] = $entry;
        $lastTimestamp = $currentTimestamp;
    } else {
        $temperatureToDelete[] = $entry['temperature_id'];
    }
}

$IdList = implode(',', $temperatureToDelete);

$queryDelete = "DELETE FROM temperature WHERE id IN ($IdList)";
$mysqli->query($queryDelete);
$all_alerts['temperature_alerts'] = $result;

$result = [];
$lastTimestamp = null;

foreach ($all_alerts['air_alerts'] as $entry) {
    $currentTimestamp = strtotime($entry['date'] . ' ' . $entry['time']);

    if ($lastTimestamp === null || $currentTimestamp - $lastTimestamp >= 300) {
        $result[] = $entry;
        $lastTimestamp = $currentTimestamp;
    } else {
        $airToDelete[] = $entry['air_id'];
    }
}

$IdList = implode(',', $airToDelete);

$queryDelete = "DELETE FROM airquality WHERE id IN ($IdList)";
$mysqli->query($queryDelete);

$all_alerts['air_alerts'] = $result;

$result = [];
$lastTimestamp = null;

foreach ($all_alerts['mix'] as $entry) {
    $currentTimestamp = strtotime($entry['date'] . ' ' . $entry['time']);

    if ($lastTimestamp === null || $currentTimestamp - $lastTimestamp >= 300) {
        $result[] = $entry;
        $lastTimestamp = $currentTimestamp;
    }
}
$all_alerts['mix'] = $result;

$individualAlerts = [];

foreach ($all_alerts as $key => $alerts) {
    $individualAlerts = array_merge($individualAlerts, $alerts);
}

// Add a timestamp field to each notification entry
foreach ($individualAlerts as &$alert) {
    $alert['timestamp'] = strtotime($alert['date'] . ' ' . $alert['time']);
}

// Sort the alerts based on the timestamp in descending order
usort($individualAlerts, function ($a, $b) {
    return $b['timestamp'] - $a['timestamp'];
});

// Send JSON response
header('Content-Type: application/json');
echo json_encode($individualAlerts);
?>
