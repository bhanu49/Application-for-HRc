<?php 
include("dbconnect.php");
mysqli_set_charset($dbconnect,"utf8");

    $ID = $_GET["ID"];
    $ID2 = $_GET["ID1"];
    $ID3 = $_GET["ID2"];
    //echo "bodypart id: $ID";
    //echo "qty id: $ID2 ";
   // echo "inj id: $ID3 ";
   
if (!empty($ID) && !empty($ID2) && !empty($ID3)) {
	# code...
   $query = "SELECT  bodypart FROM bodyparts b ,lokalisation l,loadevent e,resultofstress r ,bodypartarea a ,units u ,symbolssi s,stressevent se,injurytype i,injury_class c
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

  $query2 = "SELECT InjuryLevel FROM injury_class where ID = $ID3";
	
	$result = mysqli_query($dbconnect,$query);

	$result2 = mysqli_query($dbconnect,$query2);

	$row_cnt = mysqli_num_rows($result);

echo "Number of limit values available: " .$row_cnt ;

$result2 = mysqli_query($dbconnect,$query2);

$row = mysqli_fetch_assoc($result2);
$injlevel = $row["InjuryLevel"];
//secho "$injlevel";

 }
 ?>