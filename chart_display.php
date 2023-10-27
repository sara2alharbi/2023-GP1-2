<?php
//this code for displaying the chart based on the room and date
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room = $_POST["room"];
    $date = $_POST["date"];
    $microID = ($room === 'G9') ? 'ESP12F' : 'ESP12E';

    // Connect to your database (adjust the database credentials)
    $db = new PDO('mysql:host=localhost;dbname=elmam', 'root', '');

    // Fetch temperature data based on user selections
    $query = "SELECT Temperature, Humidity, Date_today, DATE_FORMAT(Time_today, '%H:%i') AS MinuteTime 
              FROM temperature 
              WHERE Date_today = :date AND microID = :microID 
              GROUP BY MinuteTime";

    $stmt = $db->prepare($query);
    $stmt->execute(array(':date' => $date, ':microID' => $microID));
    $temperatureData = $stmt->fetchAll();

    // Fetch noise data based on user selections
    $query = "SELECT Noise, Date_today, DATE_FORMAT(Time_today, '%H:%i') AS MinuteTime 
              FROM noise 
              WHERE Date_today = :date AND microID = :microID 
              GROUP BY MinuteTime";

    $stmt = $db->prepare($query);
    $stmt->execute(array(':date' => $date, ':microID' => $microID));
    $noiseData = $stmt->fetchAll();
}

// Check if there is no data for the selected room on the chosen date
if (empty($temperatureData) && empty($noiseData)) {
    echo ".لايوجد بيانات للغرفة المختارة في هذا التاريخ";
    exit;
}

$temperatureLabels = [];
$temperatureValues = [];
$noiseLabels = [];
$noiseValues = [];

foreach ($temperatureData as $data) {
    $temperatureLabels[] = $data['MinuteTime'];
    $temperatureValues[] = $data['Temperature'];
}

foreach ($noiseData as $data) {
    $noiseLabels[] = $data['MinuteTime'];
    $noiseValues[] = $data['Noise'];
}

$responseData = [
    'temperatureData' => [
        'labels' => $temperatureLabels,
        'datasets' => [
            [
                'label' => 'درجة الحرارة (°C)',
                'data' => $temperatureValues,
                'borderColor' => 'rgb(75, 192, 192)',
                'borderWidth' => 1,
                'fill' => false,
            ],
        ],
    ],
    'noiseData' => [
        'labels' => $noiseLabels,
        'datasets' => [
            [
                'label' => ' مستوى الضوضاء',
                'data' => $noiseValues,
                'borderColor' => 'rgb(255, 99, 132)',
                'borderWidth' => 1,
                'fill' => false,
            ],
        ],
    ],
];

echo json_encode($responseData);
?>
