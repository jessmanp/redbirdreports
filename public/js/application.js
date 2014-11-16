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
	
	// DASHBOARD
	$("#dashboard").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/dashboard";
	});

	// POLICIES
	$("#policies").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/policies";
	});

	// PAYROLL
	$("#payroll").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/payroll";
	});

	// AGENCY
	$("#agency").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/agency";
	});

	// SUPPORT
	$("#support").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/support";
	});

	// SETTINGS
	$("#settings").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/settings";
	});

	// LOGOUT
	$("#logout").on("click", function(event) {
		event.preventDefault();
		//window.location.href = "/";
	});




	
});
/* ]]> */
