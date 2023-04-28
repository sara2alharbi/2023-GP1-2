<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index2.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التسجيل</title>

     <!-- font awesome cdn link  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <link rel="stylesheet"  integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
      
<!-- header section starts  -->

<header class="header">

<a href="#" class="logo">إلـ<span>مــام</span></a>

<nav class="navbar">
<a href="index.php">الرئيسية</a>
   <a href="index.php #about">من نحن</a>
   <a href="index.php #services">خدماتنا</a>
   <a href="index.php #contact">تواصل معنا</a>
</nav>

<div class="icons">
   <div id="menu-btn" class="fas fa-bars"></div>
</div> <!--div-->
</header>

<div class="contact-info">

   <div id="close-contact-info" class="fas fa-times"></div>

   <div class="info">
      <i class="fas fa-phone"></i>
      <h3>رقم الجوال</h3>
      <p>+123-456-7890</p>
      <p>+111-222-3333</p>
   </div>

   <div class="info">
      <i class="fas fa-envelope"></i>
      <h3>البريد الإلكتروني</h3>
      <p>Elmam@gmail.com</p>
      <p>El-mam@gmail.com</p>
   </div>

   <div class="info">
      <i class="fas fa-map-marker-alt"></i>
      <h3>الموقع الرئيسي</h3>
      <p>المملكة العربية السعودية ،الرياض  </p>
   </div>

   <div class="share">
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
   </div>

</div>

    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"<div class='required'>All fields are required.</div>");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, " <div class='notvalid'>Email is not valid.</div>");
           }
           if (strlen($password)<8) {
            array_push($errors,"<div class='password'> Password must be at least 8 charactes long.</div>");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"<div class='password'>Password does not match.</div>");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"<div class='email'>Email already exists!</div>");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        <section class="register" id="register">
        <h1 class="heading1"> تسجيل جديد</h1>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="الاسم">
            </div>
            <div class="form-group">
                <input type="emamil" class="form-control" name="email" placeholder="البريد الإلكتروني">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="كلمة المرور">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder=" إعادة كلمة المرور">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="التسجبل" name="submit">
            </div>
        </form>
        <div>
        <div class="log-in" ><p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p></div>
      </div>
    </div>
    </section>

    
<!-- footer section starts  -->

<section class="footer">

<div class="links">
<a class="btn" href="index.php">الرئيسية</a>
    <a class="btn" href="index.php #about">من نحن</a>
    <a class="btn" href="index.php #services">خدماتنا</a>
    <a class="btn" href="index.php #contact">تواصل معنا</a>
</div>

<div class="credit"> created by <span>Elmam team</span> | all rights reserved! </div>

</section>

<!-- footer section ends -->


</body>
</html>