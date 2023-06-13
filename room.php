<?php 
include "DB.php";
?>

<!DOCTYPE html>
<html  lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> غرف المبنى</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/style.css"> 
    <link rel="stylesheet" href="CSS/room.css"> 
</head>
<body>
    
<!-- header section starts  -->

<header>

    <a href="manager.php" class="logo"><img src="images/elmam-logo.png" width="110"></a>

    <div id="menu" class="fas fa-bars"></div>

    <nav class="navbar">
        <ul>
            <li><a class="active" href="Manager.php">القائمة </a></li>
            <li ><a href="logout.php" id="reg">تسجيل الخروج</a></li>
            <a><li class='fas fa-bell' ></li></a>
        </ul>
    </nav>

</header>

<!-- header section ends -->

<section class="home" id="home">

    <div class="content">

        <h1 dir="rtl"> غرف المبنى</h1>
        <br>
        <br>
        <br>
        <br>
        <p  dir="rtl">  من هنا تستطيع استعراض جميع معلومات القاعات والمعامل داخل المبنى</p>
        
        <a href="#about" class="btn">استعرض</a>
     
    </div>

    <div class="image">
        <img src="images/room.png" alt="">
    </div>

</section>

<!-- home section ends -->

<!-- air quality  starts  -->

<section class="about" id="about">

    <div class="row">
        <div class="content">
            <h1 class="heading" dir="rtl">الغرف داخل المبنى </h1>
            <br><br><br><br>
        </div>
    </div>

<?php include 'DB.php'; ?>
<div class="container">
	<div class="header_wrap">
            
		<div class="num_rows">
			<div class="form-group">
				<!--		Show Numbers Of Rows 		-->
				<select class  ="form-control" name="state" id="maxRows">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="40">40</option>
                                        <option value="50">50</option>
					<option value="61">إظهار الكل</option>
				</select>
			</div>
		</div>
        
    
      
	<input dir="rtl" type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="ابحث بالأسم" class="form-control">
    	</div> 
	
	<table class="table table-striped table-class" id= "table-id">
		<thead>
			<tr>
			<th>الأسم</th><th>الدور</th><th>النوع</th><th>السعة</th>
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
	

		<tbody>
	</table>
	<!--		Start Pagination -->
	<div class='pagination-container'>
		<nav>
			<ul class="pagination">
				<!--	Here the JS Function Will Add the Rows -->
			</ul>
		</nav>
	</div>
	
</div>
<!-- 		End of Container -->

</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>   
</section>

<!-- air quality ends  -->

<!-- footer section starts  -->

<section class="footer" dir="rtl">

    <div class="box-container">



        <div class="box">
            <h3>موقعنا</h3>
            <a href="#">المملكة العربية السعودية</a>
     
        </div>

        <div class="box">
            <h3>الروابط السريعة</h3>
            <a href="Manager.php" >الصفحة الرئيسية</a>
        </div>

        <div class="box">
            <h3>معلومات التواصل</h3>
            <p> <i class="fas fa-envelope"></i> ElmamProject1@gmail.com</p>
            <p> <i class="fas fa-map-marker-alt"></i>   المملكة العربيه السعودية - الرياض  - 12314 </p>
            <div class="share">
                <a href="https://www.youtube.com/@1Elmam" class="fab fa-youtube"></a>
                <a href="https://twitter.com/elmam_sa?s=11&t=bQf4d5cu-HYAhb1QcYfSJQ" class="fab fa-twitter"></a>
                <a href="https://instagram.com/elmam_sa?igshid=YmMyMTA2M2Y=" class="fab fa-instagram"></a>
            </div>
        </div>

    </div>

    <h1 class="credit">  جميع الحقوق محفوظة   <a href="#">©2023</a></h1>

</section>

<!-- footer section ends -->

<!-- scroll top  -->

<a href="#home" class="scroll-top">
    <img src="images/office-building.png" alt="">
</a>


<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- custom js file link  -->
<script src="javaScript/script.js"></script>

</body>
</html>

<script>
	  getPagination('#table-id');
	$('#maxRows').trigger('change');
	function getPagination (table){

		  $('#maxRows').on('change',function(){
		  	$('.pagination').html('');						// reset pagination div
		  	var trnum = 0 ;									// reset tr counter 
		  	var maxRows = parseInt($(this).val());			// get Max Rows from select option
        
		  	var totalRows = $(table+' tbody tr').length;		// numbers of rows 
			 $(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
			 	trnum++;									// Start Counter 
			 	if (trnum > maxRows ){						// if tr number gt maxRows
			 		
			 		$(this).hide();							// fade it out 
			 	}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
			 });											//  was fade out to fade it in 
			 if (totalRows > maxRows){						// if tr total rows gt max rows option
			 	var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
			 												//	numbers of pages 
			 	for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
			 	$('.pagination').append('<li data-page="'+i+'">\
								      <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
								    </li>').show();
			 	}											// end for i 
     
         
			} 												// end if row count > max rows
			$('.pagination li:first-child').addClass('active'); // add active class to the first li 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
       showig_rows_count(maxRows, 1, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

        $('.pagination li').on('click',function(e){		// on click each page
        e.preventDefault();
				var pageNum = $(this).attr('data-page');	// get it's number
				var trIndex = 0 ;							// reset tr counter
				$('.pagination li').removeClass('active');	// remove active class from all li 
				$(this).addClass('active');					// add active class to the clicked 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL
       showig_rows_count(maxRows, pageNum, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL
        
        
        
				 $(table+' tr:gt(0)').each(function(){		// each tr in table not the header
				 	trIndex++;								// tr index counter 
				 	// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
				 	if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
				 		$(this).hide();		
				 	}else {$(this).show();} 				//else fade in 
				 }); 										// end of for each tr in table
					});										// end of on click pagination list
		});
											// end of on select change 
		 
								// END OF PAGINATION 
    
	}	


			

// SI SETTING
$(function(){
	// Just to append id number for each row  
default_index();
					
});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
   //Default rows showing
        var end_index = maxRows*pageNum;
        var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
        var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
        $('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
  $('table tr:eq(0)').prepend('<th> الرقم </th>')

					var id = 0;

					$('table tr:gt(0)').each(function(){	
						id++
						$(this).prepend('<td>'+id+'</td>');
					});
}

// All Table search script
function FilterkeyWord_all_table() {
  
// Count td if you want to search on all table instead of specific column

  var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

        // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input_all");
  var input_value =     document.getElementById("search_input_all").value;
        filter = input.value.toLowerCase();
  if(input_value !=''){
        table = document.getElementById("table-id");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
          
          var flag = 0;
           
          for(j = 0; j < count; j++){
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
             
                var td_text = td.innerHTML;  
                if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                //var td_text = td.innerHTML;  
                //td.innerHTML = 'shaban';
                  flag = 1;
                } else {
                  //DO NOTHING
                }
              }
            }
          if(flag==1){
                     tr[i].style.display = "";
          }else {
             tr[i].style.display = "none";
          }
        }
    }else {
      //RESET TABLE
      $('#maxRows').trigger('change');
    }
}
</script>
