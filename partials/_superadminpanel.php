<?php
    session_start();
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
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span style="color: white;"><?php echo $_SESSION['sadminNAME']; ?> (Super Admin)</span>
            <button class="btn btn-danger"><a href="_superadminlogout.php" style="text-decoration: none; color: white">Log Out</a></button>
        </div>
    </nav>
    <!-- Header END -->
    
    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container my-5 user-select-none" style="color: white;">
        <h2 class="text-center">Welcome To Super Admin Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- MainSection START -->
    <?php
        if(isset($_SESSION['logIN']) && $_SESSION['logIN']== true && $_SESSION['userTYPE']== 'superadmin'){
            echo '<div class="container my-5 mb-5">
                    <div class="row my-3">
                        <div class="col-md-6 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Add Admin.</h5>
                                    <button class="btn btn-danger" style="color: white;"><a href="_superadminaddadmin.php" style="text-decoration: none; color: white;">Add Admin</a></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Admin Details.</h5>
                                    <a href="_superadminadminmanage.php"><button class="btn btn-danger" style="color: white;">Admin Details</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Farmer Details.</h5>
                                    <a href="_superadminfarmermanage.php"><button class="btn btn-danger" style="color: white;">Farmer Details</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Report Details.</h5>
                                    <a href="_superadminreport.php"><button class="btn btn-danger" style="color: white;">Edit Report</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-5">
                            <div class="card mx-auto shadow-lg bg-body rounded" style="width: 20rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-center user-select-none">Crop Price Details.</h5>
                                    <a href="_superadmincropprice.php"><button class="btn btn-danger" style="color: white;">Crop Price</button></a>
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