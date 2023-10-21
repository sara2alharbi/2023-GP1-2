<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; 
include "base/session_checker.php";?>

<head>
  <?php include "base/head_imports.php"; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<!-- Start Map2 Style-->
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
    text-align: left;
    background-color: rgb(231, 231, 231);
    /* min-width: var(--cell-width); */
    /* border: 1px solid rgb(202, 202, 202); */
    /* border: 1px solid black; */
  }

  td p {
    margin-bottom: 8px;
  }

  .mytc {
    /* background-color: #5858582a; */
    margin: 3px;
    display: flex;
    padding: .3rem;
    /* max-width: var(--cell-width);
    */
    /* max-height: var(--cell-height);  */
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
    /* max-height: 150vh !important;  */
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
    max-height: 1.5rem;
  }

  #itr2 {
    height: 1rem;
  }

  .table1 td {
    width: 2rem;
  }

  .accross {
    display: flex;
    height: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    text-align: center;
  }

  #tr3 {
    height: 2rem;
  }

  #tr3 .mytc {
    height: 4rem;
  }

  #tr3 .mytc p {
    margin: 0;
  }

  #itr5 {
    height: 10rem;
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
<!-- End Map2 Style-->

<!-- Start Body map-->
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
                <th scope="row">اسم الغرفة</th>
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
<?php include "base/header.php"; ?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php include "base/sidebar.php"; ?>
<!-- End Sidebar-->

