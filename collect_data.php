<html>
<body>

<?php

$dbname = 'collect_data';
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


?>
</body>
</html>