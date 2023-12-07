<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; 
include "base/session_checker.php";?>

<head>
    <?php include "base/head_imports.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
      <h1> التنبيهات</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a> التنبيهات السابقة  </a></li>
          <li class="breadcrumb-item"></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <section class="section dashboard">
      <!-- Add this table to your HTML -->
<table class="table" id="alerts-table">
  <thead>
    <tr>
      <th>التاريخ</th>
      <th>الوقت</th>
      <th>الغرفة</th>
      <th>حذف</th>
    </tr>
  </thead>
  <tbody>
    <!-- Table rows will be dynamically added here -->
  </tbody>
</table>

    </section>

</main><!-- End Main -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->

<!-- Vendor JS Files -->
<?php include "base/js_imports.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- End JS Files -->




</body>
</html>