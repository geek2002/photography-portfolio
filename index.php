<?php
    include "includes/navbar.php";
    include "imageProcessing/processing.php";
?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="image w-100" style="background-image: url(<?php echo substr($_GET['fileName'],3); ?>);"></div>
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
                            <input type="file" name="uploadedFile" />
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
                            <input type="text" class="form-control" name="price">
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
        
        </div>
        
    </body>
</html>