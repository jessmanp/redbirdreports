<!-- begin content area -->
<div id="myagency-content">
<?php
	$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
?>
			<div id="myagency-container">
			<br />
				<div class="myagency-area">
					<div class="myagency-title">Billing Information</div>
					<div class="myagency-settings-holder">
					Billing Coming Soon.
					<br /><br /><br /><br />
					</div>
					<div class="myagency-text-footer">&nbsp;</div>
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
	$("#billing").css("background-color","#000000");
	
});

/* ]]> */
</script>
