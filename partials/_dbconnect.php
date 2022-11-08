<?php
    $servername= 'localhost';
    $username= 'root';
    $password= '';
    $database= 'forfarmers';

    $conn= mysqli_connect($servername, $username, $password, $database);

    if(!$conn){
        exit();
    }
?>