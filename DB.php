<?php  
   
    $conn = mysqli_connect("localhost","root","", "elmam");
    $error = mysqli_connect_error();
    if ($error != null){
        exit("on connection to the database". $error);//TODO remove error msg
    }
?>