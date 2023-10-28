                     <?php 
            include 'DB.php';
            date_default_timezone_set('Asia/Riyadh');
//checking for the avilable if the room avilable based on the scehdule or no
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

                    if (mysqli_num_rows($resultG35) > 0) {
                        $roomAvailability["G35"] = "محجوزة";
                    }

                    // Display the room availability
                    foreach ($roomAvailability as $room => $status) {
                        echo "<tr><td>$room</td><td>$status</td><td></td></tr>";
                    }

               
                    ?>
