<?php
    session_start();

    if(isset($_GET['panel']) && isset($_GET['deviceID']) && $_GET['panel']== 'admin'){
        $deviceID= $_GET['deviceID'];
    }

    if(isset($_SESSION['login']) && isset($_SESSION['userTYPE']) && $_SESSION['login']= true && $_SESSION['userTYPE']== 'admin'){
        include '_sensordbconnect.php';

        $deviceLOCATIONSQL= "SELECT * FROM `senor-list` WHERE deviceID= '$deviceID'";
        $deviceLOCATIONRESULT= mysqli_query($conn, $deviceLOCATIONSQL);
        $deviceLOCATIONROWS= mysqli_num_rows($deviceLOCATIONRESULT);

        if($deviceLOCATIONROWS== 1){
            $deviceLOCATIONROW= mysqli_fetch_assoc($deviceLOCATIONRESULT);
            
            $deviceLAT= $deviceLOCATIONROW['deviceLAT'];
            $deviceLON= $deviceLOCATIONROW['deviceLON'];

            header('Location: https://www.google.co.in/maps/place/'.$deviceLAT.'+'.$deviceLON);
        }
    }
?>