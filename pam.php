<?php
include("dbconnect.php");
include ("navbar.php.html");
mysqli_set_charset($dbconnect,"utf8");
    $ID2 = $_GET["Quantity"];
  if (!empty($ID2)) {

  $query = "SELECT a.bodypart,i.Injury,c.InjuryLevel,u.Unit,s.Quantity,r.wert  FROM bodyparts b ,lokalisation l,loadevent e,resultofstress r ,bodypartarea a ,units u ,symbolssi s,stressevent se,injurytype i,valuetypes v ,injury_class c
   WHERE  
    r.BelastungsereignisID = e.BelastungsereignisID

     AND e.LokalisationID = l.ID 
     AND l.KoerperbereichID =b.ID 
     AND b.KoerpereinzelbereicheID = a.ID 
     AND r.EinheitID = u.ID 
     AND r.groesseID=s.id
     AND se.BelastungsereignisID= r.BelastungsereignisID 
     AND se.BeanspruchungsartID = i.id 
     and r.WertetypID = v.ID
     and i.injuryID = c.ID
     and s.ID = $ID2";

$result = mysqli_query($dbconnect,$query);
   
$headers = "bodypart,Injury,InjuryLevel,Unit,Quantity,wert";
$file = fopen("clusterdata.csv", "w");
fputcsv($file, explode(',', $headers));
fclose($file);
$fp = fopen('clusterdata.csv', 'a'); 
if ($fp && $result) 
{     
       while ($row = mysqli_fetch_row($result)) 
       {
           
          fputcsv($fp, array_values($row)); 
       }
} 
fclose($fp);
}
$row_cnt = mysqli_num_rows($result);
if ($row_cnt > 60) {
    exec('Rscript pamclus.R',$out);
    //echo '<pre>', join("\r\n", $out), "</pre>\r\n";
    ?>
    <!--<div class="well-text-center">
     <div class="col-md-12"><p><br><br>Look below the figures for the limit value <br><br><hr></p></div>
  <div class="row">
    <div class="col-md-6">
        <h4>Clustering Results</h4>
        <img src="pam.png">
    </div>-->
    <?php
    $nocache = rand();

    echo "<center><h4> <br><br>Cluster Plot</h4>
    <img src='pam.png?$nocache' /> <center>";
    
}else{
  echo "<h4 style = 'color:red' align = 'center'> <br><br> Insufficient data for clustering </h4>";
}

?>