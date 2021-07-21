<?php
    include "includes/navbar.php";
    include "imageProcessing/processing.php";
?>
        <div class="container">
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
        <div class="image mx-auto" style="background-image: url(<?php echo substr($_GET['fileName'],3); ?>);">

        </div>
    </body>
</html>