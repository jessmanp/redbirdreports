<!-- begin content area -->
<div id="myagency-content">
<?php
	$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
?>
		<div id="myagency-container">
			<br />
			  <form id="update_agency_info_form" name="update_agency_info_form">
				<div class="myagency-area">
					<div class="myagency-title">Agency Information</div>
					<div class="myagency-info-holder">
					Agency Name<sup>*</sup>: 
					<input type="text" maxlength="64" style="width:348px;" id="agency_name" name="agency_name" placeholder="Agency Name" value="<?php echo $agency_data[0]->agency_name; ?>" />
					<br />
					Address: 
					<input type="text" maxlength="255" style="width:348px;" id="agency_address" name="agency_address" placeholder="Address" value="<?php echo $agency_data[0]->agency_address; ?>" />
					<br />
					City: 
					<input type="text" maxlength="64" style="width:348px;" id="agency_city" name="agency_city" placeholder="City" value="<?php echo $agency_data[0]->agency_city; ?>" />
					<br />
					State: 
					<input type="text" maxlength="2" style="width:30px;" id="agency_state" name="agency_state" placeholder="State" value="<?php echo $agency_data[0]->agency_state; ?>" />
					&nbsp;
					Zip<sup>*</sup>: 
					<input type="text" maxlength="10" style="width:60px;" id="agency_zip_code" name="agency_zip_code" placeholder="Zip Code" value="<?php echo $agency_data[0]->agency_zip; ?>" />
					&nbsp;
					Phone: 
					<input type="text" maxlength="20" style="width:127px;" id="agency_phone" name="agency_phone" placeholder="Phone" value="<?php echo $agency_data[0]->agency_phone; ?>" />
					<br /><br />
					<button id="agency_info_save" data-type="save" class="plain-btn" style="margin-right:140px;">Update Information</button>
					</div>
					<div style="padding:10px;background-color:#ffffff;clear:both;">
					<div class="myagency-required-key"><sup>*</sup>Required Field(s)</div>
					<br />
					</div>
					<div class="myagency-text-footer">&nbsp;</div>
				</div>
			  </form>
		</div>
		<br /><br />
<?php

?>
</div>
<!-- end content area -->
<script>
/* <![CDATA[ */

// LOAD
$(document).ready(function() {

	var url = "<?php echo $url; ?>";
	$("#info").css("background-color","#000000");
	
});

/* ]]> */
</script>
