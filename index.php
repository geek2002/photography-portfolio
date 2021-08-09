<?php
    session_start();
    include "global/varables.php";
    include "global/databaseFunctions.php";
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
                            <input type="file" name="uploadedFile" required/>
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
                            <input type="text" class="form-control" name="catagory">
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
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                                <input type="text" value="login" name="action" hidden>
                            </div>
                            
                            
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="uploadBtn" type="submit" value="Upload" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div> 
        
        </div>
        
    </body>
</html>