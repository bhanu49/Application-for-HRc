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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>



    </style>

</head>
<body>
<?php include 'navbar.php.html'; ?>

<div class="container">
<div class="row">
<div class="col-lg-12">
 <h3 class="page-header" >Browse for Limit values.</h3> 
</div>
</div>
    <div class="jumbotron">
    
   <form  method="GET"  action="tbldisp.php" class="form-horizontal"   role="form">
    <div class="form-group">

        <div class="bodyarea">
        <div class="col-xs-4">
        <label >Body Part</label>
             <select class="form-control" name="bodypartarea"  id="bp_list" onchange="getID()">

             <option value="">Select from the List</option>

             <?php //query to retrive the data from DB
                $query = "select * from bodypartarea";
                $result = mysqli_query($dbconnect,$query);

                foreach ($result as $bodypartarea) { 
             ?>
             <option value="<?php echo $bodypartarea["ID"];?>"> 
             <?php echo $bodypartarea["bodypart"]; ?> </option>
            <?php 
             }
             ?>
             </select>
        </div>
    </div>
      </div>

<div class="Quantity">
      <div class="form-group">
      <div class="col-xs-4">
        <label>Quantity</label>
            <select  class="form-control" name="Quantity"  id="qty_list" onchange="getID()">
                
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
    <div class="Injlev">
      <div class="form-group">
      <div class="col-xs-4">
        <label>Injury Level</label>
            <select  class="form-control" name="injlev" id="inj_list" onchange="getID()">
              
                <?php 
                    $query2 = "select * from injury_class";

                    $result2 = mysqli_query($dbconnect,$query2);
                     foreach ($result2 as $inj) { 

                ?>

                <option value="<?php echo $inj["ID"];?>">
                <?php echo $inj["InjuryLevel"] ;?>
                </option>
                <?php
                }
                ?>
              
            </select>
    </div>
    </div>
    </div>

<p id="display_info" style="color: #1B4F72;font-size: 100%;"></p>
     
 <button type="Submit" name="Submit" class="btn btn-primary">View in Table</button>

    <button type="Submit" formaction="xmldisp.php" class="btn btn-primary">view as xml</button>
<button type="Submit" formaction="cal.php" class="btn btn-primary">Get value</button>
<!--<button type="Submit" formaction="rtest.php" class="btn btn-primary">test</button>-->
<div id="display_info"></div>
   </form>
    </div>

<script type="text/javascript">
    function getID(val){
        var bodypart = $("#bp_list").val();
        var Quantity = $("#qty_list").val();
        var injclass = $("#inj_list").val();
        if (bodypart  == -1 || Quantity == -1 ||  injclass == -1 ) { 
        }else{
            $.ajax({
                type:"GET",
                url: "getbodypart.php",
                data: {"ID":bodypart,"ID1":Quantity,"ID2":injclass},
                success: function(data){
                    $("#display_info").html(data);
                    //alert (data);
                }
            });
        }
    }
</script>

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