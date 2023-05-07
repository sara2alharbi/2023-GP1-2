<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Elmam - إلـمـام</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->

<header class="header">

   <a href="#" class="logo">إلـ<span>مــام</span></a>

   <nav class="navbar">
      <a href="#home">الرئيسية </a>
      <a href="#about">من نحن</a>
      <a href="#services">خدماتنا</a>
      <a href="#contact">تواصل معنا</a> 
   </nav>

   <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
      <div id="info-btn" class="fas fa-info-circle"></div>
      <div id="search-btn" class="fas fa-search"></div>
      <a  href="registration.php"><div id="login-btn"  class="fas fa-user"></div></a>

   

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
      <a href="https://twitter.com/elmam_sa?s=11&t=bQf4d5cu-HYAhb1QcYfSJQ" class="fab fa-twitter"></a>
      <a href="https://instagram.com/elmam_sa?igshid=YmMyMTA2M2Y=" class="fab fa-instagram"></a>
   </div>

</div>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <section class="swiper-slide slide" style="background: url(images/home-slide-1.jpg) no-repeat;">
            <div class="content">
               <h3>نوفر أفضل الخدمات</h3>
               <p>تمتع بمراقبة درجة الحرارةو جودة الهواء في أي وقت تريده</p>
               <a href="#about" class="btn">get started</a>
            </div>
         </section>

         <section class="swiper-slide slide" style="background: url(images/home-slide-2.jpg) no-repeat;">
            <div class="content">
               <h3>راحتك هدفنا</h3>
               <p>تمتع بالحصول على تقارير ملخصة لحالة المبنى</p>
               <a href="#about" class="btn">get started</a>
            </div>
         </section>

         <section class="swiper-slide slide" style="background: url(images/home-slide-4.jpg) no-repeat;">
            <div class="content">
               <h3>راحة العميل أولويتنا</h3>
               <p>نقدم جميع خدماتنا دون إنتهاك خصوصية الزائر </p>
               <a href="#about" class="btn">get started</a>
            </div>
         </section>

      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

   <h1 class="heading"> من نحن </h1>

   <div class="row">

      <div class="video">
      <img src="images/OFAF.gif" >
      </div>

      <div class="content">
         <h3>سنقدم لك أفضل الخدمات</h3>
         <p>نحن فريق إلمام ،إلمام هو نظام لإدارة مبناك بشكل آمن وسليم نحن نعمل على مراقبة درجة الحرارة وجودة الهواء في الغرف داخل المبنى،حيث نقوم بذلك دون المساس بخصوصية الزائر . نقدم أفضل الخدمات وأجدد التقنيات .لأن راحتك هي هدفنا</p>
         <a href="https://youtu.be/JAMxqWVDJUE" class="btn">أعرف أكثر</a>
      </div>
   </div>

</section>

<!-- about section ends -->

<!-- services section starts  -->

<section class="services" id="services">

   <h1 class="heading"> خدماتنا </h1>

   <div class="box-container">

      <div class="box">
         <img src="images/temp.png" alt="">
         <h3>مراقبة درجة الحرارة</h3>
         <p>نعمل على مراقبة درجة الحرارة من خلال مستشعرات خاصة،لنمكن الزوار من أخذ كافة راحتهم في المبنى</p>
      </div>

      <div class="box">
         <img src="images/air.png" alt="">
         <h3>مراقبة جودة الهواء</h3>
         <p> نعمل على مراقبة جودة الهواء في المبنى من خلال مستشعرات خاصة بالهواء، لضمان المحافظة على صحة زوار المبنى</p>
      </div>

      <div class="box">
         <img src="images/sound.png" alt="">
         <h3>مراقبة الأصوات</h3>
         <p>نستخدم أفضل الحسسات لمراقبة الأصوات داخل الغرفةحيث نستطيع معرفة حالة الغرفة مشغولة/متاحة،مع المحافظة على سرية وخصوصية الزائر</p>
      </div>

      <div class="box">
         <img src="images/report.png" alt="">
         <h3>تقارير للمبنى</h3>
         <p>توفير تقارير ملخصة خاصة بالمبنى،تقدم معلومات عن حالة درجات الحرارة ،جودة الهواء </p>
      </div>
         
      <div class="box" >
  
         <img src="images/map.png" alt="">
         <h3>عرض خريطة للمبنى</h3>
         <p>نوفر خريطة لمداخل ومخارج المبنى و أماكن الغرف المتواجدة داخل المبنى</p>
      </div>

      <div class="box" >
         <img src="images/aviliable.png" alt="">
         <h3>عرض الغرف المتاحة في المبنى</h3>
         <p>من خلال مستشعراتنا نستطيع توفير الجهد على مدير المبنى حيث يستطيع معرفة الغرف المتاحة في وقت معين</p>
      </div>

      <div class="box">
         <img src="images/privacy.png" alt="">
         <h3>الحفاظ على الخصوصية</h3>
         <p>لإن راحة الزائر هي هدفنا فنحن نعمل على تحقيق جميع خدماتنا دون إنتهاك خصوصية الزائر</p>
      </div>

</div>
 

</section>

<!-- services section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

   <h1 class="heading"> تواصل معنا </h1>
       
   <div class="row">
   <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3625.259453809475!2d46.6874779096292!3d24.683606252222376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f0342a9c00041%3A0xe7779cb0651ac00a!2sOlaya%20St%2C%20Al%20Olaya%2C%20Riyadh%2012211!5e0!3m2!1sen!2ssa!4v1682633395306!5m2!1sen!2ssa"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
     
      
      <form action="">
 <h3>ابقى على تواصل</h3>
         <input type="text" placeholder="الإسم" class="box">
         <input type="email" placeholder="البريد الإلكتروني" class="box">
         <input type="number" placeholder="رقم الجوال" class="box">
         <textarea name="" placeholder="الرسالة" class="box" id="" cols="30" rows="10"></textarea>
         <input type="submit" value="أرسل" class="btn">
      </form>

   </div>

</section>

<!-- contact section ends -->

<!-- footer section starts  -->

<section class="footer">

   <div class="links">
      <a class="btn" href="#home">الرئيسية</a>
      <a class="btn" href="#about">من نحن</a>
      <a class="btn" href="#services">خدماتنا</a>
      <a class="btn" href="#contact">تواصل معنا</a>
   </div>

   <div class="credit"> created by <span>Elmam team</span> | all rights reserved! </div>

</section>

<!-- footer section ends -->









<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

lightGallery(document.querySelector('.projects .box-container'));

</script>

</body>
</html>