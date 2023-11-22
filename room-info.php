<!DOCTYPE html>
<html lang="ar">
<?php include "DB.php"; 
include "base/session_checker.php";?>

<head>
    <?php include "base/head_imports.php"; ?>
    <link href="assets/css/room.css" rel="stylesheet">
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
            <li class="breadcrumb-item"> غرف المبنى</li>
            <li class="breadcrumb-item"></li>
          <li class="breadcrumb-item active">بيانات الغرف</li>
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
    <div class="content">
    <div class="container">
	  <div class="header_wrap">
   <div class="center">
  <span class="qs">? <span class="popover above">تتوزع الغرف في المبنى على ثلاثة أدوار وأنواعها قاعة دراسية، معمل، قاعة بحث، قاعة بث. وتتراوح سعاتها بين 12 و62</span>
</div>
              <style>


/* Just to center things */
.center {
    margin-right: 1010px;
    margin-bottom: 15px;
width: 30px;
}

/* The element to hover over */
.qs {
  background-color: blue;
  border-radius: 16px;
  color: #e3fbff;
  cursor: default;
  display: inline-block;
  font-family: 'Helvetica',sans-serif;
  font-size: 18px;
  font-weight: bold;
  height: 30px;
  line-height: 30px;
  position: relative;
  text-align: center;
  width: 30px;
  
  .popover {
    background-color: white;
    border-radius: 5px;
    bottom: 42px;
    box-shadow: 0 0 5px rgba(0,0,0,0.4);
    color: black;
    display: none;
    font-size: 12px;
 
    left: -95px;
    padding: 7px 10px;
    position: absolute;
    width: 200px;
    z-index: 4;
    
    &:before {
        border-top: 7px solid rgba(0,0,0,0.85);
        border-right: 7px solid transparent;
        border-left: 7px solid transparent;
        bottom: -7px;
        content: '';
        display: block;
        left: 50%;
        margin-left: -7px;
        position: absolute;
      }
  }
  
  &:hover {
      .popover {
        display: block;
        -webkit-animation: fade-in .3s linear 1, move-up .3s linear 1;
        -moz-animation: fade-in .3s linear 1, move-up .3s linear 1;
        -ms-animation: fade-in .3s linear 1, move-up .3s linear 1;
      }
    }
}
</style>     
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
	<input dir="rtl" type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="ابحث بالأسم" class="form-control"> <br><br>
  </div> 
	
	<table class="table table-striped table-class" id= "table-id">
		<thead>
			<tr>
			<th>رقم الغرفة</th><th>الدور</th><th>النوع</th><th>السعة</th>
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
</div>
</section>

</main>
<!-- End Main -->

<!-- ======= Footer ======= -->
<?php include "base/footer.php"; ?>
<!-- End Footer -->


<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>   
<?php include "base/js_imports.php"; ?>
<!-- End JS Files -->

<script>
  //for the dropdown menu code
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
///////////////////////////////////////////////////////////////////////////////////////////////////

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

</body>

</html>