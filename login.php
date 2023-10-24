<?php
include "DB.php";
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
$msg = "";

if (isset($_POST["login"])) 
{
   $email = $_POST["email"];
   $password = $_POST["password"]; 
   $passwordHash = sha1($password); 
   
   $sql = "SELECT * FROM manager WHERE email = '$email' && password = '$passwordHash'";
   $result = mysqli_query($conn, $sql);

   if (empty($email) OR empty($password)) {  
      $msg = "<div dir='rtl' class='alert alert-danger'>جميع البيانات مطلوبة</div>";
   } else { 
      if(mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         $_SESSION["user"] = $row["name"]; // Set $_SESSION["user"] to the user's name
         $_SESSION["email"] = $row["email"]; // Set $_SESSION["email"] to the user's email
         header("Location: index.php");
         die();
      } else {
         $msg = "<div class='alert alert-danger redAlr' role='alert'>كلمة المرور أو البريد الإلكتروني غير صحيح</div>";
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>تسجيل الدخول</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/elmam-logo.png" rel="icon">

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
  <link href="assets/css/style1_home.css" rel="stylesheet">

</head>
<body>
<header id="header" class="d-flex flex-column justify-content-center">
     
  
     <nav id="navbar" class="navbar nav-menu">
   
       <ul>
         <li><a href="home.html #hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>الرئيسية</span></a></li>
         <li><a href="home.html #about" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>من نحن</span></a></li>
         <li><a href="home.html #services" class="nav-link scrollto"><i class="bx bx-server"></i> <span>خدماتنا</span></a></li>
       </ul>
     </nav><!-- .nav-menu -->
 
   </header><!-- End Header -->
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">تسجيل الدخول</h5>
                    <p class="text-center small">أدخل الإسم وكلمة المرور</p>
                  </div>

                  <form action="login.php" method="post" class="row g-3">
                    <div class="col-12">
                      <?php echo $msg; // Place the error message here ?>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">الإسم</label>
                      <input type="text" name="email" class="form-control" id="yourUsername">
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">كلمة المرور</label>
                      <input type="password" name="password" class="form-control" id="yourPassword">
                    </div>

                    <div class="col-12">
                      <input class="btn btn-primary w-100" type="submit" name="login" value="تسجيل الدخول">
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">ليس لديك حساب؟ <a href="registration.php">سجل الآن</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

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