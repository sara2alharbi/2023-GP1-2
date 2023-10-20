<!DOCTYPE html>
<html lang="ar">

<?php include "DB.php"; 
include "base/session_checker.php";?>

<head>
    <?php include "base/head_imports.php"; ?>
</head>

<body>

<!-- ======= Header ======= -->
<?php include "base/header.php"; ?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php include "base/sidebar.php"; ?>
<!-- End Sidebar-->

<!-- ======= Main ======= -->
<main id="main" class="main">

    <div class="pagetitle">
      <h1>معلومات التواصل</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="contact.php">للتواصل</a></li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section contact">

      <div class="row gy-4">

        <div class="col-xl-6">

          <div class="row">
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-geo-alt"></i>
                <h3>الموقع</h3>
                <p>المملكة العربية السعودية،الرياض</p>
                <br>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-telephone"></i>
                <h3>للإتصال</h3>
                <p dir="rtl">+966 568346791 <br>+966 544387612</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-envelope"></i>
                <h3>البريد الإلكتروني</h3>
                <p>elmamGP1@gmail.com</p>
                <br>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-clock"></i>
                <h3>أوقات التواصل</h3>
                <p>الأحد - الخميس<br>9:00AM - 08:00PM</p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section>

</main>
<!-- End Main -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->

<!-- Vendor JS Files -->
<?php include "base/js_imports.php"; ?>
<!-- End JS Files -->

</body>
</html>