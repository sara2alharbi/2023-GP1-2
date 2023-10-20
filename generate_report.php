<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>التقرير الإسبوعي</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link href="assets/css/report.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class='class="card info-card sales-card"' id = 'head'>
    <img class='logo1' src='assets/img/elmam-logo.png' alt=' Logo' >
    <h2>
    <?php
    if (isset($_POST['room'])) {
        echo $_POST['room'];
    }
    ?> التقرير الإسبوعي لغرفة رقم
</h2>
<hr>
</div>
    <div class='static-data'>
    <div><strong>الدور:</strong> الأرضي</div>
    <div><strong>الكلية:</strong> كلية علوم الحاسب والمعلومات</div>
    </div>

    <?php
    include "DB.php";

    // Get the microID based on the selected room
    $room = $_POST['room'];
    $microID = ($room == 'G9') ? 'ESP12F' : 'ESP12E';

    // Get the date range for the last 7 days
    $endDate = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime('-7 days', strtotime($endDate)));

    // Fetch temperature, humidity, and noise data
    $temperature_query = "SELECT temperature, humidity, Date_today FROM temperature WHERE microID = '$microID' AND Date_today BETWEEN '$startDate' AND '$endDate'";
    $temperature_result = $conn->query($temperature_query);

    $temperatures = [];
    $humidity = [];
    $dates = [];

    while ($row = $temperature_result->fetch_assoc()) {
        $temperatures[] = $row['temperature'];
        $humidity[] = $row['humidity'];
        $dates[] = date('d-M', strtotime($row['Date_today'])); // Format the date as needed
    }

    // Fetch noise data
    $noise_query = "SELECT noise, Date_today FROM noise WHERE microID = '$microID' AND Date_today BETWEEN '$startDate' AND '$endDate'";
    $noise_result = $conn->query($noise_query);

    $noiseData = [];
    $dailyNoiseAverages = [];
    $currentDate = '';
    $sumNoise = 0;
    $count = 0;

    while ($row = $noise_result->fetch_assoc()) {
        $noise = $row['noise'];
        $date = date('d-M', strtotime($row['Date_today']));

        if ($date !== $currentDate) {
            if ($count > 0) {
                $dailyNoiseAverages[] = array(
                    'date' => $currentDate,
                    'noise' => number_format($sumNoise / $count, 2),
                );
            }
            $currentDate = $date;
            $sumNoise = 0;
            $count = 0;
        }

        $sumNoise += $noise;
        $count++;
    }

    if ($count > 0) {
        $dailyNoiseAverages[] = array(
            'date' => $currentDate,
            'noise' => number_format($sumNoise / $count, 2),
        );
    }

    // Check if there is no data for the selected room
    if (empty($temperatures) || empty($dailyNoiseAverages)) {
        echo "<div style ='text-align:center;'>لاتوجد بيانات لآخر 7 أيام</div>";
    } else {
        // Calculate averages with 2 decimal places
        $average_temperature = number_format(array_sum($temperatures) / count($temperatures), 2);
        $average_humidity = number_format(array_sum($humidity) / count($humidity), 2);
        $average_noise = number_format(array_sum(array_column($dailyNoiseAverages, 'noise')) / count($dailyNoiseAverages), 2);

        // Calculate high and low temperatures
        $high_temperature = max($temperatures);
        $low_temperature = min($temperatures);

        // Check air quality
        $air_quality_query = "SELECT airquality FROM airquality WHERE microID = '$microID' AND Date_today BETWEEN '$startDate' AND '$endDate'";
        $air_quality_result = $conn->query($air_quality_query);

        $air_quality_affected = false;

        while ($row = $air_quality_result->fetch_assoc()) {
            if ($row['airquality'] == 0) {
                $air_quality_affected = true;
                break;
            }
        }

        // Display the report
        echo "<p class='dates'>التقرير للتاريخ من <strong>$startDate</strong> إلى <strong>$endDate</strong></p>";
        echo "<br>";
        echo "<hr>";
        echo "<br>";

        echo "<div class='averages'>";
        echo "<p>متوسط درجة الحرارة: <strong>° $average_temperature</strong> <span class='icon'>🌡️</span></p>";
        echo "<p>متوسط درجة الرطوبة: <strong>% $average_humidity</strong> <span class='icon'>💧</span></p>";
        echo "<p>متوسط الضوضاء:  <strong>$average_noise </strong> <span class='icon'>🔊</span></p>";
        echo "</div>";
        echo "<div class='temp'>";
        echo "<p>أعلى درجة الحرارة: <strong>° $high_temperature</strong> <span class='icon'>🔥</span></p>";
        echo "<p>أقل درجة الحرارة: <strong>° $low_temperature</strong> <span class='icon'>❄️</span></p>";
        echo "</div>";


        if ($air_quality_affected) {
            echo "<p class ='air'>جودة الهواء <strong class='highlight'> تأثرت </strong>خلال 7 أيام🌫️</p>";
            echo "<br>";
            echo "<hr>";
        } else {
            echo "<p class ='air'>جودة الهواء <strong class='highlight'>لم تتأثر </strong> خلال 7 أيام</p>";
            echo "<br>";
            echo "<hr>";

        }

        // Display the charts side by side
        echo "<br>";
        echo '<div class="chart-container">';
        echo '<div style="width: 50%;">'; // Adjust the width as needed
        echo '<p class="chat_title">متوسط درجة الحرارة لكل  يوم</p>';
        echo "<br>";
        echo '<canvas id="temperatureChart" width="400" height="200"></canvas>';
        echo '</div>';
        echo '</div>';
        echo '<div class="chart-container">';
        echo "<br>";
        echo '<div style="width: 50%;">'; // Adjust the width as needed
        echo '<p class="chat_title">متوسط مستوى الضوضاء لكل  يوم</p>';
        echo "<br>";
        echo '<canvas id="noiseChart" width="400" height="200">متوسط نسبة الضوضاء لكل يوم</canvas>';
        echo '</div>';
        echo '</div>';

    }
    // Prepare data for the report
