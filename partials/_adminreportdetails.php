<?php
    include '_admindbconnect.php';

    $loginf= false;
    $print= false;
    $ri= false;

    if(isset($_GET['loginf']) && $_GET['loginf']== true){
        $loginf= true;
    }
    if(isset($_GET['print']) && $_GET['print']== true){
        $print= true;
    }
    if(isset($_GET['ri']) && $_GET['ri']== true){
        $ri= true;
    }
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
    <?php
        if($loginf){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR!</strong> Your\'e Admin Password is INCORRECT.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($print){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Farmer ID Card is ready to print.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if($ri){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Farmer Report Has Been Sent.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container my-3" style="color: white;">
        <h2 class="text-center user-select-none">Welcome To Report Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- MainSection START -->
    <div class="container my-3">
        <table class="table table-striped table-dark table-hover user-select-none text-center" id="reportTABLE">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Report</th>
                    <th scope="col">Response</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $adminID= $_SESSION['adminID'];
                    $reportdetailsSQL= "SELECT * FROM `report` WHERE adminID= '$adminID'";
                    $reportdetailsRESULT= mysqli_query($sconn, $reportdetailsSQL);

                    while($reportdetailsROW= mysqli_fetch_assoc($reportdetailsRESULT)){
                        $reportdate= $reportdetailsROW['issueTIME'];
                        $reportdate= date('d-m-Y', strtotime($reportdate));

                        echo '<tr>
                                <th scope="row">'.$reportdetailsROW['issueID'].'</th>
                                <td>'.$reportdetailsROW['issueMSG'].'</td>
                                <td>'.$reportdetailsROW['issueRESPONSE'].'</td>
                                <td>'.$reportdate.'</td>
                            </tr>';
                    }
                ?>
            </tbody>
        </table>
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
    <script type="text/javascript" src="/farm/resource/datatable/datatables.min.js"></script>
    
    <script>
        $(document).ready(function() {
        $('#reportTABLE').DataTable( {
        "ordering": false,
        "pageLength": 25,
        "lengthChange": false,
        "info": false,
        "paging": false,
        "processing": true,
        "responsive": false
            });
        });
    </script>
</body>

</html>