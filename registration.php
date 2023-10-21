<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: login.php");
}
include 'DB.php';
?>
<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>تسجيل جديد</title>
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
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="home.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/elmam-logo.png" alt="">
                  <span class="d-none d-lg-block">إلمــام - Elmam</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">إنشاء حساب</h5>
                    <p class="text-center small">أدخل المعلومات التالية</p>
                  </div>

                    <form action="registration.php" method="post" class="row g-3" >
                    <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           $passwordHash = sha1($password); 
          
         
           $errors = array();
         
            
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"<div dir='rtl' class='required'>جميع البيانات مطلوبة</div>");
           }
           if (!empty($email)) 
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, " <div dir='rtl' class='notvalid'>البريد الإلكتروني غير صالح</div>");
           }
           if (!empty($password)) {
           if (strlen($password)<8) {
            array_push($errors,"<div dir='rtl' class='password'>يجب أن تتكون كلمة المرور من ثمانية أحرف على الأقل</div>");
           }}
           if ($password!==$passwordRepeat) {
            array_push($errors,"<div dir='rtl' class='password'>كلمة المرور غير متطابقة</div>");
           }
           require_once "DB.php";
           $sql = "SELECT * FROM manager WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"<div dir='rtl' class='email'>البريد الإلكتروني موجود بالفعل</div>");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo  "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO manager ( name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div dir='rtl' class='alert alert-success'>لقد تم تسجيلك بنجاح</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>  
                    <div class="col-12">
                      <label for="yourName" class="form-label">الإسم</label>
                      <input type="text" name="fullname" class="form-control" id="yourName" > 
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">الإيميل</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" >
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">كلمة المرور</label>
                      <input type="password" name="password" class="form-control" id="yourPassword">
                    </div>
                        
                     <div class="col-12">
                      <label for="yourPassword" class="form-label">إعادة كلمة المرور</label>
                      <input type="password" name="repeat_password" class="form-control" id="yourPassword">
                    </div>

                 
                    <div class="col-12">
                        <input class="btn btn-primary w-100" type="submit" name="submit" value="إنشاء الحساب">
                    </div>
                        
                    <div class="col-12">
                      <p class="small mb-0">هل لديك حساب؟<a href="login.php">تسجيل الدخول</a></p>
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