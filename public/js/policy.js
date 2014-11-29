/* <![CDATA[ */

// OPEN/CLOSE MESSAGE WINDOW
function openModal(type,message) {
			
	var winh = $(window).height();
	var doch = $(document).height();
	if (winh > doch) {
		$("#modal").height(winh);
	} else {
		$("#modal").height(doch);
	}
	$("#modal").fadeIn();
				
	var winw = $(window).width();
	var neww = (winw/2)-298;
	var scrolled_val = $(document).scrollTop().valueOf();
	var newh = (scrolled_val+25);
	$("#popupmessage").css({ "margin-left": neww+"px", "margin-top": "-330px" });
	$("#popupmessage").fadeIn();
	$("#message").fadeIn();
	$("#message").html(message);
			
}
function closeModal() {
	$("#modal").fadeOut();
	$("#popupmessage").fadeOut();
	$("#message").fadeOut();
}

// OPEN/CLOSE POPUP WINDOW
function openWindow(type,message,id,text,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,zip) {

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
	if (type == 'add') {
		$("#policy-edit").fadeIn();
		$("#policy-edit #id").val(id);
		$("#policy-save").hide();
		$("#policy-add").fadeIn();
		$("#policy_first_name").val(fname);
		$("#policy_last_name").val(lname);
		$("#policy_description").val(desc);
		$("#policy_premium").val(prem);
		$("#policy_zip").val(zip);
		$("#policy_notes").val(text);
		$("#policy_sub_category option[value="+cat+"]").prop("selected", true);
		$("#policy_business_type option[value="+busi+"]").prop("selected", true);
		$("#policy_team_member option[value="+sold+"]").prop("selected", true);
		$("#policy_source_type option[value="+src+"]").prop("selected", true);
		$("#policy_length_type option[value="+len+"]").prop("selected", true);
	}
	if (type == 'edit') {
		$("#policy-edit").fadeIn();
		//$("#policy-edit #icon").html('<img src="/public/img/icon_'+cat+'.png class="policy-entry-icon" />');
		$("#policy-edit #id").val(id);
		$("#policy-add").hide();
		$("#policy-save").fadeIn();
		$("#policy_first_name").val(fname);
		$("#policy_last_name").val(lname);
		$("#policy_description").val(desc);
		$("#policy_premium").val(prem);
		$("#policy_zip").val(zip);
		$("#policy_notes").val(text);
		$("#policy_sub_category option[value="+cat+"]").prop("selected", true);
		$("#policy_business_type option[value="+busi+"]").prop("selected", true);
		$("#policy_team_member option[value="+sold+"]").prop("selected", true);
		$("#policy_source_type option[value="+src+"]").prop("selected", true);
		$("#policy_length_type option[value="+len+"]").prop("selected", true);
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
	openWindow('add','Add New Policy',id,'','','','','','',0,0,0,0,0,'','','','');
}

// EDIT POLICY
function openPolicyEditWindow(id,text,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,zip) {
	openWindow('edit','Edit Policy ',id,text,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,zip);
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

	// CLOSE MODAL WINDOW
	$("#popupmessage").find(".plain-btn").on("click", function() {
		closeModal();
	});

	var currcat = 'listall';
	$("#statuscat").text('All');

	// CLOSE POPUPS
	$(".plain-btn-close").on("click", function(event) {
		event.preventDefault();
		closeWindow();
	});

	$("#policy_premium").focusout(function() {

		if($(this).val().indexOf('.')!=-1){         
            if($(this).val().split(".")[1].length > 2){                
                if( isNaN( parseFloat( this.value ) ) ) return;
                this.value = parseFloat(this.value).toFixed(2);
            }  
         } 

    		if (isNaN(Number($(this).val()))) {
        		$(this).val('');
    		}
	});

	// HIGHLIGHT MAIN SECTION
	$("#policies").closest(".main-button").css("background-color","#cccccc");
	// HIGHLIGHT SUB SECTION
	$("#all").closest(".sub-button").css("background-color","#000000");

// =============== BEGIN ADD/EDIT/DELETE POLICY =============== //

	$("#policy-add").on("click", function(event) {
		event.preventDefault();
		$('#policy_entry_form').submit();
		closeWindow();
	});

	$("#policy-save").on("click", function(event) {
		event.preventDefault();
		$('#policy_entry_form').submit();
		closeWindow();
	});
			
	$('#policy_entry_form').submit(function(event) {

			if ($("#policy-edit #id").val() == 0) {
                $.ajax({
					type: 'POST',
					url: '/app/policies/addrec',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$("#policy-content").load("/app/policies/"+currcat);
							// show success message...
							openModal('info',data.msg);
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
			} // end if add

			if ($("#policy-edit #id").val() > 0) {
                $.ajax({
					type: 'POST',
					url: '/app/policies/editrec',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$("#policy-content").load("/app/policies/"+currcat);
							// show success message...
							openModal('info',data.msg);
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
			} // end if edit

		event.preventDefault();
	});

	$("#policy-disable").on("click", function(event) {
		event.preventDefault();
		$('#policy_delete_form').submit();
		closeWindow();
	});
			
	$('#policy_delete_form').submit(function(event) {
                $.ajax({
					type: 'POST',
					url: '/app/policies/deleterec',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$("#policy-content").load("/app/policies/"+currcat);
							// show success message...
							openModal('info',data.msg);
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
		event.preventDefault();
	});

// =============== END ADD/EDIT/DELETE POLICY =============== //

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