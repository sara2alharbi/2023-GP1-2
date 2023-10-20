<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; 
include "base/session_checker.php";?>

<head>
    <?php include "base/head_imports.php"; ?>
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
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
      <h1>بيانات الغرف</h1>
      <br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="room-info.php">غرف </a></li>
          <li class="breadcrumb-item">المبنى</li>
          <li class="breadcrumb-item active">الغرف المتاحة</li>
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
              <table class="table datatable" dir="rtl">
                <thead>
                  <tr>
                    <th scope="col">الأسم</th>
                    <th scope="col">الدور</th>
                    <th scope="col">النوع</th>
                    <th scope="col">السعة</th>
                  </tr>
                </thead>
                <tbody>
                    
    <?php     $sql = "SELECT * FROM room";
    $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){ ?>
         <td><?php echo $row['roomNo'] ; ?> </td> 
         <td><?php echo $row['floor'] ;?> </td>
         <td><?php echo $row['type'] ; ?> </td>
         <td id="c"><?php echo $row['capacity'] ; ?> </td>  
            </tr>    
     <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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

</html>