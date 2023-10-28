<?php
include "DB.php";
//this for reserve a room and store it in lecture table
$day = $_POST['day'];
$course = $_POST['course'];
$section = $_POST['sectionNumber'];
$roomNo = $_POST['roomNo'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$semester = $_POST['semester']; // Retrieve the semester value from POST data


$sql = "INSERT INTO lecture (day, courseCo, section, roomNo, startTime, endTime , semester)
VALUES ('$day', '$course', '$section', '$roomNo', '$startTime', '$endTime' , '$semester')";

$result = mysqli_query($conn, $sql);

if ($result === TRUE) {
  //  echo "<script>alert('Reserved Successfully');</script>";
    echo "<script>alert('Reserved Successfully'); window.location = 'bookRoom.php';</script>";

} else {
    // Insert failed
    echo "Error: " . mysqli_error($conn);
}
?>