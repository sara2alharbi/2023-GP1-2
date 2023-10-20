
<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<!-- Favicons -->
<link rel="icon" type="image/png" href="assets/img/elmam-logo.png">

<title>تسجيل جديد</title>
<meta content="" name="description">
<meta content="" name="keywords">
<!-- font awesome cdn link  -->
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->

<link href="assets/vendor_home/aos/aos.css" rel="stylesheet">
<link href="assets/vendor_home/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor_home/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor_home/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor_home/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="assets/vendor_home/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/a81368914c.js"></script>

<link href="assets/css/style1_home.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

</head>

   
<body>
<a href="#" class="logo"><img src="assets/img/elmam-logo.png" width="70"></a>
<header id="header" class="d-flex flex-column justify-content-center">

	 <nav id="navbar" class="navbar nav-menu">
   
	   <ul>
		 <li><a href="home.html #hero" class="nav-link scrollto "><i class="bx bx-home"></i> <span>الرئيسية</span></a></li>
		 <li><a href="home.html #about" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>من نحن</span></a></li>
		 <li><a href="home.html #services" class="nav-link scrollto"><i class="bx bx-server"></i> <span>خدماتنا</span></a></li>
	   </ul>
	 </nav><!-- .nav-menu -->
 
   </header><!-- End Header --> 
       	<div class="wave" > </div>
	<div class="container">
		<div class="img">
			<img  src="assets/img/sign-up.svg" width='1000' height='700'>
		</div>
		<div class="login-content">
			<form action="registration.php" method="post">
				<img src="assets/img/avatar.svg">
				<h2 class="title">مرحباً بك في نظام إلمـام</h2>
                                
 <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           $passwordHash = sha1($password); 
          
         
           $errors = array();
         
            
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"<div dir='rtl' class='required'>جميع البيانات مطلوبة</div>");
           }
           if (!empty($email)) 
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, " <div dir='rtl' class='notvalid'>البريد الإلكتروني غير صالح</div>");
           }
           if (!empty($password)) {
           if (strlen($password)<8) {
            array_push($errors,"<div dir='rtl' class='password'>يجب أن تتكون كلمة المرور من ثمانية أحرف على الأقل</div>");
           }}
           if ($password!==$passwordRepeat) {
            array_push($errors,"<div dir='rtl' class='password'>كلمة المرور غير متطابقة</div>");
           }
           require_once "DB.php";
           $sql = "SELECT * FROM manager WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"<div dir='rtl' class='email'>البريد الإلكتروني موجود بالفعل</div>");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo  "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO manager ( name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div dir='rtl' class='alert alert-success'>لقد تم تسجيلك بنجاح</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
         
                        <div class="input-div one">
           		   <div class="i">
           		       <i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		       <input dir="rtl" type="text" placeholder="الاسم" class="input" name="fullname">
           		   </div>
           		</div>    
                                
                                
                                
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fa fa-envelope"></i>
           		   </div>
           		   <div class="div">
           		       <input dir="rtl" type="text" placeholder="البريد الإلكتروني" class="input" name="email">
           		   </div>
           		</div>
                                
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<input dir="rtl" type="password" placeholder="كلمة المرور"  class="input" name="password">
            	           </div>
            	       </div>
                                
                                  		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-user-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<input dir="rtl" type="password" placeholder="إعادة كلمة المرور"  class="input" name="repeat_password">
            	           </div>
            	       </div>         
             
            	 <div class ="registeration" ><p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p></div>
                 <div class="icon-paragraph">
                     <i class="bi bi-info-circle " > </i> &nbsp; 
                 <p  >كلمة المرور يجب أن تتكون من ثمانية خانات أو أكثر</p>
                 </div>
            	<input type="submit" class="btn" value="تسجيل جديد" name="submit">
            </form>
        </div>
    </div>
 
</body>
</html>



<script>
const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

</script>

<style>

 .icon-paragraph {
  display: flex;
  
}

.bi-info-circle  {
   color: #34A0A4;
}
    
*{
       
       direction: rtl ;
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}



.wave{
        height: 50px;
        width: 750px;
        background-color: #b5e48c;
        background-image: linear-gradient(160deg, #b5e48c 0%, #34a0a4 50%, #1a759f 100%);
	position: fixed;
	bottom: 0;
	right: 0;
	height: 100%;
	z-index: -1;
}

.container{
    width: 100vw;
    height: 100vh;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap :7rem;
    padding: 0 2rem;
}

.img{
	display: flex;
	justify-content: flex-end;
	align-items: center;
}


.login-content{
	display: flex;
	justify-content: center;
	align-items: center;
	text-align: center;
}

.img img{
	width: 500px;
}

form{
	width: 360px;
}

.login-content img{
    height: 100px;
}

.login-content h2{
        font-family: 'Kufam', sans-serif;
	margin: 15px 0;
	color: #333;
	text-transform: uppercase;
	font-size: 29px;
}

.login-content .input-div{
    position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin: 25px 0;
    padding: 5px 0;
    border-bottom: 2px solid #d9d9d9;
}

.login-content .input-div.one{
	margin-top: 0;
}

.i{
	color: #34A0A4;
	display: flex;
	justify-content: center;
	align-items: center;
}

.i i{
	transition: .3s;
}

.input-div > div{
    position: relative;
	height: 45px;
}

.input-div > div > h5{
	position: absolute;
	left: 10px;
	top: 50%;
	transform: translateY(-50%);
	color: #999;
	font-size: 18px;
	transition: .3s;
}

.input-div:before, .input-div:after{
	content: '';
	position: absolute;
	bottom: -2px;
	width: 0%;
	height: 2px;
	background-color: #38d39f;
	transition: .4s;
}

.input-div:before{
	right: 50%;
}

.input-div:after{
	left: 50%;
}

.input-div.focus:before, .input-div.focus:after{
	width: 50%;
}

.input-div.focus > div > h5{
	top: -5px;
	font-size: 15px;
}

.input-div.focus > .i > i{
	color: #38d39f;
}

.input-div > div > input{
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	border: none;
	outline: none;
	background: none;
	padding: 0.5rem 0.7rem;
	font-size: 20px;
	color: #555;
	
}

.input-div.pass{
	margin-bottom: 4px;
}

.registeration{
    padding-top: 3px;
	display: block;
	text-align: right;
        color: #333;
	font-size: 17px;
	transition: .3s;
}

a{
  text-decoration: none;  
  color: #999;
}

a:hover{
	color: #38d39f;
}

.btn{
	display: block;
	width: 100%;
	height: 50px;
	border-radius: 25px;
	outline: none;
	border: none;
	background-color: #34A0A4;
	background-size: 200%;
	font-size: 1.2rem;
	color: #fff;
	text-transform: uppercase;
	margin: 1rem 0;
	cursor: pointer;
	transition: .5s;
}
.btn:hover{
	background-color: #76C893;
        color: #fff;
}


@media screen and (max-width: 1050px){
	.container{
		grid-gap: 5rem;
	}
}

@media screen and (max-width: 1000px){
	form{
		width: 290px;
	}

	.login-content h2{
        font-size: 2.4rem;
        margin: 8px 0;
	}

	.img img{
		width: 400px;
	}
}

@media screen and (max-width: 900px){
	.container{
		grid-template-columns: 1fr;
	}

	.img{
		display: none;
	}

	.wave{
		display: none;
	}

	.login-content{
		justify-content: center;
	}
}





#password2{
	color:red;
}



</style>