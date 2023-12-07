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
      <h1>مراقبة حالة الغرفة</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">غرف المبنى</li>
          <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">مراقبة حالة الغرفة</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <br>
    <form method="post">
        <label for="roomSelect" class="subHeader1">اختر الغرفة :</label>&nbsp;&nbsp;
    <select name="roomSelect" id="roomSelect">
        <option value="ESP12F">G9</option>
        <option value="ESP12E">G35</option>
    </select>&nbsp; <br> <br>
  <!--  <input type="submit" name="submit" value="اعرض البيانات">-->
   </form>
    <br>
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="d-flex justify-content-center align-items-center">
          <div class="row">

            <!-- noise Card -->
            <div class="col-xxl-6 col-md-5">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title subHeader2">الضوضاء <span>| الآن</span></h5>
                  <p class="infoo">أعلى قيمة للضوضاء داخل الغرف <span class="redd">30</span> ديسيبل</p>
 <br>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> 
                      <i class="bi bi-volume-up-fill"></i>
                      
                    </div> &nbsp;&nbsp;
                    <div class="ps-3">
                      <h6 id="viewNoise"></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End noise Card -->

            <!-- air Card -->
            <div class="col-xxl-6 col-md-5">
              <div class="card info-card sales-card">

                

                <div class="card-body">
                  <h5 class="card-title subHeader2">جودة الهواء <span>| الآن</span></h5>
                  <p  class="infoo">تتأثر بوجود <span class="redd"> الكحول - الغاز - أو الدخان </span></p>
 <br>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cloud-fog2"></i>
                    </div> &nbsp;&nbsp;
                    <div class="ps-3">
                      <h6 id="viewAir"></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End air Card -->

            <!-- humidity Card -->
            <div class="col-xxl-6 col-md-5">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title subHeader2"> درجة الرطوبة <span>| الآن </span></h5>
                  <p  class="infoo">يتراوح نطاق الرطوبة الداخلي المثالي تبدأ من <span class="greenn">40 جم / م 3.</span></p>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-moisture"></i>
                    </div> &nbsp;&nbsp;
                    <div class="ps-3">
                      <h6 id="viewHum"></h6>
                     
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End humidity Card -->

            <!-- temp Card -->
            <div class="col-xxl-6 col-md-5">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title subHeader2">درجة الحرارة <span>| الآن </span></h5>
                  <p  class="infoo">درجة حرارة الغرفة المريحة لمعظم الناس عادة ما تكون بين <span class="greenn" >18-25 درجة مئوية </span></p>
                  <br>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-thermometer-sun"></i>
                    </div>&nbsp;&nbsp;
                    <div class="ps-3">
                    <h6 id="viewTemp"></h6>
                    <script>
    // JavaScript code to display live data
    document.addEventListener('DOMContentLoaded', function () {
    const textViewTemp = document.getElementById('viewTemp');
    const textViewHum = document.getElementById('viewHum');
    const textViewNoise = document.getElementById('viewNoise');
    const textViewAir = document.getElementById('viewAir');

    setInterval(function () {
        fetch('live_data.php', {
            method: 'POST',
            body: new URLSearchParams({
                'submit': true,
                'roomSelect': document.getElementById('roomSelect').value
            })
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            // Update the displayed values with live data
            textViewTemp.textContent = data.viewTemp;
            textViewHum.textContent =  data.viewHum;
            textViewNoise.textContent = data.viewNoise;

            if (isNaN(data.viewTemp) || isNaN(data.viewHum) || isNaN(data.viewNoise)  ) {
              textViewTemp.textContent = 'لاتوجد قيمة';
              textViewHum.textContent = 'لاتوجد قيمة';
              textViewNoise.textContent = 'لاتوجد قيمة';
                }

            // Handle air quality display
            if (data.viewAir === '0') {
                textViewAir.style.color = 'red';
                textViewAir.textContent = 'منخفضة';
            } else if (data.viewAir === '1') {
                textViewAir.style.color = ''; // Reset to default color
                textViewAir.textContent = 'جيدة';
            } else {
                textViewAir.style.color = ''; // Reset to default color
                textViewAir.textContent = ' لاتوجد قيمة';
            }

            // Handle temperature color
            const temperature = parseFloat(data.viewTemp);
            if (!isNaN(temperature)) {
                if (temperature > 35) {
                    textViewTemp.style.color = 'red';
                } else {
                    textViewTemp.style.color = ''; // Reset to default color
                }
            } else {
                textViewTemp.style.color = ''; // Reset to default color
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }, 1000);
     });
     </script>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End temp Card -->
          </div>
        </div><!-- End Left side columns -->
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