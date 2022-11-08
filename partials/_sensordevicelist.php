<?php
    if(isset($_GET['state']) && isset($_GET['panel']) && $_GET['panel']== 'admin'){
        $stateNAME= $_GET['state'];
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
        <h2 class="text-center"><?php echo $stateNAME; ?>'s Devices Updated Data Panel!</h2>
    </div>
    <div class="container my-3 pb-5 user-select-none text-center">
        <table class="table table-dark table-hover table-striped table-sm" id="deviceTABLE">
            <thead>
                <tr>
                    <th scope="col">Device ID</th>
                    <th scope="col">Temperature(±1)</th>
                    <th scope="col">Humidity(±3)</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_SESSION['login']) && $_SESSION['login']== true && isset($_SESSION['userTYPE']) && $_SESSION['userTYPE']== 'admin'){
                        include '_sensordbconnect.php';

                        $deviceSHOWSQL= "SELECT * FROM `senor-list` WHERE deviceLOCATION= '$stateNAME'";
                        $deviceSHOWRESULT= mysqli_query($conn, $deviceSHOWSQL);

                        while($deviceSHOWROW= mysqli_fetch_assoc($deviceSHOWRESULT)){
                            $deviceID= $deviceSHOWROW['deviceID'];
                            $deviceCONTACT= $deviceSHOWROW['deviceCONTACT'];

                            $deivceLASTDATASQL= "SELECT `temp`, `humid`, `date`, `time` FROM `temp-humid-sensor` WHERE `deviceID`='$deviceID' ORDER BY `id` DESC LIMIT 1";
                            $deviceLASTDATARESULT= mysqli_query($conn, $deivceLASTDATASQL);
                            $deviceLASTDATAROWS= mysqli_num_rows($deviceLASTDATARESULT);
                            
                            if($deviceLASTDATAROWS> 0){
                                $deviceLASTDATAROW= mysqli_fetch_assoc($deviceLASTDATARESULT);

                                echo '<tr>
                                        <th scope="row">'.$deviceID.'</th>
                                        <td>'.$deviceLASTDATAROW['temp'].'°C</td>
                                        <td>'.$deviceLASTDATAROW['humid'].'%</td>
                                        <td>'.$deviceLASTDATAROW['date'].'</td>
                                        <td>'.$deviceLASTDATAROW['time'].'</td>
                                        <td><button class="DEVICEdetail btn btn-info mx-1" style="color: white;">Device Details</button></td>
                                    </tr>';
                            }
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
        $('#deviceTABLE').DataTable( {
        "ordering": false,
        "pageLength": 20,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "processing": true,
        "responsive": true
            });
        });
    </script>
    <script>
        details = document.getElementsByClassName('DEVICEdetail');
        Array.from(details).forEach((element) => {
            element.addEventListener("click", (e) => {
            tr= e.target.parentNode.parentNode;
            deviceID= tr.getElementsByTagName("th")[0].innerText;
            // console.log(deviceID);
            location.href= "_sensordevicedata.php?panel=admin&deviceID="+ deviceID;
            })
        })
    </script>
</body>

</html>