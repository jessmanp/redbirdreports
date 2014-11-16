// do load
$(document).ready(function() {

	// ABOUT
	$("header").find("img").on("click", function(event) {
		event.preventDefault();
		//window.location.href = "/about";
		window.location.href = "http://www.agencynerd.com";
	});

	 // NAVIGATION
	$("#whiteboard-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/whiteboard";
	});
	$("#myagency-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/myagency";
	});
	$("#policies-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/policies";
	});
	$("#controld-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/controld";
	});
	$("#reports-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/reports";
	});
	$("#employees-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/employees";
	});
	$("#support-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/support";
	});
	$("#how-to-videos-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/support/howtovideos";
	});
	$("#settings-link").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/login/?edit";
	});
	$("#logout-link").on("click", function(event) {
		event.preventDefault();
		window.location = "/login/?logout";
	});
	
	// SLIDE OUT MENU
	$(".button-right").on("click", function() {
		var state = parseInt($("#user-panel").css("right"),10) > -250;
		$("#user-panel").animate({"right": (state ? -250: 0)});
	});
	
});