// Prepare data for the report
$room = isset($_POST['room']) ? $_POST['room'] : '';

// Check if the required variables are defined
if (isset($average_temperature, $average_humidity, $average_noise, $high_temperature, $low_temperature)) {
    $reportData = [
        'room' => $room,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'average_temperature' => $average_temperature,
        'average_humidity' => $average_humidity,
        'average_noise' => $average_noise,
        'high_temperature' => $high_temperature,
        'low_temperature' => $low_temperature,
    ];
    

} else {
    // Handle the case where there's no data
    $reportData = [
        'room' => $room,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'average_temperature' => ' لايوجد بيانات',
        'average_humidity' => 'لايوجد بيانات',
        'average_noise' => ' لايوجد بيانات',
        'high_temperature' => ' لايوجد بيانات',
        'low_temperature' => ' لايوجد بيانات',
        'temperatures' => ' لايوجد بيانات',
    ];
}


// Create a URL with query parameters to pass the data to the download_report.php script
$pdfUrl = 'download_report.php?reportData=' . urlencode(json_encode($reportData));


    // Close the database connection
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-to-image"></script>

    <script>
    // JavaScript for chart rendering and handling form submission
    var temperatureData = <?php echo json_encode($temperatures); ?>;
    var noiseData = <?php echo json_encode(array_column($dailyNoiseAverages, 'noise')); ?>;
    var chartLabels = <?php echo json_encode(array_column($dailyNoiseAverages, 'date')); ?>;

    var temperatureCtx = document.getElementById("temperatureChart").getContext('2d');
    var noiseCtx = document.getElementById("noiseChart").getContext('2d');

    var temperatureChart = new Chart(temperatureCtx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Temperature',
                data: temperatureData,
                backgroundColor: 'rgb(255, 99, 132)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                x: [{
                    title: {
                        display: true,
                        text: 'Date'
                    }
                }],
                y: [{
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'درجة الحرارة (°C)'
                    }
                }]
            }
        }
    });

    var noiseChart = new Chart(noiseCtx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Noise',
                data: noiseData,
                backgroundColor: 'rgb(54, 162, 235)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                x: [{
                    title: {
                        display: true,
                        text: 'Date'
                    }
                }],
                y: [{
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'متوسط مستوى الضوضاء (db)'
                    }
                }]
            }
        }
    });

    // Save charts as images when the page loads
    temperatureChart.toImage('image/jpeg', 1, function (imageData) {
        var a = document.createElement('a');
        a.href = imageData;
        a.download = 'temperature_chart.jpg';
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });

    noiseChart.toImage('image/jpeg', 1, function (imageData) {
        var a = document.createElement('a');
        a.href = imageData;
        a.download = 'noise_chart.jpg';
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });
</script>



    <br><br>
    <form method="post" action="download_report.php">
    <input type="hidden" name="reportData" value='<?php echo json_encode($reportData); ?>'>
    <input type="hidden" name="temperatures" value="<?php echo implode(',', $temperatures); ?>">
    <input type="hidden" name="dates" value="<?php echo implode(',', $dates); ?>">
    <input type="hidden" name="noises" value="<?php echo implode(',', array_column($dailyNoiseAverages, 'noise')); ?>">
    <button type="submit"> <a href="<?php echo $pdfUrl; ?>" target="_blank">تحميل التقرير</a>
</button>
</form>

    </div>

</body>
</html>
