<!DOCTYPE html>
<html lang="en">
    <?php
    include('DB.php');?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التسجيل</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
    crossorigin="anonymous">
    
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="reg.css"> 

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

<!-- header section ends--------------------------------------------------------- -->

<div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="signup-process.php" method="post">
                <h1>أنشاء حساب جديد</h1>

                <input dir='rtl' name="name" type="text" placeholder="الأسم" required/>
                <input dir='rtl' name="email" type="email" placeholder="الإيميل" required/>
                <input dir='rtl' name="password" type="password" placeholder="كلمة المرور" requierd/>
                <button>تسجيل</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="post">
                <h1>تسجيل الدخول</h1>

              
                <input dir="rtl" name="email" type="email" placeholder="الإيميل" requierd/>
                <input dir="rtl" name="password" type="password" placeholder="كلمة المرور" requierd/>
                <a href="#">هل نسيت كلمة المرور؟</a>
                <?php
      if(isset($_POST['login'])){
        $query = mysqli_query($con, "SELECT * from user where email='{$_POST['email']}'");
        if(trim($_POST['email'])=='' || trim($_POST['password'])==''){
          echo "<h2 style='color:red;' dir='rtl;'>لم يتم ادخال بعض أو كل المدخلات</h2>";
        }
        else if(!strpos($_POST['email'], '@')){
          echo " <h2 style='color:red;'' dir='rtl;' >  الايميل غير صحيح</h2>";
        }
        else if(mysqli_num_rows($query) == 0){
          echo "<h2 style='color:red;' ' dir='rtl;'> الايميل أو كلمة المرور غير صحيحه </h2>";
        }
        else if(mysqli_fetch_assoc($query)['Password'] != $_POST['password']){
          echo "<h2 style='color:red;' ' dir='rtl;' > الايميل أو كلمة المرور غير صحيحه</h2>";
        }
        else{
          session_start();
          $_SESSION['admin'] = true;
          header("location:homePage.php");//مهممممممممممممممممممممممممممممممممممممممممه
        }
      }
      ?>
                <button name="login" type="submit">تسجيل دخول</button>
                
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>! أهلا بعودتك</h1>
                    <p>لتبقى على تواصل معنا قم بتسجيل الدخول</p>
                    <button class="ghost" id="signIn">تسجيل الدخول</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>! أهلا بك</h1>
                    <p>سجل معلوماتك للبدأ باستخدام نظام إلمام</p>
                    <button class="ghost" id="signUp">تسجيل مستخدم جديد</button>
                </div>
            </div>
        </div>
    <?php
                if(isset($_GET['msg']) && !empty($_GET['msg'])){
                  if ($_GET['msg'] == 'عذرا الحساب مسجل') echo '<script>alert("sorry .... email already exist")</script>';
                }
            ?>
    </div>





<!-- footer section starts --> 

<section class="footer" dir="rtl">

    <div class="box-container">



        <div class="box">
            <h3>موقعنا</h3>
            <a href="#">المملكة العربية السعودية</a>
     
        </div>

        <div class="box">
            <h3>الروابط السريعة</h3>
            <a href="#">الصفحة الرئيسية</a>
            <a href="#">عن إلمام</a>
            <a href="#">خدماتنا</a>
            <a href="#">التسجيل</a>
           
           
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
    <img src="images/scroll-img.png" alt="">
</a>




<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom js file link  -->
<script src="script.js"></script>


</body>
</html>