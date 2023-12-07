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
        <!-- Container to display the table -->
<div id="previous-notifications-container"></div>

<!-- JavaScript to update the table every 5 minutes -->
<script>
    // Function to update the table every 5 minutes
    function updateTable() {
        $('#previous-notifications-container').load('notification/previous_notifications.php');
    }

    // Periodically update the table (every 5 minutes)
    setInterval(function () {
        updateTable();
    }, 300000); // 300,000 milliseconds = 5 minutes

    // Initial update when the page loads
    $(document).ready(function () {
        updateTable();
    });
</script>

    
    </section>

</main><!-- End Main -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->

<!-- Vendor JS Files -->
<?php include "base/js_imports.php"; ?>
<!-- End JS Files -->




</body>
</html>