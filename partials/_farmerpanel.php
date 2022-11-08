<?php
    $logins= false;
    $loginp= false;
    $loginu= false;

    if(isset($_GET['logins']) && $_GET['logins']== true){
        $logins= true;
    }
    if(isset($_GET['loginp']) && $_GET['loginp']== true){
        $loginp= true;
    }
    if(isset($_GET['loginu']) && $_GET['loginu']== true){
        $loginu= true;
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
        if($logins){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> You Successfully Logged in as a FARMER.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($loginp){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR.</strong> Your\'e password is INCORRECT.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($loginu){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERROR.</strong> No record found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container my-5" style="color: white;">
        <h2 class="text-center">Welcome To Farmers Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- MainSection START -->
    
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