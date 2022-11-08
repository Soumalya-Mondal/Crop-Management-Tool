<?php
    include '_sensordbconnect.php';

    if(!empty($_POST['temp']) && !empty($_POST['humid']) && !empty($_POST['deviceID'])){
        $deviceidDATA= $_POST['deviceID'];
        $tempDATA= $_POST['temp'];
        $humidDATA= $_POST['humid'];   

        date_default_timezone_set('Asia/Kolkata');
        $dateDATA= date('d-m-Y');
        $timeDATA= date('H:i:s');

        $insertSQL= "INSERT INTO `temp-humid-sensor` (`deviceID`, `date`, `time`, `temp`, `humid`) VALUES ('$deviceidDATA', '$dateDATA', '$timeDATA', '$tempDATA', '$humidDATA')";

        $result= mysqli_query($conn, $insertSQL);

        if($result){
            echo '1';
        }
    }
?>