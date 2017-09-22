

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


</head>
<body>

<div class="container">

<?php
//import library phpML
require ('phpml/vendor/autoload.php');
use Phpml\Math\Statistic\Mean;
//function to calculate median
function calculate_median($arr) {
    sort($arr);
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return $median;
}

include("dbconnect.php");
mysqli_set_charset($dbconnect,"utf8");
	$ID = $_GET["bodypartarea"];
    $ID2 = $_GET["Quantity"];
    $ID3 = $_GET["injlev"];
 //include 'pam.php';
  if (!empty($ID)) {

  $query = "SELECT * FROM bodyparts b ,lokalisation l,loadevent e,resultofstress r ,bodypartarea a ,units u ,symbolssi s,stressevent se,injurytype i,injury_class c
   WHERE  
    r.BelastungsereignisID = e.BelastungsereignisID

     AND e.LokalisationID = l.ID 
     AND l.KoerperbereichID =b.ID 
     AND b.KoerpereinzelbereicheID = a.ID 
     AND r.EinheitID = u.ID 
     AND r.groesseID=s.id
     AND se.BelastungsereignisID= r.BelastungsereignisID 
     AND se.BeanspruchungsartID = i.id 
     
     and i.injuryID = c.ID
     AND b.KoerpereinzelbereicheID=$ID
     and s.ID = $ID2
     and c.ID = $ID3";

  $result = mysqli_query($dbconnect,$query);

//write values into array
$op = array();
foreach ($result as $value) {
	
$n = $value["Wert"];
 array_push($op, $n);
}

// Converts array elements to a CSV string
$file = fopen("limitval.csv","w");

foreach ($op as $line)
  {
  fputcsv($file,explode(',',$line));
  }

fclose($file); 

if (!empty($op) && count($op) >= 4) {
     //$val = calculate_median($op);
      //$m = Mean::arithmetic($op);
      //$median = Mean::median($op);
    //echo "<h3> <br><br>median $val </h3>";
    //echo "<h4><br>mean $m <br></h4>";
    //echo "<h4>median $median</h4>";
   
//ececute Rsript through command line and display results back in web page
    exec("Rscript estimators.R", $output);
    echo "<br>";
    //print_r($output) ;
    $fval = substr($output[0], 3) ;
    //echo '<pre>', join("\r\n", $output), "</pre>\r\n";
// return image tag
  $nocache = rand();
?>

<div class="row">
    
    <div class="col-lg-12">

<?php
echo "<h4 align='center'> <br>The Limit Value for selection is: $fval</h4>";

?>

</div>
 
<?php
include 'lights.html';
echo "<hr>";
  ?>

     <div align="center">
        <h2>Distribution of Limit values</h2>
        <img src="temp.png">
        
        <hr>
    </div>
  
  <?php
  
}else{
  echo "<h4 style = 'color:red' align = 'center'> <br><br> Insufficient data or no data available for estimating limit value </h4>";
  
}
}
include 'clusgallery.php';
?>
</div>

</body>
</html>