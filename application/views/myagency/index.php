<!-- begin content area -->
<div id="myagency-content">
<?php
	$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
?>
			<div id="myagency-container">
			  <form id="update_agency_info_form" name="update_agency_info_form">
				<div class="myagency-area">
					Agency Name<sup>*</sup>: 
					<input type="text" maxlength="64" style="width:285px;" id="agency_name" name="agency_name" placeholder="Agency Name" value="<?php echo $agency_data[0]->agency_name; ?>" />
					<br />
					Address: 
					<input type="text" maxlength="255" style="width:285px;" id="agency_address" name="agency_address" placeholder="Address" value="<?php echo $agency_data[0]->agency_address; ?>" />
					<br />
					City: 
					<input type="text" maxlength="64" style="width:285px;" id="agency_city" name="agency_city" placeholder="City" value="<?php echo $agency_data[0]->agency_city; ?>" />
					<br />
					State: 
					<input type="text" maxlength="2" style="width:35px;" id="agency_state" name="agency_state" placeholder="State" value="<?php echo $agency_data[0]->agency_state; ?>" />
					<br />
					Zip Code<sup>*</sup>: 
					<input type="text" maxlength="10" style="width:65px;" id="agency_zip_code" name="agency_zip_code" placeholder="Zip Code" value="<?php echo $agency_data[0]->agency_zip; ?>" />
					<br />
					Phone: 
					<input type="text" maxlength="20" style="width:115px;" id="agency_phone" name="agency_phone" placeholder="Phone" value="<?php echo $agency_data[0]->agency_phone; ?>" />
					<br /><br />
				</div>
				<button id="agency_info_save" data-type="save" class="plain-btn">Save</button>
			  </form>
			</div>
			<br /><br />
<?php

?>
</div>
<!-- end content area -->