<!DOCTYPE html>
<html  lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درجةالحرارة و الرطوبة</title>

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
        </ul>
    </nav>

</header>

<!-- header section ends -->

<section class="home" id="home">

    <div class="content">

        <h1 dir="rtl">درجة الحرارة و الرطوبة</h1>
        <br>
        <br>
        <br>
        <br>
        <p  dir="rtl">من هنا تستطيع مراقبة درجة الحرارة أو درجة الرطوبة</p>
        <p  dir="rtl">  في المكان الذي يتوفر أدوات الإستشعار، راقب في أي مكان</p>
        <a href="#about" class="btn">درجة الحرارة </a>   <a href="#about" class="btn"> درجة الرطوبة</a>
    </div>

    <div class="image">
        <img src="images/Temp2.png" alt="">
    </div>

</section>

<!-- home section ends -->

<!-- about starts  -->

<section class="about" id="about">

    <div class="row">
        <div class="content">
            <h1 class="heading" dir="rtl">درجة الحرارة</h1>
            <br>
            <br>
            <br>
            <iframe width="430" height="260" style="border: 3px solid #184E77;" src="https://thingspeak.com/channels/2171597/charts/1?bgcolor=%23ffff&color=%2352B69A&dynamic=true&min=15&results=60&title=%D8%AF%D8%B1%D8%AC%D8%A9+%D8%A7%D9%84%D8%AD%D8%B1%D8%A7%D8%B1%D8%A9&type=spline&xaxis=%D8%A7%D9%84%D9%88%D9%82%D8%AA&yaxis=%D8%AF%D8%B1%D8%AC%D8%A9+%D8%A7%D9%84%D8%AD%D8%B1%D8%A7%D8%B1%D8%A9&yaxismin=15"></iframe>
            <iframe width="410" height="260" style="border: 3px solid #184E77;" src="https://thingspeak.com/channels/2171597/widgets/662538"></iframe>
            <iframe width="450" height="260" style="border: 3px solid #184E77;" src="https://thingspeak.com/channels/2171597/widgets/662544"></iframe>

              




        </div>
        
    </div>

</section>

<!-- About section ends -->














<!-- footer section starts  -->

<section class="footer" dir="rtl">

    <div class="box-container">



        <div class="box">
            <h3>موقعنا</h3>
            <a href="#">المملكة العربية السعودية</a>
     
        </div>

        <div class="box">
            <h3>الروابط السريعة</h3>
            <a href="#home" >الصفحة الرئيسية</a>
            <a href="#about">عن إلمام</a>
            <a href="#services">خدماتنا</a>
            <a href="register.php">التسجيل</a>  
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