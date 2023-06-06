<!DOCTYPE html>
<html  lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقارير المبنى</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/style.css"> 

</head>
<body>
    
<!-- header section starts  -->

<header>

    <a href="Manager.php" class="logo"><img src="images/elmam-logo.png" width="110"></a>

    <div id="menu" class="fas fa-bars"></div>

    <nav class="navbar">
        <ul>
            <li><a class="active" href="Manager.php">القائمة </a></li>
            <li ><a href="logout.php" id="reg">تسجيل الخروج</a></li>
        </ul>
    </nav>

</header>

<!-- header section ends -->

<section class="home" id="home">

    <div class="content">

        <h1 dir="rtl"> تقارير المبنى </h1>
        <br>
        <br>
        <br>
        <br>
        <p  dir="rtl">من هنا تستطيع الحصول على تقارير القاعات والغرف المتوفرة في المبنى  </p>
        <p  dir="rtl">في المكان التي تتوفر فيه أدوات الإستشعار</p>
        <a href="#about" class="btn">اعرض</a>   
    </div>

    <div class="image">
        <img src="images/report2.png" alt="map">
    </div>

</section>

<!-- home section ends -->

<!-- air quality  starts  -->

<section class="about" id="about">

    <div class="row">
        <div class="content">
            <h1 class="heading" dir="rtl"> تقارير المبنى </h1>
            <br><br><br><br>

        </div>
    </div>
</section>

<!-- air quality ends  -->

<!-- footer section starts  -->

<section class="footer" dir="rtl">

    <div class="box-container">



        <div class="box">
            <h3>موقعنا</h3>
            <a href="#">المملكة العربية السعودية</a>
     
        </div>

        <div class="box">
            <h3>الروابط السريعة</h3>
            <a href="Manager.php" >الصفحة الرئيسية</a>
            <a href="index.php">عن إلمام</a>
            <a href="index.php">خدماتنا</a>
            <a href="registration.php">التسجيل</a>  
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

<!-- scroll top  -->

<a href="#home" class="scroll-top">
    <img src="images/office-building.png" alt="">
</a>


<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom js file link  -->
<script src="javaScript/script.js"></script>


</body>
</html>