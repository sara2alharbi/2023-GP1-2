<?php
include "base/session_checker.php";?>


<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>التقرير الإسبوعي</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
<link href="assets/img/elmam-logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <?php include "base/head_imports.php"; ?>
    <link href="assets/css/report.css" rel="stylesheet">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


</head>

<body>
    <div id="report-container" class="container">
    <img class='logo1' src='assets/img/elmam-logo.png' alt=' Logo' >
    
    <div class="repHeader">
        
    <!-- first ul info --------------------------------------------------->
    <ul class="ulOne">
        <li> <strong>التقرير الإسبوعي لغرفة رقم:</strong> 
    <?php
    if (isset($_POST['room'])) {
        echo $_POST['room'];
    }
    ?></li>
        <li><strong>الكلية:</strong> علوم الحاسب والمعلومات</li>
        <li><strong>الدور:</strong>الأرضي</li>   
    </ul>
        
    <!-- second ul info --------------------------------------------------->
    
    <ul class="ulTwo">   

    <?php
    include "DB.php";

    // Get the microID based on the selected room
    $room = $_POST['room'];
    $microID = ($room == 'G9') ? 'ESP12F' : 'ESP12E';


// Get the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
$currentDayOfWeek = date('w');

// Calculate the start date (Sunday) and end date (Thursday) of the current week
$startOfCurrentWeek = date('Y-m-d', strtotime('-' . $currentDayOfWeek . ' days'));
$endOfCurrentWeek = date('Y-m-d', strtotime('+' . (6 - $currentDayOfWeek) . ' days'));

// Calculate the start date (Sunday) and end date (Thursday) of the previous week
$startOfPreviousWeek = date('Y-m-d', strtotime('last Sunday', strtotime($startOfCurrentWeek)));
$endOfPreviousWeek = date('Y-m-d', strtotime('next Thursday', strtotime($startOfPreviousWeek)));

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
?>
                  <li><strong>اسم المدير:</strong> <?php echo $userName; ?></li> 
              <li>
                  <?php
            date_default_timezone_set('Asia/Riyadh');
          
            $arabicDays = [
    'Saturday' => 'السبت',
    'Sunday' => 'الأحد',
    'Monday' => 'الاثنين',
    'Tuesday' => 'الثلاثاء',
    'Wednesday' => 'الأربعاء',
    'Thursday' => 'الخميس',
    'Friday' => 'الجمعة'
];

            // Get the current time and day
$currentTime = date("H:i");
$currentDay = strftime('%A'); // Get the current day name in English

