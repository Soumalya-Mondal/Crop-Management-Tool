<?php
    $servername= 'localhost';
    $username= 'root';
    $password= '';
    $database= 'forfarmerssuperadmin';

    $sconn= mysqli_connect($servername, $username, $password, $database);

    if(!$sconn){
        exit();
    }
?>