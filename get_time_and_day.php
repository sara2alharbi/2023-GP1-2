<?php

// for giiting the current time every sec
date_default_timezone_set('Asia/Riyadh');
$currentTime = date('H:i');
$currentDay = strftime('%A');

$data = [
    'time' => $currentTime,
    'day' => $currentDay
];

echo json_encode($data);
?>
