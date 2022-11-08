<?php
    session_start();
    include '_admindbconnect.php';
    include '_adminmail.php';

    if(isset($_SESSION['logIN']) && isset($_SESSION['userTYPE']) && $_SESSION['logIN']== true && $_SESSION['userTYPE']== 'superadmin'){
        if($_SERVER['REQUEST_METHOD']== 'POST'){     
            $adminID= $_POST['adminID'];
            $adminNAME= $_POST['adminNAME'];
            $adminPHONE= $_POST['adminPHONE'];
            $adminAADHAAR= $_POST['adminAADHAAR'];
            $adminEMAIL= $_POST['adminEMAIL'];
            $sadminPASSWORD= $_POST['sadminPASSWORD'];

            $sadminID= $_SESSION['sadminID'];
            $sadminNAME= $_SESSION['sadminNAME'];

            $sadmincheckSQL= "SELECT * FROM `sadmin` WHERE sadminNAME= '$sadminNAME' AND sadminID= '$sadminID'";
            $sadmincheckRESULT= mysqli_query($sconn, $sadmincheckSQL);
            $sadmincheckROWS= mysqli_num_rows($sadmincheckRESULT);

            if($sadmincheckROWS== 1){
                $sadmincheckROW= mysqli_fetch_assoc($sadmincheckRESULT);

                if(password_verify($sadminPASSWORD, $sadmincheckROW['sadminPASSWORD'])){

                    $adminemailexitsSQL= "SELECT * FROM `admin` WHERE adminID= '$adminID'";
                    $adminemailexitsRESULT= mysqli_query($sconn, $adminemailexitsSQL);
                    $adminemailexitsROWS= mysqli_num_rows($adminemailexitsRESULT);

                    if($adminemailexitsROWS== 1){
                        $adminemailexitsROW= mysqli_fetch_assoc($adminemailexitsRESULT);

                        if($adminEMAIL!= $adminemailexitsROW['adminEMAIL']){
                            $password1= substr($adminNAME, 0, 4);
                            $password2= substr($adminAADHAAR, 4, 4);

                            $adminPASSWORD= strtoupper($password1.$password2);
                            $staus= sendOTP($adminEMAIL, $adminID, $adminPASSWORD);

                            if($staus== 1){
                                $adminPASSWORDHASH= password_hash($adminPASSWORD, PASSWORD_DEFAULT);

                                $adminupdateSQL= "UPDATE `admin` SET `adminNAME`= '$adminNAME', `adminPHONE`= '$adminPHONE', `adminAADHAAR`= '$adminAADHAAR', `adminEMAIL`= '$adminEMAIL', `adminPASSWORD`= '$adminPASSWORDHASH', `adminCREATENAME`= '$sadminNAME', `adminCREATEID`= '$sadminID' WHERE `admin`.`adminID` = '$adminID'";
                                $adminupdateRESULT= mysqli_query($sconn, $adminupdateSQL);

                                if($adminupdateRESULT){
                                    header('Location: _superadminadminmanage.php?us=true');
                                }
                            }
                        }
                        if($adminEMAIL== $adminemailexitsROW['adminEMAIL']){
                            $password1= substr($adminNAME, 0, 4);
                            $password2= substr($adminAADHAAR, 4, 4);

                            $adminPASSWORD= strtoupper($password1.$password2);
                            $staus= sendOTP($adminEMAIL, $adminID, $adminPASSWORD);

                            if($staus== 1){
                                $adminPASSWORDHASH= password_hash($adminPASSWORD, PASSWORD_DEFAULT);

                                $adminupdateSQL= "UPDATE `admin` SET `adminNAME`= '$adminNAME', `adminPHONE`= '$adminPHONE', `adminAADHAAR`= '$adminAADHAAR', `adminEMAIL`= '$adminEMAIL', `adminPASSWORD`= '$adminPASSWORDHASH', `adminCREATENAME`= '$sadminNAME', `adminCREATEID`= '$sadminID' WHERE `admin`.`adminID` = '$adminID'";
                                $adminupdateRESULT= mysqli_query($sconn, $adminupdateSQL);

                                if($adminupdateRESULT){
                                    header('Location: _superadminadminmanage.php?us=true');
                                }
                            }
                        }
                    }
                }
                else{
                    header('Location: _superadminadminmanage.php?sp=true');
                }
            }
        }
    }
?>