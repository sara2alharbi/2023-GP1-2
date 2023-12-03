<?php
#for map pages**************************************************************************************************

#connect to the databse
$dbname = 'u169182990_elmam';
$dbuser = 'u169182990_elmam';  
$dbpass = 'E123l123'; 
$dbhost = 'localhost'; 

$con = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

#to display the room info based on room microID , so each room has own data
function getRoomState($id){
    global $con;
    $sql = "SELECT noise FROM `noise` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);

#check if data is null 
    $data = [
        'noise' => (empty($row['noise']) || !mb_check_encoding($row['noise'], 'UTF-8')) ? 'لا يوجد بيانات' : $row['noise'],
    ];

    $sql = "SELECT temperature, humidity FROM `temperature` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);

#check if data is null 
    $data['temp'] = (empty($row['temperature']) || !mb_check_encoding($row['temperature'], 'UTF-8')) ? 'لا يوجد بيانات' : $row['temperature'];
    $data['hum'] = (empty($row['humidity']) || !mb_check_encoding($row['humidity'], 'UTF-8')) ? 'لا يوجد بيانات' : $row['humidity'];

    $sql = "SELECT airquality FROM `airquality` WHERE microID = '$id' ORDER BY Date_today DESC, Time_today DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
#this for airquality to check if 0 or one
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

#Retrieving Room Data:  the script receives a GET request , it retrieves data for two rooms with microcontroller IDs "ESP12F" and "ESP12E" by calling the getRoomState function for each room.The data is stored in an array and then encoded as JSON, which is echoed as the response.
if(isset($_GET['rooms'])) {
    $id1 = "ESP12F";
    $id2 = "ESP12E";
    $data = [
        getRoomState($id1),
        getRoomState($id2),
    ];
    echo json_encode($data);
}

#to get the capacity from room table based on the id of the room
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