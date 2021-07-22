<?php
    session_start();
    include "global/varables.php";
    include "includes/navbar.php";
    include "imageProcessing/processing.php";
    if (isset($_SESSION['lastUploadedFileId'])) {
        $uploadedImage = $globalUploadLocation . "/preview/" . $_SESSION['lastUploadedFileId'] . ".jpg";
    }else{
        $uploadedImage = "images/No-Image.jpg";
    }
    
    
?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php if(isset($_SESSION['lastUploadedFileId'])){echo $_SESSION['lastUploadedFileId'];} ?>
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
                            <input type="number" min="0.01" step="0.01" class="form-control" name="price">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="catagory">Catagory</label>
                            <input type="text" class="form-control" name="catagory">
                        </div>
                    </div>
                    
                    <button name="uploadBtn" type="submit" value="Upload" class="btn btn-primary">Upload</button>
                </form>
                <form action="global/globalFunctions.php" method="POST">
                    <input name="function" type="text" value="globalDeleteAllImages" hidden>
                    <button type="submit">Delete All Photos</button>
                </form>
                
            </div>
            </div>
        
        </div>
        
    </body>
</html>