<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>upload</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/fileinput.js" type="text/javascript"></script>
        <script src="js/fileinput_locale_fr.js" type="text/javascript"></script>
        <script src="js/fileinput_locale_es.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>

<?php include 'navbar.php.html'; ?>

        <div class="container kv-main">

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Upload a csv file:</h3> 
                </div>
            </div>
            
            <form enctype="multipart/form-data"  action="csvmap.php" accept-charset="utf-8" method="POST" >
              <input id="file" name="file" type="file" class="file"   accept=".csv,.sql,.txt" multiple="true">
                <br>
               <!-- <button type="submit" name="submit" class="btn btn-primary">Submit</button>-->
                <button type="submit" name="submit" formaction="csvmap.php" class="btn btn-primary">Go</button>
                <!--<button type="reset" class="btn btn-default">Reset</button> -->
            </form>
        
       
 
<script>
$("#file").fileinput({
        showUpload: false,           
    });
</script>
<hr>
            <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; IFF Magdeburg</p>
                </div>
            </div>
        </footer> 
    </body>
	</div>
</html>