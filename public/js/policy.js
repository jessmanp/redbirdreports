/* <![CDATA[ */

// LOAD DATE BOXES ON PAGE
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

	// SHOW/HIDE PREDEFINED DATES
	$("#pre-dates").on("click", function(event) {
		event.preventDefault();
   		$("#pre-dates-container").toggle();
		$("#filter-container").hide();
		$(".calendar").hide();
		event.stopPropagation();
	});
	$("#pre-dates-container").click(function(event) {
		event.stopPropagation();
	});

	// SHOW/HIDE FILTER
	$("#advanced-search").on("click", function(event) {
		event.preventDefault();
   		$("#filter-container").toggle();
		$("#pre-dates-container").hide();
		$(".calendar").hide();
		event.stopPropagation();
	});
	$("#filter-container").click(function(event) {
		event.stopPropagation();
	});

	$("body").click(function(event) {
		// hide layer code here
		$("#pre-dates-container").hide();
		$("#filter-container").hide();
	});

	
	// SCROLL TO TOP
	$("#top").on("click", function(event) {
		event.preventDefault();
		window.scrollTo(0, 0);
	});

});

/* ]]> */