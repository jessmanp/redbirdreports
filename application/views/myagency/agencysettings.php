<!-- begin content area -->
<div id="myagency-content">
<?php
	$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
?>
			<div id="myagency-container">
				<div class="myagency-area">
					Commission Frequency<sup>*</sup>: 
					<select id="agency_frequency">
						<option value="0">Monthly</option>
						<option value="0">Bi-Weekly</option>
					</select>
					<br /><br />
				</div>
				<button id="agency_settings_save" data-type="save" class="plain-btn">Save</button>
			</div>
			<br /><br />
<?php

?>
</div>
<!-- end content area -->