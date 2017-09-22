<?php  
 include 'navbar.php.html'; 
?>


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

<div class="container">
<div class="row">
<div class="col-lg-12">
 <h3 class="page-header" >Browse for similar limit values.</h3> 
</div>
</div>
    <div class="jumbotron">
    
   <form  method="POST"  action="" class="form-horizontal"   role="form">
    <div class="form-group">

        <div class="bodyarea">

        <div class="col-xs-4">
        <label >Quantity</label>
             <select class="form-control" name="quantity"  id="quantity" onchange="getID()">

             <option value="Kraft">Kraft</option>
             <option value="Druck">Druck</option>
             </select>
        </div>
    </div>
      </div>

<div class="form-group">

        <div class="bodyarea">

        <div class="col-xs-4">
        <label >Cluster</label>
             <select class="form-control" name="cluster"  id="cluster" onchange="getID()">

             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5">5</option>
             <option value="6">6</option>

             </select>
        </div>
    </div>
      </div>
<button type="Submit" name="Submit" class="btn btn-primary">Go</button>
    </div>
</form>
<?php 
include("dbconnect.php");
mysqli_set_charset($dbconnect,"utf8");

if(isset($_POST['quantity']) && isset($_POST['cluster'])){ 

    $ID = mysqli_real_escape_string($dbconnect,$_POST["quantity"]);
    $ID2 = mysqli_real_escape_string($dbconnect,$_POST["cluster"]);
    //echo "$ID"." ". $ID2;

        $query = "SELECT * FROM clustered_kraft where clusters = $ID2 and Quantity = '$ID'";
        
        $result = mysqli_query($dbconnect,$query);

         $row_cnt = mysqli_num_rows($result);
         //echo "$row_cnt </br>";

  if ($row_cnt>0) {
                     ?>
                    <div class="container">
                              <!--<div class="jumbotron">-->
                              <h3>Please look into the table for the similar Limit values</h3>

                          <table id="table" class="table table-striped table-hover" 
                             data-row-style="rowStyle" data-show-refresh="true" data-show-toggle="true" data-pagination="true" data-search="true">
                              <thead>
                                <tr>
                                  <th data-field="sno">S.No</th>
                                  <th data-field="bpart">Bodypart </th>
                                  <th data-field="inj">Injury </th>
                                  <th data-field="ilev">Injury Level</th>
                                  <th data-field="unt">Unit</th>
                                  <th data-field="qty">Quantity</th>
                                  <th data-field="val">Limit value</th>
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
                        <td><?php echo $limitvalues["Injury"];?> </td>
                        <td><?php echo $limitvalues["InjuryLevel"] ;?></td>         
                        <td><?php echo $limitvalues["Unit"];?></td>
                        <td><?php echo $limitvalues["Quantity"] ;?></td>
                        <td><?php echo $limitvalues["wert"] ; ?></td>
                        
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

