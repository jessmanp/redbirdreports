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
function openWindow(currcat,type,message,id,text,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,zip) {

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
	
	var category = currcat.replace(/list/g, "");
	categoryName = category.charAt(0).toUpperCase() + category.slice(1);
	if (categoryName == "All") {
		categoryName = "";
	}

	$("#policy-window").css({ "margin-left": neww+"px", "margin-top": "-330px" });
	$("#policy-window").fadeIn();
	$(".policy-message").fadeIn();
	$(".policy-message").text(message);
	if (category != '') {
		$(".policy-message").prepend('<img src="/public/img/icon_'+category+'.png" class="modal-icon" alt="'+categoryName+'" />');
		$(".policy-message").append(' '+categoryName+' Policy');
	}
	// display category options based on current category
	$("#policy_sub_category").empty();
	if (category == 'auto') {
		$("#policy_sub_category").append($("#captionsauto").val());
	} else if (category == 'fire') {
		$("#policy_sub_category").append($("#captionsfire").val());
	} else if (category == 'life') {
		$("#policy_sub_category").append($("#captionslife").val());
	} else if (category == 'health') {
		$("#policy_sub_category").append($("#captionshealth").val());
	} else if (category == 'deposit') {
		$("#policy_sub_category").append($("#captionsdeposit").val());
	} else if (category == 'loan') {
		$("#policy_sub_category").append($("#captionsloan").val());
	} else if (category == 'fund') {
		$("#policy_sub_category").append($("#captionsfund").val());
	} else {
		$("#policy_sub_category").append($("#captionsall").val());
	}
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
		$("#policy_business_type option[value="+busi+"]").prop("selected", true);
		$("#policy_team_member option[value="+sold+"]").prop("selected", true);
		$("#policy_source_type option[value="+src+"]").prop("selected", true);
		if (category == 'auto') {
			$("#policy_length_type option[value=1]").prop("selected", true);
		} else {
			$("#policy_length_type option[value="+len+"]").prop("selected", true);
		}
		//Create a Date object
 		var date = new Date();
 		//Concatenate the sections of your Date into a string ("dd/mm/yyyy")
 		var nowformatted = (date.getMonth() + 1)+'/'+date.getDate()+'/'+date.getFullYear();
		$("#writtendate").val(nowformatted);
		$("#issueddate").val('');
		$("#effectivedate").val('');
		$("#canceleddate").val('');
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
		if (cat != 0) {
			$("#policy_sub_category option[value="+cat+"]").prop("selected", true);
		}
		$("#policy_business_type option[value="+busi+"]").prop("selected", true);
		$("#policy_team_member option[value="+sold+"]").prop("selected", true);
		$("#policy_source_type option[value="+src+"]").prop("selected", true);
		$("#policy_length_type option[value="+len+"]").prop("selected", true);
		$("#writtendate").val(sqlToJsDate(dw));
		if (di == '') {
			$("#issueddate").val('');
		} else {
			$("#issueddate").val(sqlToJsDate(di));
		}
		if (de == '') {
			$("#effectivedate").val('');
		} else {
			$("#effectivedate").val(sqlToJsDate(de));
		}
		if (dc == '') {
			$("#canceleddate").val('');
		} else {
			$("#canceleddate").val(sqlToJsDate(dc));
		}
	}
	if (type == 'text') {
		if (text == '') {
			text = '&nbsp;';
		}
		$("#policy-text").fadeIn();
		$("#policy-text").find("p").text('');
		$("#policy-text").find("p").html(formatText(text));
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

function calendarPickerSubmit() {
	// call from datepicker
	$("#search_text_form").submit();
}

function calendarUnHighlightDay(target) {
	// remove last highlighted day in datepicker
	//alert(target.className);
	$(target).closest("table").find(".today").removeClass();
	$(".date-pickers").html("Date Range:");
	$("#all_time").removeAttr("style");
	$("#today").removeAttr("style");
	$("#this_week").removeAttr("style");
	$("#last_week").removeAttr("style");
	$("#this_month").removeAttr("style");
	$("#last_month").removeAttr("style");
	$("#this_quarter").removeAttr("style");
	$("#first_quarter").removeAttr("style");
	$("#second_quarter").removeAttr("style");
	$("#third_quarter").removeAttr("style");
	$("#fourth_quarter").removeAttr("style");
	$("#last_six_months").removeAttr("style");
	$("#this_year").removeAttr("style");
	$("#last_two_years").removeAttr("style");
}

// FORMAT TEXT
// format text with line braks and links
function formatText(str) {
	var regxp = /[\r\n]/g
	str = str.replace(regxp, "<br />");
	return str;
}

// CLEAR ALL SORT CLASSES
function resetSortLinks(searchSubmit) {
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

	if (searchSubmit == 0) {
		// reset text fields by default
		$("#first").prop('checked', true);
		$("#last").prop('checked', true);
		$("#description").prop('checked', true);
		//$("#premium").prop('checked', true);
		$("#notes").prop('checked', true);
	
		// reset dates by default
		$("#written").prop('checked', true);
		$("#issued").prop('checked', true);
		$("#effective").prop('checked', true);
		$("#canceled").prop('checked', true);
	}
}

// ADD POLICY
function openPolicyAddWindow(currcat,id) {
	openWindow(currcat,'add','Add New',id,'','','','','','',0,0,0,0,0,'','','','');
}

// EDIT POLICY
function openPolicyEditWindow(currcat,id,text,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,zip) {
	openWindow(currcat,'edit','Edit',id,text,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,zip);
}

// SHOW DESC TEXT IN A WINDOW
function openPolicyDescWindow(text) {
	openWindow('','text','Policy Description','-1',text);
}

// SHOW NOTE TEXT IN A WINDOW
function openPolicyTextWindow(text) {
	openWindow('','text','Policy Notes','-1',text);
}

// DELETE POLICY
function doPolicyDelete(id) {
	openWindow('','delete','Erase Policy',id,'');
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
	
	$("#field").focusout(function() {
	
		var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    	var str = $(this).val();
    	if (!regex.test(str)) {
        	$(this).val('');
    	}
    	
	});

	$("#datepick1").focusout(function() {
	
		var regex = new RegExp("^[0-9/]+$");
    	var str = $(this).val();
    	if (!regex.test(str)) {
        	$(this).val('');
    	}

	});

	$("#datepick2").focusout(function() {
	
		var regex = new RegExp("^[0-9/]+$");
    	var str = $(this).val();
    	if (!regex.test(str)) {
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
			// set current path for listing of policies
			var path = "/"+$("#policy-edit #path").val();

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
							$("#policy-content").load(path);
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
							$("#policy-content").load(path);
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
		openPolicyAddWindow(currcat,0);
		$("#field").val('');
	});

	// VIEW ALL
	$("#all").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		resetSortLinks(0);
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#auto").closest(".sub-button").removeAttr("style");
		$("#fire").closest(".sub-button").removeAttr("style");
		$("#life").closest(".sub-button").removeAttr("style");
		$("#health").closest(".sub-button").removeAttr("style");
		$("#deposit").closest(".sub-button").removeAttr("style");
		$("#loan").closest(".sub-button").removeAttr("style");
		$("#fund").closest(".sub-button").removeAttr("style");
		$("#statuscat").text('All');
		loadDatePickers();
		$(".date-pickers").html("Date Range:");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#policy-content").load("/app/policies/listall");
		currcat = 'listall';
	});

	// AUTO
	$("#auto").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		resetSortLinks(0);
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").removeAttr("style");
		$("#fire").closest(".sub-button").removeAttr("style");
		$("#life").closest(".sub-button").removeAttr("style");
		$("#health").closest(".sub-button").removeAttr("style");
		$("#deposit").closest(".sub-button").removeAttr("style");
		$("#loan").closest(".sub-button").removeAttr("style");
		$("#fund").closest(".sub-button").removeAttr("style");
		$("#statuscat").text('Auto');
		loadDatePickers();
		$(".date-pickers").html("Date Range:");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#policy-content").load("/app/policies/listauto");
		currcat = 'listauto';
	});

	// FIRE
	$("#fire").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		resetSortLinks(0);
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").removeAttr("style");
		$("#auto").closest(".sub-button").removeAttr("style");
		$("#life").closest(".sub-button").removeAttr("style");
		$("#health").closest(".sub-button").removeAttr("style");
		$("#deposit").closest(".sub-button").removeAttr("style");
		$("#loan").closest(".sub-button").removeAttr("style");
		$("#fund").closest(".sub-button").removeAttr("style");
		$("#statuscat").text('Fire');
		loadDatePickers();
		$(".date-pickers").html("Date Range:");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#policy-content").load("/app/policies/listfire");
		currcat = 'listfire';
	});

	// LIFE
	$("#life").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		resetSortLinks(0);
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").removeAttr("style");
		$("#auto").closest(".sub-button").removeAttr("style");
		$("#fire").closest(".sub-button").removeAttr("style");
		$("#health").closest(".sub-button").removeAttr("style");
		$("#deposit").closest(".sub-button").removeAttr("style");
		$("#loan").closest(".sub-button").removeAttr("style");
		$("#fund").closest(".sub-button").removeAttr("style");
		$("#statuscat").text('Life');
		loadDatePickers();
		$(".date-pickers").html("Date Range:");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#policy-content").load("/app/policies/listlife");
		currcat = 'listlife';
	});

	// HEALTH
	$("#health").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		resetSortLinks(0);
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").removeAttr("style");
		$("#auto").closest(".sub-button").removeAttr("style");
		$("#fire").closest(".sub-button").removeAttr("style");
		$("#life").closest(".sub-button").removeAttr("style");
		$("#deposit").closest(".sub-button").removeAttr("style");
		$("#loan").closest(".sub-button").removeAttr("style");
		$("#fund").closest(".sub-button").removeAttr("style");
		$("#statuscat").text('Health');
		loadDatePickers();
		$(".date-pickers").html("Date Range:");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#policy-content").load("/app/policies/listhealth");
		currcat = 'listhealth';
	});

	// DEPOSIT
	$("#deposit").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		resetSortLinks(0);
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").removeAttr("style");
		$("#auto").closest(".sub-button").removeAttr("style");
		$("#fire").closest(".sub-button").removeAttr("style");
		$("#life").closest(".sub-button").removeAttr("style");
		$("#health").closest(".sub-button").removeAttr("style");
		$("#loan").closest(".sub-button").removeAttr("style");
		$("#fund").closest(".sub-button").removeAttr("style");
		$("#statuscat").text('Deposit');
		loadDatePickers();
		$(".date-pickers").html("Date Range:");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#policy-content").load("/app/policies/listdeposit");
		currcat = 'listdeposit';
	});

	// LOAN
	$("#loan").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		resetSortLinks(0);
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").removeAttr("style");
		$("#auto").closest(".sub-button").removeAttr("style");
		$("#fire").closest(".sub-button").removeAttr("style");
		$("#life").closest(".sub-button").removeAttr("style");
		$("#health").closest(".sub-button").removeAttr("style");
		$("#deposit").closest(".sub-button").removeAttr("style");
		$("#fund").closest(".sub-button").removeAttr("style");
		$("#statuscat").text('Loan');
		loadDatePickers();
		$(".date-pickers").html("Date Range:");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#policy-content").load("/app/policies/listloan");
		currcat = 'listloan';
	});

	// FUND
	$("#fund").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		resetSortLinks(0);
		$(this).closest(".sub-button").css("background-color","#000000");
		$("#all").closest(".sub-button").removeAttr("style");
		$("#auto").closest(".sub-button").removeAttr("style");
		$("#fire").closest(".sub-button").removeAttr("style");
		$("#life").closest(".sub-button").removeAttr("style");
		$("#health").closest(".sub-button").removeAttr("style");
		$("#deposit").closest(".sub-button").removeAttr("style");
		$("#loan").closest(".sub-button").removeAttr("style");
		$("#statuscat").text('Mutual Fund');
		loadDatePickers();
		$(".date-pickers").html("Date Range:");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#policy-content").load("/app/policies/listfund");
		currcat = 'listfund';
	});

