<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; ?>
<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>إحصائية درجة الحرارة</title>
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
        <ul id="tables-nav" class="nav-content  " data-bs-parent="#sidebar-nav">
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
            <a href="room-date.php" class="nav-link">
              <i class="bi bi-circle"></i><span> إحصائية درجة الحرارة</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
      
            <li class="nav-item">
        <a class="nav-link collapsed" href="#">
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
      <h1> إحصائية درجة الحرارة </h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="room-date.php">  درجة الحرارة</a></li>
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
                  <h5 class="card-title"> درجة الحرارة</h5>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package with 'ar' (Arabic) language setting.
        google.charts.load('current', {'packages':['corechart'], 'language': 'ar'});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Function to draw the temperature chart
        function drawChart() {
            // Get user input for the desired date
            var desiredDate = document.getElementById("desired_date").value;

            // Create a data table with column headers
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'الوقت');
            data.addColumn('number', 'درجة الحرارة');

            // Fetch temperature data from PHP script
            <?php
            // Database connection parameters
            $db_host = 'localhost';
            $db_name = 'elmam';
            $db_user = 'root';
            $db_pass = '';

            // Connect to the database
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

            // Get user input for desired date
            $desiredDate = isset($_POST['desired_date']) ? $_POST['desired_date'] : null;

            // Check if data exists for the selected date
            $stmt_check = $conn->prepare("SELECT COUNT(*) FROM temperature WHERE Date_today = ?");
            $stmt_check->execute([$desiredDate]);
            $count = $stmt_check->fetchColumn();

            if ($desiredDate && $count > 0) {
                // Prepare and execute a SQL query to retrieve temperature data for the selected date
                $stmt = $conn->prepare("SELECT DATE_FORMAT(Time_today, '%h:%i %p') AS Time, temperature FROM temperature WHERE Date_today = ? AND temperature > 0");
                $stmt->execute([$desiredDate]);

                // Initialize variables for temperature comparison
                $prevTemperature = null;
                $prevTime = null;

                // Fetch data and add it to the JavaScript array
                echo "var chartData = [";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Check if the temperature has changed or the specified time interval (e.g., 3 minutes) has passed
                    if ($row['temperature'] != $prevTemperature || $prevTime === null || strtotime($row['Time']) - strtotime($prevTime) >= 180) {
                        echo "['" . $row['Time'] . "', " . $row['temperature'] . "],";
                    }

                    // Update previous temperature and time
                    $prevTemperature = $row['temperature'];
                    $prevTime = $row['Time'];
                }
                echo "];";

                echo "data.addRows(chartData);";
            } else {
                // Display a message when no data is available for the selected date
                echo "var chartData = [['لا توجد قيم في هذا التاريخ', 0]];";
                echo "data.addRows(chartData);";
            }

            // Close the database connection
            $conn = null;
            ?>
            
           // Set chart options with Arabic language settings
var options = {
    title: 'درجة الحرارة في <?php echo $desiredDate; ?>',
    legend: { position: 'center' },
    hAxis: {
        title: 'الوقت',
        textStyle: {
            fontSize: 10// Adjust the font size as needed
        }
    },
    vAxis: { title: 'درجة الحرارة' },
    chartArea: { width: '70%', height: '70%' },
    backgroundColor: 'white', // Set background color
    colors: ['#52B69A'], // Set line color
    lineWidth: 2, // Set line width
    pointSize: 5, // Set point size
    curveType: 'function' // Use smooth curve lines
};

            // Create and draw the chart as a line chart
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
    <!-- Form for user input -->
    <form method="post">
        <label for="desired_date" style="margin-right:350px;" >اختر تاريخًا لعرض درجة الحرارة:</label>&nbsp;&nbsp;
        <input type="date" id="desired_date" name="desired_date" required>&nbsp;
        <input type="submit" value="عرض الرسم البياني">
    </form>

    <!-- Container for the temperature chart -->
    <div id="chart_div" style="width: 850px; height: 500px; margin-right:180px;margin-top:30px;border:20%;" ></div>
    </div>
              </div>
    </div><!-- End Recent Sales -->
    </div><!-- End Right side columns -->
      </div>
    </section>
  </main><!-- End #main -->

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
