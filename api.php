<?php

$dbname = 'elmam';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$con = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

function getRoomState($id){
    global $con;
    $sql = "SELECT noise FROM `noise` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $noise = mysqli_fetch_assoc($query)['noise'];
    $sql = "SELECT temperature, humidity FROM `temperature` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $res = mysqli_fetch_assoc($query);
    $sql = "SELECT airquality FROM `airquality` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $air = mysqli_fetch_array($query)[0];
    $temp = $res['temperature'];
    $humidity = $res['humidity'];
    return $data = [
        'noise' => $noise,
        'temp' => $temp,
        'hum' => $humidity,
        'air' => $air
    ];
}


if(isset($_GET['rooms'])) {
    $id1 = "ESP12F";
    $id2 = "ESP12E";
    $data = [
        getRoomState($id1),
        getRoomState($id2),
    ];
    echo json_encode($data);
}

if(isset($_GET['capacity'])){
    $id = $_GET['id'];
    $sql = "SELECT capacity FROM `room` WHERE roomNo = '$id'";
    $query = mysqli_query($con, $sql);
    $cp = mysqli_fetch_array($query)[0];
    $data = [
        'cp' => $cp
    ];
    echo json_encode($data);
}
?>