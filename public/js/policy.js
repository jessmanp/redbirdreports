/* <![CDATA[ */

// OPEN POPUP WINDOW
function openWindow(type,message,id,text) {

	var winh = $(window).height();
	var doch = $(document).height();
	if (winh > doch) {
		$("#policy-popup").height(winh);
	} else {
		$("#policy-popup").height(doch);
	}
	$("#policy-popup").fadeIn();
				
	var winw = $(window).width();
	var neww = (winw/2)-398;
	var scrolled_val = $(document).scrollTop().valueOf();
	var newh = (scrolled_val+25);
	$("#policy-window").css({ "margin-left": neww+"px", "margin-top": "-330px" });
	$("#policy-window").fadeIn();
	$(".policy-message").fadeIn();
	$(".policy-message").text(message);
	if (type == 'edit') {
		$("#policy-edit").fadeIn();
		//$("#policy-edit #icon").html('<img src="/public/img/icon_'+cat+'.png class="policy-entry-icon" />');
		$("#policy-edit #id").val(id);
	}
	if (type == 'text') {
		$("#policy-text").fadeIn();
		$(".policy-message").append('<p>'+formatText(text)+'</p>');
	}
	if (type == 'delete') {
		$("#policy-delete").fadeIn();
		$("#policy-delete #id").val(id);
	}
			
}
function closeWindow() {
	$("#policy-popup").fadeOut();
	$("#policy-window").fadeOut();
	$(".policy-message").fadeOut();
	$("#policy-edit").fadeOut();
	$("#policy-text").fadeOut();
	$("#policy-delete").fadeOut();
}

// FORMAT TEXT
// format text with line braks and links
function formatText(str) {
	var regxp = /[\r\n]/g
	str = str.replace(regxp, "<br />");
	return str;
}

// CLEAR ALL SORT CLASSES
function resetSortLinks() {
	// setup array of sort link IDs
	var sortLinkArray = ["#sortfirst","#sortlast","#sortdesc","#sortcat","#sortprem","#sorttype","#sortsold","#sortsrc","#sortlen","#sortwdate","#sortidate","#sortedate"];
		
	// loop over sort links
		for (var i=0; i < sortLinkArray.length; i++) {
 			// reset all sort link classes that do NOT have default class
			if (!$(sortLinkArray[i]).hasClass("sort-link")) {
				// swap class back to default
				$(sortLinkArray[i]).removeClass();
				$(sortLinkArray[i]).addClass("sort-link");
			}
		}
}

// ADD POLICY
function openPolicyAddWindow(id) {
	openWindow('edit','Add New Policy',id,'');
}

// EDIT POLICY
function openPolicyEditWindow(id) {
	openWindow('edit','Edit Policy ',id,'');
}

// SHOW DESC TEXT IN A WINDOW
function openPolicyDescWindow(text) {
	openWindow('text','Policy Description','-1',text);
}

// SHOW NOTE TEXT IN A WINDOW
function openPolicyTextWindow(text) {
	openWindow('text','Policy Notes','-1',text);
}

// DELETE POLICY
function doPolicyDelete(id) {
	openWindow('delete','Delete Policy',id,'');
}

// LOAD
$(document).ready(function() {

	var currcat = 'listall';
	$("#statuscat").text('All');

	// CLOSE POPUPS
	$(".plain-btn-close").on("click", function(event) {
		event.preventDefault();
		closeWindow();
	});

	// HIGHLIGHT MAIN SECTION
	$("#policies").closest(".main-button").css("background-color","#cccccc");
	// HIGHLIGHT SUB SECTION
	$("#all").closest(".sub-button").css("background-color","#000000");

// =============== BEGIN SUB NAV =============== //

	// ADD NEW
	$("#add").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		openPolicyAddWindow(0);
	});

	// VIEW ALL
	$("#all").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
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
		resetSortLinks();
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
		resetSortLinks();
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
		resetSortLinks();
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
		resetSortLinks();
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
		resetSortLinks();
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
		resetSortLinks();
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
		resetSortLinks();
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

// =============== BEGIN STATUS NAV =============== //

	// VIEW ALL WRITTEN ONLY
	$("#allwritten").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$("#policy-content").load("/app/policies/"+currcat+"/allwritten");
	});

	// VIEW NOT ISSUED ONLY
	$("#notissued").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$("#policy-content").load("/app/policies/"+currcat+"/notissued");
	});

	// VIEW ALL PENDING RENEWAL ONLY
	$("#pendingrenewal").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$("#policy-content").load("/app/policies/"+currcat+"/pendingrenewal");
	});

// =============== END STATUS NAV =============== //

// =============== BEGIN SORT NAV =============== //

	var order = 'asc';

	// SORTING
	$("#sortfirst").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/firstnamedesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/firstname");
			order = "desc";
		}
	});
	$("#sortlast").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/lastnamedesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/lastname");
			order = "desc";
		}
	});
	$("#sortdesc").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/descriptiondesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/description");
			order = "desc";
		}
	});
	$("#sortcat").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/categorydesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/category");
			order = "desc";
		}
	});
	$("#sortprem").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/premiumdesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/premium");
			order = "desc";
		}
	});
	$("#sorttype").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/typedesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/type");
			order = "desc";
		}
	});
	$("#sortsold").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/soldbydesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/soldby");
			order = "desc";
		}
	});
	$("#sortsrc").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/sourcedesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/source");
			order = "desc";
		}
	});
	$("#sortlen").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/lengthdesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/length");
			order = "desc";
		}
	});
	$("#sortwdate").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/writtendesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/written");
			order = "desc";
		}
	});
	$("#sortidate").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/issueddesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/issued");
			order = "desc";
		}
	});
	$("#sortedate").on("click", function(event) {
		event.preventDefault();
		resetSortLinks();
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/effectivedesc");
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/effective");
			order = "desc";
		}
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