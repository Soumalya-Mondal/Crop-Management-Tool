<?php
    session_start();
    include '_dbconnect.php';
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
        if(isset($_GET['fv']) && $_GET['fv']== true){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Farmer Is Now Active.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if(isset($_GET['sp']) && $_GET['sp']== true){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR!</strong> You Entered The Wrong Password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if(isset($_GET['fe']) && $_GET['fe']== true){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Farmer Is Now Not Active.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container my-3 user-select-none" style="color: white;">
        <h2 class="text-center">Welcome To Farmer Manage Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- Erro Modal START -->
    <div class="modal" tabindex="-1" id="farmerERROR" aria-labelledby="farmerDETAILS" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-select-none" id="farmerERROR">Farmer Error.</h5>
                </div>
                <div class="modal-body">
                    <form action="_superadminfarmererror.php" method="POST" autocomplete="off">
                        <input type="hidden" id="FARMEREid" name="farmerID">
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
    <!-- Error Modal END -->
    <!-- Verified Modal START -->
    <div class="modal" tabindex="-1" id="farmerVERIFY" aria-labelledby="farmerDETAILS" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-select-none" id="farmerVERIFY">Farmer Varification</h5>
                </div>
                <div class="modal-body">
                    <form action="_superadminfarmerverify.php" method="POST" autocomplete="off">
                        <input type="hidden" id="FARMERVid" name="farmerID">
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
    <!-- Verified Modal END -->
    <!-- MainSection START -->
    <div class="container user-select-none text-center">
        <table class="table table-dark table-hover table-striped" id="farmerTABLE">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Aadhaar</th>
                    <th scope="col">DoB</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $famrmermanageSQL= "SELECT * FROM `farmer`";
                    $farmermanageRESULT= mysqli_query($conn, $famrmermanageSQL);

                    while($farmermanageROW= mysqli_fetch_assoc($farmermanageRESULT)){

                        if($farmermanageROW['farmerACTIVE']== 2 || $farmermanageROW['farmerACTIVE']== 0){
                            $farmerDOB= $farmermanageROW['farmerDOB'];
                            $farmerDOB= date("d-m-Y", strtotime($farmerDOB));

                            echo '<tr>
                                    <th scope="row"><img src="/farm/'.$farmermanageROW['farmerPICTURE'].'" alt="User" width="90px" height="90px" id="farmerPICTURE"></th>
                                    <td>'.$farmermanageROW['farmerID'].'</td>
                                    <td>'.$farmermanageROW['farmerNAME'].'</td>
                                    <td>'.$farmermanageROW['farmerAADHAAR'].'</td>
                                    <td>'.$farmerDOB.'</td>
                                    <td>'.$farmermanageROW['farmerADDRESS'].'<br>State- '.$farmermanageROW['farmerSTATE'].'<br>Zip- '.$farmermanageROW['farmerPINCODE'].'</td>
                                    <td><button type="button" class="verify btn btn-warning mx-1">Verify</button> <button type="button" class="error btn btn-danger mx-1">Error</button></td>
                                </tr>';
                        }
                        if($farmermanageROW['farmerACTIVE']== 1){
                            $farmerDOB= $farmermanageROW['farmerDOB'];
                            $farmerDOB= date("d-m-Y", strtotime($farmerDOB));

                            echo '<tr>
                                    <th scope="row"><img src="/farm/'.$farmermanageROW['farmerPICTURE'].'" alt="User" width="90px" height="90px" id="farmerPICTURE"></th>
                                    <td>'.$farmermanageROW['farmerID'].'</td>
                                    <td>'.$farmermanageROW['farmerNAME'].'</td>
                                    <td>'.$farmermanageROW['farmerAADHAAR'].'</td>
                                    <td>'.$farmerDOB.'</td>
                                    <td>'.$farmermanageROW['farmerADDRESS'].'<br>State- '.$farmermanageROW['farmerSTATE'].'<br>Zip- '.$farmermanageROW['farmerPINCODE'].'</td>
                                    <td><button class="verify btn btn-success">Verified</button></td>
                                </tr>';
                        }
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
            $('#farmerTABLE').DataTable({
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
        verified = document.getElementsByClassName('verify');
        Array.from(verified).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                farmerVID= tr.getElementsByTagName("td")[0].innerText;
                console.log(farmerVID);
                FARMERVid.value= farmerVID;
                $('#farmerVERIFY').modal('toggle');
            })
        })
    </script>
    <script>
        errors = document.getElementsByClassName('error');
        Array.from(errors).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                farmerEID= tr.getElementsByTagName("td")[0].innerText;
                console.log(farmerEID);
                FARMEREid.value= farmerEID;
                $('#farmerERROR').modal('toggle');
            })
        })
    </script>

</body>

</html>