<?php
    session_start();
    include '_admindbconnect.php';
    date_default_timezone_set('Asis/Kolkata');

    if(isset($_SESSION['login']) && isset($_SESSION['userTYPE']) && $_SESSION['login']== true && $_SESSION['userTYPE']== 'admin'){
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $adminPASSWORD= $_POST['adminPASSWORD'];
            $adminID= $_SESSION['adminID'];
            $issueID= $_POST['issueID'];
            $reportRESPONSE= $_POST['reportRESPONSE'];

            $admincheckSQL= "SELECT * FROM `admin` WHERE adminID= '$adminID'";
            $admincheckRESULT= mysqli_query($sconn, $admincheckSQL);
            $admincheckROWS= mysqli_num_rows($admincheckRESULT);

            if($admincheckROWS== 1){
                $admincheckROW= mysqli_fetch_assoc($admincheckRESULT);

                if(password_verify($adminPASSWORD, $admincheckROW['adminPASSWORD'])){
                    $time= date('Y-m-d');

                    $reportinsertSQL= "INSERT INTO `report` (`issueID`, `issueMSG`, `issueRESPONSE`, `issueACTIVE`, `adminID`, `issueTIME`) VALUES ('$issueID', '$reportRESPONSE', '', 'issue', '$adminID', '$time')";

                    $reportinsertRESULT= mysqli_query($sconn, $reportinsertSQL);

                    if($reportinsertRESULT){
                        header('Location: _farmermanage.php?panel=admin&ri=true');
                    }
                }
                else{
                    header('Location: _farmermanage.php?panel=admin&loginf=true');
                }
            }
        }
    }
?>