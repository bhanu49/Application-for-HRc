<!DOCTYPE html>
<html>
<head>
	<title>CSV import</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.js"></script>
</head>
<body>
<?php include 'navbar.php.html'; ?>
<div class="container">
<?php
//post to getval1.php
 if ( isset($_POST["submit"]) ) {

   if ( isset($_FILES["file"])) {

            //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            //echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            echo "<center>
                    <h3><br>
                    <b>Selection cannot be empty, please go back to select a file..</b></h3>
                <center>";

        }
        else {
                 //Print file details
             echo "<h3>Uploaded successfully,please find the details below.. <br></h3>";
             echo "<p>Uploaded file: " . $_FILES["file"]["name"] . "<br/></p>";
             echo "<p>Type: " . $_FILES["file"]["type"] . "<br />";
             echo "<p>Size: " . ($_FILES["file"]["size"] / 1024) . " <br/></p>";
             echo "<p>Temp file: " . $_FILES["file"]["tmp_name"] . "<br/></p>";

                 //if file already exists
             if (file_exists("upload/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " already exists. ";
             }
             else {
                    //Store file in directory "upload" with the name of "uploaded_file"
            $storagename = "uploaded_file.csv";
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
            echo "Stored in: " . "upload/" . $storagename. "<br />";

            //include snippet which allows to map header values
            include 'headermap.php';
            }
        }
     } else {
             echo "No file selected <br />";
     }
}

?>
</div>
<hr>
<footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; IFF Magdeburg</p>
                </div>
            </div>
        </footer>
</body>
</html>