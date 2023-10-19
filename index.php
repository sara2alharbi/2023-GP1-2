<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; ?>
<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

$userName = $_SESSION["user"];

?>
<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>لوحة التحكم</title>
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
  <link href="assets/css/alert.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="notification/alerting.js"></script>


  
</head>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/elmam-logo.png" alt="">
       
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    
<!--the notification start-------------------------------------------------------------- -->
   
<nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
      <div id="notification-bell" onclick="toggleAlerts()">
    <a class="nav-link nav-icon">
        <i class="bi bi-bell" style="font-size:30px"></i>
        <span id="notification-count"></span>
    </a>
</div>
<span id="alerts-container">
<div id="alerts-dropdown" class="dropdown-menu">
    <!-- Alerts will be displayed here -->
</div>
 


<!--the notification end-------------------------------------------------------------- -->
   
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
                <span> تسجيل الخروج</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
          </ul>

        </li><!-- End Profile Nav -->
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= ------------------------------------------->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span> الرئيسية</span>
        </a>
      </li><!-- End home Nav -->      
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
            <a href="bookRoom.php" >
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
      </li><!-- End Login Page Nav -->
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>لوحة التحكم</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسية  </a></li>
          <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">لوحة التحكم</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <section class="section dashboard">
      <div class="row">


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h1 class="card-title" style="font-size: 230%;"> مرحبًا بِك <?php echo $userName; ?><span style="font-size: 70%;"> | في إلمام</span></h1>                   
                </div>
              </div>
            </div><!-- End Recent Sales -->
                                <!-- building-info Card -->
                                <div class="col-lg-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">معلومات المبنى</h5>
                  <canvas id="myPieChart" width="200" height="200"></canvas>
                </div>
              </div>
            </div><!-- End building-info Card -->
            <div class="col-lg-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">نسبة استغلال المساحة </h5> 
                  <canvas id="myDoughnutChart" width="200" height="200"></canvas>
                </div>
              </div>
            </div><!-- End building-info Card -->
            <div class="col-lg-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">منسوبي الكلية</h5> 
                  <canvas id="myBarChart" width="200" height="200"></canvas>
              </div>                
              </div>
            </div><!-- End building-info Card -->
        </div><!-- End Right side columns -->
        
        
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
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
// Static data for the pie chart
var data = [39,29, 2 ,5 , 4 , 12];
var labels = ['القاعات الدراسية', 'المعامل', 'مصلى' , 'قاعة بحث' , 'معمل أبحاث' , 'مكاتب'];

// Get the canvas element
var ctx = document.getElementById('myPieChart').getContext('2d');

// Create the pie chart
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
        'rgba(255, 173, 173)',
        'rgba(255, 214, 165)',
        'rgba(253, 255, 182)',
        'rgba(202, 255, 191)',
        'rgba(155, 246, 255)',
        'rgba(160, 196, 255)',
      ],
            }]
    }
});
</script>

<script>
        // Static data for the doughnut chart
        var data = [80 , 20]; // Data for each segment
        var labels = ['المستغلة', 'الغير مستغلة']; // Labels for each segment

        // Get the canvas element
        var ctx = document.getElementById('myDoughnutChart').getContext('2d');

        // Create the doughnut chart
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#caf0f8', '#00b4d8'], // Customize the colors of each segment
                }]
            }
        });
    </script>

<script>
        // Data for the number of students and teachers
        var data = {
            labels: ['الطالبات', 'منسوبي الكلية'],
            datasets: [{
                label: 'أعداد منسوبي كلية الحاسب والمعلومات',
                data: [1000, 100], // Replace with your actual data
                backgroundColor: ['#7b2cbf', '#e0aaff'], // Customize the colors
            }]
        };

        // Get the canvas element
        var ctx = document.getElementById('myBarChart').getContext('2d');

        // Create a bar chart
        var myBarChart = new Chart(ctx, {
            type: 'bar', // Use 'bar' for vertical bars or 'horizontalBar' for horizontal bars
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>