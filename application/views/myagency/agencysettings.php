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
							<br /><br />
							<div class="myagency-required-key"><sup>*</sup>Required Field(s)</div>

							<br /><br />
							<div style="text-align:center;margin:25px 0 15px 0;padding:10px;background-color:#a20004;color:#ffffff;">
								File Management
							</div>
				
							<div id="multipleupload">Upload File</div>
							<div id="status"></div>
							<!-- <div id="eventsmessage"><br /><b>Upload Status:</b></div> -->
							<div style="clear:both;">&nbsp;</div>
							<div style="text-align:center;margin:25px 0 15px 0;padding:10px;background-color:#eeeeee;color:#000000;font-size:16px;">
								<strong>File Listing</strong>
							</div>
								<div id="file_listing" class="table-container">
<?php
$rowcnt = 1;
if ($agency_advanced) {
	foreach ($agency_advanced as $file) {
		if ($rowcnt & 1) {
			$rowclass = 'table-row';
		} else {
			$rowclass = 'table-row-alt';
		}
		if ($file->policy == 1) {
			$import = " <a href=\"javascript:doFileImport(".$file->id.",'".$file->title."');\">import</a>";
		} else {
			$import = '';
		}
?>
								<div class="<?php echo $rowclass; ?>" style="text-align:left;line-height:35px;">&nbsp;&nbsp;&nbsp;<?php echo $file->title; ?><?php echo $import; ?><div style="float:right;"><a href="javascript:doFileDelete(<?php echo $file->id.",'" .$file->title."'"; ?>)">delete</a>&nbsp;&nbsp;&nbsp;</div></div>
<?php
	$rowcnt++;
	}
}
?>
							</div>
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
	
	var opts = {
	  lines: 13, // The number of lines to draw
	  length: 15, // The length of each line
	  width: 6, // The line thickness
	  radius: 27, // The radius of the inner circle
	  corners: 1, // Corner roundness (0..1)
	  rotate: 0, // The rotation offset
	  direction: 1, // 1: clockwise, -1: counterclockwise
	  color: '#000', // #rgb or #rrggbb or array of colors
	  speed: 1, // Rounds per second
	  trail: 60, // Afterglow percentage
	  shadow: false, // Whether to render a shadow
	  hwaccel: false, // Whether to use hardware acceleration
	  className: 'spinner', // The CSS class to assign to the spinner
	  zIndex: 2e9, // The z-index (defaults to 2000000000)
	  top: '55%', // Top position relative to parent
	  left: '50%' // Left position relative to parent
	};
	var target = document.getElementById('myagency-import-progress');
	var spinner = new Spinner(opts).spin(target);
	
});

/* ]]> */
</script>
