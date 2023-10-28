<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; 
include "base/session_checker.php";?>

<head>
<?php include "base/head_imports.php"; ?>
<link href="assets/css/report.css" rel="stylesheet">
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
      <h1> التقارير </h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="report.php"> تقارير أسبوعية</a></li>
          <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active"> حسب الغرفة</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
      <div class="form-container">
      <div class="card info-card sales-card">
    <h5>اختر الغرفة للحصول على التقرير الإسبوعي</h5> 
    <br><br>
    <form method="post" action="generate_report.php" id="report-form">
    <div class="label-select-container">
    <label for="room" class="label">اختر الغرفة:</label>
        <select name="room" id="room" class="select">
            <option value="G9">G9</option>
            <option value="G35">G35</option>
        </select>
    </div>
        <button type="submit" class="button">اختيار</button>
    </form>
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