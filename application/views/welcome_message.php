<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>All Data!</h1>

	<div id="body">

		<div class="mb-3">
			<label for="country" class="form-label">Country Name</label>
			<select  class="form-control" name="country" id="country">
				<option>Select Country</option>
				<?php foreach($country as $val){?>
					<option value="<?php echo $val->id;?>"><?php echo $val->name;?></option>
				<?php } ?>		
			</select>
		</div>
		<div class="mb-3">
			<label for="State" class="form-label">State</label>
			<select  class="form-control" name="state" id="state">
				<option>Select Stae</option>
			</select>
		
		</div>
		<div class="mb-3">
			<label for="City" class="form-label">City</label>
			<select  class="form-control" name="city" id="city">
				<option>Select City</option>
			</select>
		</div>
		

	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
// baseURL variable

$(document).ready(function(){
	var base_url = '<?php echo base_url();?>';
  $('#country').change(function(){
	
	var country = $(this).val();

	
	$.ajax({
	  url:base_url+"index.php/welcome/getState",
	  type: "POST",
	  data: {country: country},
	  dataType: "json",
	  success: function(response){
		console.log("ch",response);
		// Remove options 
		$('#state').find('option').not(':first').remove();
		$('#city').find('option').not(':first').remove();

		// Add options
		$.each(response,function(index,data){
			console.log('sneha',data);
		   $('#state').append('<option value="'+data['id']+'">'+data['name']+'</option>');
		});
	  }
   	});
  });

  // City change
   $('#state').change(function(){

     var state = $(this).val();

    
    $.ajax({
       url:base_url+"index.php/welcome/getCity",
       method: 'post',
       data: {state: state},
       dataType: 'json',
       success: function(response){
 
         // Remove options
         $('#city').find('option').not(':first').remove();

         // Add options
         $.each(response,function(index,data){
           $('#city').append('<option value="'+data['id']+'">'+data['name']+'</option>');
         });
       }
    });
   });

}); 
</script>