<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; ?>
<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>إحصائية درجة الحرارة الضوضاء </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/elmam-logo.png" rel="icon" >


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>
<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
$userName = $_SESSION["user"];
?>

 <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/elmam-logo.png" alt="">
       
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
  </a><!-- End Notification Icon ------------------------------------------>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav-------------------------------------------------------------------------- -->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/empty-profile.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $userName; ?></span>
          </a><!-- End Profile Iamge Icon ----------------------------------------------------------->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $userName; ?></h6>
              <span>مدير مبنى</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>الملف الشخصي</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>تسجيل الخروج</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= ------------------------------------------->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span> الرئيسية</span>
        </a>
      </li><!-- End home Nav -->

       <li class="nav-item">
        <a class="nav-link collapsed" href="notification.php">
          <i class="bi bi-bell"></i>
          <span> التنبيهات</span>
        </a>
      </li><!-- End notfications  Nav --------------->
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"> 
            <i class="bi bi-map"></i>
           <span>خريطة المبنى</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="map0.php">
              <i class="bi bi-circle"></i><span>الدور الأرضي</span>
            </a>
          </li>
          <li>
            <a href="map1.php">
              <i class="bi bi-circle"></i><span>الدور الأول</span>
            </a>
          </li>
          <li>
            <a href="map2.php">
              <i class="bi bi-circle"></i><span>الدور الثاني</span>
            </a>
          </li>
        </ul>
      </li><!-- End map  Nav --------------->
      

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>غرف المبنى</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="room-info.php">
              <i class="bi bi-circle"></i><span>بيانات الغرف</span>
            </a>
          </li>
          <li>
            <a href="room-monitoring.php">
              <i class="bi bi-circle"></i><span>مراقبة حالة الغرفة</span>
            </a>
          </li>
          <li>
            <a href="room-date.php">
              <i class="bi bi-circle"></i><span> إحصائية درجة الحرارة و الضوضاء</span>
            </a>
          </li>
               <li>
            <a href="bookRoom.php">
              <i class="bi bi-circle"></i><span>  حجز غرفة</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
      
            <li class="nav-item">
        <a class="nav-link collapsed" href="report.php">
            <i class="bi bi-file-earmark-bar-graph"></i>
           <span> تقارير اسبوعية</span>
        </a>
      </li><!-- End report  Nav ---------------------------------------------------->

      
      <!-- End line  ------------------------------------------------------------------------------->
      <li> <hr> </li>

      
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>الملف الشخصي</span>
        </a>
      </li><!-- End Profile Page Nav ------------------------------------->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.php">
          <i class="bi bi-question-circle"></i>
          <span>الأسئلة الشائعة</span>
        </a>
      </li><!-- End F.A.Q Page Nav ------------------------------------>

      <li class="nav-item">
        <a class="nav-link collapsed" href="contact.php">
          <i class="bi bi-envelope"></i>
          <span>تواصل معنا</span>
        </a>
      </li><!-- End Contact Page Nav --------------------------------->

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-right"></i>
          <span>تسجيل الخروج</span>
        </a>
      </li><!-- End logout Page Nav -->
    </ul>
  </aside><!-- End Sidebar-->

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
</main><!-- End #main -->
<!-- Add a CSS style block to your HTML -->
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


   <!-- ======= Footer ======= -->
   <footer id="footer" class="footer">
    <div class="copyright">
      &copy;  جميع الحقوق محفوظة <strong><span>لإلمـام</span></strong> 
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        <div class="social-links">
        <a href="https://twitter.com/elmam_sa?s=11&t=bQf4d5cu-HYAhb1QcYfSJQ" class="twitter"  ><i class="bx bxl-twitter"></i></a>
        <a href="https://www.youtube.com/@1Elmam" class="facebook"><i class="bx bxl-youtube"></i></a>
        <a href="https://instagram.com/elmam_sa?igshid=YmMyMTA2M2Y" class="instagram"><i class="bx bxl-instagram"></i></a>
        
        
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
