<?php  
    $connection = mysqli_connect("localhost","root","", "login_register");
    $con = mysqli_connect("localhost","root","", "login_register");
    $error = mysqli_connect_error();
    if ($error != null){
        exit("on connection to the database". $error);//TODO remove error msg
    }
?>