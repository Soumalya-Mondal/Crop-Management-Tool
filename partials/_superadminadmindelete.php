<?php
    session_start();
    include '_admindbconnect.php';

    if(isset($_SESSION['logIN']) && isset($_SESSION['userTYPE']) && $_SESSION['logIN']== true && $_SESSION['userTYPE']== 'superadmin'){
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $adminID= $_POST['adminID'];
            $sadminPASSWORD= $_POST['sadminPASSWORD'];

            $sadminID= $_SESSION['sadminID'];
            $sadminNAME= $_SESSION['sadminNAME'];

            $sadmincheckSQL= "SELECT * FROM `sadmin` WHERE sadminNAME= '$sadminNAME' AND sadminID= '$sadminID'";
            $sadmincheckRESULT= mysqli_query($sconn, $sadmincheckSQL);
            $sadmincheckROWS= mysqli_num_rows($sadmincheckRESULT);

            if($sadmincheckROWS== 1){
                $sadmincheckROW= mysqli_fetch_assoc($sadmincheckRESULT);

                if(password_verify($sadminPASSWORD, $sadmincheckROW['sadminPASSWORD'])){
                    
                    $admindeleteSQL= "DELETE FROM `admin` WHERE `admin`.`adminID`= '$adminID'";
                    $admindeleteRESULT= mysqli_query($sconn, $admindeleteSQL);

                    if($admindeleteRESULT){
                        header('Location: _superadminadminmanage.php?ad=true');
                    }
                }
                else{
                    header('Location: _superadminadminmanage.php?sp=true');
                }
            }
        }
    }
?>