<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index2.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل جديد</title>

     <!-- font awesome cdn link  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <link rel="stylesheet"  integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>
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
    </div>
</header>

    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index2.php");
                    die();
                }else{
                    echo "<div class='alert2'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert2'>Email does not match</div>";
            }
        }
        ?>
        <section class="register" id="register">
        <h1 class="heading1"> تسجيل الدخول</h1>
      <form action="login.php" method="post">
        <div class="form-group">
            <input type="email" placeholder="البريد الإلكتروني" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="كلمة المرور" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="الدخول" name="login" class="btn btn-primary">
        </div>
      </form>
     <div class ="registeration" ><p>ليس لديك حساب؟ <a href="registration.php">سجل الآن</a></p></div>
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