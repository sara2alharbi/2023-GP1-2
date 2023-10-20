<!DOCTYPE html>
<html lang="ar">

<?php include "base/session_checker.php";?>

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
      <h1>الأسئلة الشائعة</h1>
    </div><!-- End Page Title -->

    <section class="section faq">
      <div class="row">
      
        <div class="col-lg-12">

          <!-- F.A.Q Group 2 -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">الأسئـلة</h5>

              <div class="accordion accordion-flush" id="faq-group-2">

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-1" type="button" data-bs-toggle="collapse">
                      في حال تعرض جهاز الحساسات إلى عطل كيف يتم صيانتها؟ 
                    </button>
                  </h2>
                  <div id="faqsTwo-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                    <div class="accordion-body">
                      في حال تعرض أي من الحساسات الثلاث لعطل مفاجئ يتم التواصل معنا من خلال صفحة التواصل لمعرفة المشكلة والعمل على حلها.
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-2" type="button" data-bs-toggle="collapse">
                      هل يوجد اشتركات شهرية أو سنوية للنظام؟
                    </button>
                  </h2>
                  <div id="faqsTwo-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                    <div class="accordion-body">
                     نعم ،يوجد اشتراك يتم تجديده كل سنة.
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-3" type="button" data-bs-toggle="collapse">
                      ماهي الوحدات المستخدم للحساسات الثلاث؟
                    </button>
                  </h2>
                  <div id="faqsTwo-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                    <div class="accordion-body">
                      الوحدات المستخدمة لقياس كل من:<br><br>
                      1- درجة الحرارة : تقاس بوحدة سلزيوس<br>
                      2- مستوى الضوضاء: يقاس بوحدة الديسيبل<br>
                      3-جودة الهواء: يتم عرض فقط في حال أن الهواء متلوث أو لا
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-4" type="button" data-bs-toggle="collapse">
                      كيفية التسجيل في نظام إلمام؟
                    </button>
                  </h2>
                  <div id="faqsTwo-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                    <div class="accordion-body">
                      في حال كنت تعمل ك مدير للمبنى يمكنك التقديم على إنشاء حساب في الصفحة الرئيسية للنظام
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-5" type="button" data-bs-toggle="collapse">
                      هل يمكنني عرض درجة الحرارة لتاريخ معين؟
                    </button>
                  </h2>
                  <div id="faqsTwo-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                    <div class="accordion-body">
                      نعم، يمكنك ذلك من خلال النقر على صفحة "إحصائية درجة الحرارة".
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div><!-- End F.A.Q Group 2 -->
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