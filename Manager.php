<!DOCTYPE html>
<html  lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية </title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/style.css"> 

</head>
<body>
    
<!-- header section starts  -->

<header>

    <a href="#" class="logo"><img src="images/elmam-logo.png" width="110"></a>

    <div id="menu" class="fas fa-bars"></div>

    <nav class="navbar">
        <ul>
            <li><a href="#services">القائمة</a></li>
            <li ><a href="index.php" id="reg">تسجيل الخروج</a></li>
        </ul>
    </nav>

</header>

<!-- header section ends -->

<!-- home section starts  -->
<section class="home" id="home">

    <div class="content">

        <h1 dir="rtl">مرحبا بك في نظام إلـمـام</h1>
        <br>
        <h3 dir="rtl" lang="ar">تمتع بمراقبة بيئة مبناك الداخلية</h3>
        <br>
        <br>
        <br>
        <p  dir="rtl">أهلًا بك في إلـمـام المخصص لمراقبة البيئة الداخلية تستطيع مراقبة درجة</p>
        <p  dir="rtl">      الحرارة و جودة الهواء و مستوى الصوت في المبنى،أيضا عرض تقارير عن </p>
        <p  dir="rtl">  مبناك ، ومعرفة جميع الغرف المتاحة ،بالإضافة إلى عرض خريطة للمبنى</p>
        <a href="#services" class="btn">اختر من القائمة</a>
    </div>

    <div class="image">
        <img src="images/banner.png" alt="">
    </div>

</section>

<!-- home section ends -->

<!--services-->
<section class="services" id="services">

    <h1 class="heading">  القائمة</h1>

    <div class="box-container">

        <div class="box" >
            <br>
            <a href = ""><img src="images/sound.png" alt=""></a>
            <a href = ""><h3>راقب مستوى الضوضاء</h3></a>
            <br>
        </div>

        <div class="box">
            <br>
            <a href = ""><img src="images/air.png" alt=""></a>
            <a href = ""><h3>راقب جودة الهواء </h3></a>
            <br> 
        </div>

        <div class="box">
            <br>
            <a href="Tempreture.php" ><img src="images/temp.png" alt=""></a>
            <a href="Tempreture.php" ><h3>راقب درجة الحرارة</h3></a>
            <br>
        </div>

        <div class="box">
            <br>
            <a href = ""><img src="images/report.png" alt=""></a>
            <a href = ""><h3>اعرض تقارير للمبنى</h3></a>
            <br><br><br>
        </div>

        <div class="box">
            <br>
            <a href = ""><img src="images/map.png" alt=""></a>
            <a href = ""><h3> اعرض خريطة للمبنى</h3></a>
            <br><br><br>
        </div>

        <div class="box">
            <br>
            <a href = ""><img src="images/aviliable.png" alt=""></a>
            <a href = ""><h3> اعرض الغرف المتاحة في المبنى</h3></a>
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