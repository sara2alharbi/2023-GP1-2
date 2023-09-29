<?php
$mysqli = new mysqli("localhost", "root", "", "elmam");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Calculate the current minute
$currentMinute = date('i');

$queryTemperature = "SELECT * FROM temperature WHERE Date_today = ? AND Time_today <= ? AND temperature > 25";
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

$queryAirQuality = "SELECT * FROM airquality WHERE Date_today = ? AND Time_today <= ? AND airquality = 0";
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
    $temperatureAlerts[] = "Alert: High temperature detected ($temperature °C) at $date $time in $room";
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
    $airQualityAlerts[] = "Alert: Low air quality detected at $date $time in $room";
}

$stmtTemperature->close();
$stmtAirQuality->close();
$mysqli->close();

// Output the alerts as an HTML list
echo "<ul>";

if (!empty($temperatureAlerts) && !empty($airQualityAlerts)) {
    echo "<li class='notification-item'>
    <i class='bi bi-exclamation-circle text-warning'></i>
    <div>
      <h4>جودة الهواء منخفضة و درجة الحرارة مرتفعة </h4>
      <p>التاريخ $date</p>
      <p>الوقت $time</p>
      <p> في الغرفة رقم $room</p>
    </div></li>
    <button class='remove-btn' onclick='removeNotification(this)'>حذف</button>
    <li>
    <hr class='dropdown-divider'>
    </li>";
} 

elseif (!empty($temperatureAlerts)) {
    echo "<li class='notification-item'>
    <i class='bi bi-exclamation-circle text-warning'></i>
    <div>
      <h4>درجة الحرارة مرتفعة </h4>
      <p>التاريخ $date</p>
      <p>الوقت $time</p>
      <p> في الغرفة رقم $room</p>
    </div></li>
    <button class='remove-btn' onclick='removeNotification(this)'>حذف</button>
    <li>
    <hr class='dropdown-divider'>
    </li>";
} 

elseif (!empty($airQualityAlerts)) {
    echo "<li class='notification-item'>
    <i class='bi bi-exclamation-circle text-warning'></i>
    <div>
      <h4 >جودة الهواء منخفضة </h4>
      <p>التاريخ $date</p>
      <p>الوقت $time</p>
      <p> في الغرفة رقم $room</p>
    </div></li>
    <button class='remove-btn' onclick='removeNotification(this)'>حذف</button>
    <li>
    <hr class='dropdown-divider'>
    </li>";} 

else {
    echo "<li>لا يوجد تنبيهات<br>
    <button class='remove-btn' onclick='removeNotification(this)'>حذف</button></li>";
}

echo "</ul>";
?>
