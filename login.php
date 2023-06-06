<?php
include "DB.php";
session_start();
if (isset($_SESSION["user"])) {
   header("Location: Manager.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

     <!-- font awesome cdn link  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <link rel="stylesheet"  integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/reg-log.css">

</head>
</head>
<body>
      
<!-- header section starts  -->

<header>

    <a href="#" class="logo"><img src="images/elmam-logo.png" width="110"></a>

    <div id="menu" class="fas fa-bars"></div>

    <nav class="navbar">
        <ul>
            <li><a class="active" href="index.php">الصفحة الرئيسية</a></li>
        </ul>
    </nav>

</header>

    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"]; 
           
            $sql = " SELECT * FROM manager WHERE email = '$email' && password = '$password' ";
            $result = mysqli_query($conn, $sql);
 
             if (empty($email) OR empty($password) ) 
             { echo "<div dir='rtl' class='alert2'>جميع البيانات مطلوبة</div>"; }
             
             else  
                //here i will check user input .....
              if(mysqli_num_rows($result) > 0) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: Manager.php");
                    die();
        } else
            { echo "<div dir='rtl'  class='alert2'>كلمة المرور أو البريد الإلكتروني غير صحيح</div>"; }
        }
           
          

        
              
    
           /* if ($user) {
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
        } */
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