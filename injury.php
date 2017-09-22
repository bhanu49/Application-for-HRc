<!DOCTYPE html>
<html>
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

	<title></title>
</head>
<body>
<?php include 'dbconnect.php';  ?>

<div class="container">
<form class="form-group" method="get" action="injip.php">
	<div class="form-inline col-xs-2">

<?php

$sql = 'select * from injurytype';
$sql2 = 'select * from injury_class';
$result2 = mysqli_query($dbconnect,$sql2);
$result = mysqli_query($dbconnect,$sql);

foreach ($result as $row) {
	
?>
<label>
<input type="hidden" name="injury" value="<?php $row['ID'] ?>">
	<?php echo $row['Injury'];
		?>

</label>

     <select class="form-control" name="scale">
     	<option>select</option>
     	<?php foreach ($result2 as $row2) { ?>
        <option value="<?php echo $row2['ID'];?>"><?php        	
        	 echo $row2['class']; } ?>
        </option>
        
      </select>     
	
<?php
echo "<br>";
}
 ?>
 
</form>
</div>
</body>
</html>