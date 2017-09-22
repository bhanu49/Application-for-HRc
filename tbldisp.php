
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="iffdb">
    <title>Limit Values</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>

    <!-- Latest compiled and minified Locales -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/locale/bootstrap-table-zh-CN.min.js"></script>

  
  <title>Table display</title>
</head>

<!-- get auto incremented serial number-->
<style type="text/css">
   body
    {
      counter-reset: Serial;           
    }
    table
    {
     border-collapse: separate;
   }
    tr td:first-child:before
    {
      counter-increment: Serial;      
      content:  counter(Serial); 
    }
    .table-hover thead tr:hover th, 
     .table-hover tbody tr:hover td {
            background-color: #bfbfbf;
    }
</style>

<body>
<?php
include("dbconnect.php");
include 'navbar.php.html';
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
        
        $result = mysqli_query($dbconnect,$query);
          $row_cnt = mysqli_num_rows($result);

             if ($row_cnt>0) {
                     ?>
                    <div class="container">
                              <!--<div class="jumbotron">-->
                              <h3>Please look into the table for the Limit values</h3>


                          <table id="table" class="table table-striped table-hover" 
                             data-row-style="rowStyle" data-show-refresh="true" data-show-toggle="true" data-pagination="true" data-search="true">
                              <thead>
                                <tr>
                                  <th data-field="sno">S.No</th>
                                  <th data-field="bpart">Bodypart </th>
                                  <th data-field="lpart">Location on Body </th>
                                  <th data-field="value">Value</th>
                                  <th data-field="unt">Unit</th>
                                  <th data-field="qty">Quantity</th>
                                  <th data-field="inj">Injury</th>
                                  <th data-field="state" data-checkbox="true"></th>
                                  <th data-field="remove">Remove</th>
                                  <!--<th><span class="glyphicon glyphicon-plus"></span></th>-->
                                   </tr>
                              </thead>
                              <tbody>                   
                  <?php 
                    foreach ($result as $limitvalues ) {
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $limitvalues["bodypart"];?></td>
                        <td><?php echo $limitvalues["localpart"];?> </td>
                        <td><?php echo $limitvalues["Wert"] ; ?></td>
                        <td><?php echo $limitvalues["Unit"];?></td>
                        <td><?php echo $limitvalues["Quantity"] ;?></td>
                        <td><?php echo $limitvalues["Injury"] ;?></td>
                        <td><div class="checkbox"><input type="checkbox" value="" onclick=""></div></td>
                        <td><button type="button" class="btn btn-default btn-xs"  onclick="deleteRow(this.parentNode.prowIndex)"><span class="glyphicon glyphicon-trash"></button></td>
                   </tr>    
  <?php
  }
  }else{
    echo "<br><br><h4 style = 'color:red;' align = 'center'>NOTICE: No data to be displayed</h4> ";
  }
}
 ?>   
    </tbody>
  </table>

</div>
</div>
<script >
    function deleteRow(i){
        document.getElementById('table').deleteRow(i)
                      }
</script>
</body>
</html>