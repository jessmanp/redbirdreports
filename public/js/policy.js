/* <![CDATA[ */

// LOAD
$(document).ready(function() {

	// HIGHLIGHT MAIN SECTION
	$("#policies").closest(".main-button").css("background-color","#cccccc");
	// HIGHLIGHT SUB SECTION
	$("#all").closest(".sub-button").css("background-color","#000000");

// =============== BEGIN SUB NAV =============== //

	// VIEW ALL
	$("#all").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#auto").closest(".sub-button").css("background-color","#a20004");
		$("#fire").closest(".sub-button").css("background-color","#a20004");
		$("#life").closest(".sub-button").css("background-color","#a20004");
		$("#health").closest(".sub-button").css("background-color","#a20004");
		$("#deposit").closest(".sub-button").css("background-color","#a20004");
		$("#loan").closest(".sub-button").css("background-color","#a20004");
		$("#fund").closest(".sub-button").css("background-color","#a20004");
	});

	// AUTO
	$("#auto").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").css("background-color","#a20004");
		$("#fire").closest(".sub-button").css("background-color","#a20004");
		$("#life").closest(".sub-button").css("background-color","#a20004");
		$("#health").closest(".sub-button").css("background-color","#a20004");
		$("#deposit").closest(".sub-button").css("background-color","#a20004");
		$("#loan").closest(".sub-button").css("background-color","#a20004");
		$("#fund").closest(".sub-button").css("background-color","#a20004");
	});

	// FIRE
	$("#fire").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").css("background-color","#a20004");
		$("#auto").closest(".sub-button").css("background-color","#a20004");
		$("#life").closest(".sub-button").css("background-color","#a20004");
		$("#health").closest(".sub-button").css("background-color","#a20004");
		$("#deposit").closest(".sub-button").css("background-color","#a20004");
		$("#loan").closest(".sub-button").css("background-color","#a20004");
		$("#fund").closest(".sub-button").css("background-color","#a20004");
	});

	// LIFE
	$("#life").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").css("background-color","#a20004");
		$("#auto").closest(".sub-button").css("background-color","#a20004");
		$("#fire").closest(".sub-button").css("background-color","#a20004");
		$("#health").closest(".sub-button").css("background-color","#a20004");
		$("#deposit").closest(".sub-button").css("background-color","#a20004");
		$("#loan").closest(".sub-button").css("background-color","#a20004");
		$("#fund").closest(".sub-button").css("background-color","#a20004");
	});

	// HEALTH
	$("#health").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").css("background-color","#a20004");
		$("#auto").closest(".sub-button").css("background-color","#a20004");
		$("#fire").closest(".sub-button").css("background-color","#a20004");
		$("#life").closest(".sub-button").css("background-color","#a20004");
		$("#deposit").closest(".sub-button").css("background-color","#a20004");
		$("#loan").closest(".sub-button").css("background-color","#a20004");
		$("#fund").closest(".sub-button").css("background-color","#a20004");
	});

	// DEPOSIT
	$("#deposit").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").css("background-color","#a20004");
		$("#auto").closest(".sub-button").css("background-color","#a20004");
		$("#fire").closest(".sub-button").css("background-color","#a20004");
		$("#life").closest(".sub-button").css("background-color","#a20004");
		$("#health").closest(".sub-button").css("background-color","#a20004");
		$("#loan").closest(".sub-button").css("background-color","#a20004");
		$("#fund").closest(".sub-button").css("background-color","#a20004");
	});

	// LOAN
	$("#loan").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").css("background-color","#a20004");
		$("#auto").closest(".sub-button").css("background-color","#a20004");
		$("#fire").closest(".sub-button").css("background-color","#a20004");
		$("#life").closest(".sub-button").css("background-color","#a20004");
		$("#health").closest(".sub-button").css("background-color","#a20004");
		$("#deposit").closest(".sub-button").css("background-color","#a20004");
		$("#fund").closest(".sub-button").css("background-color","#a20004");
	});

	// FUND
	$("#fund").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").css("background-color","#a20004");
		$("#auto").closest(".sub-button").css("background-color","#a20004");
		$("#fire").closest(".sub-button").css("background-color","#a20004");
		$("#life").closest(".sub-button").css("background-color","#a20004");
		$("#health").closest(".sub-button").css("background-color","#a20004");
		$("#deposit").closest(".sub-button").css("background-color","#a20004");
		$("#loan").closest(".sub-button").css("background-color","#a20004");
	});

// =============== END SUB NAV =============== //

	// LOAD DATE PICKERS
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


});

/* ]]> */