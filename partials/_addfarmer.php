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
        <h2 class="text-center">Add Farmer Here!</h2>
    </div>
    <!-- Header END -->
    <!-- Picture Modal START -->
    <div class="modal" id="photomodal" tabindex="-1" aria-labelledby="pictureMODALLABEL" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pictureMODALLABEL">Webcam</h5>
                </div>
                <div class="modal-body">
                    <div>
                        <div id="my_camera" class="d-block mx-auto rounded overflow-hidden"></div>
                    </div>
                    <div id="results" class="d-none"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto">Capture Photo</button>
                    <button type="button" class="btn btn-warning mx-auto text-white d-none" id="retakephoto">Retake</button>
                    <button type="button" class="btn btn-warning mx-auto text-white d-none" data-bs-dismiss="modal" id="uploadphoto">Select</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Picture Modal END -->

    <!-- MainSection START -->
    <?php
        if(isset($_SESSION['login']) && $_SESSION['login']== true && $_SESSION['userTYPE']== 'admin'){
            echo '<div class="container bg-light rounded mb-5 col-md-6">
                <p class="text-center" style="font-size: 22px; color: red;">Take Farmer Picture First Then Fill All The Form</p>
            <form action="_addfarmerfinalcheck.php?panel=admin" method="POST" class="row" autocomplete="off">
                <div class="container py-1 text-center">
                <button class="btn btn-success" id="accesscamera" data-bs-toggle="modal" data-bs-target="#photomodal"
                    style="color: white;">Take Farmer Picture</button>
                </div>
                <!-- User Name -->
                <label for="Name" class="form-label">Name<span style="color: red;">*</span></label>
                <div class="input-group mb-3 col-12">
                    <span class="input-group-text" id="basic-addon_user"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Max.50 Character" aria-label="Username" aria-describedby="basic-addon_user" maxlength="50" name="uname" id="Name" required>
                </div>
                <!-- User Address -->
                <label for="Address" class="form-label">Address<span style="color: red;">*</span></label>
                <div class="input-group mb-3 col-12">
                    <span class="input-group-text" id="basic-addon_user"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Max.200 Character" aria-label="Address" aria-describedby="basic-addon_user" maxlength="200" name="address" id="Address" required>
                </div>
                <!-- User State And Pincode -->
                <label for="State_Pin" class="form-label">State And Pin Code<span style="color: red;">*</span></label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon_state"><i class="fa fa-map-o" aria-hidden="true"></i></span>
                    <select class="form-select" placeholder="State" aria-label="State" aria-describedby="basic-addon_state" name="state" id="State_Pin" required>
                        <option value="AN Andaman and Nicobar">Andaman and Nicobar</option>
                        <option value="AP Andhra Pradesh">Andhra Pradesh</option>
                        <option value="AR Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="AS Assam">Assam</option>
                        <option value="BH Bihar">Bihar</option>
                        <option value="CH Chandigarh">Chandigarh</option>
                        <option value="CT Chhattisgarh">Chhattisgarh</option>
                        <option value="DN Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                        <option value="DD Daman and Diu">Daman and Diu</option>
                        <option value="DL Delhi">Delhi</option>
                        <option value="GA Goa">Goa</option>
                        <option value="GJ Gujarat">Gujarat</option>
                        <option value="HR Haryana">Haryana</option>
                        <option value="HP Himachal Pradesh">Himachal Pradesh</option>
                        <option value="JK Jammu & Kashmir">Jammu & Kashmir</option>
                        <option value="JH Jharkhand">Jharkhand</option>
                        <option value="KA Karnataka">Karnataka</option>
                        <option value="KL Kerala">Kerala</option>
                        <option value="LD Lakshadweep">Lakshadweep</option>
                        <option value="MP Madhya Pradesh">Madhya Pradesh</option>
                        <option value="MH Maharashtra">Maharashtra</option>
                        <option value="MN Manipur">Manipur</option>
                        <option value="ME Meghalaya">Meghalaya</option>
                        <option value="MI Mizoram">Mizoram</option>
                        <option value="NL Nagaland">Nagaland</option>
                        <option value="OR Orissa">Orissa</option>
                        <option value="PY Puducherry">Puducherry</option>
                        <option value="PB Punjab">Punjab</option>
                        <option value="RJ Rajasthan">Rajasthan</option>
                        <option value="SK Sikkim">Sikkim</option>
                        <option value="TN Tamil Nadu">Tamil Nadu</option>
                        <option value="TS Telangana">Telangana</option>
                        <option value="TR Tripura">Tripura</option>
                        <option value="UP Uttar Pradesh">Uttar Pradesh</option>
                        <option value="UT Uttarakhand">Uttarakhand</option>
                        <option value="WB West Bengal">West Bengal</option>
                    </select>
                    <span class="input-group-text" id="basic-addon_pincode"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                    <input type="number" class="form-control" aria-label="Pin_Code" aria-describedby="basic-addon_pincode" placeholder="Pin Code" name="pincode" id="State_Pin" maxlength="6" required>
                </div>
                <!-- User Aadhar Card Number -->
                <label for="Aadhaar" class="form-label">Aadhaar Card Number<span style="color: red;">*</span></label>
                <div class="input-group mb-3 col-12">
                    <span class="input-group-text" id="basic-addon_aadhaar"><i class="fa fa-id-badge" aria-hidden="true"></i></span>
                    <input type="number" class="form-control" aria-label="Aadhaar" aria-describedby="basic-addon_aadhaar" maxlength="12" name="aadhaarnum" id="Aadhaar" required>
                </div>
                <!-- User Picture -->
                <input type="hidden" id="photoStore" name="photoStore">
                <!-- User Gender And Date of Birth -->
                <label for="Gender_Dob" class="form-label">Gender And Date Of Birth<span style="color: red;">*</span></label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon_gender"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <select class="form-select" placeholder="Gender" aria-label="Gender" aria-describedby="basic-addon_gender" name="gender" id="Gender_Dob" required>
                        <option selected value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <span class="input-group-text" id="basic-addon_pass"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span>
                    <input type="date" class="form-control" aria-label="Date_Of_Birth" aria-describedby="basic-addon_dob" name="dob" id="Gender_Dob" required>
                </div>
                <div class="container text-center mb-5">
                    <button class="btn btn-primary"><a href="_adminpanel.php?panel=admin" style="text-decoration: none; color: white">Back</a></button>
                    <button type="submit" class="btn btn-danger">Final Check</button>
                </div>
            </form>
        </div>';
        }
    ?>
    <!-- MainSection END -->
    <!-- Content END -->
    <!-- Footer START -->
    <?php
        include '_footer.php';
    ?>
    <!-- Footer END -->

    <!-- Script Resource START -->
    <script src="/farm/resource/jquery.min.js"></script>
    <script src="/farm/resource/bootstrapjs/bootstrap.bundle.min.js"></script>
    <script src="/farm/resource/sweetalertjs/sweetalert.min.js"></script>
    <script src="/farm/resource/webcamjs/webcam.min.js"></script>
    <script src="/farm/resource/main.js"></script>
    <!-- Script Resource END -->

</body>

</html>