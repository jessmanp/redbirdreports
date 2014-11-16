		<div id="search-area">
			<form name="search-form" action="app.html#search" method="post">
				<input id="field" name="field" type="text" placeholder="Search" />
				<div id="delete"><span id="x">c</span></div>
				<button id="submit"><span class="icon-find"><span></button>
				<div class="date-title">Date Range:</div>
				<input id="datepick1" name="datepick1" placeholder="" readonly />
				<input id="datepick2" name="datepick2" placeholder="" readonly />
			</form>
		</div>

<script>
// LOAD PAGE
$(document).ready(function() {

	function loadDatePickers(){
		new datepickr("datepick1", {
			"dateFormat": "m/d/Y"
		});
		new datepickr("datepick2", {
			"dateFormat": "m/d/Y"
		});
	}

	//bind orientation change to date picker event
	$(window).bind("orientationchange", loadDatePickers);
	$(window).resize(function() {
		loadDatePickers();
	});

	// SET DATE PICKERS
	$("#datepick1").attr("placeholder", currentdate());
	$("#datepick2").attr("placeholder", currentdate());
	loadDatePickers();


});
</script>