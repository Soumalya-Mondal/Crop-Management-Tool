<?php
    include '_dbconnect.php';

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
    <div class="container my-5" style="color: white;">
        <h2 class="text-center user-select-none">Welcome To Farmers Manage Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- MainSection START -->
    <!-- Details Modal START -->
    <div class="modal" tabindex="-1" id="farmerDETAILS" aria-labelledby="farmerDETAILS" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title user-select-none" id="farmerDETAILS">Farmer Id Card Print</h5>
            </div>
            <div class="modal-body">
                <form action="/farm/makePDF.php" method="POST">
                    <input type="hidden" name="FARMERid" id="FARMERid">
                    <input type="hidden" name="FARMERaadhaar" id="FARMERaadhaar">
                    <div class="mb-3">
                        <label for="adminPASSWORD" class="form-label">Admin Password <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" id="adminPASSWORD" name="adminPASSWORD" required>
                    </div>
            </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Print</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
          </div>
        </div>
    </div>
    <!-- Details Modal END -->
    <!-- Response Modal START -->
    <div class="modal" tabindex="-1" id="reportSEND" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-select-none" id="reportSEND">Report</h5>
                </div>
                <div class="modal-body">
                    <form action="_adminreportsend.php" method="POST" autocomplete="off">
                        <input type="hidden" id="ISSUEid" name="issueID">
                        <div class="mb-3">
                            <label for="ReportResponse" class="form-label">Message</label>
                            <textarea type="password" class="form-control" id="ReportResponse" name="reportRESPONSE" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="AdminPassword" class="form-label">Admin Password</label>
                            <input type="password" class="form-control" id="AdminPassword" name="adminPASSWORD">
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
    <div class="container my-3 bg-light py-3">
        <table class="table table-striped table-light table-hover user-select-none text-center" id="farmerTABLE" style="padding-top: 10px;">
            <thead>
                <tr>
                    <th scope="col">Farmer Image</th>
                    <th scope="col">Farmer ID</th>
                    <th scope="col">Farmer Name</th>
                    <th scope="col">Farmer DoB</th>
                    <th scope="col">Farmer Aadhaar</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $farmermanageSQL= "SELECT * FROM `farmer`";
                    $farmermanageRESULT= mysqli_query($conn, $farmermanageSQL);

                    while($farmermanageROW= mysqli_fetch_assoc($farmermanageRESULT)){
                        $farmerDOB= $farmermanageROW['farmerDOB'];
                        $farmerDOB= date("d-m-Y", strtotime($farmerDOB));
                        $farmeractive= $farmermanageROW['farmerACTIVE'];

                        if($farmeractive== 1){
                            echo '<tr>
                                    <td><img src="/farm/'.$farmermanageROW['farmerPICTURE'].'" alt="User" width="90px" height="90px" id="farmerPICTURE"></td>
                                    <th scope="row">'.$farmermanageROW['farmerID'].'</th>
                                    <td>'.$farmermanageROW['farmerNAME'].'<br><span class="badge bg-success">Verified</span></td>
                                    <td>'.$farmerDOB.'<br><span class="badge bg-success">Verified</span></td>
                                    <td>'.$farmermanageROW['farmerAADHAAR'].'<br><span class="badge bg-success">Verified</span></td>
                                    <td><button type="button" class="detail btn btn-danger">Print <span class="badge bg-light" style="color: #000000;">'.$farmermanageROW['farmerPRINTCOUNT'].'</span></button><button type="button" class="report btn btn-info mx-1">Report</button></td>
                                </tr>';
                        }
                        if($farmeractive== 0){
                            echo '<tr>
                                    <td><img src="/farm/'.$farmermanageROW['farmerPICTURE'].'" alt="User" width="90px" height="90px" id="farmerPICTURE"></td>
                                    <th scope="row">'.$farmermanageROW['farmerID'].'</th>
                                    <td>'.$farmermanageROW['farmerNAME'].'<br><span class="badge bg-danger">Yet To Verifeid</span></td>
                                    <td>'.$farmerDOB.'<br><span class="badge bg-danger">Yet To Verifeid</span></td>
                                    <td>'.$farmermanageROW['farmerAADHAAR'].'<br><span class="badge bg-danger">Yet To Verifeid</span></td>
                                    <td><button type="button" class="report btn btn-info mx-1">Report</button></td>
                                </tr>';
                        }
                        if($farmeractive== 2){
                            echo '<tr>
                                    <td><img src="/farm/'.$farmermanageROW['farmerPICTURE'].'" alt="User" width="90px" height="90px" id="farmerPICTURE"></td>
                                    <th scope="row">'.$farmermanageROW['farmerID'].'</th>
                                    <td>'.$farmermanageROW['farmerNAME'].'<br><span class="badge bg-warning">Doc. Error</span></td>
                                    <td>'.$farmerDOB.'<br><span class="badge bg-warning">Doc. Error</span></td>
                                    <td>'.$farmermanageROW['farmerAADHAAR'].'<br><span class="badge bg-warning">Doc. Error</span></td>
                                    <td><button type="button" class="report btn btn-info mx-1">Report</button></td>
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
        $('#farmerTABLE').DataTable( {
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
    <script>
        details = document.getElementsByClassName('detail');
        Array.from(details).forEach((element) => {
            element.addEventListener("click", (e) => {
            tr= e.target.parentNode.parentNode;
            farmerID= tr.getElementsByTagName("th")[0].innerText;
            farmerAADHAAR= tr.getElementsByTagName("td")[3].innerText;
            // console.log(farmerID, farmerAADHAAR);
            FARMERid.value= farmerID;
            FARMERaadhaar.value= farmerAADHAAR;
            $('#farmerDETAILS').modal('toggle');
            })
        })
    </script>
    <script>
        reported = document.getElementsByClassName('report');
        Array.from(reported).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                issueID= tr.getElementsByTagName("th")[0].innerText;
                console.log(issueID);
                ISSUEid.value= issueID;
                $('#reportSEND').modal('toggle');
            })
        })
    </script>

</body>

</html>