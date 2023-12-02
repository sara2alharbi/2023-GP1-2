<?php  
 // database connection  
    $conn = mysqli_connect("localhost","u169182990_elmam","E123l123", "u169182990_elmam");
    $error = mysqli_connect_error();
    if ($error != null){
        exit("on connection to the database". $error);
    }
?>