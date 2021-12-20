<?php
    session_start();
    include "global/globalFunctions.php";
    include "global/varables.php";
    include "global/databaseFunctions.php";
    $rootLocation = "";
    include "includes/navbar.php";
    include "imageProcessing/processing.php";
    if (isset($_SESSION['lastUploadedFileId'])) {
        $uploadedImage = $globalUploadLocation . "/preview/" . $_SESSION['lastUploadedFileId'] . ".jpg";
    }else{
        $uploadedImage = "images/No-Image.jpg";
    }
    checkID(1);
    
?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div style="text-align:center;">
                        <p><b>Image ID:</b> <?php if(isset($_SESSION['lastUploadedFileId'])){echo $_SESSION['lastUploadedFileId'];} ?></p>
                    </div>
                    <div class="image w-100" style="background-image: url('<?php echo $uploadedImage; ?>');"></div>
                    <p class="mx-auto">
                        <span style="margin-right: 10px"><i class="fas fa-undo"></i></span>
                        <span style="margin-right: 10px"><i class="fas fa-undo fa-flip-horizontal"></i></span>
                    </p>
                </div>
                <div class="col-md-6">
                    <form method="POST" action="imageProcessing/upload.php" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group" id="adminFormGroup">
                                <label for="uploadedFile">Upload A file:</label>
                                <input type="file" name="uploadedFile" accept=".png,.jpg,.gif,.bmp" required/>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" name="location">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="price">Price</label>
                                <input type="number" min="0.00" step="0.01" class="form-control" name="price">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="catagory">Catagory</label>
                                <select class="custom-select custom-select-md mb-3">
                                    <option selected>Select Catagory</option>
                                    <?php
                                        $catagories = getCatagories();
                                        foreach ($catagories as &$catagory) {
                                            echo "<option value='" . $catagory . "'>" . getCatagoryName($catagory) . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button name="uploadBtn" type="submit" value="Upload" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="userManagment/createUser.php" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" name="fname" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" name="lname" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="userType">Account Type</label>
                                    <select class="custom-select custom-select-sm" name="userType">
                                        <option selected value="0">Normal</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                                <input type="text" value="login" name="action" hidden>
                            </div>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="uploadBtn" type="submit" value="Upload" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="userManagment/login.php" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Create Account</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="uploadBtn" type="submit" value="Upload" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="error-unauth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Unauthorised</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="color:red;">Error: You need to be logged in to access this page.</p>
                            <form method="POST" action="userManagment/login.php" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="uploadBtn" type="submit" value="Upload" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        
        </div>
    </body>
</html>
<script>
    const params = new URLSearchParams(window.location.search)
    if (params.has('error')) {
        value=params.get('error')
        switch (value) {
            case "unauth":
                $('#error-unauth').modal('show')
                break;
            default:
                break;
        }
    }
    if (params.has('debug')) {
        value=params.get('debug')
        switch (value) {
            case "login":
                $('#login').modal('show')
                break;
            case "createUser":
                $('#createUser').modal('show')
                break;
            default:
                break;
        }
    }
    
    
</script>