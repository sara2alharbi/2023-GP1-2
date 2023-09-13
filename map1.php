<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; ?>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>الدور الأول</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/elmam-logo.png" rel="icon" >


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<style>
  .table-map {
    font-family: 'Tajawal', sans-serif !important;
    font-weight: 700;
    table-layout: fixed;
  }

  :root {
    --cell-width: 9vw;
    --cell-height: 5vh;
  }

  .popup {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    z-index: 999;
    /* Add more styles as needed */
  }

  td {
    position: relative;
    overflow: hidden;
    min-width: var(--cell-width);
    /* min-width: var(--cell-width); */
    /* height: var(--cell-height); */
    text-align: left;
    background-color: rgb(231, 231, 231);
    /* border: 1px solid rgb(202, 202, 202); */
    /* border: 1px solid black; */
  }

  td p {
    margin-bottom: 8px;
  }

  .mytc {
    /* background-color: #5858582a; */
    margin: 3px;
    border-radius: 5px;
    display: flex;
    padding: .3rem;
    /* max-width: var(--cell-width);
    max-height: var(--cell-height); */
    flex-direction: column;
    justify-content: center;
    align-items: center;
    overflow: wrap;
    white-space: wrap;
    position: relative;
    text-align: center;
  }

  .mytc2 {
    /* background-color: #5858582a; */
    margin: 3px;
    border-radius: 5px;
    display: flex;
    padding: .3rem;
    /* max-width: var(--cell-width);
    max-height: var(--cell-height); */
    flex-direction: column;
    justify-content: center;
    align-items: center;
    overflow: wrap;
    white-space: wrap;
    position: relative;
    text-align: center;
  }

  .exit {
    max-width: var(--cell-width);
    width: var(--cell-width);
    height: 50px;
  }

  .bath {
    max-width: var(--cell-width)/2;
    width: var(--cell-width)/2;
    height: 50px;
  }

  .mosque {
    height: 50px;
  }

  .moon {
    height: 150px;
    opacity: 30%;
  }

  .down {
    margin-top: auto;
    max-height: 75em;
  }

  .borl {
    border-left: 1px solid black;
  }

  .borb {
    border-bottom: 1px solid black;
  }

  .bort {
    border-top: 1px solid black;
  }

  .borr {
    border-right: 1px solid black;
  }

  .bor {
    border: 1px solid black;
  }

  .grp0 {
    background-color: white;
    height: 100px;
  }

  .grp1 {
    background-color: orange;
  }

  .grp2 {
    background-color: rgb(31, 182, 124);
  }

  .grp3 {
    background-color: rgb(233, 200, 14);
  }

  .grp4 {
    background-color: rgb(175, 141, 202);
  }

  .grp5 {
    background-color: rgb(185, 185, 185);
  }

  .grp6 {
    background-color: white;
  }

  .mycard {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background-color: white;
  }

  .wc {
    background-color: rgb(238, 224, 161);
    width: 40px;
    height: 20px;
  }

  .abs1 {
    position: absolute;
    top: 0;
    right: 0;
  }

  .inner-table {
    background-color: white;
    /* border: 1px solid black; */
    /* height: 100%;
    width: 100%; */
  }

  .inner-table tr {
    /* border: 1px solid red; */
    height: 7rem;
  }

  .inner-table td {
    /* border: 1px solid red; */
    /* min-width: 15%; */
  }

  .inner-cont {
    position: relative;
    padding: 1rem;
    background-color: white;
    /* border: 1px solid black; */
    /* width: 50vw; */
  }

  .inner-cont table {
    width: 90%;
    margin: auto;
  }

  .col2 {
    max-width: var(--cell-width)*2;
  }

  #tb1 {
    width: 100%;
  }

  #itr1 {
    /* height: 1.5rem; */
  }

  #itr2 {
    height: 1.5rem;
  }

  .table1 td {
    width: 2rem;
  }
  .rm-nm,
  .rm-tr {
    display: none;
  }

  .rm-no {
    text-transform: uppercase;
    font-size: 1.5rem;
    /* font-weight: 900; */
  }
</style>


<body>

