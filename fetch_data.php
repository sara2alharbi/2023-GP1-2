<?php
$dbname = 'elmam';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$connect = @mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connect) {
    echo "Error: " . mysqli_connect_error();
    exit();
}

// Get the current date
$currentDate = date("Y-m-d");

// Retrieve data from the database based on conditions
$sql = "SELECT t.temperature, t.humidity, t.microID, t.Date_today, TIME_FORMAT(t.Time_today, '%H:%i') AS Time_today,
               n.noise, a.airquality
        FROM temperature t
        LEFT JOIN noise n ON t.microID = n.microID AND t.Date_today = n.Date_today
        LEFT JOIN airquality a ON t.microID = a.microID AND t.Date_today = a.Date_today
        WHERE t.Date_today = '$currentDate'
        AND (a.airquality = 0 OR t.temperature > 35)";

$result = mysqli_query($connect, $sql);

$dataArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $dataArray[] = $row;
}

// Close the database connection
mysqli_close($connect);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($dataArray);
?>
