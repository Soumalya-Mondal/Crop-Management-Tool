<?php
    $servername= 'localhost';
    $username= 'root';
    $password= '';
    $databse= 'crop-sensor';

    $conn= mysqli_connect($servername, $username, $password, $databse);

    if(!$conn){
        exit();
    }
?>