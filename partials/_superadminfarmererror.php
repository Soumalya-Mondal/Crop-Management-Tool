<?php
    session_start();
    include '_dbconnect.php';
    include '_admindbconnect.php';

    if(isset($_SESSION['logIN']) && isset($_SESSION['userTYPE']) && $_SESSION['logIN']== true && $_SESSION['userTYPE']== 'superadmin'){
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $farmerID= $_POST['farmerID'];
            $sadminPASSWORD= $_POST['sadminPASSWORD'];

            $sadminID= $_SESSION['sadminID'];
            $sadminNAME= $_SESSION['sadminNAME'];

            $sadmincheckSQL= "SELECT * FROM `sadmin` WHERE sadminNAME= '$sadminNAME' AND sadminID= '$sadminID'";
            $sadmincheckRESULT= mysqli_query($sconn, $sadmincheckSQL);
            $sadmincheckROWS= mysqli_num_rows($sadmincheckRESULT);

            if($sadmincheckROWS== 1){
                $sadmincheckROW= mysqli_fetch_assoc($sadmincheckRESULT);

                if(password_verify($sadminPASSWORD, $sadmincheckROW['sadminPASSWORD'])){
                    $farmeractiveSQL= "UPDATE `farmer` SET `farmerACTIVE` = '2' WHERE `farmer`.`farmerID` = '$farmerID'";
                    $farmeractiveRESULT= mysqli_query($conn, $farmeractiveSQL);

                    if($farmeractiveRESULT){
                        header('Location: _superadminfarmermanage.php?fe=true');
                    }
                }
                else{
                    header('Location: _superadminfarmermanage.php?sp=true');
                }
            }
        }
    }
?>