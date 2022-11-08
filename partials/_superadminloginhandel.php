<?php
    include '_admindbconnect.php';
    include '_superadminmail.php';

    session_start();
    session_unset();
    session_destroy();

    $status= '';

    date_default_timezone_set('Asia/Kolkata');
    $time = date('Y-m-d H:i:s');

    function OTPgenerator($length){
    $chars = '!@#$%^&0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($chars), 0, $length);
    }

    if(!empty($_POST['sadminID']) && !empty($_POST['sadminPASSWORD']) && empty($_POST['sadminDBID']) && empty($_POST['sadminEMAIL']) && empty($_POST['sadminOTP'])){
        $sdaminID = $_POST['sadminID'];
        $sadminPASSWORD = $_POST['sadminPASSWORD'];

        $sadmincheckSQL = "SELECT * FROM `sadmin` WHERE sadminID= '$sdaminID'";
        $sadmincheckRESULT = mysqli_query($sconn, $sadmincheckSQL);
        $sadmincheckROWS = mysqli_num_rows($sadmincheckRESULT);

        if ($sadmincheckROWS == 1) {
            $sadmincheckROW = mysqli_fetch_assoc($sadmincheckRESULT);

            if (password_verify($sadminPASSWORD, $sadmincheckROW['sadminPASSWORD'])) {
                $sadminEMAIL = $sadmincheckROW['sadminEMAIL'];
                $sadminOTP = OTPgenerator(6);

                $status = sendOTP($sadminEMAIL, $sadminOTP);

                $sadminotpinsertSQL = "INSERT INTO `otp_check` (`otp`, `email`, `expired`, `createtime`) VALUES ('$sadminOTP', '$sadminEMAIL', '0', '$time')";
                $sadminotpinserRESULT = mysqli_query($sconn, $sadminotpinsertSQL);
                $sadminotpinserID = mysqli_insert_id($sconn);
            }
            else {
                header('Location: _adminpanel.php?panel=admin&loginsf=true');
            }
        }
        else{
            header('Location: _adminpanel.php?panel=admin&loginsf=true');
        }
    }

    if(!empty($_POST['sadminOTP']) && !empty($_POST['sadminEMAIL']) && !empty($_POST['sadminDBID']) && empty($_POST['sadminID']) && empty($_POST['sadminPASSWORD'])){
        $sadminOTP= $_POST['sadminOTP'];
        $sadminEMAIL= $_POST['sadminEMAIL'];
        $sadminDBID= $_POST['sadminDBID'];

        $sadminotpcheckSQL= "SELECT * FROM `otp_check` WHERE id= '$sadminDBID' AND email= '$sadminEMAIL' AND NOW()<= DATE_ADD(createtime, INTERVAL 3 MINUTE)";
        $sadminotpcheckRESULT= mysqli_query($sconn, $sadminotpcheckSQL);
        $sadminotpcheckROWS= mysqli_num_rows($sadminotpcheckRESULT);

        if($sadminotpcheckROWS== 1){
            $sadminotpcheckROW= mysqli_fetch_assoc($sadminotpcheckRESULT);
            $sadminotpDBID= $sadminotpcheckROW['otp'];

            if($sadminOTP== $sadminotpDBID){
                $sadminotpexpireSQL= "UPDATE `otp_check` SET `expired`= '1' WHERE `otp_check`.`id`= '$sadminDBID' AND `otp_check`.`email`= '$sadminEMAIL'";
                $sadminotpexpireRESULT= mysqli_query($sconn, $sadminotpexpireSQL);

                if($sadminotpexpireRESULT){
                    $sadminnameSQL= "SELECT * FROM `sadmin` WHERE sadminEMAIL= '$sadminEMAIL'";
                    $sadminnameRESULT= mysqli_query($sconn, $sadminnameSQL);
                    $sadminnameROWS= mysqli_num_rows($sadminnameRESULT);

                    if($sadminnameROWS== 1){
                        $sadminnameROW= mysqli_fetch_assoc($sadminnameRESULT);
                        $sadminNAME= $sadminnameROW['sadminNAME'];
                        $sadminID= $sadminnameROW['sadminID'];

                        session_start();
                        $_SESSION['logIN']= true;
                        $_SESSION['userTYPE']= 'superadmin';
                        $_SESSION['sadminNAME']= $sadminNAME;
                        $_SESSION['sadminID']= $sadminID;
                    
                        header('Location: _superadminpanel.php');
                    }
                }
            }
            else{
                header('Location: _adminpanel.php?panel=admin&loginso=true');
            }
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/farm/resource/bootstrapcss/bootstrap.min.css">
    <link rel="stylesheet" href="/farm/resource/icon/css/font-awesome.min.css">
    <title>ForFarmers!</title>

    <style>
        #all {
            background-image: url('/farm/content/image/bg.jpg');
            height: 80vh;
        }
    </style>
</head>

<body id="all" onload="pageRedirect()">
    <!-- Header START -->
    <?php
    include '_header.php';
    ?>
    <!-- Header END -->

    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container mb-3 mt-5 user-select-none text-center" style="color: white;">
        <h2 class="text-center">Welcome To Super Admin Login Portal</h2>
        <h5 class="text-dark my-3">This Page Will Be Close In: <span id="countdown">180</span> seconds.</h5>
    </div>
    <!-- Page Title END -->
    <!-- MainSection START -->
    <div class="container text-dark col-md-6">
    <?php
        if ($status == 1) {
            echo '<div class="container text-center user-select-none my-3" style="color: green;">
                        <h5>The OTP has been sent to your\'e Registered Email Address.</h5>
                </div>';
        }
    ?>
        <form action="_superadminloginhandel.php" method="POST" autocomplete="off">
            <?php
                if($status!= 1){
                    echo '<div class="mb-3">
                            <label for="SuperAdminId" class="form-label" style="font-weight: bold; font-size: 22px">Super Admin Id.</label>
                            <input type="text" class="form-control" id="SuperAdminId" name="sadminID" required>
                        </div>
                        <div class="mb-3">
                            <label for="SuperAdminPassword" class="form-label" style="font-weight: bold; font-size: 22px">Super Admin Password</label>
                            <input type="password" class="form-control" id="SuperAdminPassword" name="sadminPASSWORD" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Send OTP</button>
                        </div>';
                }
                if($status== 1){
                    echo '<div class="mb-3">
                            <label for="SuperAdminOTP" class="form-label" style="font-weight: bold; font-size: 22px">Enter OTP Here.</label>
                            <input type="text" class="form-control" id="SuperAdminOTP" name="sadminOTP" required>
                            <input type="hidden" name="sadminEMAIL" value="'.$sadminEMAIL.'">
                            <input type="hidden" name="sadminDBID" value="'.$sadminotpinserID.'">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Log In</button>
                        </div>';
                }
            ?>
        </form>
    </div>
    <div class="container pb-5 text-center">
        <button class="btn btn-danger my-3"><a href="_adminpanel.php?panel=admin" style="text-decoration: none; color: white;">Back To Admin Portal.</a></button>
    </div>
    <!-- MainSection END -->
    <!-- Content END -->

    <!-- Footer START -->
    <?php
    include '_footer.php';
    ?>
    <!-- Footer END -->
    <script src="/farm/resource/bootstrapjs/bootstrap.bundle.min.js"></script>
    <script>
        function pageRedirect() {
            setTimeout(function() {
                location.href = "_adminpanel.php?panel=admin"
            }, 180000);
        }

        var max_time = 180;
        var cinterval;

        function countdown_timer() {
            max_time--;
            document.getElementById('countdown').innerHTML = max_time;
            if (max_time == 0) {
                clearInterval(cinterval);
            }
        }
        cinterval = setInterval('countdown_timer()', 1000);
    </script>

</body>

</html>