// =============== END SUB NAV =============== //

// =============== BEGIN STATUS NAV =============== //

	// VIEW ALL WRITTEN ONLY
	$("#allwritten").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		$("#policy-content").load("/app/policies/"+currcat+"/allwritten");
	});

	// VIEW NOT ISSUED ONLY
	$("#notissued").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		$("#policy-content").load("/app/policies/"+currcat+"/notissued");
	});

	// VIEW ALL PENDING RENEWAL ONLY
	$("#pendingrenewal").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		$("#policy-content").load("/app/policies/"+currcat+"/pendingrenewal");
	});

	// VIEW ALL CANCELED ONLY
	$("#allcanceled").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		$("#policy-content").load("/app/policies/"+currcat+"/allcanceled");
	});

// =============== END STATUS NAV =============== //

// =============== BEGIN SORT NAV =============== //

	var order = 'asc';

	// SORTING
	$("#sortfirst").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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
		resetSortLinks(0);
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

// =============== BEGIN PREDEFINED DATES =============== //

	$("#all_time").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#datepick1").val('');
		$("#datepick2").val('');
		$("#field").val('');
		$(".date-pickers").html("All Time:");
		loadDatePickers();
		$("#policy-content").load("/app/policies/"+currcat);
   		$("#pre-dates-container").toggle();
	});

	$("#today").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("Today:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#this_week").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("This Week:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#last_week").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("Last Week:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#this_month").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("This Month:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#last_month").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("Last Month:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#this_quarter").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("This Quarter:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#first_quarter").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("1st Quarter:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#second_quarter").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("2nd Quarter:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#third_quarter").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("3rd Quarter:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#fourth_quarter").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("4th Quarter:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#last_six_months").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("Last 6 Mos.:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#this_year").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#last_two_years").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("This Year:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

	$("#last_two_years").on("click", function(event) {
		event.preventDefault();
		$(this).css("background-color","#000000");
		$(this).css("border-color","#000000");
		$("#all_time").removeAttr("style");
		$("#today").removeAttr("style");
		$("#this_week").removeAttr("style");
		$("#last_week").removeAttr("style");
		$("#this_month").removeAttr("style");
		$("#last_month").removeAttr("style");
		$("#this_quarter").removeAttr("style");
		$("#first_quarter").removeAttr("style");
		$("#second_quarter").removeAttr("style");
		$("#third_quarter").removeAttr("style");
		$("#fourth_quarter").removeAttr("style");
		$("#last_six_months").removeAttr("style");
		$("#this_year").removeAttr("style");
		$("#field").val('');
		var dateRange = $(this).data('dates');
		var dates = dateRange.split(".");
		var sdate = dates[0].replace(/-/g, "/");
		var edate = dates[1].replace(/-/g, "/");
		$("#datepick1").val(sdate);
		$("#datepick2").val(edate);
		$(".date-pickers").html("Last 2 Years:");
		loadDatePickers();
		//$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
		$("#search_text_form").submit();
   		$("#pre-dates-container").toggle();
	});

