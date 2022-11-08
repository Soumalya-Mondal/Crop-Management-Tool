<?php
    include '_sensordbconnect.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/farm/resource/bootstrapcss/bootstrap.min.css">
    <link rel="stylesheet" href="/farm/resource/icon/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/farm/resource/datatable/datatables.min.css"/>
    <script src="/farm/resource/jquery.js"></script>
    <title>ForFarmers!</title>
    <style>
        #all{
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
        <h2 class="text-center">Welcome To Temperature Details Panel!</h2>
    </div>
    <div class="container my-3 pb-5 user-select-none text-center">
        <table class="table table-dark table-hover table-striped table-sm" id="sensorTABLE">
            <thead>
                <tr>
                    <th scope="col">State</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Contact Person Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sensorstateSHOWSQL= "SELECT * FROM `state-list`";
                    $sensorstateSHOWRESULT= mysqli_query($conn, $sensorstateSHOWSQL);

                    while($sensorstateSHOWROW= mysqli_fetch_assoc($sensorstateSHOWRESULT)){
                        echo '<tr>
                                <th scope="row">'.$sensorstateSHOWROW['stateNAME'].'</th>
                                <td>'.$sensorstateSHOWROW['stateCONTACT'].'</td>
                                <td>'.$sensorstateSHOWROW['stateCONTACTNAME'].'</td>
                                <td><a href=""><button class="btn btn-danger" style="color: white;">Details</button></a></td>
                            </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        include '_footer.php';
    ?>

    <script type="text/javascript" src="/farm/resource/datatable/datatables.min.js"></script>
    
    <script>
        $(document).ready(function() {
        $('#sensorTABLE').DataTable( {
        "ordering": false,
        "pageLength": 50,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "processing": true,
        "responsive": true
            });
        });
    </script>
</body>