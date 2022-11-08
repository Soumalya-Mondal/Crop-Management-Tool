<?php
    session_start();
    include '_admindbconnect.php';

    $si= false;
    $sp= false;
    $ad= false;
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
        if(isset($_GET['us']) && $_GET['us']== true){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Admin Data Update Successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if(isset($_GET['sp']) && $_GET['sp']== true){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR!</strong> You Entered The Wrong Password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if(isset($_GET['ad']) && $_GET['ad']== true){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong> Admin Delete Successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    <!-- Content START -->
    <!-- Page Title START -->
    <div class="container my-3 user-select-none" style="color: white;">
        <h2 class="text-center">Welcome To Admin Manage Panel</h2>
    </div>
    <!-- Page Title END -->
    <!-- Edit Modal START -->
    <div class="modal" tabindex="-1" id="adminEDIT" aria-labelledby="farmerDETAILS" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-select-none" id="adminEDIT">Admin Edit</h5>
                </div>
                <div class="modal-body">
                    <form action="_superadminadminedit.php" method="POST" autocomplete="off">
                        <input type="hidden" id="ADMINEid" name="adminID">
                        <div class="mb-3">
                            <label for="ADMINname" class="form-label">Admin Name</label>
                            <input type="text" class="form-control" id="ADMINname" name="adminNAME">
                        </div>
                        <div class="mb-3">
                            <label for="ADMINphone" class="form-label">Admin Phone(add +91)</label>
                            <input type="number" class="form-control" id="ADMINphone" name="adminPHONE">
                        </div>
                        <div class="mb-3">
                            <label for="ADMINaadhaar" class="form-label">Admin Aadhaar</label>
                            <input type="number" class="form-control" id="ADMINaadhaar" name="adminAADHAAR">
                        </div>
                        <div class="mb-3">
                            <label for="ADMINemail" class="form-label">Admin Email</label>
                            <input type="email" class="form-control" id="ADMINemail" name="adminEMAIL">
                        </div>
                        <div class="mb-3">
                            <label for="SAdminPassword" class="form-label">Super Admin Password</label>
                            <input type="password" class="form-control" id="SAdminPassword" name="sadminPASSWORD">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal END -->
    <!-- Delete Modal START -->
    <div class="modal" tabindex="-1" id="adminDELETE" aria-labelledby="farmerDETAILS" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-select-none" id="adminDELETE">Admin Delete</h5>
                </div>
                <div class="modal-body">
                    <form action="_superadminadmindelete.php" method="POST" autocomplete="off">
                        <input type="hidden" id="ADMINDid" name="adminID">
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
    <!-- MainSection START -->
    <div class="container user-select-none text-center">
        <table class="table table-dark table-hover table-striped" id="adminTABLE">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Aadhaar</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $adminmanageSQL = "SELECT * FROM `admin`";
                $adminmanageRESULT = mysqli_query($sconn, $adminmanageSQL);

                while ($adminmanageROW = mysqli_fetch_assoc($adminmanageRESULT)) {
                    echo '<tr>
                                <th scope="row">'.$adminmanageROW['adminID'].'</th>
                                <td>'.$adminmanageROW['adminNAME'].'</td>
                                <td>'.$adminmanageROW['adminPHONE'].'</td>
                                <td>'.$adminmanageROW['adminAADHAAR'].'</td>
                                <td>'.$adminmanageROW['adminEMAIL'].'</td>
                                <td><button type="button" class="edit btn btn-primary mx-1">Edit</button> <button type="button" class="delete btn btn-danger mx-1">Delete</button></td>
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
            $('#adminTABLE').DataTable({
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
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                adminEID= tr.getElementsByTagName("th")[0].innerText;
                adminNAME = tr.getElementsByTagName("td")[0].innerText;
                adminPHONE = tr.getElementsByTagName("td")[1].innerText;
                adminAADHAAR= tr.getElementsByTagName("td")[2].innerText;
                adminEMAIL = tr.getElementsByTagName("td")[3].innerText;
                // console.log(adminID ,adminNAME, adminPHONE, adminEMAIL);
                ADMINEid.value= adminEID;
                ADMINname.value = adminNAME;
                ADMINphone.value = adminPHONE;
                ADMINaadhaar.value= adminAADHAAR;
                ADMINemail.value = adminEMAIL;
                $('#adminEDIT').modal('toggle');
            })
        })
    </script>
    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                adminDID= tr.getElementsByTagName("th")[0].innerText;
                // console.log(adminID);
                ADMINDid.value= adminDID;
                $('#adminDELETE').modal('toggle');
            })
        })
    </script>

</body>

</html>