<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; 
include "base/session_checker.php";?>

<head>
    <?php include "base/head_imports.php"; ?>
    <link href="assets/css/room.css" rel="stylesheet">
</head>
 

<body>
 <!-- ======= Header ======= -->
<?php include "base/header.php"; ?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php include "base/sidebar.php"; ?>
<!-- End Sidebar-->

<!-- ======= Main ======= -->
<main id="main" class="main" dir="rtl">

    <div class="pagetitle">
      <h1>استغلال الغرف</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="room-info.php">غرف </a></li>
          <li class="breadcrumb-item">المبنى</li>
          <li class="breadcrumb-item active">الغرف المستغلة حسب الضوضاء والجدول الدراسي</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">جدول الغرف</h5>
              
              <!--table------------------------------------------------------------------------------>            
     <div class="content">
        <div class="container">
            <table class="table table-striped table-class" id="table-id">
                <thead>
                    <tr>
                        <th>الأسم</th>
                        <th>الحجز</th>
                    </tr>
                </thead>
                <tbody id="room-status">
           
                </tbody>
            </table>
        
        </div>
        <!-- End of Container -->
    </div>
</section>

</main>
<!-- End Main -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->


<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>   
<?php include "base/js_imports.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        function updateRoomAvailability() {
            $.ajax({
                type: "GET",
                url: "get_room_availability.php",
                success: function(data) {
                    $("#room-status").html(data);
                }
            });
        }

        function updateCurrentTimeAndDay() {
            $.ajax({
                type: "GET",
                url: "get_time_and_day.php",
                dataType: "json",
                success: function(data) {
                    $("#current-time").text(data.time);
                    $("#current-day").text(data.day);
                }
            });
        }

        $(document).ready(function() {
            updateRoomAvailability();
            updateCurrentTimeAndDay();

            setInterval(updateRoomAvailability, 1000); // Update every second
            setInterval(updateCurrentTimeAndDay, 1000); // Update every second
        });
    </script>

</body>

</html>