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
      <h1>الملف الشخصي</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="users-profile.php">الملف الشخصي</a></li>
          <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">البيانات الشخصية</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/empty-profile.png" alt="Profile" class="rounded-circle">
              <h2><?php echo $userName; ?></h2>
              <h3>مدير مبنى</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">البيانات</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">بيانات الشخصية</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "> الإسم</div>
                    <div class="col-lg-9 col-md-8"><?php echo $userName; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">الوظيفة</div>
                    <div class="col-lg-9 col-md-8">مدير مبنى</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">البريد الإلكتروني</div>
                    <div class="col-lg-9 col-md-8"><?php echo $userEmail; ?></div>
                  </div>

                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
   <br><br>
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