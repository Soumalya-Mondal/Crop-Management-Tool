<?php
    include '_admindbconnect.php';

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $adminID= $_POST['adminID'];
        $adminPASSWORD= $_POST['adminPASSWORD'];

        $adminloginSQL= "SELECT * FROM `admin` WHERE adminID= '$adminID'";
        $adminloginRESULT= mysqli_query($sconn, $adminloginSQL);
        $adminloginROWS= mysqli_num_rows($adminloginRESULT);

        if($adminloginROWS== 1){
            $adminloginROW= mysqli_fetch_assoc($adminloginRESULT);

            if(password_verify($adminPASSWORD, $adminloginROW['adminPASSWORD'])){
                session_start();
                $_SESSION['login']= true;
                $_SESSION['adminNAME']= $adminloginROW['adminNAME'];
                $_SESSION['adminID']= $adminloginROW['adminID'];
                $_SESSION['userTYPE']= 'admin';

                header('Location: /farm/partials/_adminpanel.php?logins=true&panel=admin');
            }
            else{
                header('Location: /farm/partials/_adminpanel.php?loginp=true&panel=admin');
            }
        }
        else{
            header('Location: /farm/partials/_adminpanel.php?loginu=true&panel=admin');
        }
    }
?>