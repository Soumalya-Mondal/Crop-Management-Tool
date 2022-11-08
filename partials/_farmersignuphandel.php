<?php
    session_start();
    include '_dbconnect.php';

    $admincreatedID= $_SESSION['adminID'];
    $admincreatedNAME= $_SESSION['adminNAME'];
    $uploadDIR= 'C:/xampp/htdocs/farm/partials/farmerPICTURE/';

    // Function For Unique Farmer ID START
    function get_unique_farmer_id($conn, $state){
        date_default_timezone_set("Asia/Kolkata");

        $farmeridSQL= "SELECT farmerID FROM `farmer` ORDER BY farmerDBID DESC LIMIT 1";
        $farmeridRESULT= mysqli_query($conn, $farmeridSQL);
        $farmeridexitsROWS= mysqli_num_rows($farmeridRESULT);

        if($farmeridexitsROWS> 0){
            $farmeridexitsROW= mysqli_fetch_assoc($farmeridRESULT);

            $farmeridexits= $farmeridexitsROW['farmerID'];
            $farmeridexits= substr($farmeridexits, 14, 18);

            $farmeridTODAY= date('Ymd');
            $farmeridTODAY= substr($farmeridTODAY, 2, 6);

            $farmeridTIME= date('hisa');
            $farmeridTIME= substr($farmeridTIME, 0, 6);

            $farmeridSTATE= substr($state, 0, 2);

            $farmeridexits= $farmeridexits+1;

            $farmeridexits= sprintf('%04s', $farmeridexits);
            $farmeridexits= substr($farmeridexits, 1, 5);

            $farmerNEWID= $farmeridSTATE.$farmeridTODAY.$farmeridTIME.sprintf('%04s', $farmeridexits);

            return $farmerNEWID;
        }
        else{
            $farmeridTODAY= date('Ymd');
            $farmeridTODAY= substr($farmeridTODAY, 2, 6);

            $farmeridTIME= date('hisa');
            $farmeridTIME= substr($farmeridTIME, 0, 6);

            $farmeridSTATE= substr($state, 0, 2);

            $farmerNEWID= $farmeridSTATE.$farmeridTODAY.$farmeridTIME.'0001';

            return $farmerNEWID;
        }

    }
    // Function For Unique Farmer ID END

    // Function For State Name START
    function get_state_name($farmerSTATE){
        $farmerLEN= strlen($farmerSTATE);
        $farmerNEWSTATE= substr($farmerSTATE, 3, $farmerLEN);

        return $farmerNEWSTATE;
    }
    // Function For State Name END

    // Function For Farmer Password START
    function get_farmer_password($farmerNAME, $farmerAADHAAR){

        $farmerNAME= substr($farmerNAME, 0, 4);
        $farmerNAME= strtoupper($farmerNAME);

        $farmerAADHAAR= substr($farmerAADHAAR, 8, 12);

        $farmerPASSWORD= $farmerNAME.$farmerAADHAAR;

        return $farmerPASSWORD;
    }

    if($_SERVER['REQUEST_METHOD']== 'POST' && $_SESSION['userTYPE']== 'admin'){
        $farmerNAME= $_POST['uname'];
        $farmerADDRESS= $_POST['address'];
        $farmerSTATE= $_POST['state'];
        $farmerPINCODE= $_POST['pincode'];
        $farmerAADHAAR= $_POST['aadhaarnum'];
        $farmerGENDER= $_POST['gender'];
        $farmerDOB= $_POST['dob'];
        $farmerPICTURE= $_POST['pictureDIR'];

        $farmeraadhaarexitsSQL= "SELECT * FROM `farmer` WHERE farmerAADHAAR= '$farmerAADHAAR'";
        $farmeraadhaarexitsRESULT= mysqli_query($conn, $farmeraadhaarexitsSQL);
        $farmeraadhaarexitsROW= mysqli_num_rows($farmeraadhaarexitsRESULT);

        if($farmeraadhaarexitsROW>0){
            header('Location: /farm/partials/_adminpanel.php?loginfe=true&panel=admin');
        }
        else{
            // Server Generated Farmer ID
            $farmerUNIQUEID= get_unique_farmer_id($conn, $farmerSTATE);

            // Server Generated State Name
            $farmerNEWSTATE= get_state_name($farmerSTATE);

            // Server Generated Password
            $farmerPASSWORD= get_farmer_password($farmerNAME, $farmerAADHAAR);
            $farmerPASSWORDHASH= password_hash($farmerPASSWORD, PASSWORD_DEFAULT);

            //Current Time
            $time= date('Y-m-d H:i:s');
            
            // Move Picture
            $farmerPICTURENAME= $farmerNAME.$farmerAADHAAR.'.jpeg';
            $perfermerPICTUREDIR= $uploadDIR.$farmerPICTURENAME;
            rename($farmerPICTURE, $perfermerPICTUREDIR);
            unlink($farmerPICTURE);
            $farmerSQLDIR= 'partials/farmerPICTURE/'.$farmerPICTURENAME;

            $farmersignupSQL= "INSERT INTO `farmer` (`farmerID`, `farmerNAME`, `farmerADDRESS`, `farmerSTATE`, `farmerPINCODE`, `farmerAADHAAR`, `farmerPICTURE`, `farmerGENDER`, `farmerDOB`, `farmerACTIVE`, `farmerPASSWORD`, `farmerPRINTCOUNT`, `admincreatedID`, `admincreatedNAME`, `farmerCREATE`) VALUES ('$farmerUNIQUEID', '$farmerNAME', '$farmerADDRESS', '$farmerNEWSTATE', '$farmerPINCODE', '$farmerAADHAAR', '$farmerSQLDIR', '$farmerGENDER', '$farmerDOB', '0', '$farmerPASSWORDHASH', '0', '$admincreatedID', '$admincreatedNAME', '$time')";

            $farmersignupRESULT= mysqli_query($conn, $farmersignupSQL);

            if($farmersignupRESULT){
                header('Location: /farm/partials/_adminpanel.php?loginfs=true&panel=admin');
            }
            else{
                header('Location : /farm/partials/_adminpanel.php?loginff=true&panel=admin');
            }
        }
    }
