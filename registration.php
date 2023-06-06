<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: login.php");
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
    <link rel="stylesheet" href="CSS/reg-log.css">

</head>
<body>
      
<!-- header section starts  -->

<header>

    <a href="index.php" class="logo"><img src="images/elmam-logo.png" width="110"></a>

    <div id="menu" class="fas fa-bars"></div>

    <nav class="navbar">
        <ul>
            <li><a class="active" href="index.php">الصفحة الرئيسية</a></li>
        </ul>
    </nav>

</header>

<!-- header section ends -->


    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
          

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"<div dir='rtl' class='required'>جميع البيانات مطلوبة</div>");
           }
           if (!empty($email)) 
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, " <div dir='rtl' class='notvalid'>البريد الإلكتروني غير صالح</div>");
           }
           if (strlen($password)<8) {
            array_push($errors,"<div dir='rtl' class='password'>يجب أن تتكون كلمة المرور من ثمانية أحرف على الأقل</div>");
           }
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
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO manager ( name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"ssi",$fullName, $email, $password);
                mysqli_stmt_execute($stmt);
                echo "<div dir='rtl' class='success'>لقد تم تسجيلك بنجاح</div>";
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

<section class="footer" dir="rtl">

    <div class="box-container">



        <div class="box">
            <h3>موقعنا</h3>
            <a href="#">المملكة العربية السعودية</a>
     
        </div>

        <div class="box">
            <h3>الروابط السريعة</h3>
            <a href="index.php" >الصفحة الرئيسية</a>
            

        </div>

        <div class="box">
            <h3>معلومات التواصل</h3>
            <p> <i class="fas fa-envelope"></i> ElmamProject1@gmail.com</p>
            <p> <i class="fas fa-map-marker-alt"></i>   المملكة العربيه السعودية - الرياض  - 12314 </p>
            <div class="share">
                <a href="https://www.youtube.com/@1Elmam" class="fab fa-youtube"></a>
                <a href="https://twitter.com/elmam_sa?s=11&t=bQf4d5cu-HYAhb1QcYfSJQ" class="fab fa-twitter"></a>
                <a href="https://instagram.com/elmam_sa?igshid=YmMyMTA2M2Y=" class="fab fa-instagram"></a>
            </div>
        </div>

    </div>

    <h1 class="credit">  جميع الحقوق محفوظة   <a href="#">©2023</a></h1>

</section>

<!-- footer section ends -->


</body>
</html>