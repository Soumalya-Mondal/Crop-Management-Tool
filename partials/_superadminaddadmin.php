<?php
    session_start();
    include '_admindbconnect.php';
    include '_adminmail.php';

    date_default_timezone_set('Asia/Kolkata');
    $ai= false;
    $ae= false;

    if(isset($_GET['ai']) && $_GET['ai']== true){
        $ai= true;
    }
    if(isset($_GET['ae']) && $_GET['ae']== true){
        $ae= true;
    }

    function get_admin_ID($sconn){
        $adminidSQL= "SELECT adminID FROM `admin` ORDER BY adminDBID DESC LIMIT 1";
        $adminidRESULT= mysqli_query($sconn, $adminidSQL);
        $adminidROWS= mysqli_num_rows($adminidRESULT);

        if($adminidROWS> 0){
            $sadminidROW= mysqli_fetch_assoc($adminidRESULT);

            $adminidEXITS= $sadminidROW['adminID'];
            $adminidEXITS= substr($adminidEXITS, 10, 14);
            $adminidEXITS= $adminidEXITS+ 1;
            $adminidEXITS= sprintf('%04s', $adminidEXITS);
            $adminidEXITS= substr($adminidEXITS, 1, 5);

            $date= date('y-m');

            $adminNEWID= 'ADM/'.$date.'/'.sprintf('%04s', $adminidEXITS);

            return $adminNEWID;
        }
        else{
            $date= date('y-m');

            $adminNEWID= 'ADM/'.$date.'/0001';

            return $adminNEWID;
        }
    }
    if(isset($_SESSION['logIN']) && isset($_SESSION['userTYPE']) && $_SESSION['logIN']== true && $_SESSION['userTYPE']== 'superadmin'){
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $adminNAME= $_POST['adminNAME'];
            $adminPHONE= $_POST['adminPHONE'];
            $adminEMAIL= $_POST['adminEMAIL'];
            $adminGENDER= $_POST['adminGENDER'];
            $adminAADHAAR= $_POST['adminAADHAAR'];

            $admincheckSQL= "SELECT * FROM `admin` WHERE adminEMAIL= '$adminEMAIL' OR adminAADHAAR= '$adminAADHAAR'";
            $admincheckRESULT= mysqli_query($sconn, $admincheckSQL);
            $admincheckROWS= mysqli_num_rows($admincheckRESULT);

            if($admincheckROWS== 0){
                $createTIME= date('Y-m-d H:i:s');
                $adminID= get_admin_ID($sconn);

                $password1= substr($adminNAME, 0, 4);
                $password2= substr($adminAADHAAR, 4, 4);
                $adminPASSWORD= strtoupper($password1.$password2);
                
                $status= sendOTP($adminEMAIL, $adminID, $adminPASSWORD);

                if($status== 1){
                    $adminPASSWORDHASH= password_hash($adminPASSWORD, PASSWORD_DEFAULT);

                    $adminCREATENAME= $_SESSION['sadminNAME'];
                    $adminCREATEID= $_SESSION['sadminID'];

                    $admininsertSQL= "INSERT INTO `admin` (`adminID`, `adminPASSWORD`, `adminNAME`, `adminGENDER`, `adminPHONE`, `adminEMAIL`, `adminAADHAAR`, `adminCREATETIME`, `adminCREATENAME`, `adminCREATEID`) VALUES ('$adminID', '$adminPASSWORDHASH', '$adminNAME', '$adminGENDER', '$adminPHONE', '$adminEMAIL', '$adminAADHAAR', '$createTIME', '$adminCREATENAME', '$adminCREATEID')";
                    $admininsertRESULT= mysqli_query($sconn, $admininsertSQL);

                    if($admininsertRESULT){
                    header('Location: _superadminaddadmin.php?ai=true');
                    }
                }
            }
            else{
                header('Location: _superadminaddadmin.php?ae=true');
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
        #formBG {
            background-color: #97f2f0;
        }
    </style>
</head>

<body id="all">
    <!-- Header START -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span style="color: white;"><?php echo $_SESSION['sadminNAME']; ?> (Super Admin)</span>
            <button class="btn btn-danger"><a href="_superadminlogout.php" style="text-decoration: none; color: white">Log Out</a></button>
        </div>
    </nav>
    <!-- Header END -->
    <?php
        if($ai){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Admin Is Successfully Added.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($ae){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERROR!</strong> Admin Already Registered.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container my-3 user-select-none" style="color: white;">
        <h2 class="text-center">Welcome To Add Admin Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- MainSection START -->
    <?php
        if(isset($_SESSION['logIN']) && isset($_SESSION['userTYPE']) && $_SESSION['logIN']== true && $_SESSION['userTYPE']== 'superadmin'){
            echo '<div class="container col-md-8 pb-5" id="formBG">
                    <form action="_superadminaddadmin.php" method="POST" autocomplete="off">
                        <div class="mb-3">
                            <label for="AdminName" class="form-label" style="font-weight: bold; font-size: 22px;">Name</label>
                            <input type="text" class="form-control" id="AdminName" name="adminNAME" required>
                        </div>
                        <div class="mb-3">
                            <label for="AdminPassword" class="form-label" style="font-weight: bold; font-size: 22px;">Contact Number (add:+91)</label>
                            <input type="number" class="form-control" id="AdminPassword" name="adminPHONE" required>
                        </div>
                        <div class="mb-3">
                            <label for="AdminEmail" class="form-label" style="font-weight: bold; font-size: 22px;">Email</label>
                            <input type="email" class="form-control" id="AdminEmail" name="adminEMAIL" required>
                        </div>
                        <div class="mb-3">
                            <label for="AdminAadhaar" class="form-label" style="font-weight: bold; font-size: 22px;">Aadhaar Number</label>
                            <input type="number" class="form-control" id="AdminAadhaar" name="adminAADHAAR" required>
                        </div>
                        <div class="mb-3">
                            <label for="AdminGender" class="form-label" style="font-weight: bold; font-size: 22px;">Gender</label>
                            <select class="form-select" id="AdminGender" name="adminGENDER" required>
                                <option selected value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="container text-center">
                            <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                            <button class="btn btn-danger"><a href="_superadminpanel.php" style="text-decoration: none; color: white;">Back To Super Admin Portal.</a></button>
                        </div>
                </div>';
        }
    ?>
    <!-- MainSection END -->
    <!-- Content END -->

    <!-- Footer START -->
    <?php
    include '_footer.php';
    ?>
    <!-- Footer END -->
    <script src="/farm/resource/bootstrapjs/bootstrap.bundle.min.js"></script>

</body>

</html>