// =============== END PREDEFINED DATES =============== //

// =============== BEGIN SEARCH TEXT =============== //

	$("#field").keypress(function(e) {
  		if (e.which == 13) {
    		$("#search_text_form").submit();
    		return false;    //<---- Add this to do preventDefault and propagation
  		}
	});

	$("#submit").on("click", function(event) {
		event.preventDefault();
		$("#search_text_form").submit();
	});

	$("#search_text_form").submit(function(event) {
		event.preventDefault();
		// set path even if date is blank
		var path = "/app/policies/"+currcat+"/default/any/";
			
		if ($("#datepick1").val() != '' && $("#datepick2").val() != '') {
			// do date range searches
			var datetype = "any";
			// format dates for link
			var sdate = $("#datepick1").val().replace(/\//g, "-");
			var edate = $("#datepick2").val().replace(/\//g, "-");
			if ($("#written").prop('checked') === true && $("#issued").prop('checked') === false && $("#effective").prop('checked') === false && $("#canceled").prop('checked') === false) {
				datetype = ".w";
			}
			if ($("#issued").prop('checked') === true && $("#written").prop('checked') === false && $("#effective").prop('checked') === false && $("#canceled").prop('checked') === false) {
				datetype = ".i";
			}
			if ($("#effective").prop('checked') === true && $("#written").prop('checked') === false && $("#issued").prop('checked') === false && $("#canceled").prop('checked') === false) {
				datetype = ".e";
			}
			if ($("#effective").prop('checked') === false && $("#written").prop('checked') === false && $("#issued").prop('checked') === false && $("#canceled").prop('checked') === true) {
				datetype = ".c";
			}
			if ($("#written").prop('checked') === true && $("#issued").prop('checked') === true && $("#effective").prop('checked') === false && $("#canceled").prop('checked') === false) {
				datetype = ".wi";
			}
			if ($("#written").prop('checked') === true && $("#effective").prop('checked') === true && $("#issued").prop('checked') === false && $("#canceled").prop('checked') === false) {
				datetype = ".we";
			}
			if ($("#written").prop('checked') === true && $("#effective").prop('checked') === true && $("#issued").prop('checked') === false && $("#canceled").prop('checked') === true) {
				datetype = ".wc";
			}
			if ($("#effective").prop('checked') === true && $("#issued").prop('checked') === true && $("#written").prop('checked') === false && $("#canceled").prop('checked') === false) {
				datetype = ".ei";
			}
			if ($("#effective").prop('checked') === true && $("#issued").prop('checked') === false && $("#written").prop('checked') === false && $("#canceled").prop('checked') === true) {
				datetype = ".ec";
			}
			if ($("#written").prop('checked') === true && $("#issued").prop('checked') === true && $("#effective").prop('checked') === true && $("#canceled").prop('checked') === false) {
				datetype = ".wie";
			}
			if ($("#written").prop('checked') === true && $("#issued").prop('checked') === false && $("#effective").prop('checked') === true && $("#canceled").prop('checked') === true) {
				datetype = ".wec";
			}
			if ($("#written").prop('checked') === true && $("#issued").prop('checked') === true && $("#effective").prop('checked') === false && $("#canceled").prop('checked') === true) {
				datetype = ".iwc";
			}
			if ($("#written").prop('checked') === false && $("#issued").prop('checked') === true && $("#effective").prop('checked') === true && $("#canceled").prop('checked') === true) {
				datetype = ".eic";
			}
			if ($("#written").prop('checked') === true && $("#issued").prop('checked') === true && $("#effective").prop('checked') === true && $("#canceled").prop('checked') === true) {
				datetype = ".a";
			}
			var dateRange = sdate+"."+edate+datetype;
			if (datetype == 'any') {
				var path = "/app/policies/"+currcat+"/default/any/";
			} else {
				var path = "/app/policies/"+currcat+"/default/"+dateRange+"/";
			}
		}
		// do keyword searches
		var type = null;
		var phrase = '';
		if ($("#field").val() != '') {
			var text = $("#field").val().replace(/ /g, "-");
			var phrase = text;
			// do search based on checkboxes
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".a";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".f";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".l";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".d";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".p";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".n";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".fl";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".fd";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".fp";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".fn";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".ld";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".lp";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".ln";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".dp";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".dn";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".pn";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".fld";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".flp";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".fln";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".fdp";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".fdn";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".fpn";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".ldp";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".lpn";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".dpn";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".dln";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".fldp";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".fldn";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".ldpn";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".fdpn";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".dfpn";
			}
			if (type) {
				phrase = phrase+type;
			}
		}
		// update path
		path = path+phrase;
		//alert(path);
		$("#policy-content").load(path);
		// clear any sorting that might be clicked
		resetSortLinks(1);
	});
	
	// turn on all text fields by default
	$("#first").prop('checked', true);
	$("#last").prop('checked', true);
	$("#description").prop('checked', true);
	//$("#premium").prop('checked', true);
	$("#notes").prop('checked', true);
	
	// turn on all dates by default
	$("#written").prop('checked', true);
	$("#issued").prop('checked', true);
	$("#effective").prop('checked', true);
	$("#canceled").prop('checked', true);

// =============== END SEARCH TEXT =============== //

// =============== BEGIN SEARCH DATES =============== //

/*
	$("#written").on("click", function(event) {
		if ($("#datepick1").val() != '' && $("#datepick2").val() != '') {
			$("#issued").prop('checked', false);
			$("#effective").prop('checked', false);
			// format dates for link
			var sdate = $("#datepick1").val().replace(/\//g, "-");
			var edate = $("#datepick2").val().replace(/\//g, "-");
			var dateRange = sdate+"."+edate+".w";
			$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
   			$("#filter-container").toggle();
		}
	});

	$("#issued").on("click", function(event) {
		if ($("#datepick1").val() != '' && $("#datepick2").val() != '') {
			$("#written").prop('checked', false);
			$("#effective").prop('checked', false);
			// format dates for link
			var sdate = $("#datepick1").val().replace(/\//g, "-");
			var edate = $("#datepick2").val().replace(/\//g, "-");
			var dateRange = sdate+"."+edate+".i";
			$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
   			$("#filter-container").toggle();
		}
	});

	$("#effective").on("click", function(event) {
		if ($("#datepick1").val() != '' && $("#datepick2").val() != '') {
			$("#written").prop('checked', false);
			$("#issued").prop('checked', false);
			// format dates for link
			var sdate = $("#datepick1").val().replace(/\//g, "-");
			var edate = $("#datepick2").val().replace(/\//g, "-");
			var dateRange = sdate+"."+edate+".e";
			$("#policy-content").load("/app/policies/"+currcat+"/default/"+dateRange);
   			$("#filter-container").toggle();
		}
	});
*/

// =============== END SEARCH DATES =============== //

	// LOAD DATE PICKERS
	function loadDatePickers(){
		new datepickr("datepick1", {
			"dateFormat": "m/d/Y"
		});
		new datepickr("datepick2", {
			"dateFormat": "m/d/Y"
		});
		// edit winow date pickers
	}

	//bind orientation change to date picker event
	$(window).bind("orientationchange", loadDatePickers);
	$(window).resize(function() {
		loadDatePickers();
	});

	// SET DATE PICKERS
	$("#datepick1").attr("placeholder", "Start Date");
	$("#datepick2").attr("placeholder", "End Date");
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