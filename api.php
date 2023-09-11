<?php

$dbname = 'elmam';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$con = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(isset($_POST['rooms'])) {
    $sql = "SELECT noise FROM `noise` WHERE microID = 'ESP12F' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $noise1 = mysqli_fetch_assoc($query)['noise'];
    $sql = "SELECT temperature FROM `temperature` WHERE microID = 'ESP12F' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $temp1 = mysqli_fetch_assoc($query)['temperature'];
    
    $sql = "SELECT noise FROM `noise` WHERE microID = 'ESP12E' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $noise2 = mysqli_fetch_assoc($query)['noise'];
    $sql = "SELECT temperature FROM `temperature` WHERE microID = 'ESP12E' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $temp2 = mysqli_fetch_assoc($query)['temperature'];
    
    $data = [
        'temp1' => $temp1,
        'noise1' => $noise1,
        'temp2' => $temp2,
        'noise2' => $noise2,
    ];
    // header('Content-Type: application/json');
    echo json_encode($data);
}
?>