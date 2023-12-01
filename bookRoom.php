<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; 
include "base/session_checker.php";?>

<!--This page for making room reservation-->

<head>
    <?php include "base/head_imports.php"; ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="assets/js/display_rooms.js"></script>
    <script src="./assets/js/fixed-notification-bootstrap-alert/src/bootstrap-show-notification.js"></script>
    
    <style>
        /* Customize the pagination controls */
        .dataTables_paginate {
            text-align: center;
        }
        tr.even {
            background-color: blue; /* Change this to the desired background color */
            color: white; /* Change the text color if needed */
        }
        tr.dataTable-row {
            background-color: #f0f0f0;
            color: #333;
        }

        tr.dataTable-row:hover {
            background-color: #007bff;
            color: #fff;
        }
        .dataTables_wrapper{
            padding: 20px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button a, .dataTables_paginate a {
            display: inline-block;
            padding: 5px 10px;
            margin: 2px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 20rem; /* Adjust the border-radius as needed */

        }

        .dataTables_paginate a.current {
            background-color: #007bff;
            color: #fff;
            border-radius: 20rem; /* Adjust the border-radius as needed */

        }
        .dataTables_paginate .paginate_button {
            border-radius: 10rem;
        }

        /* Styling for disabled pagination buttons */
        .dataTables_paginate a.disabled {
            color: #aaa;
            pointer-events: none;
        }

        table.dataTable thead .sorting{
            background-color: #d1e7dd;
        }

    </style>
</head>

<body>

<!-- ======= Header ======= -->
<?php include "base/header.php"; ?>
<!-- End Header -->

<!-- ======= Sidebar ======= ------------------------------------------->
<?php include "base/sidebar.php"; ?>
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>حجز غرفة </h1>
        <br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">غرف المبنى</li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">حجز غرفة</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card ">
        <div class="card-body">
            <!-- JavaScript -->


            <!-- Form General ------------------------------------------------------------------------->
            <div class="fSet1" id="first-form">
                <br>

                <div class="alert alert-danger" id="error1" role="alert" hidden="true"></div>
                <h5 class="card-title">الرجاء ادخال بيانات المحاضرة</h5>
                <div class="c1">
                    <p> حجز غرفة عن طريق:</p>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="capacity" value="السعة"> السعة
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="capacity" value="رقم الغرفة"> رقم الغرفة
                        </label>
                    </div>
                </div>
                <br>
                <div class="c1">
                    <p> الفصل الدراسي:</p>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="semester" value="الأول"> الأول
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="semester" value="الثاني"> الثاني
                        </label>
                    </div>
                </div>


                <!-- Start button -->
                <div class="text-center">
                    <br>
                    <button onclick="showFieldset()" type="button" name="next" class="btn btn-primary ourBtn" id="next-button">
                        التالي
                    </button>
                </div>
                <!-- End button -->
            </div>

            <!-- Start second info -->
            <div class="row g-3 fSet2" id="second-form" style="display: none;">
                <br>

                <div class="alert alert-danger" id="error2" role="alert" hidden="true"></div>
                <div class="row">
                    <div class="col-10">
                        <h5 class="card-title">اكمل ادخال معلومات المحاضرة وفق السعة المطلوبة</h5>
                    </div>
                    <div class="col-2 text-right">
                        <button onclick="showPreviousPage()" id="backBtn" class="btn btn-light">

                            عوده
                            &larr;
                        </button>
                    </div>
                </div>


                <div class="c1">
                    <p> النوع:</p>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type" value="عادية"> قاعة دراسية
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type" value="معمل"> معمل
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type" value="بحث"> قاعة بحث
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type" value="مدرج"> مدرج
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" id="show-second-form" class="form-check-input" name="type"
                                   value="بث"> قاعة بث 
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="number" id="InputCapacity" name="InputCapacity" class="form-control" placeholder="السعة">
                </div>
                <div class="col-md-6">
                    <select id="inputState" class="form-select" name="day">
                        <option selected>اختر اليوم</option>
                        <option value="Sunday">الأحد</option>
                        <option value="Monday">الاثنين</option>
                        <option value="Tuesday">الثلاثاء</option>
                        <option value="Wednesday">الأربعاء</option>
                        <option value="Thursday">الخميس</option>
                    </select>
                </div>

                <div class="col-md-6">

                    <input type="text" id="InputStartTime" name=" InputStartTime" class=" timePicker form-control"
                           value="وقت بداية المحاضرة"
                           placeholder="وقت بداية المحاضرة ">
                </div>
                <div class="col-md-6">
                    <input type="text" name="InputEndTime" class="timePicker form-control"
                           placeholder="وقت نهاية المحاضرة ">
                </div>
                <div class="text-center">
                    <br>
                    <button onclick="ValidateFieldset2()" class="btn btn-primary ourBtn" type="button" id="searchButton"
                            name="search">

                        بحث
                    </button>
                </div>
            </div>
        </div>
        <!-- Start third info -->
        <br>
        <div class="row g-3 fSet3 px-md-4" id="third-form" style="display: none;">
            <div class="alert alert-danger" id="error3" role="alert" hidden="true"></div>
            <div class="row">
                <div class="col-10">
                    <h5 class="card-title">اكمل ادخال معلومات المحاضرة وفق السعة المطلوبة</h5>
                </div>
                <div class="col-2 text-right">
                    <button onclick="showPreviousPage()" id="backBtn" class="btn btn-light">
                        عوده
                        &larr;
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <input type="text" name="roomNoInput" class="form-control" id='roomNo' placeholder="رقم الغرفة">
            </div>
            <div class="col-md-6">
                <select id="day2" class="form-select" name="day2">
                <option selected>اختر اليوم</option>
                        <option value="Sunday">الأحد</option>
                        <option value="Monday">الاثنين</option>
                        <option value="Tuesday">الثلاثاء</option>
                        <option value="Wednesday">الأربعاء</option>
                        <option value="Thursday">الخميس</option>
                </select>
            </div>

            <div class="col-md-6">
                <input type="time" id="InputStartTime2" name="InputStartTime2" class="timePicker form-control"
                       placeholder="وقت نهاية المحاضرة">

            </div>
            <div class="col-md-6">
                <input type="text" id="InputEndTime2" name="InputEndTime2" class=" timePicker form-control"
                       placeholder="وقت نهاية المحاضرة ">
            </div>
            <div class="text-center">
                <button onclick="ValidateFieldset3()" type="button" id="bookRoom" name="bookRoom"
                        class="btn btn-primary ourBtn">
                    احجز
                </button>
            </div>
            <br>

        </div>

        <h5 id="noDataMessage" style="display: none; text-align: center">لا يوجد بيانات</h5>
        <div id="tableContainer">

            <table id="table" class="table" style="visibility: hidden">
                <thead>
                <tr>
                    <th>#</th>
                    <th>رقم الغرفة</th>
                    <th>الدور</th>
                    <th>السعة</th>
                    <th>الحجز</th>
                </tr>
                </thead>
                <tbody id="table-body">
                <!-- Add more rows as needed, each with a button -->
                </tbody>
            </table>
        </div>


        <div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حجز غرفة</h5>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="reservationForm">
                            <p>رقم الغرفة: <span id="roomNumber"></span></p>

                            <div class="form-group">
                                <label for="sectionNumber" class="col-form-label">الشعبة</label>
                                <input type="text" class="form-control" id="sectionNumber" name="sectionNumber" >
                            </div>
                            <div class="form-group">
                                <label for="course" class="col-form-label">كود المقرر</label>
                                <input type="text" class="form-control" id="course" name="course">
                            </div>
                            <input type="hidden" id="day1" name="day"/>
                            <input type="hidden" id="roomNo1" name="roomNo"/>
                            <input type="hidden" id="startTime1" name="startTime"/>
                            <input type="hidden" id="endTime1" name="endTime"/>
                            <input type="hidden" id="semester1" name="semester"/>

                            <br>
                            <br>
                            <button type="button" onclick="closeModal()" class="btn btn-secondary ourBtn" data-dismiss="modal"
                                    id="closeModalButton">إغلاق
                            </button>
                            <button type="button" onclick="reserveRoom()" class="btn btn-primary ourBtn"
                                    id="reserveButton">حجز
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Get the input element by name

            flatpickr(".timePicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: false
            });

        </script>
        <script>
            // JavaScript
    function showPreviousPage() {
    const firstFieldset = document.getElementById("first-form");
    const secondFieldset = document.getElementById("second-form");
    const thirdFieldset = document.getElementById("third-form");

    // Close the modal
    const roomModal = document.getElementById("roomModal");
    if (roomModal) {
        const modal = new bootstrap.Modal(roomModal);
        modal.hide();
    }

    firstFieldset.style.display = "block";
    secondFieldset.style.display = "none";
    thirdFieldset.style.display = "none";
    document.getElementById('backBtn').style.display = 'none';
    document.getElementById("table").style.display = 'none';
    document.getElementById("noDataMessage").style.display = 'none';
    document.getElementById("table_wrapper").style.display = 'none';
}



            let error1 = document.getElementById("error1");
            let error2 = document.getElementById("error2");
            let error3 = document.getElementById("error3");

            var type = document.querySelector('input[name="type"]:checked');

            let semester = null; // Declare semester variable here
    function showFieldset() {
    const capacityRadio = document.querySelector('input[name="capacity"]:checked');
    const semesterRadio = document.querySelector('input[name="semester"]:checked');
    const firstFieldset = document.getElementById("first-form");
    const secondFieldset = document.getElementById("second-form");
    const thirdFieldset = document.getElementById("third-form");

    document.getElementById('backBtn').style.display = '';


    let semesterError = false;
    let capacityError = false;

    if (capacityRadio) {
        if (semesterRadio) {
            semester = semesterRadio.value; // Update the value of semester
            if (capacityRadio.value === "السعة") {
                firstFieldset.style.display = "none";
                secondFieldset.style.display = "block";
                thirdFieldset.style.display = "none";
            } else if (capacityRadio.value === "رقم الغرفة") {
                firstFieldset.style.display = "none";
                secondFieldset.style.display = "none";
                thirdFieldset.style.display = "block";
            }
        } else {
            semesterError = true;
        }
    } else {
        capacityError = true;
        if (!semesterRadio) {
            semesterError = true;
        }
    }

    checkFirstErrors(capacityError, semesterError);
}

            function checkFirstErrors(capacityError, semesterError) {
                let error1 = document.getElementById("error1");
                let message = ' '

                if (capacityError || semesterError) {
                    if (capacityError && semesterError) {
                        message = 'يجب إختيار نوعية البحث ';
                        message += '<br>يجب إختيار فصل دراسي<br>';
                    } else if (capacityError && !semesterError) {
                        message = 'يجب إختيار نوعية البحث ';
                    } else if (!capacityError && semesterError) {
                        message = 'يجب إختيار فصل دراسي ';
                    }
                    error1.removeAttribute("hidden");
                    error1.innerHTML = message;

                }

            }

            function ValidateFieldset2() {
                const InputCapacity = document.getElementById("InputCapacity").value;
                const day = document.getElementById("inputState").value;
                const InputStartTime = document.getElementById("InputStartTime").value;
                const InputEndTime = document.getElementsByName("InputEndTime")[0].value;

                const typeRadioButtons = document.getElementsByName("type");
                let typeSelected = false;

                // Check if at least one radio button is selected for "النوع"
                for (let i = 0; i < typeRadioButtons.length; i++) {
                    if (typeRadioButtons[i].checked) {
                        typeSelected = true;
                        Chosetype = typeRadioButtons[i].value; // Get the value of the selected radio button

                        break;
                    }
                }

                let error = '';
                // Validate each input field
                if (!typeSelected) {
                    error += 'يرجى إدخال النوع.<br>';
                }
                if (InputCapacity.trim() === '') {
                    error += 'يرجى إدخال السعة.<br>';
                } else {
                    const capacity = parseInt(InputCapacity, 10); // Parse the input as an integer
                    if (capacity > 100) {
                        error += 'السعة يجب أن تكون أقل من أو تساوي 100.<br>';
                    }
                }
                if (day === 'اختر اليوم') {
                    error += 'يرجى اختيار اليوم.<br>';
                }
                if (InputStartTime.trim() === '') {
                    error += 'يرجى إدخال وقت بداية المحاضرة.<br>';
                }
                if (InputEndTime.trim() === '') {
                    error += 'يرجى إدخال وقت نهاية المحاضرة.<br>';

                }

                var startTimeTest = new Date("2000-01-01 " + InputStartTime);
                var endTimeTest = new Date("2000-01-01 " + InputEndTime);

                if (startTimeTest >= endTimeTest) {
                    error += 'وقت بداية المحاضرة يجب أن يكون قبل وقت نهاية المحاضرة.<br>';
                }
                const errorElement = document.getElementById("error2");
                if (error !== '') {
                    errorElement.innerHTML = error;
                    errorElement.removeAttribute("hidden");
                } else {
                    errorElement.setAttribute("hidden", "true");
                    console.log("Semester before call");
                    console.log(semester);
                    searchRooms(Chosetype, InputCapacity, day, InputStartTime, InputEndTime, semester);
                }

            }

            function ValidateFieldset3() {

                var roomNo = document.getElementById("roomNo").value;
                var day2 = document.querySelector('#day2').value;
                var inputStartTime2 = document.getElementById("InputStartTime2").value;
                var inputEndTime2 = document.getElementById("InputEndTime2").value;


                let error = '';
                // Validate each input field

                if (roomNo.trim() === '') {
                    error += 'يرجى إدخال رقم الغرفة.<br>';
                }
                if (day2 === 'اختر اليوم') {
                    error += 'يرجى اختيار اليوم.<br>';
                }
                if (inputStartTime2.trim() === '') {
                    error += 'يرجى إدخال وقت بداية المحاضرة.<br>';
                }
                if (inputEndTime2.trim() === '') {
                    error += 'يرجى إدخال وقت نهاية المحاضرة.<br>';

                }

                var startTimeTest = new Date("2000-01-01 " + inputStartTime2);
                var endTimeTest = new Date("2000-01-01 " + inputEndTime2);

                if (startTimeTest >= endTimeTest) {
                    error += 'وقت بداية المحاضرة يجب أن يكون قبل وقت نهاية المحاضرة.<br>';
                }

                const errorElement = document.getElementById("error3");
                if (error !== '') {
                    errorElement.innerHTML = error;
                    errorElement.removeAttribute("hidden");
                } else {
                    console.log('Capacity Clicked');
                    errorElement.setAttribute("hidden", "true");
                    searchSingleRooms(roomNo, day2, inputStartTime2, inputEndTime2, semester);
                }

            }


        </script>

    </div>
    </div>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->



<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script src="assets/js/main_home.js"></script>


<?php

if (isset($_POST['bookRoom'])) {
    echo "Im clicked";
}
?>
</body>

</html>