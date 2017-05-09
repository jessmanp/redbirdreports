<!-- begin sub header area -->
<div id="myagency-header">
	<div id="sub-menu-empty"></div>
</div>
<!-- end sub header area -->
<!-- begin content area -->
<div id="myagency-content-short">
	<div id="myagency-container">
		<br />
			<div class="myagency-area">
				<div class="myagency-title">Agency Information</div>
				<div class="myagency-info-holder">
				Agency Name: 
				<input type="text" maxlength="64" style="width:348px;" id="agency_name" name="agency_name" placeholder="Agency Name" value="<?php echo $agency_data[0]->agency_name; ?>" disabled />
				<br />
				Address: 
				<input type="text" maxlength="255" style="width:348px;" id="agency_address" name="agency_address" placeholder="Address" value="<?php echo $agency_data[0]->agency_address; ?>" disabled />
				<br />
				City: 
				<input type="text" maxlength="64" style="width:348px;" id="agency_city" name="agency_city" placeholder="City" value="<?php echo $agency_data[0]->agency_city; ?>" disabled />
				<br />
				State: 
				<input type="text" maxlength="2" style="width:30px;" id="agency_state" name="agency_state" placeholder="State" value="<?php echo $agency_data[0]->agency_state; ?>" disabled />
				&nbsp;
				Zip: 
				<input type="text" maxlength="10" style="width:60px;" id="agency_zip_code" name="agency_zip_code" placeholder="Zip Code" value="<?php echo $agency_data[0]->agency_zip; ?>" disabled />
				&nbsp;
				Phone: 
				<input type="text" maxlength="20" style="width:127px;" id="agency_phone" name="agency_phone" placeholder="Phone" value="<?php echo $agency_data[0]->agency_phone; ?>" disabled />
				<br /><br />
				</div>
				<div style="padding:10px;background-color:#ffffff;clear:both;">
				<br />
				</div>
				<div class="myagency-text-footer">&nbsp;</div>
			</div>
	</div>
	<br /><br />
</div>
<!-- end content area -->