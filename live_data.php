<?php
include "DB.php";

// This code for gitting live data to the manager

date_default_timezone_set('Asia/Riyadh');
$current_date = date("Y-m-d");

if (isset($_POST['submit'])) {
    $selectedRoom = $_POST['roomSelect'];
    $data = [];

    $sql = "SELECT * FROM temperature WHERE Date_today = '$current_date' AND microID = '$selectedRoom'";
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $data['viewTemp'] = $row['temperature'];
        $data['viewHum'] = $row['humidity'];
    }
    
    $sql1 = "SELECT * FROM noise WHERE Date_today = '$current_date' AND microID = '$selectedRoom'";
    $result1 = mysqli_query($conn, $sql1);
    
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $data['viewNoise'] = $row1['noise'];
    }
    
    $sql2 = "SELECT * FROM airquality WHERE Date_today = '$current_date' AND microID = '$selectedRoom'";
    $result2 = mysqli_query($conn, $sql2);
    
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $data['viewAir'] = $row2['airquality']; 
    }
    
    mysqli_close($conn);
    
    echo json_encode($data);
    
}
?>
