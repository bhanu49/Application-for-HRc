<?php

include("dbconnect.php");
mysqli_set_charset($dbconnect,"utf8");

  $ID = $_GET["bodypartarea"];
    $ID2 = $_GET["Quantity"];
    $ID3 = $_GET["injlev"];

if (!empty($ID) && !empty($ID2) && !empty($ID3)) {
	
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
           /*and r.WertetypID = v.ID*/
           and i.injuryID = c.ID
           AND b.KoerpereinzelbereicheID=$ID
           and s.ID = $ID2
           and c.ID = $ID3";
	//$result = mysqli_query($dbconnect,$query);
$result = mysqli_query($dbconnect, $query);
$row_cnt = mysqli_num_rows($result);
if ($row_cnt>0) {

    Header('Content-type: text/xml');

    echo '<?xml version="1.0" encoding="utf-8"?>';

    echo '<Results>';


    //fetch associative array 
    while ($row = mysqli_fetch_assoc($result)) {

	     echo '<Limitdata>';

            echo '<Bodyarea>' . htmlspecialchars($row["bodypart"]) . '</Bodyarea>';
            echo '<Bodypart>' . htmlspecialchars($row["localpart"]) . '</Bodypart>';
            echo '<Value>' . htmlspecialchars($row["Wert"]) . '</Value>';
            echo '<Quantity>' . htmlspecialchars($row["Quantity"]) . '</Quantity>';
            echo '<Unit>' . htmlspecialchars($row["Unit"]) . '</Unit>';
            


        echo '</Limitdata>';

    }


}else{
    echo "<br><br><h4 style = 'color:red;' align = 'center'>NOTICE: No data to be displayed</h4> ";
  }

}else{
    echo "<br><br><h4 style = 'color:red;' align = 'center'>NOTICE: No data to be displayed</h4> ";
  }
//close the database connection
$dbconnect->close();

echo '</Results>';
 
?>

 