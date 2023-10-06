<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>حجز غرفة</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/elmam-logo.png" rel="icon" >
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
            <span> تسجيل الخروج</span>
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
        <a class="nav-link collapsed " href="index.php">
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
            <a href="bookRoom.php" class="nav-link">
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
        <a class="nav-link collapsed " href="contact.php">
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
      <h1>حجز غرفة </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">غرف المبنى</li>
           <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">حجز غرفة</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

     <div class="card ">
            <div class="card-body">
              <h5 class="card-title">الرجاء ادخال بيانات المحاضرة</h5>

              <!-- No Labels Form -->
            <!--  <form class="row g-3" method="POST" action="insert_lecture.php">
               
                <div class="col-md-6">
                  <input type="text" name="courseCo" class="form-control" placeholder="رمز المقرر">
                </div>
                <div class="col-md-6">
                  <input type="text" name="roomNo"  class="form-control" placeholder="رقم الغرفة">
                </div>
                <div class="col-md-6">
                  <input type="text" name="section" class="form-control" placeholder="رقم الشعبة">
                </div>
                <div class="col-md-6">
                  <input type="text" name="day" class="form-control" placeholder="اليوم">
                </div>
                  <div class="col-md-6">
                  <input type="text" name="startTime" class="form-control" placeholder="وقت بداية المحاضرة">
                </div>
                <div class="col-md-6">
                  <input type="text" name="endTime" class="form-control" placeholder="وقت نهاية المحاضرة">
                </div>
               
                  <!-- <div class="col-md-4">
                  <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                  
                </div> 
                  
             
                <div class="text-center">
                    <button type="submit" name="add" class="btn btn-primary">Submit</button>
                 
                </div>
              </form>End No Labels Form -->
                  
                  <?php
// Include the database connection file (DB.php)
include 'DB.php';

// Initialize error and success messages
$errorMessage = "";
$successMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $courseCo = $_POST["courseCo"];
    $roomNo = $_POST["roomNo"];
    $section = $_POST["section"];
    $day = $_POST["day"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];

    // Check if any field is empty
    if (empty($courseCo) || empty($roomNo) || empty($section) || empty($day) || empty($startTime) || empty($endTime)) {
        $errorMessage = "جميع الحقول مطلوبة";
    } else {
        // Convert time strings to a suitable format for comparison
        $startTimeFormatted = date("H:i", strtotime($startTime));
        $endTimeFormatted = date("H:i", strtotime($endTime));

        // Check if there is a conflict in the database
        $checkQuery = "SELECT * FROM lecture WHERE roomNo = '$roomNo' AND day = '$day' AND
                       (CAST('$startTimeFormatted' AS TIME) <= CAST(endTime AS TIME) AND CAST('$endTimeFormatted' AS TIME) >= CAST(startTime AS TIME))";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // Room is busy
            $errorMessage = " الغرفة محجوزة في هذا الوقت";
        } else {
            // Room is available, insert the data
            $insertQuery = "INSERT INTO lecture (courseCo, roomNo, section, day, startTime, endTime)
                            VALUES ('$courseCo', '$roomNo', '$section', '$day', '$startTimeFormatted', '$endTimeFormatted')";

            if ($conn->query($insertQuery) === TRUE) {
                $successMessage = "تم حجز الغرفة بنجاح";
            } else {
                $errorMessage = "Error: " . $conn->error;
            }
        }
    }
}
?>
                  
  <!-- Error Message -->
    <?php if (!empty($errorMessage)) { ?>
      <div class="col-md-12">
        <div class="alert alert-danger redAlr" role="alert">
          <?php echo $errorMessage; ?>
        </div>
      </div>
    <?php } ?>

    <!-- Success Message -->
    <?php if (!empty($successMessage)) { ?>
      <div class="col-md-12">
        <div class="alert alert-success greenAlr" role="alert">
          <?php echo $successMessage; ?>
        </div>
      </div>
    <?php } ?>
    
      <form class="row g-3 book" method="POST" action="">
          
          <div class="col-md-6">
                  <input type="text" name="courseCo" class="form-control" placeholder="رمز المقرر">
                </div>
                <div class="col-md-6">
                  <input type="text" name="roomNo"  class="form-control" placeholder="رقم الغرفة">
                </div>
                <div class="col-md-6">
                  <input type="text" name="section" class="form-control" placeholder="رقم الشعبة">
                </div>
                <div class="col-md-6">
                  <select id="inputState" class="form-select" name="day" >
                    <option selected>اختر اليوم</option>
                    <option value="الأحد">الأحد</option>
                    <option value="الاثنين" >الاثنين</option>
                    <option value="الثلاثاء" >الثلاثاء</option>
                    <option value="الأربعاء" >الأربعاء</option>
                    <option value="الخميس" >الخميس</option>
                  </select>
                </div>
                  <div class="col-md-6">
                  <input type="text" name="startTime" class="form-control" placeholder="وقت بداية المحاضرة">
                </div>
                <div class="col-md-6">
                  <input type="text" name="endTime" class="form-control" placeholder="وقت نهاية المحاضرة">
                </div>
                   
             
                <div class="text-center">
                    <button type="submit" name="add" class="btn btn-primary">Submit</button>
                 
                </div>
              </form> <!-- End No Labels Form --> 
    

            </div>
          </div>

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