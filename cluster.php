<?php  
include("dbconnect.php");
mysqli_set_charset($dbconnect,"utf8");

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Browse Limit values</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    </style>

</head>
<body>
<?php include 'navbar.php.html'; ?>

<div class="container">
<div class="row">
<div class="col-lg-12">
 <h3 class="page-header" >Select quantity for the data to be clustered.</h3> 
</div>
</div>
    <div class="jumbotron">
    
   <form  method="GET"  action="pam.php" class="form-horizontal"   role="form">
    <div class="form-group">


<div class="Quantity">
      <div class="form-group">
      <div class="col-xs-4">
        <label>Quantity</label>
            <select  class="form-control" name="Quantity">
                
                <?php 
                    $query1 = "select * from symbolssi";

                    $result1 = mysqli_query($dbconnect,$query1);
                     foreach ($result1 as $qty) { 

                ?>
               
                <option value="<?php echo $qty["ID"];?>">
                <?php echo $qty["Quantity"] ;?>
                </option>
                <?php
                }
                ?>
              
            </select>
    </div>
    </div>
    </div>
   

 <button type="Submit" name="Submit" class="btn btn-primary">cluster</button>
</div>
</form>
</div>

<hr>

<footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; IFF Magdeburg</p>
                </div>
            </div>
        </footer>
        </div>
        </div>
</body>
</html>