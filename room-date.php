<!DOCTYPE html>
<html lang="ar">
<?php  include "base/session_checker.php";?>

<head>
    <?php include "base/head_imports.php"; ?>
<style>
    /* Center the charts and form */
    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
        margin: 0;
    }


    /* Style the form container */
    #chartForm {
        text-align: center;
    }

    /* Style radio buttons and labels */
    input[type="radio"] {
        margin: 0 10px;
    }

    label[for="roomG9"], label[for="roomG35"] {
        margin-right: 20px;
    }

    .radio-container {
        text-align: center;
        padding-bottom :20px;
    }

    /* Style radio buttons and labels */
    input[type="radio"] {
        margin: 0 10px;
    }

    /* Center-align the date container */
    .date-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-bottom :20px;
    }

    /* Style the date input */
    input[type="date"] {
        margin: 0 10px;
    }

    /* Style the "Show Charts" button */
    #showChartsButton {
        background-color: #1A759F;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    #showChartsButton:hover {
        background: #168AAD;
        border-color: #168AAD;
    }

    /* Style the charts container */
    #chartsContainer {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    }


    /* Style the "No data available" message */
    #noDataMessage {
        text-align: center;
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }

    /* Style the canvas elements */
    canvas {
        margin: 10px 0;
    }


</style>
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
        <h1>قراءات درجات الحرارة و الضوضاء </h1>
        <br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> غرف المبنى</li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">قراءات درجات الحرارة و الضوضاء</li>
            </ol>
            <br>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title"> درجة الحرارة الضوضاء</h5>
    <form id="chartForm">
        <!-- Create a container for the dropdown menu and its label -->
        <div class="radio-container">
            <label for="roomSelect">اختر الغرفة:</label>
            <select id="roomSelect" name="room">
                <option value="G9">G9</option>
                <option value="G35">G35</option>
            </select>
        </div>

        <!-- Create a container for the date label and input -->
        <div class="date-container">
            <label for="date">اختر تاريخ:</label>
            <input type="date" id="date" name="date">
        </div>

        <input type="button" id="showChartsButton" value="أظهر الرسم البياني">
    </form>

    <div id="chartsContainer">
        <div style="width: 50%;">
            <canvas id="temperatureChart"></canvas>
        </div>

        <div style="width: 50%;">
            <canvas id="noiseChart"></canvas>
        </div>
    </div>

    <div id="noDataMessage" style="display: none;">
        لايوجد بيانات للغرفة المختارة في هذا التاريخ.
    </div>          
        </div><!-- End Recent Sales -->
        </div><!-- End Right side columns -->
    </section>
</main>
<!-- End Main -->


<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->

<!-- Vendor JS Files -->
<?php include "base/js_imports.php"; ?>
<!-- End JS Files -->

<script>
        var temperatureChart = null;
        var noiseChart = null;
    
        $(document).ready(function () {
    $("#chartsContainer").hide();

    $("#showChartsButton").click(function () {
        var room = $("#roomSelect").val(); // Get the selected room from the dropdown
        var date = $("#date").val();

        // Check if room and date are selected
        if (!room || !date) {
            $("#chartsContainer").hide();
            $("#noDataMessage").text("الرجاء تحديد الغرفة والتاريخ.");
            $("#noDataMessage").show();
        } else {
            $("#noDataMessage").hide();
            updateCharts(room, date);
        }
    });
});

    
        function formatTimeTo12Hour(time) {
            var date = new Date("1970-01-01 " + time);
            return date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
        }
    
        function updateCharts(room, date) {
    if (!room || !date) {
        // If room or date is not selected, show a message
        $("#chartsContainer").hide();
        $("#noDataMessage").text("الرجاء تحديد الغرفة والتاريخ.");
        $("#noDataMessage").show();
        return; // Exit the function early
    }

    if (temperatureChart) {
        temperatureChart.destroy(); // Destroy the existing chart
    }
    if (noiseChart) {
        noiseChart.destroy(); // Destroy the existing chart
    }

    $.ajax({
        type: "POST",
        url: "chart_display.php",
        data: { room: room, date: date },
        success: function (data) {
            if (data === '.لايوجد بيانات للغرفة المختارة في هذا التاريخ') {
                // If there is no data for the selected date, show a message
                $("#chartsContainer").hide();
                $("#noDataMessage").text(data);
                $("#noDataMessage").show();
            } else {
                // If there is data, hide the message and update the charts
                $("#noDataMessage").hide();
                var jsonData = JSON.parse(data);
                var temperatureData = jsonData.temperatureData;
                var noiseData = jsonData.noiseData;

                temperatureData.labels = temperatureData.labels.map(formatTimeTo12Hour);
                noiseData.labels = noiseData.labels.map(formatTimeTo12Hour);

                var temperatureChartCanvas = document.getElementById('temperatureChart');
                var noiseChartCanvas = document.getElementById('noiseChart');

                temperatureChart = new Chart(temperatureChartCanvas.getContext('2d'), {
                    type: 'line',
                    data: temperatureData,
                });

                noiseChart = new Chart(noiseChartCanvas.getContext('2d'), {
                    type: 'line',
                    data: noiseData,
                });

                $("#chartsContainer").show();
            }
        }
    });
}

    </script>



</body>
</html>