<div class="modal fade" id="smallModal" tabindex="-1">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <h5 class="modal-title">معلومات الغرفة</h5>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th scope="row">رقم الغرفة</th>
                <td id="room-no"></td>
              </tr>
              <tr>
                <th scope="row">نوع الغرفة</th>
                <td id="room-nm"></td>
              </tr>
              <tr>
                <th scope="row">السعة</th>
                <td id="room-cp"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/elmam-logo.png" alt="">
       
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
  </a><!-- End Notification Icon ------------------------------------------>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav-------------------------------------------------------------------------- -->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="assets/img/empty-profile.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">الاسم</span>
          </a><!-- End Profile Iamge Icon ----------------------------------------------------------->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>الملف الشخصي</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span> تسجيل الخروج</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= ------------------------------------------->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="index.php">
          <i class="bi bi-grid"></i>
          <span> الرئيسية</span>
        </a>
      </li><!-- End home Nav -->

       <li class="nav-item">
        <a class="nav-link collapsed" href="notification.php">
          <i class="bi bi-bell"></i>
          <span> التنبيهات</span>
        </a>
      </li><!-- End notfications  Nav --------------->
      
          <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-map"></i>
           <span>خريطة المبنى</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="map0.php">
              <i class="bi bi-circle"></i><span>الدور الأرضي</span>
            </a>
          </li>
          <li>
            <a href="map1.php">
              <i class="bi bi-circle"></i><span>الدور الأول</span>
            </a>
          </li>
          <li>
            <a href="map2.php">
              <i class="bi bi-circle"></i><span>الدور الثاني</span>
            </a>
          </li>
        </ul>
      </li><!-- End map  Nav --------------->
      

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>غرف المبنى</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="room-info.php">
              <i class="bi bi-circle"></i><span>بيانات الغرف</span>
            </a>
          </li>
          <li>
            <a href="room-monitoring.php">
              <i class="bi bi-circle"></i><span>مراقبة حالة الغرفة</span>
            </a>
          </li>
          <li>
            <a href="room-date.php">
              <i class="bi bi-circle"></i><span> إحصائية درجة الحرارة</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
      
            <li class="nav-item">
        <a class="nav-link collapsed"  data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-bar-graph"></i>
           <span> تقارير اسبوعية</span>
        </a>
      </li><!-- End report  Nav ---------------------------------------------------->

      
      <!-- End line  ------------------------------------------------------------------------------->
      <li> <hr> </li>

      
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>الملف الشخصي</span>
        </a>
      </li><!-- End Profile Page Nav ------------------------------------->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.php">
          <i class="bi bi-question-circle"></i>
          <span>الأسئلة الشائعة</span>
        </a>
      </li><!-- End F.A.Q Page Nav ------------------------------------>

      <li class="nav-item">
        <a class="nav-link collapsed" href="contact.php">
          <i class="bi bi-envelope"></i>
          <span>تواصل معنا</span>
        </a>
      </li><!-- End Contact Page Nav --------------------------------->

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-right"></i>
          <span>تسجيل الخروج</span>
        </a>
      </li><!-- End Login Page Nav -->
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>الدور الأول</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسية  </a></li>
          <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">الدور الأول</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">        
              <h5 class="card-title">خريطة الجامعة</h5>
              <div class="row">
                
              </div>
              <br><br>

              <div class="mycard">
                <table class="table-map" id="tbl1">
                  <tbody style="border: 1px solid black;">
                    <tr id='tr1'>
                      <td rowspan="2" class="borl grp1">
                        <div class="mytc">
                          <p class="rm-no">6F19</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">Classroom</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp1">
                        <div class="mytc">
                          <p class="rm-no">6g20</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp1">
                        <div class="mytc">
                          <p class="rm-no">6f21</p>
                          <p class="rm-nm">وحدة الحاسب</p>
                          <p class="rm-tr">computer unit</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp1">
                        <div class="mytc">
                          <p class="rm-no">6f24</p>
                          <p class="rm-nm">غرفة الخوادم</p>
                          <p class="rm-tr">server room</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp2">
                        <div class="mytc">
                          <p class="rm-no">6f25</p>
                          <p class="rm-nm">ورشة الصيانة</p>
                          <p class="rm-tr">hardware maintenance room</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp2">
                        <div class="mytc">
                          <p class="rm-no">6f26</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td rowspan="2" class="grp2 borb">
                        <div class="mytc">
                          <p class="rm-no">6f29</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                    <tr id='tr2'>
                    </tr>
                    <tr id='tr3'>
                      <td rowspan="1" class="borl grp1"></td>
                      <td colspan="5" rowspan="12" class="inner-cont">
                        <!-- --------------- -->
                        <table class="inner-table table-map">
                          <tbody>
                            <tr id="itr1">
                              <td rowspan="2" class="grp1 borr bort">
                                <div class="mytc"></div>
                              </td>
                              <td rowspan="2" class="grp1 borl borb bort">
                                <div style="position: absolute; left:0; top:0; height: 100%;" class="grp5">
                                  <img class="bath" src="./assets/img/bath.png" style="position: relative; top:50%">
                                </div>
                              </td>
                              <td rowspan="2" class="grp0">
                                <div class="mytc"></div>
                              </td>
                              <td class="grp2 bort borr">
                                <div class="mytc"></div>
                              </td>
                              <td rowspan="1" class="grp2 bort borl">
                                <div class="mytc"></div>
                              </td>
                            </tr>
                            <tr id="itr2">
                              <td class="grp5 bor"></td>
                              <td class="grp2 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6f17</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr3">
                              <td class="grp1 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6f17</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                              <td colspan="3" rowspan="2" class="grp5 bort"></td>
                              <td class="grp2 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6f38</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr4">
                              <td rowspan="2" class="grp1 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6f15</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                              <td rowspan="2" class="grp2 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no"></p>
                                  <p class="rm-nm">غرفة تصوير</p>
                                  <p class="rm-tr">Photocopy room</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr5">
                              <td class="grp2 bort" colspan="3">
                                <div class="mytc">
                                  <p class="rm-no">6f47y</p>
                                  <p class="rm-nm">المكتبة - Library</p>
                                  <p class="rm-tr"></p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr5">
                              <td class="grp6"></td>
                              <td colspan="3" rowspan="2" class="grp6">
                                <div style="text-align: center;">
                                  <img class="moon" src="./assets/img/moon.png">
                                </div>
                              </td>
                              <td class="grp6"></td>
                            </tr>
                            <tr id="itr6">
                              <td class="grp3 bort borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6f10</p>
                                  <p class="rm-nm">مصلى حليمة السعدية</p>
                                  <p class="rm-tr"></p>
                                  <div><img src="./assets/img/mosque.png" class="mosque"></div>
                                </div>
                              </td>
                              <td class="grp4  bort borl borr">
                                <div><img src="./assets/img/bath.png" class="bath" style="top:0"></div>
                              </td>
                            </tr>
                            <tr id="itr7">
                              <td class="grp5  bort borl borr">
                                <div class="mytc2">
                                  <div><img src="./assets/img/x.png" class="mosque"></div>
                                </div>
                              </td>
                              <td class="grp3 bor">
                                <div class="mytc">
                                  <p class="rm-no">6f11</p>
                                  <p class="rm-nm">وحدة الصيانة</p>
                                  <p class="rm-tr">Maintenance Unit</p>
                                </div>
                              </td>
                              <td class="grp5  bort borl borr" rowspan="3" style="border: 10px solid white;">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp4  bor">
                                <div class="mytc">
                                  <p class="rm-no">6f48</p>
                                  <p class="rm-nm">وحدة الإرشاد و المتابعة للطالبات</p>
                                  <p class="rm-tr"></p>
                                </div>
                              </td>
                              <td class="grp5  bort borl borr">
                                <div class="mytc2">
                                  <p class="rm-no"></p>
                                  <div><img src="./assets/img/x.png" class="mosque"></div>
                                  <p class="rm-nm"></p>
                                  <p class="rm-tr"></p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr8">
                              <td class="grp3 bor">
                                <div class="mytc">
                                  <p class="rm-no">6f6</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                              <td class="grp6 bor">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp6 bor">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp4 borl borr bort">
                                <div class="mytc">
                                  <p class="rm-no">6f51</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr9">
                              <td class="grp3 borr borb">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp3 borb">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp4 borb">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp4 borb borl">
                                <div class="mytc">
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td class="grp2 borb borr">
                        <div class="mytc" style="font-size: 12px;">
                          <p>غرف اجتماعات - 6F28</p>
                          <p>مشاريع التخرج - 6F34</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr4">
                      <td rowspan="1" class="borl borr grp1">
                        <div class="down">
                          <img class="exit" src="./assets/img/exit.bmp">
                          <img class="bath" src="./assets/img/bath.png">
                        </div>
                      </td>
                      <td class="grp2 borr">
                        <div class="down">
                          <img class="exit borb" src="./assets/img/exit.bmp">
                        </div>
                      </td>
                    </tr>
                    <tr id="tr5">
                      <td class="grp1 borl bort borr">
                        <div class="mytc">
                          <p class="rm-no">6f16</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp2 borr">
                        <div class="mytc">
                          <p class="rm-no">6f36</p>
                          <p class="rm-nm">قاعة بحث</p>
                          <p class="rm-tr">seminar room</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr6">
                      <td class="grp1 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6f14</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td class="grp2 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6f37</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr7">
                      <td class="grp1 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6f13</p>
                          <p class="rm-nm"></p>
                          <p class="rm-tr"></p>
                        </div>
                      </td>
                      <td rowspan="2" class="grp2 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6f49</p>
                          <p class="rm-nm">مدرج خديجة (ر)</p>
                          <p class="rm-tr">khadijah Auditorium</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr8">
                      <td class="grp1 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6f12</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr9">
                      <td class="grp0 bort">
                       
                      </td>
                      <td class="grp0 bort">
                        
                      </td>
                    </tr>
                    <tr id="tr10">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6f9</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td rowspan="2" class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6f50</p>
                          <p class="rm-nm">مدرج مارية (ر)</p>
                          <p class="rm-tr">Mariah Auditorium</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr11">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6g8</p>
                          <p class="rm-nm">قاعة بحث</p>
                          <p class="rm-tr">seminar room</p>
                          <div>
                            <img class="exit borb" src="./assets/img/exit.bmp">
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr12">
                      <td class="grp3 borl">
                        <div class="mytc">
                          <p class="rm-no">6f7</p>
                          <p class="rm-nm">قاعة بحث</p>
                          <p class="rm-tr">seminar room</p>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6f52</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr13">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6f5</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6f53</p>
                          <p class="rm-nm">قاعة بحث</p>
                          <p class="rm-tr">seminar room</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr14">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6f4</p>
                        </div>
                      </td>
                      <td class="grp4 borr">
                        <div class="mytc">
                          <div class="bort borb">
                            <img class="exit" src="./assets/img/exit.bmp">
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr15">
                      <td class="grp3 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6f3</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td class="grp3 borl">
                        <div class="mytc">
                          <p class="rm-no">6f2</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp3 borl">
                        <div class="mytc">
                          <p class="rm-no">6f1</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp0 borl">
                        
                      </td>
                      <td class="grp4 borl">
                        <div class="mytc">
                          <p class="rm-no">6g56</p>
                          <p class="rm-nm">قاعدة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp4 borl">
                        <div class="mytc">
                          <p class="rm-no">6g55</p>
                          <p class="rm-nm">قاعدة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp4">
                        <div class="mytc">
                          <p class="rm-no">6g54</p>
                          <p class="rm-nm">قاعدة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>


              <!-- Add the popup div as mentioned in the previous answers -->
              <div id="popup" class="popup" style="display: none;">helloo!</div>

            </div>
          </div>

        </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy;  جميع الحقوق محفوظة <strong><span>لإلمـام</span></strong> 
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        <div class="social-links">
        <a href="https://twitter.com/elmam_sa?s=11&t=bQf4d5cu-HYAhb1QcYfSJQ" class="twitter"  ><i class="bx bxl-twitter"></i></a>
        <a href="https://www.youtube.com/@1Elmam" class="facebook"><i class="bx bxl-youtube"></i></a>
        <a href="https://instagram.com/elmam_sa?igshid=YmMyMTA2M2Y" class="instagram"><i class="bx bxl-instagram"></i></a>
        
        
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

<script>
  $('.mytc').on('click', function () {
    $("#room-no").text($(this).find('.rm-no').text());
    $("#room-nm").text($(this).find('.rm-nm').text());
    var id = $(this).find('.rm-no').text();
    console.log(id);
    $.ajax({
      url: 'http://localhost/project/api.php',
      method: 'GET',
      dataType: 'json',
      data: { 'capacity': true, 'id': id.slice(1)},
      success: function (data) {
        console.log(data)
        $('#room-cp').text(data.cp);
      },
      error: function (err) {
        console.error('Error22f:', err);
      }
    });
    $('#smallModal').modal('show');
  });
</script>

</html>