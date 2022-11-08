<?php
    session_start();
    include '_admindbconnect.php';
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
    <!-- Header START -->
    <nav class="navbar navbar-dark bg-dark user-select-none">
        <div class="container-fluid">
            <span style="color: white;"><?php echo $_SESSION['sadminNAME']; ?> (Super Admin)</span>
            <button class="btn btn-danger"><a href="_superadminlogout.php" style="text-decoration: none; color: white">Log Out</a></button>
        </div>
    </nav>
    <!-- Header END -->
    <?php
        if(isset($_GET['ri']) && $_GET['ri']== true){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Your\'e Response Submitted.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if(isset($_GET['sp']) && $_GET['sp']== true){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR!</strong> You Entered Wrong Password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if(isset($_GET['rd']) && $_GET['rd']== true){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Report Delete Successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container my-3 user-select-none" style="color: white;">
        <h2 class="text-center">Welcome To Report Manage Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- Delete Modal START -->
    <div class="modal" tabindex="-1" id="reportDELETE" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-select-none" id="reportDELETE">Report Delete</h5>
                </div>
                <div class="modal-body">
                    <form action="_superadminreportdelete.php" method="POST" autocomplete="off">
                        <input type="hidden" id="REPORTDid" name="id">
                        <div class="mb-3">
                            <label for="SAdminPassword" class="form-label">Super Admin Password</label>
                            <input type="password" class="form-control" id="SAdminPassword" name="sadminPASSWORD">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal END -->
    <!-- Response Modal START -->
    <div class="modal" tabindex="-1" id="reportRESPONSE" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-select-none" id="reportRESPONSE">Report Response</h5>
                </div>
                <div class="modal-body">
                    <form action="_superadminreportresponse.php" method="POST" autocomplete="off">
                        <input type="hidden" id="REPORTRid" name="id">
                        <div class="mb-3">
                            <label for="ReportResponse" class="form-label">Message</label>
                            <textarea type="password" class="form-control" id="ReportResponse" name="reportRESPONSE" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="SAdminPassword" class="form-label">Super Admin Password</label>
                            <input type="password" class="form-control" id="SAdminPassword" name="sadminPASSWORD">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                    </form>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Response Modal END -->
    <!-- MainSection START -->
    <div class="container user-select-none text-center">
        <table class="table table-dark table-hover table-striped" id="reportTABLE">
            <thead>
                <tr>
                    <th scope="col">Report ID</th>
                    <th scope="col">From</th>
                    <th scope="col">Date</th>
                    <th scope="col">Message</th>
                    <th scope="col">Response</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $reportactiveSQL= "SELECT * FROM `report` WHERE issueACTIVE= 'issue'";
                    $reportactiveRESULT= mysqli_query($sconn, $reportactiveSQL);

                    while($reportactiveROW= mysqli_fetch_assoc($reportactiveRESULT)){
                        $reportrdate= $reportactiveROW['issueTIME'];
                        $reportrdate= date('d-m-Y', strtotime($reportrdate));
                        echo '<tr>
                                <th scope="row">'.$reportactiveROW['id'].'</th>
                                <th scope="row">'.$reportactiveROW['issueID'].'</th>
                                <th scope="row">'.$reportrdate.'</th>
                                <td>'.$reportactiveROW['issueMSG'].'</td>
                                <td>'.$reportactiveROW['issueRESPONSE'].'</td>
                                <td><button type="button" class="response btn btn-success mx-1">Response</button></td>
                            </tr>';
                    }
                    $reportinactiveSQL= "SELECT * FROM `report` WHERE issueACTIVE= 'solve'";
                    $reportinactiveRESULT= mysqli_query($sconn, $reportinactiveSQL);

                    while($reportinactiveROW= mysqli_fetch_assoc($reportinactiveRESULT)){
                        $reportsdate= $reportinactiveROW['issueTIME'];
                        $reportsdate= date('d-m-Y', strtotime($reportsdate));
                        echo '<tr>
                                <th scope="row">'.$reportinactiveROW['id'].'</th>
                                <th scope="row">'.$reportinactiveROW['issueID'].'</th>
                                <th scope="row">'.$reportsdate.'</th>
                                <td>'.$reportinactiveROW['issueMSG'].'</td>
                                <td>'.$reportinactiveROW['issueRESPONSE'].'</td>
                                <td><button type="button" class="delete btn btn-danger mx-1">Delete</button></td>
                            </tr>';
                    }
                ?>
            </tbody>
        </table>
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
    <script type="text/javascript" src="/farm/resource/datatable/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#reportTABLE').DataTable({
                "ordering": false,
                "pageLength": 25,
                "lengthChange": false,
                "info": false,
                "paging": false,
                "processing": true,
                "responsive": true
            });
        });
    </script>
    <script>
        responsed = document.getElementsByClassName('response');
        Array.from(responsed).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                reportRID= tr.getElementsByTagName("th")[0].innerText;
                // console.log(reportRID);
                REPORTRid.value= reportRID;
                $('#reportRESPONSE').modal('toggle');
            })
        })
    </script>
    <script>
        deleted = document.getElementsByClassName('delete');
        Array.from(deleted).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                reportDID= tr.getElementsByTagName("th")[0].innerText;
                // console.log(reportDID);
                REPORTDid.value= reportDID;
                $('#reportDELETE').modal('toggle');
            })
        })
    </script>

</body>

</html>