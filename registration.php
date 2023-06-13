<style>
@import url('https://fonts.googleapis.com/css2?family=Kufam&display=swap');
</style>

<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التسجيل</title>

     <!-- font awesome cdn link  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  

    <!-- custom css file link  -->


</head>
<body>
      
       
       	<img class="wave" src="images/wave2.png">
	<div class="container">
		<div class="img">
			<img src="images/reg-img.png">
		</div>
		<div class="login-content">
			<form action="registration.php" method="post">
				<img src="images/avatar.svg">
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
           if (strlen($password)<8) {
            array_push($errors,"<div dir='rtl' class='password'>يجب أن تتكون كلمة المرور من ثمانية أحرف على الأقل</div>");
           }
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
            	<input type="submit" class="btn" value="تسجيل الدخول" name="submit">
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
       font-family: 'Roboto', sans-serif;
    direction: rtl ;
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}

body{
   
    overflow: hidden;
}

.wave{
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
	font-size: 20px;
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
	background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
	background-size: 200%;
	font-size: 20px;
        font-weight: bold;
	color: #fff;
	font-family: 'Poppins', sans-serif;
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