<?php
    include '_dbconnect.php';

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $farmerAADHAAR= $_POST['farmeraadhaar'];
        $farmerPASSWORD= $_POST['farmerpassword'];

        $farmerloginSQL= "SELECT * FROM `farmer` WHERE farmerAADHAAR= '$farmerAADHAAR'";
        $farmerloginRESULT= mysqli_query($conn, $farmerloginSQL);
        $farmerloginROWS= mysqli_num_rows($farmerloginRESULT);

        if($farmerloginROWS== 1){
            $farmerloginROW= mysqli_fetch_assoc($farmerloginRESULT);

            if(password_verify($farmerPASSWORD, $farmerloginROW['farmerPASSWORD'])){
                session_start();
                $_SESSION['login']= true;
                $_SESSION['farmerNAME']= $farmerloginROW['farmerNAME'];
                $_SESSION['userTYPE']= 'farmer';

                header('Location: /farm/partials/_farmerpanel.php?logins=true&panel=farmer');
            }
            else{
                header('Location: /farm/partials/_farmerpanel.php?loginp=true&panel=farmer');
            }
        }
        else{
            header('Location: /farm/partials/_farmerpanel.php?loginu=true&panel=farmer');
        }
    }
?>