<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Share Files</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- jQuery library -->
    <script src="vendor/js/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="vendor/js/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/sweetalert2.all.min.js"></script>
    <script src="js/app.js"></script>
</head>
<body>
<?php

if (isset($_POST["submit"])) {

    $target_dir = "files/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

//    echo "<script>alert('" . $target_file . "')</script>";

    if (file_exists($target_file)) {
        $uploadOk = 0;
        echo "<script>";
        echo "
                swal({
                    type: 'error',
                    title: 'Sorry, File already exists.'
                }).then((result) => {
                    if (result) {
                        location.href = ''
                    }
                });
            ";
        echo "</script>";
    }

    if ($uploadOk != 0) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $n = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            echo "<script>";
            echo "
                swal({
                    type: 'success',
                    title: '" . $n . "'
                }).then((result) => {
                    if (result) {
                        location.href = ''
                    }
                });
            ";
            //echo "location.href = ''";
            echo "</script>";
        } else {
            echo "<script>";
            echo "
                swal({
                    type: 'error',
                    title: 'Sorry, Something went wrong.'
                }).then((result) => {
                    if (result) {
                        location.href = ''
                    }
                });
            ";
            echo "</script>";
        }
    }
}

?>
<div class="container">
    <button class="btn btn-success main-button" onclick="window.location = 'files/'">Download Files</button>
    <button class="btn btn-success main-button" data-toggle="modal" data-target="#upload-form-modal">Upload Files
    </button>
</div>
<!-- The Modal -->
<div class="modal fade" id="upload-form-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="upload-form" name="uploadForm" action="./" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Files Here</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-primary btn-file">
                                Browse&hellip; <input type="file" name="fileToUpload" id="fileToUpload">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <br>
                    <br>
                    <div id="myProgress">
                        <div id="myBar">0%</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="upload-button" class="btn btn-primary" value="Upload" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>