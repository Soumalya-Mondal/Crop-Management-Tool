<?php
    if($_SERVER['REQUEST_METHOD']== 'POST' && $_GET['panel']== 'admin'){
        $farmerNAME= $_POST['uname'];
        $farmerADDRESS= $_POST['address'];
        $farmerSTATE= $_POST['state'];
        $farmerPINCODE= $_POST['pincode'];
        $farmerAADHAAR= $_POST['aadhaarnum'];
        $farmerGENDER= $_POST['gender'];
        $farmerDOB= $_POST['dob'];
        $farmerPICTUREDATA= $_POST['photoStore'];
    }

    $tempuploadDIR= 'C:/xampp/htdocs/farm/partials/tempfarmerPICTURE/';
    $tempphotoNAME= $tempuploadDIR.$farmerNAME.$farmerAADHAAR.'.jpeg';

    $farmerpictureBINARYDATA= base64_decode($farmerPICTUREDATA);
    $result= file_put_contents($tempphotoNAME, $farmerpictureBINARYDATA);

    $IMAGE= imagecreatefromjpeg($tempphotoNAME);
    $area= ['x'=> 40, 'y'=> 0, 'width'=> 240, 'height'=> 240];
    $crop= imagecrop($IMAGE, $area);
    unlink($tempphotoNAME);
    imagejpeg($crop, $tempphotoNAME, 100);
    imagedestroy($IMAGE);
    imagedestroy($crop);

    $displayphotoNAME= $farmerNAME.$farmerAADHAAR.'.jpeg';

    $uploadPHOTODIR= 'C:/xampp/htdocs/farm/partials/tempfarmerPICTURE/'.$displayphotoNAME;
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
            height: 100vh;

        }
    </style>
</head>

<body id="all">
    <!-- Header START -->
    <?php
    include '_header.php';
    ?>
    <!-- Header END -->

    <!-- Content START -->
    <!-- Header START -->
    <div class="container" style="color: white;">
        <h2 class="text-center">Please Check All The Farmer Details Carefully Before Submit!</h2>
    </div>
    <!-- Header END -->
    <!-- MainSection START -->
    <div class="container bg-light rounded" style="font-size: 18px;">
        <?php
            echo '
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">Name:</th>
                        <td>'.$farmerNAME.'</td>
                    </tr>
                    <tr>
                        <th scope="row">Address:</th>
                        <td>'.$farmerADDRESS.'</td>
                    </tr>
                    <tr>
                        <th scope="row">State:</th>
                        <td>'.$farmerSTATE.'</td>
                    </tr>
                    <tr>
                        <th scope="row">Pin Code:</th>
                        <td>'.$farmerPINCODE.'</td>
                    </tr>
                    <tr>
                        <th scope="row">Aadhaar Number:</th>
                        <td>'.$farmerAADHAAR.'</td>
                    </tr>
                    <tr>
                        <th scope="row">Gender:</th>
                        <td>'.$farmerGENDER.'</td>
                    </tr>
                    <tr>
                        <th scope="row">Date Of Birth:</th>
                        <td>'.$farmerDOB.'</td>
                    </tr>
                    <tr>
                        <th scope="row">Farmer Image:</th>
                        <td><img src="/farm/partials/tempfarmerPICTURE/'.$displayphotoNAME.'"></td>
                    </tr>';
        ?>
                <form action="_farmersignuphandel.php" method="POST">
                    <input type="hidden" name="uname" value="<?php echo $farmerNAME ?>">
                    <input type="hidden" name="address" value="<?php echo $farmerADDRESS ?>">
                    <input type="hidden" name="state" value="<?php echo $farmerSTATE ?>">
                    <input type="hidden" name="pincode" value="<?php echo $farmerPINCODE ?>">
                    <input type="hidden" name="aadhaarnum" value="<?php echo $farmerAADHAAR ?>">
                    <input type="hidden" name="gender" value="<?php echo $farmerGENDER ?>">
                    <input type="hidden" name="dob" value="<?php echo $farmerDOB ?>">
                    <input type="hidden" name="pictureDIR" value="<?php echo $uploadPHOTODIR ?>">
                    <tr>
                        <th class="text-center"><button type="submit" class="btn btn-success">Submit</button></th>
                </form>
                        <th class="text-center"><button class="btn btn-primary mb-5"><a href="_addfarmer.php?panel=admin"
                        style="text-decoration: none; color: white;">Back</a></button></th>
                    </tr>
                </tbody>
            </table>
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