<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; 
include "base/session_checker.php";?>

<head>
  <?php include "base/head_imports.php"; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>


<!-- Start Map0 Style-->
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
    /* overflow: hidden; */
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
    /* border: 1px solid black; for the middle the line*/
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
    height: 3rem;
    /*///*/
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

  @media only screen and (max-width: 600px) {
    #header{
      width: 100vw;
      display: flex;
      flex-direction: row;
    }
  }
</style>
<!-- End Map0 Style-->

<!--POPOVER-->
<style>
  .popover__content {
    opacity: 0;
    visibility: hidden;
    position: absolute;
    top: 80%;
    transform: translate(0, 10px);
    background-color: #fff;
    box-shadow: 1px 1px 5px black;
    padding: 1.5rem;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
    width: auto;
  }

  .popover__content:before {
    position: absolute;
    z-index: -1;
    content: "";
    right: calc(50% - 10px);
    top: -8px;
    border-style: solid;
    border-width: 0 10px 10px 10px;
    border-color: transparent transparent #fff transparent;
    transition-duration: 0.3s;
    transition-property: transform;
  }

 .popover__content.active {
    z-index: 10;
    opacity: 1;
    visibility: visible;
    transform: translate(0, -20px);
    transition: all 0.5s cubic-bezier(0.75, -0.02, 0.2, 0.97);
  }

  .popover__message {
    text-align: center;
  }

  /****/
  .popover__content2 {
    opacity: 0;
    visibility: hidden;
    position: absolute;
    top: 115%;
    transform: translate(0, 10px);
    background-color: #fff;
    padding: 1.5rem;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
    width: fit-content;
  }

  .popover__content2:before {
    position: absolute;
    z-index: -1;
    content: "";
    right: calc(50% - 10px);
    top: -8px;
    border-style: solid;
    border-width: 0 10px 10px 10px;
    border-color: transparent transparent #fff transparent;
    transition-duration: 0.3s;
    transition-property: transform;
  }

  .popover__content2.active {
    z-index: 10;
    opacity: 1;
    visibility: visible;
    transform: translate(0, -20px);
    transition: all 0.5s cubic-bezier(0.75, -0.02, 0.2, 0.97);
  }

  .popover__message2 {
    text-align: center;
  }

  .popover__wrapper .rm-no, .popover__wrapper2 .rm-no{
    color: white;
    text-shadow: 1px 1px 3px black;
    transition: 0.3s ease;
  }
  .popover__wrapper:hover{
    color: black;
  }