<!-- ======= Main ======= -->
<main id="main" class="main">

    <div class="pagetitle">
      <h1>الدور الثاني</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسية </a></li>
          <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">الدور الثاني</li>
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
                          <p class="rm-no">6s20</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp1">
                        <div class="mytc">
                          <p class="rm-no">6s21</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp1">
                        <div class="mytc">
                          <p class="rm-no">6s22</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl grp0">
                        <div class="mytc">
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp2">
                        <div class="mytc">
                          <p class="rm-no">6s23</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp2">
                        <div class="mytc">
                          <p class="rm-no">6s24</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                      <td rowspan="2" class="grp2 borb">
                        <div class="mytc">
                          <p class="rm-no">6s25</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
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
                            <tr id="itr1" style="height:2rem;">
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
                              <td class="grp2 borb borl borr" rowspan="2">
                                <div class="mytc">
                                  <p class="rm-no">6s28</p>
                                  <p class="rm-nm">معمل أبحاث</p>
                                  <p class="rm-tr">research lab</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr3">
                              <td class="grp1 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6s18</p>
                                  <p class="rm-nm">معمل أبحاث</p>
                                  <p class="rm-tr">research lab</p>
                                </div>
                              </td>
                              <td colspan="3" rowspan="2" class="grp5 bort"></td>
                            </tr>
                            <tr id="itr4">
                              <td rowspan="2" class="grp1 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6s17</p>
                                  <p class="rm-nm">معمل أبحاث</p>
                                  <p class="rm-tr">research lab</p>
                                </div>
                              </td>
                              <td rowspan="2" class="grp2 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6s29</p>
                                  <p class="rm-nm">معمل أبحاث</p>
                                  <p class="rm-tr">research lab</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr5">
                              <td class="grp2 bor">
                                <div class="mytc">
                                  <p class="rm-no">6s36</p>
                                  <p class="rm-nm">معمل</p>
                                  <p class="rm-tr">lab</p>
                                </div>
                              </td>
                              <td class="grp2 bor">
                                <div class="mytc">
                                  <p class="rm-no">6s35</p>
                                  <p class="rm-nm">مكاتب</p>
                                  <p class="rm-tr">offices</p>
                                </div>
                              </td>
                              <td class="grp2 bor">
                                <div class="mytc">
                                  <p class="rm-no">6s34</p>
                                  <p class="rm-nm">معمل</p>
                                  <p class="rm-tr">lab</p>
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
                                  <p class="rm-no">6s10</p>
                                  <p class="rm-nm">معمل قابلية الاستخدام</p>
                                  <p class="rm-tr">usability lab</p>
                                </div>
                              </td>
                              <td class="grp4  bort borl borr">
                                <div><img src="./assets/img/bath.png" class="bath" style="top:0"></div>
                                <div class="mytc">
                                  <p class="rm-no"></p>
                                  <p class="rm-nm"></p>
                                  <p class="rm-tr"></p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr7">
                              <td class="grp5  bort borl borr">
                                <div class="mytc">
                                  <p class="rm-no"></p>
                                  <div><img src="./assets/img/x.png" class="mosque"></div>
                                  <p class="rm-nm"></p>
                                  <p class="rm-tr"></p>
                                </div>
                              </td>
                              <td class="grp3 bort" rowspan="2" style="border-right:1px solid rgb(233, 200, 14)">
                                <div class="mytc">
                                  <p class="rm-no">6s12</p>
                                  <p class="rm-nm">وحدة شؤون الطالبات</p>
                                  <p class="rm-tr">student affairs Unit</p>
                                </div>
                              </td>
                              <td class="grp5  bort borl borr" rowspan="3" style="border: 10px solid white;">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp4" rowspan="2">
                                <div class="mytc">
                                  <p class="rm-no">6s37</p>
                                  <p class="rm-nm">وحدة الإرشاد و التسجيل الاكاديمي</p>
                                  <p class="rm-tr">Guidance & Registration Unit</p>
                                </div>
                              </td>
                              <td class="grp5  bort borl borr">
                                <div class="mytc">
                                  <p class="rm-no"></p>
                                  <div><img src="./assets/img/x.png" class="mosque"></div>
                                  <p class="rm-nm"></p>
                                  <p class="rm-tr"></p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr8">
                              <td class="grp3 borr bort">
                                <div class="mytc">
                                  <p class="rm-no">6f6</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                              <td class="grp4 borl bort" style="border-right: 1px solid rgb(175, 141, 202)">
                                <div class="mytc">
                                  <p class="rm-no">6s41</p>
                                  <p class="rm-nm">معمل رقمي</p>
                                  <p class="rm-tr">digital lab</p>
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
                          <p class="rm-no">6s26</p>
                          <p class="rm-nm">معمل دراسات عليا</p>
                          <p class="rm-tr">postgrad lab</p>
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
                          <p class="rm-no">6s16</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td class="grp2 borr">
                        <div class="mytc">
                          <p class="rm-no">6f27</p>
                          <p class="rm-nm">مكاتب دكتوراه</p>
                          <p class="rm-tr">php offices</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr6">
                      <td class="grp1 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6s15</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                      <td class="grp2 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6s30</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr7">
                      <td class="grp1 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6s14</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td class="grp2 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6s31</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr8">
                      <td class="grp1 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6s13</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                      <td class="grp2 borr bort">
                        <div class="mytc">
                          <p class="rm-no">6s32</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr9">
                      <td class="grp0 bort">
                        <div class="mytc">
                          <p class="rm-no"></p>
                          <p class="rm-nm"></p>
                          <p class="rm-tr"></p>
                        </div>
                      <td class="grp2 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6s33</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      </td>
                    </tr>
                    <tr id="tr10">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6s11</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6s38</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr11">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6s9</p>
                          <p class="rm-nm">مكاتب دكتوراه</p>
                          <p class="rm-tr">PHD offices</p>
                          <div>
                            <img class="exit borb" src="./assets/img/exit.bmp">
                          </div>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6s39</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">Lab</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr12">
                      <td class="grp3 borl">
                        <div class="mytc">
                          <p class="rm-no">6s7</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6s40</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr13">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6s6</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">office</p>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6s42</p>
                          <p class="rm-nm">معمل صوتيات</p>
                          <p class="rm-tr">Acoustic Lab</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr14">
                      <td class="grp3 bort borl">
                        <div class="mytc" style="font-size:13px">
                          <p style="margin-bottom:2px" class="rm-no">6s6</p>
                          <p style="margin-bottom:2px" class="rm-nm">مكاتب</p>
                          <p style="margin-bottom:2px" class="rm-tr">offices</p>
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
                          <p class="rm-no">6s5</p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                      <td colspan="2" class="grp3 borl" style="position:relative;">
                        <div class="accross" style="transform: translate(-50%, -10%); display:block">
                        </div>
                        <div class="accross">
                          <div style="flex-grow:1;" class="mytc borl">
                            <p class="rm-no">6s4</p>
                            <p class="rm-nm">معامل دراسات عليا</p>
                          </div>
                        </div>
                      <td class="grp3 borl">
                        <div class="mytc">
                          <p class="rm-no">6s1</p>
                          <p class="rm-nm">مكتب التطوير و الجودة</p>
                          <p class="rm-tr">Qualtiy Unit Display Room</p>
                        </div>
                      </td>
                      <td class="grp4 borl">
                        <div class="mytc">
                          <p class="rm-no">6s45</p>
                          <p class="rm-nm">مكاتب دكتوراه</p>
                          <p class="rm-tr">PHD offices</p>
                        </div>
                      </td>
                      <td class="grp4 borl">
                        <div class="mytc">
                          <p class="rm-no">6s44</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
                        </div>
                      </td>
                      <td class="grp4">
                        <div class="mytc">
                          <p class="rm-no">6s43</p>
                          <p class="rm-nm">معمل</p>
                          <p class="rm-tr">lab</p>
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

</main>
<!-- End Main -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->


<!-- Vendor JS Files -->
<?php include "base/js_imports.php"; ?>
<!-- End JS Files -->

</body>

<!--Start script code of the map2.php-->
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
      data: { 'capacity': true, 'id': id.slice(1) },
      success: function (data) {
        console.log(data)
        $('#room-cp').text('');
        $('#room-cp').text(data.cp);
      },
      error: function (err) {
        $('#room-cp').text('');
        console.error('Error22f:', err);
      }
    });
    $('#smallModal').modal('show');
  });
</script>
<!--End script code of the map2.php-->

</html>