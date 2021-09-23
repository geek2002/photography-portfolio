<!DOCTYPE html>
<html>
    <head>
        <title>PHP File Upload</title>
        <link rel="stylesheet" href="Custom Css/style.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/Global-Assets/bootstrap/css/bootstrap.min.css">
        <script src="/Global-Assets/bootstrap/js/jquery.min.js"></script>
        <script src="/Global-Assets/bootstrap/js/popper.min.js"></script>
        <script src="/Global-Assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- Font Awesome -->
        <link href="/Global-Assets/fonts/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="/Global-Assets/fonts/fontawesome/css/brands.css" rel="stylesheet">
        <link href="/Global-Assets/fonts/fontawesome/css/solid.css" rel="stylesheet">
    </head>
    <body>
    <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-secondary" style="margin-bottom: 20px;">
        <a class="navbar-brand" href="index.php">
            <img src="images/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery-test.php">Gallery-Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Bulk Ordering</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Me</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0" action="global/globalFunctions.php" method="POST" onsubmit="return confirm('Are you sure you want to submit?');">
                        <input name="function" type="text" value="globalDeleteAllImages" hidden>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Delete All Photos</button>
                    </form>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUser">
                        [TEMP] Sign up form
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">
                        [TEMP] Login form
                    </button>
                </li>
            </ul>
        </div>
    </nav>