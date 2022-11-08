<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Log In</h5>
            </div>
            <div class="modal-body">
                <!-- Modal Body START -->
                <?php
                if (isset($_GET['panel']) && $_GET['panel'] == 'farmer' && !isset($_SESSION['login'])) {
                    echo '<form action="/farm/partials/_farmerloginhandel.php" method="post" class="row" autocomplete="off">
                            <label for="basic-url" class="form-label">Aadhaar Number<span style="color: red;">*</span></label>
                                <div class="input-group mb-3 col-12">
                                    <span class="input-group-text" id="basic-addon_farmerAADHAAR"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control" aria-label="farmerAADHAAR" aria-describedby="basic-addon_farmerAADHAAR" name="farmeraadhaar" maxlength="12" required>
                                </div>
                            <label for="basic-url" class="form-label">Password<span style="color: red;">* (Name- Soumalya Mondal, Aadhaar- **** **** 1234 so Password is- SOUM1234)</span></label>
                                <div class="input-group mb-3 col-12">
                                    <span class="input-group-text" id="basic-addon_farmerPASSWORD"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" aria-label="farmerAADHAAR" aria-describedby="basic-addon_farmerPASSWORD" maxlength="10" name="farmerpassword" required>
                                </div>
                                <div class="col-12 mt-1 modal-footer">
                                    <button type="submit" class="btn btn-success">Log In</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>';
                }
                if (isset($_GET['panel']) && $_GET['panel'] == 'admin' && !isset($_SESSION['login'])) {
                    echo '<form action="/farm/partials/_adminloginhandel.php" method="post" class="row" autocomplete="off">
                            <label for="basic-url" class="form-label">Admin Id.<span style="color: red;">*</span></label>
                                <div class="input-group mb-3 col-12">
                                    <span class="input-group-text" id="basic-addon_adminID"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" aria-label="AdminID" aria-describedby="basic-addon_adminID" name="adminID" maxlength="15" required>
                                </div>
                            <label for="basic-url" class="form-label">Password<span style="color: red;">*</span></label>
                                <div class="input-group mb-3 col-12">
                                    <span class="input-group-text" id="basic-addon_pass"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" aria-label="Password" aria-describedby="basic-addon_pass" maxlength="20" name="adminPASSWORD" required>
                                </div>
                                <div class="col-12 mt-1 modal-footer">
                                    <button type="submit" class="btn btn-success">Log In</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>';
                }
                ?>
                <!-- Modal Body END -->
            </div>
        </div>
    </div>
</div>