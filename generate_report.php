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
    <?php include "base/head_imports.php"; ?>
    <link href="assets/css/report.css" rel="stylesheet">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


</head>

<body>
    <div id="report-container" class="container">
    <div class='class="card info-card sales-card"' id = 'head'>
    <img class='logo1' src='assets/img/elmam-logo.png' alt=' Logo' >
    <h2>
    التقرير الإسبوعي لغرفة رقم
    <?php
    if (isset($_POST['room'])) {
        echo $_POST['room'];
    }
    ?>
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


// Get the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
$currentDayOfWeek = date('w');

// Calculate the start date (Sunday) and end date (Saturday) of the current week
$startOfCurrentWeek = date('Y-m-d', strtotime('-' . $currentDayOfWeek . ' days'));
$endOfCurrentWeek = date('Y-m-d', strtotime('+' . (6 - $currentDayOfWeek) . ' days'));

// Calculate the start date (Sunday) and end date (Saturday) of the previous week
$startOfPreviousWeek = date('Y-m-d', strtotime('-7 days', strtotime($startOfCurrentWeek)));
$endOfPreviousWeek = date('Y-m-d', strtotime('-1 day', strtotime($startOfCurrentWeek)));

    // Check if data for the specified date range already exists in the database
    $existingDataQuery = "SELECT COUNT(*) AS data_count FROM history WHERE room = '$room' AND start_date = '$startOfPreviousWeek' AND end_date = '$endOfPreviousWeek'";
    $existingDataResult = $conn->query($existingDataQuery);
    $dataCount = $existingDataResult->fetch_assoc()['data_count'];
   
    
    // Fetch temperature, humidity, and noise data
    $temperature_query = "SELECT temperature, humidity, Date_today FROM temperature WHERE microID = '$microID' AND Date_today BETWEEN '$startOfPreviousWeek' AND '$endOfPreviousWeek'";
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
    $noise_query = "SELECT noise, Date_today FROM noise WHERE microID = '$microID' AND Date_today BETWEEN '$startOfPreviousWeek' AND '$endOfPreviousWeek'";
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
        echo "<div style ='text-align:center;'>لاتوجد بيانات من تاريخ <strong>$startOfPreviousWeek</strong> إلى <strong>$endOfPreviousWeek</strong></div>";
    } else {
        // Calculate averages with 2 decimal places
        $average_temperature = number_format(array_sum($temperatures) / count($temperatures), 2);
        $average_humidity = number_format(array_sum($humidity) / count($humidity), 2);
        $average_noise = number_format(array_sum(array_column($dailyNoiseAverages, 'noise')) / count($dailyNoiseAverages), 2);

        // Calculate high and low temperatures
        $high_temperature = max($temperatures);
        $low_temperature = min($temperatures);

        // Check air quality
        $air_quality_query = "SELECT airquality FROM airquality WHERE microID = '$microID' AND Date_today BETWEEN '$startOfPreviousWeek' AND '$endOfPreviousWeek'";
        $air_quality_result = $conn->query($air_quality_query);

        $air_quality_affected = false;

        while ($row = $air_quality_result->fetch_assoc()) {
            if ($row['airquality'] == 0) {
                $air_quality_affected = true;
                break;
            }
        }

        // Display the report
        echo "<p class='dates'>التقرير للتاريخ من <strong>$startOfPreviousWeek</strong> إلى <strong>$endOfPreviousWeek</strong></p>";
        echo "<br>";
        echo "<hr>";
        echo "<br>";

// Display the averages data as a centered table with a border
echo "<table style='width: 50%; margin: auto; border-collapse: collapse; text-align: center;' border='1'>";
echo "<tr><th>المتغير</th><th>القيمة</th></tr>";
echo "<tr><td style='border: 1px solid #dddddd;'>متوسط درجة الحرارة</td><td style='border: 1px solid #dddddd;'>$average_temperature</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd;'>متوسط درجة الرطوبة</td><td style='border: 1px solid #dddddd;'>$average_humidity</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd;'>متوسط الضوضاء</td><td style='border: 1px solid #dddddd;'>$average_noise</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd;'>أعلى درجة حرارة</td><td style='border: 1px solid #dddddd;'>$high_temperature</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd;'>أقل درجة حرارة</td><td style='border: 1px solid #dddddd;'>$low_temperature</td></tr>";
echo "</table>";


        if ($air_quality_affected) {
            echo "<p class ='air'>🌫️جودة الهواء <strong class='highlight'> تأثرت </strong>خلال 7 أيام</p>";
            echo "<br>";
            echo "<hr>";
        } else {
            echo "<p class ='air'>جودة الهواء <strong class='highlight'>لم تتأثر </strong> خلال 7 أيام</p>";
            echo "<br>";
            echo "<hr>";

        }

        if ($dataCount == 0) {
            // Data doesn't exist, insert it into the database
            // Your code to fetch and calculate data (similar to your existing code)
    
            // Your code to insert the report data into the database (similar to your existing code)
    
            try {
                
                // Insert the report data into the "history" table, including low and high temperatures
                $insert_query = "INSERT INTO history (room, start_date, end_date, average_temperature, average_humidity, average_noise, low_temperature, high_temperature, microID)
        VALUES ('$room', '$startOfPreviousWeek', '$endOfPreviousWeek', $average_temperature, $average_humidity, $average_noise, $low_temperature, $high_temperature, '$microID')";
    
                if ($conn->query($insert_query) === TRUE) {
                    echo "";
                } else {
                    echo "console.error('Error: " . $insert_query . "', '" . $conn->error . "');";
                }
            } catch (error) {
                echo "console.error('Error:', error);";
            }
        } else {
            echo "";
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
        echo '<canvas id="noiseChart" width="400" height="200"></canvas>';
        echo '</div>';
        echo '</div>';

    }
   
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

</script>

    <br><br>
    <button  class="ourBtn" onclick="downloadImage()">تحميل التقرير</button>

    </div>

    <script>
function downloadImage() {
    // Hide the download button temporarily
    var downloadButton = document.querySelector('button');
    downloadButton.style.display = 'none';

    // Specify the element to capture (excluding the button)
    var elementToCapture = document.getElementById('report-container');

    // Use html2canvas to capture the specified element as an image
    html2canvas(elementToCapture).then(function (canvas) {
        // Convert the canvas to a data URL
        var imageData = canvas.toDataURL("image/png");

        // Create a temporary link element
        var link = document.createElement('a');
        link.href = imageData;
        link.download = 'التقرير الإسبوعي.png'; // Set the desired file name

        // Append the link to the document and trigger the download
        document.body.appendChild(link);
        link.click();

        // Remove the link from the document
        document.body.removeChild(link);

        // Show the download button again
        downloadButton.style.display = 'block';
    });
}
    </script>

</body>
</html>
