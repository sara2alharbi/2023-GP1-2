<style>
@import url('https://fonts.googleapis.com/css2?family=Kufam&display=swap');
</style>

<?php
include "DB.php";
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
$msg = "";

if (isset($_POST["login"])) {
   $email = $_POST["email"];
   $password = $_POST["password"]; 
   $passwordHash = sha1($password); 
   
   $sql = "SELECT * FROM manager WHERE email = '$email' && password = '$passwordHash'";
   $result = mysqli_query($conn, $sql);

   if (empty($email) OR empty($password)) {  
      $msg = "<div dir='rtl' class='alert alert-danger'>جميع البيانات مطلوبة</div>";
   } else { 
      if(mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         $_SESSION["user"] = $row["name"]; // Set $_SESSION["user"] to the user's name
		 $_SESSION["email"] = $row["email"]; // Set $_SESSION["email"] to the user's email
         header("Location: index.php");
         die();
      } else {
         $msg = "<div dir='rtl' class='alert alert-danger'>كلمة المرور أو البريد الإلكتروني غير صحيح</div>";
      }
   }
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
	
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
	
	<!-- Favicons -->
	<link rel="icon" type="image/png" href="assets/img/elmam-logo.png">

	<title>تسجيل الدخول</title>
	<meta content="" name="description">
    <meta content="" name="keywords">

</head>
<body>
<header id="header" class="d-flex flex-column justify-content-center">
     
  
	 <nav id="navbar" class="navbar nav-menu">
   
	   <ul>
		 <li><a href="home.html #hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>الرئيسية</span></a></li>
		 <li><a href="home.html #about" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>من نحن</span></a></li>
		 <li><a href="home.html #services" class="nav-link scrollto"><i class="bx bx-server"></i> <span>خدماتنا</span></a></li>
	   </ul>
	 </nav><!-- .nav-menu -->
 
   </header><!-- End Header -->

	<img class="wave" src="assets/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="assets/img/bg.svg">
		</div>
            
		<div class="login-content">
			<form action="login.php" method="post">
				<img src="assets/img/avatar.svg">
				<h2 class="title">مرحبا بك</h2>
                               
                <?php echo $msg  ?>
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
            	 <div class ="registeration" ><p>ليس لديك حساب؟ <a href="registration.php"><srtong style="font-weight: bold;">سجل الآن</strong></a></p></div>
            	<input type="submit" class="btn" value="تسجيل الدخول" name="login">
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

*{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
	
}

.wave{
	position: fixed;
	bottom: 0;
	left: 0;
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
	justify-content: flex-start;
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
	color: #d9d9d9;
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
	font-size: 1.2rem;
	color: #555;
	font-family: 'poppins', sans-serif;
}

.input-div.pass{
	margin-bottom: 4px;
}

.registeration{
    padding-top: 3px;
	display: block;
	text-align: right;
        color: #333;
	font-size: 0.9rem;
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
	background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
	background-size: 200%;
	font-size: 1.2rem;
	color: #fff;
	font-family: 'Kufam', sans-serif;
	text-transform: uppercase;
	margin: 1rem 0;
	cursor: pointer;
	transition: .5s;
}
.btn:hover{
	background-position: right;
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

.alert {    
    padding: 1rem;
    border-radius: 5px;
    color: white;
    margin: 1rem 0;
}

.alert-success {
    background-color: #42ba96;
}

.alert-danger {
    background-color: #fc5555;
}





</style>