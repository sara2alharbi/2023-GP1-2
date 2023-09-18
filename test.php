<!DOCTYPE html>
<html>
<head>
    <title>جدول التنبيهات</title>
    <meta http-equiv="refresh" content="5"> <!-- Refresh the page every 5 seconds -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #76C893;
            font-family: 'Droid Arabic Naskh', Arial, sans-serif;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr.alert {
            background-color: red;
            color: white;
        }

        tr.green {
            background-color: #D9ED92;
        }
    </style>
</head>
<body>

<table border="1">
    <tr>
        <th>رسالة التنبيه</th>
        <th>رقم الغرفة</th>
        <th>وقت التنبيه</th>
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


    date_default_timezone_set('Asia/Riyadh');
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
        echo "<td colspan = '2'>لا يوجد اشعارات</td>";
        echo "<td>$currentTime</td>";
        echo "</tr>";
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
</table>

<a class="nav-link nav-icon" href="#" data-bs-toggle="popover" data-bs-trigger="click" data-bs-content="No alerts">
    <i class="bi bi-bell"></i>
    <span id="alert-badge" class="badge bg-primary badge-number">0</span>
</a>

<script>
    // JavaScript code to update the bell icon badge and display alerts
    document.addEventListener("DOMContentLoaded", function () {
        // Simulate fetching the number of alerts (replace with actual code)
        var numberOfAlerts = 0; // Replace this with the actual number of alerts

        // Update the badge with the number of alerts
        var badge = document.getElementById("alert-badge");
        badge.textContent = numberOfAlerts;

        // Set the alert message based on conditions
        var alertMessage = "";
        if (numberOfAlerts > 0) {
            if (numberOfAlerts === 1) {
                alertMessage = "درجة الحرارة مرتفعة و جودة الهواء منخفضة";
            } else {
                alertMessage = "يوجد " + numberOfAlerts + " تنبيهات";
            }
            // Display the alert message as a popover
            var bellIcon = document.querySelector(".nav-icon");
            bellIcon.setAttribute("data-bs-content", alertMessage);
            $(bellIcon).popover("show"); // Show the popover
        }
    });
</script>

</body>
</html>
