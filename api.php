<?php
#for map pages**************************************************************************************************

$dbname = 'elmam';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$con = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

function getRoomState($id){
    global $con;
    $sql = "SELECT noise FROM `noise` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);

    $data = [
        'noise' => (empty($row['noise']) || !mb_check_encoding($row['noise'], 'UTF-8')) ? 'لا يوجد بيانات' : $row['noise'],
    ];

    $sql = "SELECT temperature, humidity FROM `temperature` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);

    $data['temp'] = (empty($row['temperature']) || !mb_check_encoding($row['temperature'], 'UTF-8')) ? 'لا يوجد بيانات' : $row['temperature'];
    $data['hum'] = (empty($row['humidity']) || !mb_check_encoding($row['humidity'], 'UTF-8')) ? 'لا يوجد بيانات' : $row['humidity'];

    $sql = "SELECT airquality FROM `airquality` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    if ($row !== null && isset($row[0])) {
        if ($row[0] === null) {
            $data['air'] = 'لا يوجد بيانات';
        } elseif ($row[0] == 0) {
            $data['air'] = 'منخفضة';
        } elseif ($row[0] == 1) {
            $data['air'] = 'جيدة';
        } else {
            $data['air'] = 'قيمة غير معروفة'; // Handle any other unexpected values
        }
    } else {
        $data['air'] = 'لا يوجد بيانات';
    }

    return $data;
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