</style>
<!-- End POPOVER-->

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
      <h1>الدور الأرضي</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسية </a></li>
          <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">الدور الأرضي</li>
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
                <div class='col-md-6'>
                  <button class="btn btn-primary" onClick="showInfo(this)">إظهار/إخفاء القراءات</button>
                </div>
              </div>
              <br><br>

              <div class="mycard">
                <table class="table-map" id="tbl1">
                  <tbody style="border: 1px solid black;">
                    <tr id='tr1'>
                      <td rowspan="2" class="borl grp1">
                        <div class="mytc">
                          <p class="rm-no">6G19</p>
                          <p class="rm-nm">قاعة بحث</p>
                          <p class="rm-tr">Seminar room</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp1">
                        <div class="mytc">
                          <p class="rm-no">6g20</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp1">
                        <div class="mytc">
                          <p class="rm-no">6g21</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp0">
                        <div class="mytc">
                          <p class="rm-no"></p>
                          <p class="rm-nm">مكاتب</p>
                          <p class="rm-tr">offices</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp2">
                        <div class="mytc">
                          <p class="rm-no">6g30</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td rowspan="2" class="borl borb grp2">
                        <div class="mytc">
                          <p class="rm-no">6g31</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td rowspan="3" class="grp2 borr">
                        <div class="mytc popover__wrapper2">
                          <div class="popover__content2">
                            <p class="popover__message2" id="room2"></p>
                          </div>
                          <p class="rm-no">6g35</p>
                          <p class="rm-nm">معمل ابن باجه</p>
                          <p class="rm-tr">Ibn Bajah Lab</p>
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
                              <td class="grp2 bor" rowspan="2">
                                <div class="mytc">
                                  <p class="rm-no">6g36</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr3">
                              <td class="grp1 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6g16</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                              <td colspan="3" rowspan="2" class="grp5 bort">
                                <div class="mytc">
                                  <p class="rm-nm">فناء</p>
                                  <p class="rm-tr">Patio</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr4">
                              <td rowspan="2" class="grp1 borb borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6g13</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                              <td class="grp2 borb borl borr" rowspan="2">
                                <div class="mytc">
                                  <p class="rm-no">6g38</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr5">
                              <td class="grp0 bort" colspan="3">
                              </td>
                            </tr>
                            <tr id="itr5">
                              <td class="grp6"></td>
                              <td colspan="3" rowspan="2" class="grp6">
                              </td>
                              <td class="grp6"></td>
                            </tr>
                            <tr id="itr6">
                              <td class="grp3 bort borl borr">
                                <div class="mytc">
                                  <p class="rm-no">6g10</p>
                                  <p class="rm-nm">مصلى جورية بنت الحارث</p>
                                  <p class="rm-tr"></p>
                                  <div><img src="./assets/img/mosque.png" class="mosque"></div>
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
                              <td class="grp5 bor">
                                <div class="mytc">
                                  <p class="rm-no"></p>
                                  <div><img src="./assets/img/x.png" class="mosque"></div>
                                  <p class="rm-nm"></p>
                                  <p class="rm-tr"></p>
                                </div>
                              </td>
                              <td class="grp3 bort borl" rowspan="2">
                                <div class="mytc">
                                  <p class="rm-no">6g1</p>
                                  <p class="rm-nm">المشرفة الاجتماعية</p>
                                  <p class="rm-tr">Guidance Counselor</p>
                                </div>
                              </td>
                              <td class="grp0  bort borl borr" rowspan="3" style="border-top: 10px solid white;">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp4 bort borr" style="border-bottom:1px solid rgb(175, 141, 202)">
                                <div class="mytc">
                                  <p class="rm-no">6G48</p>
                                  <p class="rm-nm">مكتب أنشطة الطالبات</p>
                                  <p class="rm-tr">Activity Office</p>
                                </div>
                              </td>
                              <td class="grp5 bor">
                                <div class="mytc">
                                  <p class="rm-no"></p>
                                  <div><img src="./assets/img/x.png" class="mosque"></div>
                                  <p class="rm-nm"></p>
                                  <p class="rm-tr"></p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr8">
                              <td class="grp3 borr" style="border-left:1px solid rgb(233, 200, 14)">
                                <div class="mytc">
                                </div>
                              </td>
                              <td class="grp4 borb borl" rowspan="2" colspan="2">
                                <div class="mytc">
                                  <p class="rm-no">6G51</p>
                                  <p class="rm-nm">قاعة دراسية</p>
                                  <p class="rm-tr">classroom</p>
                                </div>
                              </td>
                            </tr>
                            <tr id="itr9">
                              <td class="grp3 borb borr" colspan="2">
                                <div class="mytc">
                                  <p class="rm-no">6g2</p>
                                  <p class="rm-nm">مكتب التسجيل و الإرشاد</p>
                                  <p class="rm-tr">Registration Office</p>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr id="tr4">
                      <td rowspan="1" class="borl borr grp1">
                        <div class="down ">
                          <img class="exit" src="./assets/img/exit.bmp">
                          <img class="bath" src="./assets/img/bath.png">
                        </div>
                      </td>
                      <td class="grp2 borr">
                        <div class="down borb bort">
                          <img class="exit" src="./assets/img/exit.bmp">
                        </div>
                      </td>
                    </tr>
                    <tr id="tr5">
                      <td class="grp1 bor" rowspan="2">
                        <div class="mytc">
                          <p class="rm-no">6g15</p>
                          <p class="rm-nm">معمل ابن الهيثم</p>
                          <p class="rm-tr">Ibn AlHaitham Lab</p>
                        </div>
                      </td>
                      <td class="grp2 borr borb borl">
                        <div class="mytc">
                          <p class="rm-no">6g37</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr6">
                      <td class="grp2 borr">
                        <div class="mytc">
                          <p class="rm-no">6g40</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr7">
                      <td class="grp1 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6g14</p>
                          <p class="rm-nm"></p>
                          <p class="rm-tr"></p>
                        </div>
                      </td>
                      <td class="grp2 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6g41</p>
                          <p class="rm-nm">مدرج خديجة (ر)</p>
                          <p class="rm-tr">Khadijah Auditorium</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr8">
                      <td class="grp1 borl bort">
                        <div class="mytc">
                          <p class="rm-no">6g12</p>
                          <p class="rm-nm">معمل ابن سينا</p>
                          <p class="rm-tr">Ibn Sina Lab</p>
                        </div>
                      </td>
                      <td class="grp2 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6g42</p>
                          <p class="rm-nm">معمل مشاريع</p>
                          <p class="rm-tr">Projects Lab</p>
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
                      </td>
                      <td class="grp0 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6g43</p>
                          <p class="rm-nm">منطقة رقمية</p>
                          <p class="rm-tr">digital area</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr10">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6g11</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6g44</p>
                          <p class="rm-nm">معمل مشاريع</p>
                          <p class="rm-tr">projects lab</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr11">
                      <td class="grp3 bort borl borb">
                        <div class="mytc popover__wrapper">
                          <div class="popover__content">
                            <p class="popover__message" id="room1"></p>
                          </div>
                          <p class="rm-no">6g9</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                          <div class="bort">
                            <img class="exit" src="./assets/img/exit.bmp">
                          </div>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6g46</p>
                          <p class="rm-nm">مدرج مارية (ر)</p>
                          <p class="rm-tr">Mariah Auditorium</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr12">
                      <td class="grp3 borl">
                        <div class="mytc">
                          <p class="rm-no">6g7</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6g47</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr13">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no">6g5</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp4 bort borr">
                        <div class="mytc">
                          <p class="rm-no">6g48</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                    <tr id="tr14">
                      <td class="grp3 bort borl">
                        <div class="mytc">
                          <p class="rm-no"></p>
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
                          <p class="rm-no">6g5</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp3 borl">
                        <div class="mytc">
                          <p class="rm-no">6g4</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp3 borl">
                        <div class="mytc">
                          <p class="rm-no">6g3</p>
                          <p class="rm-nm">قاعة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp0 borl">
                        <div class="mytc">
                          <p class="rm-no"></p>
                          <p class="rm-nm"></p>
                          <p class="rm-tr"></p>
                        </div>
                      </td>
                      <td class="grp4 borl">
                        <div class="mytc">
                          <p class="rm-no">6g51</p>
                          <p class="rm-nm">قاعدة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp4 borl">
                        <div class="mytc">
                          <p class="rm-no">6g50</p>
                          <p class="rm-nm">قاعدة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                      <td class="grp4">
                        <div class="mytc">
                          <p class="rm-no">6g49</p>
                          <p class="rm-nm">قاعدة دراسية</p>
                          <p class="rm-tr">classroom</p>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

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


