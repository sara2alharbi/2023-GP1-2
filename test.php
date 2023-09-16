<!DOCTYPE html>
<html>
<head>
    <title>Alerts Table</title>
    <meta http-equiv="refresh" content="5"> <!-- Refresh the page every 5 seconds -->
</head>
<body>

<table border="1">
    <tr>
        <th>Alert Message</th>
        <th>Last Alert Time</th>
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

    // Get the current date and time
    $currentDate = date("Y-m-d");
    $currentTime = date("H:i:s");

    // Retrieve data from the database based on conditions
    $sql = "SELECT t.temperature, t.microID, t.Date_today, TIME_FORMAT(t.Time_today, '%H:%i') AS Time_today,
                   a.airquality
            FROM temperature t
            LEFT JOIN airquality a ON t.microID = a.microID AND t.Date_today = a.Date_today
            WHERE t.Date_today = '$currentDate'
            ORDER BY t.Date_today DESC, t.Time_today DESC
            LIMIT 1";

    $result = mysqli_query($connect, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $temperature = $row['temperature'];
        $airquality = $row['airquality'];
        $microID = $row['microID'];
        $alertTime = $row['Time_today'];

        // Determine the room number based on microID
        $roomNumber = ($microID == "ESP12E") ? "G35" : (($microID == "ESP12F") ? "G9" : "");

        // Define alert message based on conditions
        if ($airquality == 0 || $temperature > 30) {
            if ($airquality == 0 && $temperature > 30) {
                $alertMessage = "درجة الحرارة مرتفعة و جودة الهواء منخفضة";
            } elseif ($airquality == 0) {
                $alertMessage = "جودة الهواء منخفضة";
            } else {
                $alertMessage = "درجة الحرارة مرتفعة";
            }
            
            // Set the row style to red
            $rowStyle = 'background-color: red;';
        } else {
            $alertMessage = "لا يوجد اشعارات";
            
            // Set the row style to green
            $rowStyle = 'background-color: #D9ED92;';
        }

        // Display data in the table with the specified row style
        echo "<tr style='$rowStyle'>";
        echo "<td>$alertMessage</td>";
        echo "<td>$alertTime</td>";
        echo "<td>$roomNumber</td>";
        echo "</tr>";
    } else {
        // If no alerts are found, display "لا يوجد اشعارات" with a green row
        echo "<tr style='background-color: #D9ED92;'>";
        echo "<td>لا يوجد اشعارات</td>";
        echo "<td>$currentTime</td>";
        echo "<td></td>";
        echo "</tr>";
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
</table>

</body>
</html>
