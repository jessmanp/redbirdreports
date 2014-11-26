/* <![CDATA[ */

// LOAD
$(document).ready(function() {

	var currcat = 'listall';
	$("#statuscat").text('All');

// =============== BEGIN AJAX =============== //



// =============== END AJAX =============== //

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
		$("#statuscat").text('All');
		$("#policy-content").load("/app/policies/listall");
		currcat = 'listall';
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
		$("#statuscat").text('Auto');
		$("#policy-content").load("/app/policies/listauto");
		currcat = 'listauto';
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
		$("#statuscat").text('Fire');
		$("#policy-content").load("/app/policies/listfire");
		currcat = 'listfire';
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
		$("#statuscat").text('Life');
		$("#policy-content").load("/app/policies/listlife");
		currcat = 'listlife';
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
		$("#statuscat").text('Health');
		$("#policy-content").load("/app/policies/listhealth");
		currcat = 'listhealth';
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
		$("#statuscat").text('Deposit');
		$("#policy-content").load("/app/policies/listdeposit");
		currcat = 'listdeposit';
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
		$("#statuscat").text('Loan');
		$("#policy-content").load("/app/policies/listloan");
		currcat = 'listloan';
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
		$("#statuscat").text('Mutual Fund');
		$("#policy-content").load("/app/policies/listfund");
		currcat = 'listfund';
	});

// =============== END SUB NAV =============== //

// =============== BEGIN SORT NAV =============== //

	// SORTING
	$("#sortfirst").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/firstname");
	});
	$("#sortlast").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/lastname");
	});
	$("#sortdesc").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/description");
	});
	$("#sortcat").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/category");
	});
	$("#sortprem").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/premium");
	});
	$("#sorttype").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/type");
	});
	$("#sortsold").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/soldby");
	});
	$("#sortsrc").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/source");
	});
	$("#sortlen").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/length");
	});
	$("#sortwdate").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/written");
	});
	$("#sortidate").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/issued");
	});
	$("#sortedate").on("click", function(event) {
		event.preventDefault();
		$("#policy-content").load("/app/policies/"+currcat+"/effective");
	});

// =============== END SORT NAV =============== //

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