<!--Start script code of the map0.php-->
<script>
  function updateDate() {
    $.ajax({
      url: 'api.php',
      method: 'GET',
      dataType: 'json',
      data: { 'rooms': true },
      success: function (data) {
        $('#room1').html(`<div>الحرارة: ${data[0].temp}</div><div>الضوضاء: ${data[0].noise}</div><div>الرطوبة: ${data[0].hum}</div><div>جودة الهواء: ${data[0].air}<div>`);
        $('#room2').html(`<div>الحرارة: ${data[1].temp}</div><div>الضوضاء: ${data[1].noise}</div><div>الرطوبة: ${data[1].hum}</div><div>جودة الهواء: ${data[1].air}<div>`);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error('Errorf:', textStatus, errorThrown);
      }
      // success : (e) =>console.log(e),
      // error : (e) =>console.log(e),
    });
  }
  setInterval(function () { updateDate(); }, 1000);
  $('.mytc').on('click', function () {
    $("#room-no").text($(this).find('.rm-no').text());
    $("#room-nm").text($(this).find('.rm-nm').text());
    var id = $(this).find('.rm-no').text();
    console.log(id);
    $.ajax({
      url: 'api.php',
      method: 'GET',
      dataType: 'json',
      data: { 'capacity': true, 'id': id.slice(1)},
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

  function showInfo(event){
    event.classList.toggle('btn-secondary');
    const box1 = document.getElementsByClassName('popover__content')[0];
    const box2 = document.getElementsByClassName('popover__content2')[0];
    console.log(box1, box2);
    box1.classList.toggle('active');
    box2.classList.toggle('active');
  }
</script>
<!--End script code of the map0.php-->

</html>