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
        <h2 class="text-center">Welcome To Crop Price Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- MainSection START -->
    <div class="container text-center">
        <h3>Sorry, this page is under maintenance.</h3>
        <button class="btn btn-danger my-3"><a href="_superadminpanel.php" style="text-decoration: none; color: white;">Back To Super Admin Portal.</a></button>
    </div>
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