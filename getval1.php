<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div class="container"><br>

		<?php
		include 'dbconnect.php';
		error_reporting(0);

		//$dbconnect = mysqli_connect("localhost", "root", "","testiff");
		//mysqli_set_charset($dbconnect,"utf8");
			
		//	if(mysqli_connect_errno()) {
		//		echo "Connection failed:could not find Database".mysqli_connect_error();
		//		exit;
		//	}
		include 'navbar.php.html';
		$id1 = $_POST['value'];
		$id2 = $_POST['bpart'];
		$id3 = $_POST['lpart'];
		$id4 = $_POST['unt'];
		$id5 = $_POST['qty'];
		$id6 = $_POST['source'];
		$id7 = $_POST['inj'];

		if(!is_numeric($id1) ||  !is_numeric($id2) ||  !is_numeric($id3) 
		||  !is_numeric($id4) ||  !is_numeric($id5) ||  !is_numeric($id7)) {
		  echo "<center><h3><br><br><br>Ooops..!! there is an empty selection,please select a header.<h3><center>";
		}else{

		//echo $id6 ."<br>";
		//insert source name
		$sql_in_source = "insert into literatur (Titel) values ('$id6')";
			if (mysqli_query($dbconnect,$sql_in_source)) {
				# code...
				$lastID = mysqli_insert_id($dbconnect);		
				//echo "inserted source ";
				//echo "<br>";
				//echo "source ID : " .$lastID;
			}else {
				echo "<p style= 'color:red;'>Error inserting source <br> ";
				//echo " Error: " . $sql_in_source. "<br>" . mysqli_error($dbconnect);
				echo "</p>";
		}

		$file = fopen("upload/uploaded_file.csv","r"); 
				
				//header row

			$head = fgetcsv($file);

			while(! feof($file)) { 
					//remaning rows
					$column = fgetcsv($file);
					$num = count($column) ;
					//match post values with array index
					//echo "<br>";
					$value = mysqli_real_escape_string ($dbconnect,$column[$id1]);
					$bpart = mysqli_real_escape_string ($dbconnect,$column[$id2]);
					$lpart = mysqli_real_escape_string ($dbconnect,$column[$id3]);
					$unit = mysqli_real_escape_string ($dbconnect,$column[$id4]);
					$qty = mysqli_real_escape_string ($dbconnect,$column[$id5]);
					$inj = mysqli_real_escape_string ($dbconnect,$column[$id7]);


		//check bodypart area

					if ($sql_checkbpart = mysqli_query($dbconnect,"select ID from bodypartarea where bodypart = '$bpart'")) {
						
						foreach ($sql_checkbpart as $ID) 	{
						# code...
						$b_ID = $ID["ID"];
						
						//echo "bpart :" .$b_ID;
						
																}
					}else{
							echo "<p> no part found <br> ";
							//echo "Error: " . $sql_checkbpart . "<br>" . mysqli_error($dbconnect) ;
							echo "</p>";

					}
						
		//check bodyparts
					

					if (is_numeric($b_ID) And $sql_checklpart = mysqli_query($dbconnect,"select ID from bodyparts where localpart = '$lpart'
							and KoerpereinzelbereicheID = '$b_ID'")) {
						
						foreach ($sql_checklpart as $ID2) {
						//echo " <br>";
						$l_ID = $ID2["ID"];
						//echo "lpart:" .$l_ID;
						
																}
					}else{
							echo "<p> no body part found <br> ";
							//echo "Error: " . $sql_checklpart . "<br>" . mysqli_error($dbconnect) ;
							echo "</p>";

					}
						
		//check for quantity in symbolssi
					if ($sql_checkqty = mysqli_query($dbconnect,"select ID from symbolssi where quantity ='$qty'")) {
						foreach ($sql_checkqty as $IDqty) {
							# code...
							$ID_qty = $IDqty['ID'];
							//echo "<br> qty: " .$ID_qty;
							
						}
					}else{
							echo " <p> no quantity found <br> ";
							//echo "Error: " . $sql_checkqty . "<br>" . mysqli_error($dbconnect) ;
							echo "</p>";

					}
						
		//check for unit
						if ($sqlcheck_unt = mysqli_query($dbconnect,"select ID from units where Unit ='$unit'
							and GroesseID =$ID_qty")) {
							foreach ($sqlcheck_unt as $IDunt) {
							$ID_unt = $IDunt['ID'];

							//echo "<br> unt: " .$ID_unt;
							//echo "<br>";
							
						}
						}else{
							echo "<p> no unit found <br> ";
							//echo "Error: " . $sqlcheck_unt . "<br>" . mysqli_error($dbconnect) ;
							echo "</p>";
					}

		//check for injury
					if ($sqlcheck_inj = mysqli_query($dbconnect,"select ID from injurytype where Injury ='$inj'")) {
							foreach ($sqlcheck_inj as $IDinj) {
							$ID_inj = $IDinj['ID'];

							//echo "<br> unt: " .$ID_unt;
							//echo "<br>";
							
						}
						}else{
							echo "<p> no inj found <br> ";
							//echo "Error: " . $sqlcheck_unt . "<br>" . mysqli_error($dbconnect) ;
							echo "</p>";
					}

		 			echo " value:" .$value 
		 			. ", mainpart: " .$bpart. 
		 			", localpart: " .$lpart . 
		 			", unit: " .$unit . 
		 		", qty: " .$qty.
		 		", inj: " .$inj."<br>" ;

		 //insert lpart id , sourceid into localization and get lokilisationid

			
					if ($sql_in_loc = mysqli_query($dbconnect,"INSERT INTO lokalisation (KoerperbereichID,LiteraturID) VALUES ($l_ID,$lastID)")) {
						# code...
						$lastID_lok = mysqli_insert_id($dbconnect);
						//echo "<br>";
						//echo "inserted into localization <br>";
						//echo $lastID_lok;
						unset($l_ID);
						unset($b_ID);

					}else {
						echo " <p>Error inserting into localization <br> ";
							//echo "Error: " . $sql_in_loc . "<br>" . mysqli_error($dbconnect) ;
						echo "</p>";
				}


		//insert lokalization id in load event and get loadevent id

				if ($sql_in_load = mysqli_query($dbconnect,"INSERT INTO loadevent (LokalisationID) VALUES ($lastID_lok)")) {
							$lastID_load = mysqli_insert_id($dbconnect);
							//echo "<br>inserted id in loadevnt<br>";
							//echo "$lastID_load";
							unset($lastID_lok);
					}else{
						echo "<p> problem inserting into loadevnt <br> ";
						//echo "Error: " . $sql_in_load . "<br>" . mysqli_error($dbconnect) ;
						echo "</p>";
					}

		//insert injuryid, loadevent id

					if ($sql_in_stress = mysqli_query($dbconnect,"INSERT INTO stressevent (BelastungsereignisID,BeanspruchungsartID) VALUES ($lastID_load,$ID_inj)")) {
							$lastID_se = mysqli_insert_id($dbconnect);
							//echo "<br>inserted id in loadevnt<br>";
							//echo "$lastID_load";
							unset($lastID_se);
					}else{
						echo "<p> problem inserting into loadevnt <br> ";
						//echo "Error: " . $sql_in_load . "<br>" . mysqli_error($dbconnect) ;
						echo "</p>";
					}

		//insert value,qtyid,untid,loadeventid
					$sql_in_value = "insert into resultofstress (BelastungsereignisID,EinheitID,Wert,GroesseID) 
						select '$lastID_load','$ID_unt','$value','$ID_qty' 
						FROM dual
						WHERE NOT EXISTS (select * from resultofstress where BelastungsereignisID = '$lastID_load' AND 
							EinheitID = '$ID_unt' AND
							Wert = '$value' AND
							GroesseID = '$ID_qty'
						)LIMIT 1";
					if (mysqli_query($dbconnect,$sql_in_value)) {
						
						//echo "<br>";
						echo "<h4 style= 'color:green;'><i>Inserted limit values </i></h4> <hr>";
						unset($lastID_load);
						
					}else{
						//echo "<br>";
						echo "<h4 style= 'color:red;'><i>Record not inserted,Please check the input values. </i> <br>";
						echo "</h4> <hr>";
						//echo"Error:<br>" . $sql_in_value . "<br>" . mysqli_error($dbconnect) ;
						
					}		 	
			}//while close		
		}//if else close

  ?>
  </div>
  </body>
  </html>