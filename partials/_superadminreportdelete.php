<?php
    session_start();
    include '_admindbconnect.php';

    if(isset($_SESSION['logIN']) && isset($_SESSION['userTYPE']) && $_SESSION['logIN']== true && $_SESSION['userTYPE']== 'superadmin'){
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $id= $_POST['id'];
            $sadminPASSWORD= $_POST['sadminPASSWORD'];
            $sadminID= $_SESSION['sadminID'];

            $sadmincheckSQL= "SELECT * FROM `sadmin` WHERE sadminID= '$sadminID'";
            $sadmincheckRESULT= mysqli_query($sconn, $sadmincheckSQL);
            $sadmincheckROWS= mysqli_num_rows($sadmincheckRESULT);

            if($sadmincheckROWS== 1){
                $sadmincheckROW= mysqli_fetch_assoc($sadmincheckRESULT);

                if(password_verify($sadminPASSWORD, $sadmincheckROW['sadminPASSWORD'])){
                    $responseinsertSQL= "DELETE FROM `report` WHERE `report`.`id` = '$id'";
                    $responseinsertRESULT= mysqli_query($sconn, $responseinsertSQL);

                    if($responseinsertRESULT){
                        header('Location: _superadminreport.php?rd=true');
                    }
                }
                else{
                    header('Location: _superadminreport.php?sp=true');
                }
            }
        }
    }
?>