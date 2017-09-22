
	<?php 
	// this is code to populate the uploaded csv into the for to make the relevant selections
			//open csv and read
			$file = fopen("upload/".$storagename,"r");
			$head= fgetcsv($file);
				# code...
		 ?>
<div class="jumbotron">

	<form class="form-group" action="getval1.php" method="post">
		<div class="form-group row">	
			<label class="col-xs-2 col-form-label">Source name</label>	
			<div class="col-xs-4">	
  				<input type="text" class="form-control" name="source" value="<?php  echo $_FILES["file"]["name"] ?>">
			</div>
		</div>
		
		<div class="form-group row">	
			<label class="col-xs-2 col-form-label">value</label>	
			<div class="col-xs-4">	
				<select class="form-control" id="value" name="value"  onchange="getID(this.value)">
				<option>select column with limit values..</option>
					<?php 
						foreach ($head as $id => $header) {
					 ?>
					<option value="<?php echo $id; ?>"><?php echo $header; } ?></option>
				</select>
			</div>
		</div>


	    <div class="form-group row">
	    <label class="col-xs-2 col-form-label">Main-bodypart</label>
	    <div class="col-xs-4">
	    <select class="form-control" id="bpart" name="bpart" placeholder="Value">
			 <option>select column with main part..</option>
	
	    	<?php 
	    		//read remaning rows excluding headers and echo into dropdown
				foreach ($head as $id => $header) {
			 ?>
			<option value="<?php echo $id; ?>"><?php echo $header; } ?></option>
			</select>
		</div>
		</div>

		<div class="form-group row">
	    <label class="col-xs-2 col-form-label">Sub-bodypart:</label>
	    <div class="col-xs-4">	    
	    <select class="form-control" id="lpart" name="lpart" >
	    	<option>select column with subpart..</option>
	    	<?php 
				foreach ($head as $id => $header) {
			 ?>
			<option value="<?php echo $id; ?>"><?php echo $header; } ?></option>
			</select>
		</div>
		</div>

		<div class="form-group row">
	    <label class="col-xs-2 col-form-label">Unit:</label>	
	    <div class="col-xs-4">    
	    <select class="form-control" id="unt" name="unt" ">
	    	<option>select column with unit..</option>
	    	<?php 
				foreach ($head as $id => $header) {
			 ?>
			<option value="<?php echo $id; ?>"><?php echo $header; } ?></option>
			</select>
		</div>
		</div>

		<div class="form-group row">
	    <label class="col-xs-2 col-form-label">Quantity:</label>
	    <div class="col-xs-4">	    
	    <select class="form-control" id="qty" name="qty" ">
	    	<option>select column with quantity..</option>
	    	<?php 
				foreach ($head as $id => $header) {
			 ?>
			<option value="<?php echo $id; ?>"><?php echo $header; } ?></option>
			</select>
		</div>
  		</div>

  		<div class="form-group row">
	    <label class="col-xs-2 col-form-label">Injury:</label>	
	    <div class="col-xs-4">    
	    <select class="form-control" id="inj" name="inj" ">
	    	<option>select column with Injury..</option>
	    	<?php 
				foreach ($head as $id => $header) {
			 ?>
			<option value="<?php echo $id; ?>"><?php echo $header; } ?></option>
			</select>
		</div>
		</div>
		<div align="left">
	  			<button type="submit" class="btn btn-primary" > submit</button> 
	  			<button type="reset" class="btn btn-info">Reset</button>
		</div>
	</form>
	
</div>

	
</div>

<script>

$(".form-control").change(function() {
    // Assign a save object
    var SaveSpot    =   {};
    // loop through same-named dropdowns
    $.each($(".form-control"),function(keys,vals) {
        // Name value
        var ThisVal =   $(this).val();
        // If there is selection, store value and name
        if(ThisVal != '-')
            SaveSpot[ThisVal]   =   $(this).prop("name");
    });
    // This is is redundant a bit because it loops again through the same
    // DOM as above, so it could be refined a bit
    $.each($(".form-control"), function(key,value) {
        // Loop through each of the options
        $.each($(this).children(), function(subkey,subvalue) {
            // If there is a value saved in the holding object 
            if(SaveSpot[$(this).val()]) {
                    // Get the name of the parent. If name is not this dropdown, disable it
                    if($(this).parent("select").prop("name") != SaveSpot[$(this).val()])
                        $(this).prop("disabled",true);
                    // Alternatively, just keep it selected
                    else
                        $(this).prop("selected",true);
                }
            // Enable by default (incase user backs out of selections, disabled options are enabled 
            else
                $(this).prop("disabled",false);
        });
    });
    // Just to view the holding object.
    console.log(SaveSpot);
});
</script>

<!--
<script >
		function getID(val) {
			// body...
			//alert(val);
			$.ajax({
				type: "GET",
				url: "getval.php",
				data: "ID="+val,
				success: function (data) {
					$("#valueid").html(data);
				
				}
			})
		}
	</script>
	-->
</body>
</html>