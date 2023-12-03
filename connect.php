<html>
<body>
<!-- This page takes the sensor data from Arduino  and then sote it to the database -->
<?php

$connect = @mysqli_connect("localhost","u169182990_elmam",'E123l123',"u169182990_elmam");

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";

date_default_timezone_set('Asia/Riyadh');

$temperature = $_GET["temperature"];
$humidity = $_GET["humidity"];
$microID = $_GET["microID"];

$queryt = "INSERT INTO temperature (temperature, humidity , microID, Time_today) VALUES ('$temperature', '$humidity' ,'$microID',UTC_TIMESTAMP())";
$result1 = mysqli_query($connect,$queryt);

$noise = $_GET["noise"];
$queryn = "INSERT INTO noise (noise , microID, Time_today) VALUES ('$noise','$microID',UTC_TIMESTAMP())";
$result2 = mysqli_query($connect,$queryn);

$airquality = $_GET["airquality"];
$querya = "INSERT INTO airquality (airquality , microID, Time_today) VALUES ('$airquality','$microID',UTC_TIMESTAMP())";
$result3 = mysqli_query($connect,$querya);

echo "Insertion Success!<br>";

// Calculate the date 12 days ago from the current date
$twelveDaysAgo = date("Y-m-d H:i:s", strtotime('-12 days'));

// Delete rows older than 7 days based on the Date_today column in temperature table
$deleteTemperatureQuery = "DELETE FROM temperature WHERE Date_today < '$twelveDaysAgo'";
$resultDeleteTemperature = mysqli_query($connect, $deleteTemperatureQuery);

// Delete rows older than 7 days based on the Date_today column in noise table
$deleteNoiseQuery = "DELETE FROM noise WHERE Date_today < '$twelveDaysAgo'";
$resultDeleteNoise = mysqli_query($connect, $deleteNoiseQuery);

// Delete rows older than 7 days based on the Date_today column in airquality table
$deleteAirQualityQuery = "DELETE FROM airquality WHERE Date_today < '$twelveDaysAgo'";
$resultDeleteAirQuality = mysqli_query($connect, $deleteAirQualityQuery);

// Check if any of the deletions encountered errors
if (!$resultDeleteTemperature || !$resultDeleteNoise || !$resultDeleteAirQuality) {
    echo "Deletion Error: " . mysqli_error($connect);
} else {
    echo "Deletion Success!<br>";
}


?>
</body>
</html>