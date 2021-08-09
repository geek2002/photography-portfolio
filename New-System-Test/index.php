<!DOCTYPE html>
<html>
    <head>
        <title>PHP File Upload</title>
        <link rel="stylesheet" href="../Custom Css/style.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/popper.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!-- Font Awesome -->
        <link href="../fonts/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../fonts/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../fonts/fontawesome/css/solid.css" rel="stylesheet">
        
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-secondary" style="margin-bottom: 20px;">
            <a class="navbar-brand" href="index.php">
                <img src="https://getbootstrap.com/docs/4.6/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
            </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bulk Ordering</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Me</a>
                    </li>
                    </ul>
                </div>
        </nav>
        <div class="container-fluid">
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <input type="file" name="file" id="file" />
                <input type="hidden" name="rotation" id="rotation" value="0"/>
                <input type="submit" name="submit" value="Upload"/>
            </form>

            <div class="img-preview" style="display: none;">
                <button id="rleft">Left</button>
                <button id="rright">Right</button>
                <div id="imgPreview"></div>
            </div>

            

        </div>
    </body>
</html>
<script>
    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgPreview + img').remove();
                $('#imgPreview').after('<img src="'+e.target.result+'" class="pic-view" width="450" height="300"/>');
            };
            reader.readAsDataURL(input.files[0]);
            $('.img-preview').show();
        }else{
            $('#imgPreview + img').remove();
            $('.img-preview').hide();
        }
    }
    $("#file").change(function (){
        // Image preview
        filePreview(this);
    });
    $(function() {
        var rotation = 0;
        $("#rright").click(function() {
            rotation = (rotation -90) % 360;
            $(".pic-view").css({'transform': 'rotate('+rotation+'deg)'});
            
            if(rotation != 0){
                $(".pic-view").css({'width': '300px', 'height': '300px'});
            }else{
                $(".pic-view").css({'width': '100%', 'height': '300px'});
            }
            $('#rotation').val(rotation);
        });
        
        $("#rleft").click(function() {
            rotation = (rotation + 90) % 360;
            $(".pic-view").css({'transform': 'rotate('+rotation+'deg)'});
            
            if(rotation != 0){
                $(".pic-view").css({'width': '300px', 'height': '300px'});
            }else{
                $(".pic-view").css({'width': '100%', 'height': '300px'});
            }
            $('#rotation').val(rotation);
        });
    });
</script>