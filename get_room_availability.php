<?php
include 'DB.php';
date_default_timezone_set('Asia/Riyadh');

// Get the current time and day
$currentTime = date("H:i");
$currentDay = strftime('%A'); // Get the current day name in Arabic

// Initialize room availability
$roomAvailability = [
    "G9" => "متاحة",
    "G35" => "متاحة"
];

// Query to check if there's a lecture in progress for G9
$sqlG9 = "SELECT * FROM lecture
          WHERE RoomNo = 'G9'
          AND Day = '$currentDay'
          AND StartTime <= '$currentTime'
          AND EndTime >= '$currentTime'";

$resultG9 = mysqli_query($conn, $sqlG9);

if (!$resultG9) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($resultG9) > 0) {
    $roomAvailability["G9"] = "محجوزة";
}

// Query to check if there's a lecture in progress for G35
$sqlG35 = "SELECT * FROM lecture
           WHERE RoomNo = 'G35'
           AND Day = '$currentDay'
           AND StartTime <= '$currentTime'
           AND EndTime >= '$currentTime'";

$resultG35 = mysqli_query($conn, $sqlG35);

if (!$resultG35) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($resultG35) > 0) {
    $roomAvailability["G35"] = "محجوزة";
}

// Check noise data and update room availability
foreach ($roomAvailability as $room => $status) {
    $microId = ($room == "G9") ? "ESP12F" : "ESP12E";

    $sqlNoise = "SELECT * FROM noise
                 WHERE MicroID = '$microId'
                 ORDER BY Time_today DESC
                 LIMIT 1";

    $resultNoise = mysqli_query($conn, $sqlNoise);

    if (!$resultNoise) {
        die("Query failed: " . mysqli_error($conn));
    }


        $row = mysqli_fetch_assoc($resultNoise);
        $noiseLevel = $row['noise'];

        // Check if the noise level is above 25
        $availabilityStatus = ($noiseLevel > 25) ? "غير متاحة" : "متاحة";
    

    echo "<tr><td>$room</td><td>$status</td><td>$availabilityStatus</td></tr>";
}
?>
