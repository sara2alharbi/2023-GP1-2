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
      <h1>لوحة التحكم</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسية  </a></li>
          <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">لوحة التحكم</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <section class="section dashboard">
      <div class="row">


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h1 class="card-title" style="font-size: 230%;"> مرحبًا بِك <?php echo $userName; ?><span style="font-size: 70%;"> | في إلمام</span></h1>                   
                </div>
              </div>
            </div><!-- End Recent Sales -->
                                <!-- building-info Card -->
                                <div class="col-lg-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">معلومات المبنى</h5>
                  <canvas id="myPieChart" width="100" height="100"></canvas>
                </div>
              </div>
            </div><!-- End building-info Card -->
            <div class="col-lg-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">نسبة استغلال المساحة </h5> 
                  <canvas id="myDoughnutChart" width="100" height="100"></canvas>
                </div>
              </div>
            </div><!-- End building-info Card -->
            <div class="col-lg-4">
            <div class="card info-card sales-card">
            <div class="card-body">
            <h5 class="card-title">درجة الحرارة الخارجية:</h5>
           <p>درجة الحرارة الآن: <span id="outdoor-temperature">تحميل...</span></p>
          </div>
          </div>
          </div> 
          <div class="col-lg-4">
            <div class="card info-card sales-card">
            <div class="card-body">
            <h5 class="card-title">درجة الرطوبة الخارجية:</h5>
            <p class="card-text">درجة الرطوبة الآن <span id="outdoor-humidity">تحميل...</span></p>
          </div>               
            </div>
            </div><!-- End building-info Card -->
        </div><!-- End Right side columns -->
        
        
    </section>

</main><!-- End Main -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->

<!-- Vendor JS Files -->
<?php include "base/js_imports.php"; ?>
<!-- End JS Files -->


<!--Index home page script-->
<script>
// Static data for the pie chart
var data = [39,29, 2 ,5 , 4 , 12];
var labels = ['القاعات الدراسية', 'المعامل', 'مصلى' , 'قاعة بحث' , 'معمل أبحاث' , 'مكاتب'];

// Get the canvas element
var ctx = document.getElementById('myPieChart').getContext('2d');

// Create the pie chart
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
        'rgba(255, 173, 173)',
        'rgba(255, 214, 165)',
        'rgba(253, 255, 182)',
        'rgba(202, 255, 191)',
        'rgba(155, 246, 255)',
        'rgba(160, 196, 255)',
      ],
            }]
    }
});
</script>
<script>
        // Static data for the doughnut chart
        var data = [80 , 20]; // Data for each segment
        var labels = ['المستغلة', 'الغير مستغلة']; // Labels for each segment

        // Get the canvas element
        var ctx = document.getElementById('myDoughnutChart').getContext('2d');

        // Create the doughnut chart
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#caf0f8', '#00b4d8'], // Customize the colors of each segment
                }]
            }
        });
</script>
<script>
// Replace 'YOUR_API_KEY' with your actual API key
const apiKey = 'ebeaf8cebc55cdfbb9f2ec96e8146f73';
const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=Riyadh&appid=${apiKey}&units=metric`;

// Function to fetch weather data
async function fetchWeatherData() {
  try {
    const response = await fetch(apiUrl);
    const data = await response.json();
    const outdoorTemperature = data.main.temp;
    const outdoorHumidity = data.main.humidity;

    // Update the temperature and humidity in the HTML
    document.getElementById('outdoor-temperature').textContent =   '°' + outdoorTemperature ;
    document.getElementById('outdoor-humidity').textContent = '%' + outdoorHumidity ;
  } catch (error) {
    console.error('Error fetching weather data:', error);
    document.getElementById('outdoor-temperature').textContent = 'Error';
    document.getElementById('outdoor-humidity').textContent = 'Error';
  }
}

// Fetch the weather data when the page loads
fetchWeatherData();
</script>

<!-- End index home page script-->

</body>
</html>