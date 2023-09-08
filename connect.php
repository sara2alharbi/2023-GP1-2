<html>
<body>

<?php

$dbname = 'elmam';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";

$temperature = $_GET["temperature"];
$humidity = $_GET["humidity"];
$microID = $_GET["microID"];


$queryt = "INSERT INTO temperature (temperature, humidity , microID) VALUES ('$temperature', '$humidity' ,'$microID')";
$result1 = mysqli_query($connect,$queryt);

$noise = $_GET["noise"];
$queryn = "INSERT INTO noise (noise , microID) VALUES ('$noise','$microID')";
$result2 = mysqli_query($connect,$queryn);

$airquality = $_GET["airquality"];
$querya = "INSERT INTO airquality (airquality , microID) VALUES ('$airquality','$microID')";
$result3 = mysqli_query($connect,$querya);

echo "Insertion Success!<br>";

// Calculate the date 7 days ago from the current date
$sevenDaysAgo = date("Y-m-d H:i:s", strtotime('-7 days'));

// Delete rows older than 7 days based on the Date_today column in temperature table
$deleteTemperatureQuery = "DELETE FROM temperature WHERE Date_today < '$sevenDaysAgo'";
$resultDeleteTemperature = mysqli_query($connect, $deleteTemperatureQuery);

// Delete rows older than 7 days based on the Date_today column in noise table
$deleteNoiseQuery = "DELETE FROM noise WHERE Date_today < '$sevenDaysAgo'";
$resultDeleteNoise = mysqli_query($connect, $deleteNoiseQuery);

// Delete rows older than 7 days based on the Date_today column in airquality table
$deleteAirQualityQuery = "DELETE FROM airquality WHERE Date_today < '$sevenDaysAgo'";
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