// Get the Arabic equivalent of the current day
$currentDayArabic = isset($arabicDays[$currentDay]) ? $arabicDays[$currentDay] : 'Unknown';
            ?>
             <strong>تم إنشاء التقرير:</strong> <?php echo $currentDayArabic .' , ' .$currentTime ?>
              </li>
          <li><strong> التاريخ: </strong>  من&nbsp;<?php echo $startOfPreviousWeek;?> إلى <?php echo $endOfPreviousWeek ; ?></li>
    </ul>   
        
        
    </div>
    
    <?php
    // Check if there is no data for the selected room
    if (empty($temperatures) || empty($dailyNoiseAverages)) {
        echo "<div class= 'error' >لاتوجد بيانات   </div>";
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
   
  ?> 

<div class="line"></div>
<div class="firstRow">  

   <?php 
  // Display the averages data as a centered table with a border.................................................      

echo "<table class='table'>";
echo "<tr><th>المتغير</th><th>القيمة</th></tr>";
echo "<tr><td >متوسط درجة الحرارة</td><td >$average_temperature</td></tr>";
echo "<tr><td >متوسط درجة الرطوبة</td><td >$average_humidity</td></tr>";
echo "<tr><td >متوسط الضوضاء</td><td >$average_noise</td></tr>";
echo "<tr><td >أعلى درجة حرارة</td><td class='red'>$high_temperature</td></tr>";
echo "<tr><td >أقل درجة حرارة</td><td class='blue' >$low_temperature</td></tr>";
echo "</table>";


        if ($dataCount == 0) {
            // Data doesn't exist, insert it into the database
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
        echo '<div>'; // Adjust the width as needed
        echo "<br>";
        echo '<canvas id="temperatureChart" ></canvas>';
        echo '</div>';
        echo '</div>';
?>
    </div>
 
    <div class="rowTwo">
        <?php
        if ($air_quality_affected) {
            echo "<p class ='air'>🌫جودة الهواء <strong class='highlight'> تأثرت </strong>خلال 5 أيام</p>";
            echo "<br>";
            
        } else {
            echo "<p class ='air'>جودة الهواء <strong class='highlight'>لم تتأثر </strong> خلال 5 أيام</p>";
            echo "<br>";
            

        }
        echo '<p class="chat_title">متوسط درجة الحرارة لكل  يوم</p>';
        echo "<hr>";
    }
    

 

?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-to-image"></script>

    <script>
    // JavaScript for chart rendering and handling form submission
    var temperatureData = <?php echo json_encode($temperatures); ?>;
    var chartLabels = <?php echo json_encode(array_column($dailyNoiseAverages, 'date')); ?>;

    var temperatureCtx = document.getElementById("temperatureChart").getContext('2d');

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



</script>
<br><br><br>

<h5 > المحاضرات التي لم تقام في وقتها</h5>
  <br>
  
<?php

if (isset($_POST['room'])) {
    $roomNum = $_POST['room'];
    // Select all lectures in this room
    $numLec_query = "SELECT courseCo, section, day, startTime, endTime FROM lecture WHERE roomNo = '$roomNum'";
    $result_query = $conn->query($numLec_query);
    $num_rows = mysqli_num_rows($result_query);

    $trueLec = 0; // Initialize count of lectures above average noise level

    if ($result_query->num_rows > 0) {
        // Display table header
        echo "<table class='table'>";
        echo "<tr><th>رقم المقرر</th><th>الشعبة</th><th>اليوم</th><th>بداية المحاضرة</th><th>نهاية المحاضرة</th></tr>";

        while ($outerRow = $result_query->fetch_assoc()) {
            $course = $outerRow['courseCo'];
            $section = $outerRow['section'];
            $day = $outerRow['day'];
            $startTime = $outerRow['startTime'];
            $endTime = $outerRow['endTime'];
            $noiseLevel = 0;
            $count = 0;

            // Select lecture's info in this room
            $Lec_query = "SELECT noise, Date_today, Time_today FROM noise WHERE microID = '$microID'";
            $result2_query = $conn->query($Lec_query);

            if ($result2_query->num_rows > 0) {
                $result2_data = [];

                while ($innerRow = $result2_query->fetch_assoc()) {
                    $result2_data[] = $innerRow;
                }

                foreach ($result2_data as $innerRow) {
                    $noise = $innerRow['noise'];
                    $Date_today = $innerRow['Date_today'];
                    $Time_today = $innerRow['Time_today'];
                    $dayOfWeek = date('l', strtotime($Date_today));
                    $startTimeStamp = strtotime($startTime);
                    $endTimeStamp = strtotime($endTime);
                    $Time_todayStamp = strtotime($Time_today);

                    if ($day == $dayOfWeek && $Time_todayStamp >= $startTimeStamp && $Time_todayStamp <= $endTimeStamp) {
                        $noiseLevel += $noise;
                        $count++;
                    }
                }

                if ($count > 0) {
                    $avg = $noiseLevel / $count;
                    if ($avg < 20) {
                        // Print each lecture meeting the condition within the table
                        $daysMapping = array(
                         'Saturday' => 'السبت',
                         'Sunday' => 'الأحد',
                         'Monday' => 'الاثنين',
                          'Tuesday' => 'الثلاثاء',
                          'Wednesday' => 'الأربعاء',
                          'Thursday' => 'الخميس',
                           'Friday' => 'الجمعة'
                               );                          
                                  
                                 if (isset($daysMapping[$day])) {
                                 $arabicDay = $daysMapping[$day]; }
                        echo "<tr><td>$course</td><td>$section</td><td>$arabicDay</td><td>$startTime</td><td>$endTime</td></tr>";
                    } else {
                        $trueLec++; // Increment count for lectures above average noise level
                }}
                }
            }
}}

        // Close the table after all rows are printed
        echo "</table>";

        echo "<p>نسبة إقامة المحاضرات في وقتها  المحجوز بحسب الضوضاء:<strong>$trueLec</strong> من أصل <strong>$num_rows</strong></p>";
?>  <!-- This might be the cause of the error, remove this line -->

    <br><br>
    <button class="btn btn-primary ourBtn" onclick="downloadImage()">تحميل التقرير</button>
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
