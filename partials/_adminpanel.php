<?php
    $loginfs= false;
    $loginff= false;
    $loginfe= false;
    $logins= false;
    $loginp= false;
    $loginu= false;
    $loginsf= false;
    $loginso= false;

    if(isset($_GET['loginfs']) && $_GET['loginfs']== true){
        $loginfs= true;
    }
    if(isset($_GET['loginff']) && $_GET['loginff']== true){
        $loginff= true;
    }
    if(isset($_GET['loginfe']) && $_GET['loginfe']== true){
        $loginfe= true;
    }
    if(isset($_GET['logins']) && $_GET['logins']== true){
        $logins= true;
    }
    if(isset($_GET['loginp']) && $_GET['loginp']== true){
        $loginp= true;
    }
    if(isset($_GET['loginu']) && $_GET['loginu']== true){
        $loginu= true;
    }
    if(isset($_GET['loginsf']) && $_GET['loginsf']== true){
        $loginsf= true;
    }
    if(isset($_GET['loginso']) && $_GET['loginso']== true){
        $loginso= true;
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
        #all{
            background-image: url('/farm/content/image/bg.jpg');
            height: 80vh;
        }
    </style>
</head>

<body id="all">
    <!-- Header START -->
    <?php
    include '_header.php';
    ?>
    <!-- Header END -->
    <?php
        if($loginfs){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Farmer Added.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($loginff){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERROR.</strong> Farmer Added Unsuccessfull.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($loginfe){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR.</strong> This Aadhaar Number Is Already Registered.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($logins){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> You\'e Logged is as a ADMIN.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($loginp){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERROR.</strong> Admin Password is Not Match.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($loginu){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR.</strong> You\'re not ADMIN.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($loginsf){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR.</strong> Check Your\'e Credential, We Can\'t share which field is wrong because of SECURITY PERPOSE.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($loginso){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERROR.</strong> You Entered The Wrong OTP.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container my-5 user-select-none" style="color: white;">
        <h2 class="text-center">Welcome To Admin Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- MainSection START -->
    <?php
        if(isset($_SESSION['login']) && $_SESSION['login']== true && $_SESSION['userTYPE']== 'admin'){
            echo '<div class="container my-5 mb-5">
                    <div class="row my-3">
                        <div class="col-md-6 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Add Farmer.</h5>
                                    <!-- <p class="card-text text-break user-select-none">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque dolores exercitationem veniam iusto consequatur modi sapiente ea tempora nam nisi!</p> -->
                                    <button class="btn btn-danger" style="color: white;"><a href="_addfarmer.php?panel=admin" style="text-decoration: none; color: white;">Add Farmer</a></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Get Farmer Details.</h5>
                                    <!-- <p class="card-text text-break user-select-none">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis voluptas ex vero corrupti, veniam numquam nesciunt odio provident dolores asperiores.</p> -->
                                    <a href="_farmermanage.php?panel=admin"><button class="btn btn-danger" style="color: white;">Farmer Details</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Get Temperature Details.</h5>
                                    <!-- <p class="card-text text-break user-select-none">There are sensor built in WAREHOUSE, You can get all details from there.</p> -->
                                    <a href="_sensorstatelist.php?panel=admin"><button class="btn btn-danger" style="color: white;">Temperature Details</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Get Report Details.</h5>
                                    <!-- <p class="card-text text-break user-select-none">There are sensor built in WAREHOUSE, You can get all details from there.</p> -->
                                    <a href="_adminreportdetails.php?panel=admin"><button class="btn btn-danger" style="color: white;">Report Details</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Super Admin Portal.</h5>
                                    <!-- <p class="card-text text-break user-select-none">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis voluptas ex vero corrupti, veniam numquam nesciunt odio provident dolores asperiores.</p> -->
                                    <button class="btn btn-danger"><a href="_superadminloginhandel.php?panel=admin" style="text-decoration: none; color: white;">Log In</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        else{
            echo '<div class="container my-5 mb-5">
                    <div class="row my-3">
                        <div class="col-md-4 my-2">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Add Farmer.</h5>
                                    <p class="card-text text-break user-select-none">Add farmer to database, but you have to login first.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-2">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Get Farmer Details.</h5>
                                    <p class="card-text text-break user-select-none">Get Farmer details from database, but at first you have to login.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-2">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Get Temperature Details</h5>
                                    <p class="card-text text-break user-select-none">Get Temperature details from databsse, but at first you have to login.</p>
                                </div>
                            </div>
                        </div>
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