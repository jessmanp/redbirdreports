<!-- begin content area -->
<div id="myagency-content">
<?php
	$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
?>
			<div id="myagency-container">
			<br />
				<div class="myagency-area">
					<!-- form for editing employees -->
					<form id="agency_settings_form" name="agency_settings_form">
						<div class="myagency-title">Agency Settings</div>
						<div class="myagency-settings-holder">
							Commission Frequency<sup>*</sup>: 
							<select id="agency_frequency" name="agency_frequency">
								<option value="1">Monthly</option>
								<option value="2">Bi-Monthly</option>
							</select>
							<br /><br />
							<button id="agency_settings_save" data-type="save" class="plain-btn">Update Settings</button>
						</div>
						<div class="myagency-text-footer">&nbsp;</div>
					</form>
				</div>
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
	$("#agencysettings").css("background-color","#000000");
	
});

/* ]]> */
</script>
