<!DOCTYPE html>
<html lang="ar">

<?php
include "DB.php";
include "base/session_checker.php";
?>

<head>
    <?php include "base/head_imports.php"; ?>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #76C893;
            color: white;
            font-size: 20px;
        }

        td {
            text-align: center;
            font-size: 15px;
        }

        table tr:hover {
            background-color: #ddd;
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
    <main id="main" class="main">

        <div class="pagetitle">
            <h1> التنبيهات</h1>
            <br>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a> التنبيهات السابقة </a></li>
                    <li class="breadcrumb-item"></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>الوقت</th>
                                        <th>الغرفة</th>
                                        <th>الإشعار</th>
                                    </tr>
                                </thead>
                                <tbody id="alerts-table">
                                    <!-- Table rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </div><!-- End Recent Sales -->
                    </div><!-- End Right side columns -->
                </div>
            </div>
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
