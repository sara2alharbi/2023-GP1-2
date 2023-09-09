<!DOCTYPE html>
<html>
<head>
    <title>Alerts Table</title>
</head>
<body>

<table border="1">
    <tr>
        <th>Temperature</th>
        <th>Humidity</th>
        <th>Noise</th>
        <th>Air Quality</th>
        <th>Time</th>
        <th>Room Number</th>
    </tr>
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

    while ($row = mysqli_fetch_assoc($result)) {
        $temperature = $row['temperature'];
        $humidity = $row['humidity'];
        $noise = $row['noise'];
        $airquality = $row['airquality'];
        $microID = $row['microID'];
        $time_today = $row['Time_today'];

        // Determine the room number based on microID
        $roomNumber = ($microID == "ESP12E") ? "G35" : (($microID == "ESP12F") ? "G9" : "");

        // Define row style based on conditions
        $rowStyle = '';
        if ($airquality == 0 || $temperature > 35) {
            $rowStyle = 'background-color: lightcoral;';
        }

        // Display data in the table
        echo "<tr style='$rowStyle'>";
        echo "<td>$temperature</td>";
        echo "<td>$humidity</td>";
        echo "<td>$noise</td>";
        echo "<td>$airquality</td>";
        echo "<td>$time_today</td>";
        echo "<td>$roomNumber</td>";
        echo "</tr>";
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
</table>

</body>
</html>
