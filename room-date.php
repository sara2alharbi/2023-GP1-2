<!DOCTYPE html>
<html lang="ar">
<?php  include "base/session_checker.php";?>

<head>
    <?php include "base/head_imports.php"; ?>
</head>

<body>
<!-- ======= Header ======= -->
<?php include "base/header.php"; ?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php include "base/sidebar.php"; ?>
<!-- End Sidebar-->

<!-- ======= Main ======= -->
<main id="main" class="main" dir="rtl">
    <div class="pagetitle">
        <h1> إحصائية درجة الحرارة الضوضاء </h1>
        <br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="room-date.php"> درجة الحرارة الضوضاء</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active"> حسب تاريخ محدد</li>
            </ol>
            <br>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title"> درجة الحرارة الضوضاء</h5>

                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            // Load the Visualization API and the corechart package with 'ar' (Arabic) language setting.
                            google.charts.load('current', {'packages': ['corechart'], 'language': 'ar'});

                            // Set a callback to run when the Google Visualization API is loaded.
                            google.charts.setOnLoadCallback(drawCharts);

                            // Function to draw the temperature and noise charts
                            function drawCharts() {
                                // Get user input for the selected date
                                var selectedDate = document.getElementById("selected_date").value;

                                // Create a data table with column headers for temperature
                                var temperatureData = new google.visualization.DataTable();
                                temperatureData.addColumn('string', 'الوقت');
                                temperatureData.addColumn('number', 'درجة الحرارة');

                                // Create a data table with column headers for noise
                                var noiseData = new google.visualization.DataTable();
                                noiseData.addColumn('string', 'الوقت');
                                noiseData.addColumn('number', 'مستوى الضوضاء');

                                // Fetch temperature data from PHP script
                                <?php
                                // Database connection parameters for temperature data
                                $db_host = 'localhost';
                                $db_name = 'elmam';
                                $db_user = 'root';
                                $db_pass = '';

                                // Connect to the database for temperature data
                                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

                                // Get user input for desired date for temperature
                                $desiredDateTemperature = isset($_POST['selected_date']) ? $_POST['selected_date'] : null;

                                // Check if data exists for the selected date for temperature
                                $stmt_check_temperature = $conn->prepare("SELECT COUNT(*) FROM temperature WHERE Date_today = ?");
                                $stmt_check_temperature->execute([$desiredDateTemperature]);
                                $count_temperature = $stmt_check_temperature->fetchColumn();

                                if ($desiredDateTemperature && $count_temperature > 0) {
                                    // Prepare and execute a SQL query to retrieve temperature data for the selected date
                                    $stmt_temperature = $conn->prepare("SELECT DATE_FORMAT(Time_today, '%h:%i %p') AS Time, temperature FROM temperature WHERE Date_today = ? AND temperature > 0");
                                    $stmt_temperature->execute([$desiredDateTemperature]);

                                    // Initialize variables for temperature comparison
                                    $prevTemperature = null;
                                    $prevTime = null;

                                    // Fetch data and add it to the JavaScript array for temperature
                                    echo "var temperatureChartData = [";
                                    while ($row = $stmt_temperature->fetch(PDO::FETCH_ASSOC)) {
                                        // Check if the temperature has changed or the specified time interval (e.g., 3 minutes) has passed
                                        if ($row['temperature'] != $prevTemperature || $prevTime === null || strtotime($row['Time']) - strtotime($prevTime) >= 180) {
                                            echo "['" . $row['Time'] . "', " . $row['temperature'] . "],";
                                        }

                                        // Update previous temperature and time
                                        $prevTemperature = $row['temperature'];
                                        $prevTime = $row['Time'];
                                    }
                                    echo "];";

                                    echo "temperatureData.addRows(temperatureChartData);";
                                } else {
                                    // Display a message when no temperature data is available for the selected date
                                    echo "var temperatureChartData = [['لا توجد قيم في هذا التاريخ', 0]];";
                                    echo "temperatureData.addRows(temperatureChartData);";
                                }

                                // Close the database connection for temperature data
                                $conn = null;
                                ?>

                                // Fetch noise data from PHP script
                                <?php
                                // Database connection parameters for noise data
                                $db_host = 'localhost';
                                $db_name = 'elmam';
                                $db_user = 'root';
                                $db_pass = '';

                                // Connect to the database for noise data
                                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

                                // Get user input for desired date for noise
                                $desiredDateNoise = isset($_POST['selected_date']) ? $_POST['selected_date'] : null;

                                // Check if data exists for the selected date for noise
                                $stmt_check_noise = $conn->prepare("SELECT COUNT(*) FROM noise WHERE Date_today = ?");
                                $stmt_check_noise->execute([$desiredDateNoise]);
                                $count_noise = $stmt_check_noise->fetchColumn();

                                if ($desiredDateNoise && $count_noise > 0) {
                                    // Prepare and execute a SQL query to retrieve noise data for the selected date
                                    $stmt_noise = $conn->prepare("SELECT DATE_FORMAT(Time_today, '%h:%i %p') AS Time, noise FROM noise WHERE Date_today = ? AND noise > 0");
                                    $stmt_noise->execute([$desiredDateNoise]);

                                    // Initialize variables for noise comparison
                                    $prevNoise = null;
                                    $prevTime = null;

                                    // Fetch data and add it to the JavaScript array for noise
                                    echo "var noiseChartData = [";
                                    while ($row = $stmt_noise->fetch(PDO::FETCH_ASSOC)) {
                                        // Check if the noise has changed or the specified time interval (e.g., 3 minutes) has passed
                                        if ($row['noise'] != $prevNoise || $prevTime === null || strtotime($row['Time']) - strtotime($prevTime) >= 180) {
                                            echo "['" . $row['Time'] . "', " . $row['noise'] . "],";
                                        }

                                        // Update previous noise and time
                                        $prevNoise = $row['noise'];
                                        $prevTime = $row['Time'];
                                    }
                                    echo "];";

                                    echo "noiseData.addRows(noiseChartData);";
                                } else {
                                    // Display a message when no noise data is available for the selected date
                                    echo "var noiseChartData = [['لا توجد قيم في هذا التاريخ', 0]];";
                                    echo "noiseData.addRows(noiseChartData);";
                                }

                                // Close the database connection for noise data
                                $conn = null;
                                ?>

                                // Set chart options for temperature with Arabic language settings
                                var temperatureOptions = {
                                    legend: {position: 'center'},
                                    hAxis: {
                                        title: 'الوقت',
                                        textStyle: {
                                            fontSize: 10 // Adjust the font size as needed
                                        }
                                    },
                                    vAxis: {title: 'درجة الحرارة'},
                                    chartArea: {width: '70%', height: '70%'},
                                    backgroundColor: 'white', // Set background color
                                    colors: ['#52B69A'], // Set line color for temperature chart
                                    lineWidth: 2, // Set line width
                                    pointSize: 5, // Set point size
                                    curveType: 'function' // Use smooth curve lines
                                };

                                // Set chart options for noise with Arabic language settings
                                var noiseOptions = {
                                    legend: {position: 'center'},
                                    hAxis: {
                                        title: 'الوقت',
                                        textStyle: {
                                            fontSize: 10 // Adjust the font size as needed
                                        }
                                    },
                                    vAxis: {title: 'مستوى الضوضاء'},
                                    chartArea: {width: '70%', height: '70%'},
                                    backgroundColor: 'white', // Set background color
                                    colors: ['#168AAD'], // Set line color for noise chart
                                    lineWidth: 2, // Set line width
                                    pointSize: 5, // Set point size
                                    curveType: 'function' // Use smooth curve lines
                                };
                                

                                // Create and draw the temperature chart as a line chart
                                var temperatureChart = new google.visualization.LineChart(document.getElementById('temperature_chart_div'));
                                temperatureChart.draw(temperatureData, temperatureOptions);

                                // Create and draw the noise chart as a line chart
                                var noiseChart = new google.visualization.LineChart(document.getElementById('noise_chart_div'));
                                noiseChart.draw(noiseData, noiseOptions);
                            }
                        </script>
                        <!-- Form for user input -->
                        <div class="form-container">
                        <form method="post">
                            <label for="selected_date" >اختر تاريخًا لعرض درجة الحرارة ومستوى الضوضاء:</label>&nbsp;&nbsp;
                            <input type="date" id="selected_date" name="selected_date" required>&nbsp;
                            <input type="submit" name="submit_combined" value="عرض الرسم البياني للحرارة الضوضاء">
                        </form>
                          </div>

                        <!-- Container for the temperature chart -->
                        <div class="chart-title">درجة الحرارة</div>
                        <div id="temperature_chart_div"
                             style="width: 950px; height: 400px; margin-right: 180px; margin-top: 30px; border: 20%;">
                            </div>

                        <!-- Container for the noise chart -->
                        <div class="chart-title">مستوى الضوضاء</div>
                        <div id="noise_chart_div"
                             style="width: 950px; height: 400px; margin-right: 180px; margin-top: 30px; border: 20%;">
                            </div>
                    </div>
                </div>
            </div><!-- End Recent Sales -->
        </div><!-- End Right side columns -->
    </section>
</main>
<!-- End Main -->


<!-- Add a CSS style -->
<style>
    /* Style for chart titles */
    .chart-title {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-right: 180px; 
        margin-top: 30px;
        color:#184E77;
    }

        /* Style for the form container */
        .form-container {
        text-align: center;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    /* Style for the form labels */
    label {
        margin-right: 10px;
        font-weight: bold;
    }

    /* Style for the form input fields */
    input[type="date"] {
        width: 200px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    /* Style for the form submit button */
    input[type="submit"] {
        padding: 10px 20px;
        background-color: #99D98C;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    /* Style for the form submit button on hover */
    input[type="submit"]:hover {
        background-color: #D9ED92;
    }
</style>
<!-- End a CSS style -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->

<!-- Vendor JS Files -->
<?php include "base/js_imports.php"; ?>
<!-- End JS Files -->

</body>
</html>
