<?php
include "DB.php";

$roomNo = $_POST['roomNo'];
$day = $_POST['day'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$semester = $_POST['semester'];

$sqlGetRoom = "SELECT * FROM room r WHERE r.roomNo = '$roomNo'";
$resultGetRoom = mysqli_query($conn, $sqlGetRoom);

if ($resultGetRoom) {
    $roomData = mysqli_fetch_assoc($resultGetRoom);
} else {
    // Handle the case where room retrieval failed
    http_response_code(500); // Set a 500 Internal Server Error status code
    echo "Error: " . mysqli_error($conn);
}

if (!empty($roomData)) {
    $sqlCheckAvailability = "SELECT 1 FROM lecture l
        WHERE l.roomNo = '$roomNo'
        AND l.day = '$day'
        AND l.semester = '$semester'
        AND l.startTime <= '$endDate'
        AND l.endTime >= '$startDate'";

    $resultCheckAvailability = mysqli_query($conn, $sqlCheckAvailability);

    if ($resultCheckAvailability && mysqli_num_rows($resultCheckAvailability) === 0) {

        header('Content-Type: application/json');
        $data = [];
        $data[] = $roomData;
        echo json_encode($data);
    } else {
        http_response_code(409); // Set a 409 Conflict status code
        echo "الغرفة ليست متاحة في هذا الوقت";
    }
} else {
    http_response_code(404); // Set a 404 Not Found status code
    echo "رقم الغرفة غير موجود";
}
?>
