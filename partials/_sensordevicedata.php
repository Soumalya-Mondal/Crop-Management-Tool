<?php
if (isset($_GET['deviceID']) && isset($_GET['panel']) && $_GET['panel'] == 'admin') {
    $deviceID = $_GET['deviceID'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/farm/resource/bootstrapcss/bootstrap.min.css">
    <link rel="stylesheet" href="/farm/resource/icon/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/farm/resource/datatable/datatables.min.css" />
    <script src="/farm/resource/jquery.js"></script>
    <title>ForFarmers!</title>
    <style>
        #all {
            background-image: url('/farm/content/image/bg.jpg');
            height: 80vh;
        }
    </style>

</head>

<body id="all">
    <?php
    include '_header.php';
    ?>
    <div class="container my-3 user-select-none" style="color: white;">
        <h2 class="text-center">Device <?php echo $deviceID; ?> Details!</h2>
    </div>
    <?php
        if(isset($_SESSION['login']) && isset($_SESSION['userTYPE']) && $_SESSION['login']== true && $_SESSION['userTYPE']== 'admin'){
            include '_sensordbconnect.php';

            $devicedetailsSQL= "SELECT * FROM `senor-list` WHERE deviceID= '$deviceID'";
            $devicedetailsRESULT= mysqli_query($conn, $devicedetailsSQL);
            $devicedetialsROWS= mysqli_num_rows($devicedetailsRESULT);

            if($devicedetialsROWS== 1){
                $devicedetailsROW= mysqli_fetch_assoc($devicedetailsRESULT);

                echo '<div class="container col-md-10 text-center user-select-none">
                        <table class="table table-borderless table-info">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Pincode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">'.$devicedetailsROW['deviceCONTACTPERSON'].'</th>
                                    <td><span style="font-weight: bold;">'.$devicedetailsROW['deviceCONTACT'].'</span></td>
                                    <td>'.$devicedetailsROW['deviceADDRESS'].'</td>
                                    <td>'.$devicedetailsROW['devicePINCODE'].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
            }
        }
    ?>
    <div class="container my-3 pb-5 user-select-none text-center">
        <table class="table table-dark table-hover table-striped table-sm" id="deviceTABLE">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time(24Hr Format)</th>
                    <th scope="col">Temperature(±1)</th>
                    <th scope="col">Humidity(±3)</th>
                </tr>
            </thead>
            <tbody>
    <?php
        if (isset($_SESSION['login']) && isset($_SESSION['userTYPE']) && $_SESSION['login'] == true && $_SESSION['userTYPE'] = 'admin') {
            include '_sensordbconnect.php';

            $deviceDATASQL = "SELECT * FROM `temp-humid-sensor` WHERE deviceID= '$deviceID' ORDER BY id DESC";
            $deviceDATARESULT = mysqli_query($conn, $deviceDATASQL);

            while ($deviceDATAROW = mysqli_fetch_assoc($deviceDATARESULT)) {
                echo '<tr>
                        <th scope="row">' . $deviceDATAROW['date'] . '</th>
                        <td>' . $deviceDATAROW['time'] . '</td>
                        <td>' . $deviceDATAROW['temp'] . '°C</td>
                        <td>' . $deviceDATAROW['humid'] . '%</td>
                    </tr>';
                }
            }
    ?>
            </tbody>
        </table>
    </div>
    <div class="container pb-5 text-center">
        <button class="btn btn-danger my-3"><a href="_adminpanel.php?panel=admin" style="text-decoration: none; color: white;">Back To Admin Portal.</a></button>
    </div>
    <?php
    include '_footer.php';
    ?>

    <script type="text/javascript" src="/farm/resource/datatable/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#deviceTABLE').DataTable({
                "ordering": false,
                "pageLength": 15,
                "lengthChange": false,
                "info": false,
                "paging": true,
                "processing": true,
                "responsive": true
            });
        });
    </script>
</body>

</html>