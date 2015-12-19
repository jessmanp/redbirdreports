/* <![CDATA[ */

// CREATE TODAY DATE
function currentdate() {
	var currentDate = new Date()
	var day = (currentDate.getDate()<10 ? "0" : "") + currentDate.getDate()
	var month = (currentDate.getMonth()<9 ? "0" : "") + (currentDate.getMonth()+1)
	var year =  currentDate.getFullYear()
	var todayDate =  month +"/" +day + "/" + year ;
	return todayDate;
}

// LOAD PAGE
$(document).ready(function() {

	window.scrollTo(0, 0);

	// MAIN LOGO
	$("#logo").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/";
	});	
	
	// DASHBOARD
	$("#dashboard").closest(".main-button").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/dashboard";
	});

	// POLICIES
	$("#policies").closest(".main-button").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/policies";
	});

	// COMMISSIONS
	$("#commissions").closest(".main-button").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/commissions";
	});

	// AGENCY
	$("#myagency").closest(".main-button").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/myagency";
	});

	// SUPPORT
	$("#support").closest(".main-button").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/support";
	});

	// SETTINGS
	$("#settings").closest(".main-button").on("click", function(event) {
		event.preventDefault();
		var rpth = $(this).data("rpath");
		window.location.href = "/login/?edit=1&r="+rpth;
	});

	// LOGOUT
	$("#logout").closest(".main-button").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/login?logout";
	});

	// SETTINGS BACK BUTTON
	$("#settings-back").closest(".button-right").on("click", function(event) {
		event.preventDefault();
		var rpth = $(this).data("rpath");
		rpth = decodeURIComponent(rpth);
		window.location.href = decodeURI(rpth);
	});	

	// SETTINGS LOGO
	$("#settings-logo").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/";
	});	
	
	// SCROLL TO TOP
	$("#top").on("click", function(event) {
		event.preventDefault();
		window.scrollTo(0, 0);
	});

	
});
/* ]]> */
