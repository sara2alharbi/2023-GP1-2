<?php
include ("DB.php");
    
      $msg = "";
        $type = 1;
        $exists=false;
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT );
        
       
            
    
    $sql = "Select * from user where Email='$email'";
    
    $result = mysqli_query($con, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the email is already present 
    // or not in our Database
    if($num == 0) {
    echo '<h3> email already exist </h3>' ; }
        
        
        /*
        
            $sql = "SELECT * from user where Email='$email'";
            $stmt = $con ->prepare($sql);
            $stmt->execute();
            if($stmt->count()>0){
                $msg .= "عذرا الحساب مسجل";
                header('Location: index.php?msg='.$msg);
            }
            else{
                $sql = "INSERT INTO user ('Email','Password','Name') VALUES (?,?,?)";
                $stmt = $con ->prepare($sql);
                $stmt->execute([$email,$password,$name]);
                
                    $msg .= "created";
                  header('Location: index.php?msg='.$msg);
    
                
            }*/
            
    ?>
