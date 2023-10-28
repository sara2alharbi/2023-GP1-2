<?php
include "DB.php";

$type = $_POST['type'];
$day = $_POST['day'];
$capacity =(int) $_POST['capacity'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$semester = $_POST['semester'];

if (isset($_POST['roomNo'])){

}
$sql = "SELECT * FROM room r
        WHERE r.type = '$type'
        AND r.capacity >= $capacity
        AND NOT EXISTS (
            SELECT 1
            FROM lecture l
            WHERE l.roomNo = r.roomNo
            AND l.day = '$day'
            AND l.startTime <= '$endDate'
            AND l.endTime >= '$startDate'
            AND l.semester = '$semester'
        )";


$result = mysqli_query($conn, $sql);

if ($result) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
}

?>
