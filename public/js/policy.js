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
	$("#modal").delay(300).fadeIn();
				
	var winw = $(window).width();
	var neww = (winw/2)-298;
	var scrolled_val = $(document).scrollTop().valueOf();
	var newh = (scrolled_val+25);
	$("#popupmessage").css({ "margin-left": neww+"px", "margin-top": "-330px" });
	$("#popupmessage").delay(300).fadeIn();
	$("#message").delay(300).fadeIn();
	$("#message").html(message);
			
}
function closeModal() {
	$("#modal").fadeOut("fast");
	$("#popupmessage").fadeOut("fast");
	$("#message").fadeOut("fast");
}

// OPEN/CLOSE POPUP WINDOW
function openWindow(currcat,type,message,id,text,pnum,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,renewal,stat) {

	$("#policy-window").hide();

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
	$("#policy-window").fadeIn("fast");
	$(".policy-message").fadeIn("fast");
	$(".policy-message").text(message);
	if (category != '') {
		if (Retina.isRetina()) {
			category = category+"@2x";
		}
		$(".policy-message").prepend('<img src="/public/img/icon_'+category+'.png" class="modal-icon" alt="'+categoryName+'" />');
		$(".policy-message").append(' '+categoryName+' Policy');
	}
	// display category options based on current category
	$("#policy_type").prop("disabled", false);
	$("#policy_type").empty();
	$("#policy_type").append($("#captionsmain").val());
	$("#policy_sub_category").empty();
	// populate based on dropdown
	$("#policy_type").change(function() {
		$("#policy_sub_category").empty();
		if ($("#policy_type").val() == 1) {
			$("#policy_sub_category").append($("#captionsauto").val());
		} else if ($("#policy_type").val() == 9) {
			$("#policy_sub_category").append($("#captionsfire").val());
		} else if ($("#policy_type").val() == 26) {
			$("#policy_sub_category").append($("#captionslife").val());
		} else if ($("#policy_type").val() == 40) {
			$("#policy_sub_category").append($("#captionshealth").val());
		} else if ($("#policy_type").val() == 50) {
			$("#policy_sub_category").append($("#captionsdeposit").val());
		} else if ($("#policy_type").val() == 58) {
			$("#policy_sub_category").append($("#captionsloan").val());
		} else if ($("#policy_type").val() == 70) {
			$("#policy_sub_category").append($("#captionsfund").val());
		} else {
			$("#policy_sub_category").append('<option value="0"></option>');
		}
	});
	// populate based on category
	if (category == 'auto') {
		$("#policy_sub_category").append($("#captionsauto").val());
		$("#policy_type option[value=1]").prop("selected", true);
		$("#policy_type").prop("disabled", true);
	} else if (category == 'fire') {
		$("#policy_sub_category").append($("#captionsfire").val());
		$("#policy_type option[value=9]").prop("selected", true);
		$("#policy_type").prop("disabled", true);
	} else if (category == 'life') {
		$("#policy_sub_category").append($("#captionslife").val());
		$("#policy_type option[value=26]").prop("selected", true);
		$("#policy_type").prop("disabled", true);
	} else if (category == 'health') {
		$("#policy_sub_category").append($("#captionshealth").val());
		$("#policy_type option[value=40]").prop("selected", true);
		$("#policy_type").prop("disabled", true);
	} else if (category == 'deposit') {
		$("#policy_sub_category").append($("#captionsdeposit").val());
		$("#policy_type option[value=50]").prop("selected", true);
		$("#policy_type").prop("disabled", true);
	} else if (category == 'loan') {
		$("#policy_sub_category").append($("#captionsloan").val());
		$("#policy_type option[value=58]").prop("selected", true);
		$("#policy_type").prop("disabled", true);
	} else if (category == 'fund') {
		$("#policy_sub_category").append($("#captionsfund").val());
		$("#policy_type option[value=70]").prop("selected", true);
		$("#policy_type").prop("disabled", true);
	}
	if (type == 'add') {
		$("#policy-edit").fadeIn();
		$("#policy-edit #id").val(id);
		$("#policy-save").hide();
		$("#policy-add").fadeIn();
		$("#policy-erase").hide();
		$("#policy_first_name").val(fname);
		$("#policy_last_name").val(lname);
		$("#policy_description").val(desc);
		$("#policy_premium").prop("readonly", false);
		$("#policy_premium").val(prem);
		$("#policy_zip").val(zip);
		$("#policy_notes").val(text);
		$("#policy_number").val(pnum);
		$("#policy_dropdown_cover").hide();
		$(".policy-new-premium").hide();
		$("#policy_business_type option[value="+busi+"]").prop("selected", true);
		$("#policy_team_member option[value="+sold+"]").prop("selected", true);
		$("#policy_source_type option[value="+src+"]").prop("selected", true);
		if (category == 'auto') {
			$("#policy_length_type option[value=1]").prop("selected", true);
		} else if (category == 'fire') {
			$("#policy_length_type option[value=2]").prop("selected", true);
		} else if (category == 'life') {
			$("#policy_length_type option[value=2]").prop("selected", true);
		} else if (category == 'health') {
			$("#policy_length_type option[value=2]").prop("selected", true);
		} else if (category == 'deposit') {
			$("#policy_length_type option[value=3]").prop("selected", true);
		} else if (category == 'loan') {
			$("#policy_length_type option[value=3]").prop("selected", true);
		} else if (category == 'fund') {
			$("#policy_length_type option[value=3]").prop("selected", true);
		} else {
			$("#policy_length_type option[value="+len+"]").prop("selected", true);
		}
		$("#writtendate").val(setClientDate());
		$("#issueddate").val('');
		$("#issueddate").prop("disabled", true);
		$("#issueddate").css("opacity","0.5");
		$("#effectivedate").prop("disabled", false);
		$("#effectivedate").removeAttr("style");
		$("#effectivedate").val('');
		$("#premiumdate").val('');
		$("#canceleddate").val('');
		$("#canceleddate").prop("disabled", true);
		$("#canceleddate").css("opacity","0.5");
		$("#status_pending").prop("checked", true);
		$("#status_issued").prop("disabled", true);
		$("#status_declined").prop("disabled", true);
		$("#status_canceled").prop("disabled", true);
	}
	if (type == 'edit') {
		$("#policy-edit").fadeIn();
		//$("#policy-edit #icon").html('<img src="/public/img/icon_'+cat+'.png class="policy-entry-icon" />');
		$("#policy-edit #id").val(id);
		$("#policy-add").hide();
		$("#policy-erase").fadeIn();
		$("#policy-save").fadeIn();
		$("#policy_first_name").val(fname);
		$("#policy_last_name").val(lname);
		$("#policy_description").val(desc);
		$("#policy_premium_org").val(prem);
		$("#policy_premium").val(prem);
		$("#policy_zip").val(zip);
		$("#policy_notes").val(text);
		$("#policy_number").val(pnum);
		var catparts = cat.split("-");
		cat = catparts[0];
		var catp = null;
		catp = catparts[1];
		if (catp == 0) {
			$("#policy_type option[value="+cat+"]").prop("selected", true);
			$("#policy_sub_category").empty();
			if (cat == 1) {
				$("#policy_sub_category").append($("#captionsauto").val());
			} else if (cat == 9) {
				$("#policy_sub_category").append($("#captionsfire").val());
			} else if (cat == 26) {
				$("#policy_sub_category").append($("#captionslife").val());
			} else if (cat == 40) {
				$("#policy_sub_category").append($("#captionshealth").val());
			} else if (cat == 50) {
				$("#policy_sub_category").append($("#captionsdeposit").val());
			} else if (cat == 58) {
				$("#policy_sub_category").append($("#captionsloan").val());
			} else if (cat == 70) {
				$("#policy_sub_category").append($("#captionsfund").val());
			}
		} else {
			$("#policy_type option[value="+catp+"]").prop("selected", true);
			$("#policy_sub_category").empty();
			if (catp == 1) {
				$("#policy_sub_category").append($("#captionsauto").val());
			} else if (catp == 9) {
				$("#policy_sub_category").append($("#captionsfire").val());
			} else if (catp == 26) {
				$("#policy_sub_category").append($("#captionslife").val());
			} else if (catp == 40) {
				$("#policy_sub_category").append($("#captionshealth").val());
			} else if (catp == 50) {
				$("#policy_sub_category").append($("#captionsdeposit").val());
			} else if (catp == 58) {
				$("#policy_sub_category").append($("#captionsloan").val());
			} else if (catp == 70) {
				$("#policy_sub_category").append($("#captionsfund").val());
			}
		}
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
		$("#premiumdate").val('');
		/*
		if (renewal == 'dorenew') {
			// disable all edit fields EXCEPT premium and notes
			$("#policy_first_name").prop("readonly", true);
			$("#policy_last_name").prop("readonly", true);
			$("#policy_description").prop("readonly", true);
			$("#policy_premium").prop("readonly", false);
			$("#policy_zip").prop("readonly", true);
			$("#policy_notes").prop("readonly", false);
			$("#policy_dropdown_cover").show();
			//$("#writtendate").prop("disabled", true);
			$("#issueddate").prop("disabled", true);
			$("#issueddate").css("opacity","0.5");
			$("#effectivedate").prop("disabled", true);
			$("#effectivedate").css("opacity","0.5");
			$("#canceleddate").prop("disabled", true);
			$("#canceleddate").css("opacity","0.5");
		}
		*/
		// enable all edit fields
		$("#policy_first_name").prop("readonly", false);
		$("#policy_last_name").prop("readonly", false);
		$("#policy_description").prop("readonly", false);
		$("#policy_premium").prop("readonly", false);
		$("#policy_zip").prop("readonly", false);
		$("#policy_notes").prop("readonly", false);
		$("#policy_dropdown_cover").hide();
		$("#status_issued").prop("disabled", false);
		$("#status_declined").prop("disabled", false);
		$("#status_canceled").prop("disabled", false);
		if (stat == 1) {
			// set radio btn
			$("#status_pending").prop("checked", true);
			// diable premium
			$("#policy_premium").prop("readonly", true);
			$(".policy-new-premium").hide();
			$("#status_canceled").prop("disabled", true);
		}
		if (stat == 2) {
			// set radio btn
			$("#status_issued").prop("checked", true);
			// turn on premium change date on issued status
			$(".policy-new-premium").fadeIn();
		}
		if (stat == 3) {
			// set radio btn
			$("#status_declined").prop("checked", true);
			// diable premium
			$("#policy_premium").prop("readonly", true);
			$(".policy-new-premium").hide();
			$("#status_canceled").prop("disabled", true);
		}
		if (stat == 4) {
			// set radio btn
			$("#status_canceled").prop("checked", true);
			// diable premium
			$("#policy_premium").prop("readonly", true);
			$(".policy-new-premium").hide();
			$("#status_canceled").prop("disabled", true);
		}
		//$("#writtendate").prop("disabled", false);
		$("#issueddate").prop("disabled", false);
		$("#issueddate").removeAttr("style");
		$("#effectivedate").prop("disaled", false);
		$("#effectivedate").removeAttr("style");
		$("#canceleddate").prop("disabled", true);
	   	$("#canceleddate").css("opacity","0.5");
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
		$("#policy-delete #delid").val(id);
		$("#policy-delete").find("p").text('');
		$("#policy-delete").find("p").html('<em>Policy Preview</em><br /><br /><div class="delete-table-container"><div class="delete-table-row"><div class="edit-col"><strong>Customer Name:</strong></div><div class="delete-col">'+fname+'&nbsp;'+lname+'</div></div><div class="delete-table-row"><div class="edit-col"><strong>Description:</strong></div><div class="delete-col">'+desc+'</div></div></div>');
	}
	if (type == 'renewal') {
		$("#policy-renewal").fadeIn();
		$("#policy-renewal #renid").val(id);
		$("#policy-renewal #renew_cancel_info").val(fname+"','"+lname+"','"+desc);
	}
	if (type == 'renew') {
		$("#policy-do-renew").fadeIn();
		$("#policy-do-renew #renpid").val(id);
		$("#policy-do-renew #renew_premium").val(prem);
		$("#policy-do-renew").find("p").text('');
		$("#policy-do-renew").find("p").html('<em>Policy Preview</em><br /><br /><div class="delete-table-container"><div class="delete-table-row"><div class="edit-col"><strong>Customer Name:</strong></div><div class="delete-col">'+fname+'&nbsp;'+lname+'</div></div><div class="delete-table-row"><div class="edit-col"><strong>Description:</strong></div><div class="delete-col">'+desc+'</div></div></div>');
	}
	if (type == 'renewcancel') {
		$("#policy-renew-cancel").fadeIn();
		$("#policy-renew-cancel #rencid").val(id);
		$("#policy-renew-cancel").find("p").text('');
		$("#policy-renew-cancel").find("p").html('<em>Policy Preview</em><br /><br /><div class="delete-table-container"><div class="delete-table-row"><div class="edit-col"><strong>Customer Name:</strong></div><div class="delete-col">'+fname+'&nbsp;'+lname+'</div></div><div class="delete-table-row"><div class="edit-col"><strong>Description:</strong></div><div class="delete-col">'+desc+'</div></div></div>');
	}
	if (type == 'reinstate') {
		$("#policy-reinstate").fadeIn();
		$("#policy-reinstate #uncid").val(id);
	}
			
}
function closeWindow() {
	$("#policy-popup").fadeOut("fast");
	$("#policy-window").fadeOut("fast");
	$(".policy-message").fadeOut("fast");
	$("#policy-edit").fadeOut("fast");
	$("#policy-text").fadeOut("fast");
	$("#policy-delete").fadeOut("fast");
	$("#policy-renewal").fadeOut("fast");
	$("#policy-do-renew").fadeOut("fast");
	$("#policy-renew-cancel").fadeOut("fast");
	$("#policy-reinstate").fadeOut("fast");
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
	openWindow(currcat,'add','Add New',id,'','','','','','',0,0,0,0,0,'','','','',0);
}

// EDIT POLICY
function openPolicyEditWindow(currcat,id,text,pnum,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,renewal,stat) {
	openWindow(currcat,'edit','Edit',id,text,pnum,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,renewal,stat);
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
function doPolicyDelete(id,first,last,desc) {
	$("#policy-edit").hide();
	openWindow('','delete','Erase Policy',id,'','',first,last,desc);
}

// RENEW POLICY
function doPolicyRenewal(id,first,last,desc) {
	openWindow('','renewal','Renew Policy',id,'','',first,last,desc);
}

// RENEW CANCEL POLICY
function doPolicyCancel(id,first,last,desc) {
	openWindow('','renewcancel','Cancel Policy',id,'','',first,last,desc);
}

// REINSTATE POLICY
function doPolicyReinstate(id) {
	openWindow('','reinstate','Reinstate Policy',id,'');
}

// SET DATE PICKERS AND LOAD LISTING
function loadListing(currcat){
		$("#datepick1").val(setClientDate('first'));
		$("#datepick2").val(setClientDate('last'));
		$("#field").val('');
		$(".date-pickers").html("This Month:");
		$("#search_text_form").submit();
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
	
	$("#renew_premium").focusout(function() {

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
	// SET DEFAULT TO CURRENT MONTH
	$("#datepick1").val(setClientDate('first'));
	$("#datepick2").val(setClientDate('last'));
	$("#field").val('');
	$(".date-pickers").html("This Month:");

// =============== BEGIN ADD/EDIT/DELETE POLICY =============== //

	$("#policy-add").on("click", function(event) {
		event.preventDefault();
		$('#policy_entry_form').submit();
	});

	$("#policy-save").on("click", function(event) {
		event.preventDefault();
		$('#policy_entry_form').submit();
	});
			
	$("#policy-erase").on("click", function(event) {
		event.preventDefault();
		var id = $("#policy-edit #id").val();
		var first = $("#policy_first_name").val();
		var last = $("#policy_last_name").val();
		var desc = $("#policy_description").val();
		doPolicyDelete(id,first,last,desc);
	});
			
	$('#policy_entry_form').submit(function(event) {
			// set current path for listing of policies
			var path = "/"+$("#policy-edit #edit_path").val();

			if ($("#policy-edit #id").val() == 0) {
                $.ajax({
					type: 'POST',
					url: '/app/policies/addrec',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$("#policy-content").load(path);
							// show success message...
							closeWindow();
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
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$("#policy-content").load(path);
							// show success message...
							closeWindow();
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

	$("#policy-renew").on("click", function(event) {
		event.preventDefault();
		$('#policy_renewal_form').submit();
		closeWindow();
	});
	
	$("#policy-renew-save").on("click", function(event) {
		event.preventDefault();
		$('#policy_renew_premium_form').submit();
	});
	
	$("#policy-cancel").on("click", function(event) {
		event.preventDefault();
		var id = $("#policy-renewal #renid").val();
		var info = $("#policy-renewal #renew_cancel_info").val();
		fields = info.split("','");
		var first = fields[0];
		var last = fields[1];
		var desc = fields[2];
		closeWindow();
		doPolicyCancel(id,first,last,desc);
	});
	
	$("#policy-renew-cancel-save").on("click", function(event) {
		event.preventDefault();
		$('#policy_renew_cancel_form').submit();
	});

	$("#policy-uncancel").on("click", function(event) {
		event.preventDefault();
		$("#canceleddate").val('');
		$('#policy_reinstate_form').submit();
		closeWindow();
	});
			
	$('#policy_delete_form').submit(function(event) {
			// set current path for listing of policies
			var path = "/"+$("#policy-delete #delete_path").val();
			
                $.ajax({
					type: 'POST',
					url: '/app/policies/deleterec',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
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
		event.preventDefault();
	});

	$('#policy_renewal_form').submit(function(event) {
                $.ajax({
					type: 'POST',
					url: '/app/policies/renewrec',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							// show edit window...
							$.each(data, function(key, value) {
								//openWindow(currcat,'edit','Edit',value.id,value.notes,value.first,value.last,value.description,value.premium,value.zip_code,value.category_id,value.business_type_id,value.user_id,value.source_type_id,value.length_type_id,value.date_written,'','','','dorenew');
								openWindow(currcat,'renew','Renew',value.id,'',value.first,value.last,value.description,value.premium);
							});
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
		event.preventDefault();
	});
	
	$('#policy_renew_premium_form').submit(function(event) {
			// set current path for listing of policies
			var path = "/"+$("#policy-do-renew #renew_path").val();
			
                 $.ajax({
					type: 'POST',
					url: '/app/policies/renewsave',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$("#policy-content").load(path);
							// show success message...
							closeWindow();
							openModal('info',data.msg);
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
		event.preventDefault();
	});
	
	$('#policy_renew_cancel_form').submit(function(event) {
			// set current path for listing of policies
			var path = "/"+$("#policy-renew-cancel #renew_cancel_path").val();
			
                 $.ajax({
					type: 'POST',
					url: '/app/policies/renewcancelsave',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$("#policy-content").load(path);
							// show success message...
							closeWindow();
							openModal('info',data.msg);
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
		event.preventDefault();
	});

	$('#policy_reinstate_form').submit(function(event) {
			// set current path for listing of policies
			var path = "/"+$("#policy-reinstate #reinstate_path").val();
			
                $.ajax({
					type: 'POST',
					url: '/app/policies/uncancelrec',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							// reload current list
							$("#policy-content").load(path);
							// show edit window...
							$.each(data, function(key, value) {
								openWindow(currcat,'edit','Edit',value.id,value.notes,value.first,value.last,value.description,value.premium,value.zip_code,value.category_id,value.business_type_id,value.user_id,value.source_type_id,value.length_type_id,value.date_written,value.date_issued,value.date_effective,value.date_canceled,value.renewal);
							});
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
		event.preventDefault();
	});
	
	$('#status_pending').change(function() {
	   if($(this).is(":checked")) {
	   		// turn off canceled date
	   		$("#canceleddate").prop("disabled", true);
	   		$("#canceleddate").css("opacity","0.5");
	   		$("#issueddate").val('');
	   }
	});
	$('#status_issued').change(function() {
	   if($(this).is(":checked")) {
	   		// turn off canceled date
	   		$("#canceleddate").prop("disabled", true);
	   		$("#canceleddate").css("opacity","0.5");
	   		$("#issueddate").val(currentdate());
	   }
	});
	$('#status_declined').change(function() {
	   if($(this).is(":checked")) {
	   		// turn off canceled date
	   		$("#canceleddate").prop("disabled", true);
	   		$("#canceleddate").css("opacity","0.5");
	   		$("#issueddate").val('');
	   }
	});
	$('#status_canceled').change(function() {
	   if($(this).is(":checked")) {
		  	//'checked' event code
		  	$("#canceleddate").prop("disabled", false);
	      	$("#canceleddate").removeAttr("style");
	   		$("#issueddate").val('');
	   }
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
		// SET CATEGORY
		currcat = 'listall';
		// LOAD LISTING
		loadListing(currcat);
	});

	// AUTO
	$("#auto").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
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
		// SET CATEGORY
		currcat = 'listauto';
		// LOAD LISTING
		loadListing(currcat);
	});

	// FIRE
	$("#fire").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
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
		// SET CATEGORY
		currcat = 'listfire';
		// LOAD LISTING
		loadListing(currcat);
	});

	// LIFE
	$("#life").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
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
		// SET CATEGORY
		currcat = 'listlife';
		// LOAD LISTING
		loadListing(currcat);
	});

	// HEALTH
	$("#health").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
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
		// SET CATEGORY
		currcat = 'listhealth';
		// LOAD LISTING
		loadListing(currcat);
	});

	// DEPOSIT
	$("#deposit").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
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
		// SET CATEGORY
		currcat = 'listdeposit';
		// LOAD LISTING
		loadListing(currcat);
	});

	// LOAN
	$("#loan").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
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
		// SET CATEGORY
		currcat = 'listloan';
		// LOAD LISTING
		loadListing(currcat);
	});

	// FUND
	$("#fund").closest(".sub-button").on("click", function(event) {
		event.preventDefault();
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
		// SET CATEGORY
		currcat = 'listfund';
		// LOAD LISTING
		loadListing(currcat);
	});

// =============== END SUB NAV =============== //

// =============== BEGIN STATUS NAV =============== //

	// VIEW ALL WRITTEN ONLY
	$("#allwritten").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		var path = "/app/policies/"+currcat+"/allwritten/"+dateRange+"/"+phrase;
		//alert(path);
		$("#policy-content").load(path);
	});

	// VIEW NOT ISSUED ONLY
	$("#notissued").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		var path = "/app/policies/"+currcat+"/notissued/"+dateRange+"/"+phrase;
		//alert(path);
		$("#policy-content").load(path);
	});

	// VIEW ALL PENDING RENEWAL ONLY
	$("#pendingrenewal").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		var path = "/app/policies/"+currcat+"/pendingrenewal/"+dateRange+"/"+phrase;
		//alert(path);
		$("#policy-content").load(path);
	});

	// VIEW ALL CANCELED ONLY
	$("#allcanceled").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		var path = "/app/policies/"+currcat+"/allcanceled/"+dateRange+"/"+phrase;
		//alert(path);
		$("#policy-content").load(path);
	});

// =============== END STATUS NAV =============== //

// =============== BEGIN SORT NAV =============== //

	var order = 'asc';

	// SORTING
	$("#sortfirst").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    		$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/firstnamedesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    		$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/firstname/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortlast").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    		$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/lastnamedesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    		$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/lastname/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortdesc").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/descriptiondesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/description/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortcat").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/categorydesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/category/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortprem").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/premiumdesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/premium/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sorttype").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/typedesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/type/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortsold").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/soldbydesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/soldby/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortsrc").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/sourcedesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/source/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortlen").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/lengthdesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/length/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortwdate").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/writtendesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/written/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortidate").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/issueddesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/issued/"+dateRange+"/"+phrase);
			order = "desc";
		}
	});
	$("#sortedate").on("click", function(event) {
		event.preventDefault();
		resetSortLinks(0);
		var sdate = $("#datepick1").val().replace(/\//g, "-");
		var edate = $("#datepick2").val().replace(/\//g, "-");
		if (sdate != '' && edate != '') {
			dateRange = sdate+"."+edate+".a";
		} else {
			dateRange = 'any';
		}
		if ($("#field").val() != '') {
			var phrase = $("#field").val()+".a";
		} else {
			phrase = '';
		}
		$(this).removeClass();
		if (order == "desc") {
    			$(this).addClass('sort-link-desc');
			$("#policy-content").load("/app/policies/"+currcat+"/effectivedesc/"+dateRange+"/"+phrase);
			order = "asc";
		} else {
    			$(this).addClass('sort-link-asc');
			$("#policy-content").load("/app/policies/"+currcat+"/effective/"+dateRange+"/"+phrase);
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
			if ($("#written").prop('checked') === false && $("#issued").prop('checked') === false && $("#effective").prop('checked') === false && $("#canceled").prop('checked') === false) {
				datetype = ".none";
			}
			var dateRange = sdate+"."+edate+datetype;
			if (datetype == 'any') {
				var path = "/app/policies/"+currcat+"/default/any/";
			} else {
				var path = "/app/policies/"+currcat+"/default/"+dateRange+"/";
			}
		}
		// do keyword searches
		var type = '.none';
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
			//if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
			//	type = ".p";
			//}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".n";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
				type = ".fl";
			}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".fd";
			}
			//if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
			//	type = ".fp";
			//}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".fn";
			}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".ld";
			}
			//if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
			//	type = ".lp";
			//}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".ln";
			}
			//if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
			//	type = ".dp";
			//}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".dn";
			}
			//if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
			//	type = ".pn";
			//}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
				type = ".fld";
			}
			//if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === false) {
			//	type = ".flp";
			//}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
				type = ".fln";
			}
			//if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
			//	type = ".fdp";
			//}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".fdn";
			}
			//if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
			//	type = ".fpn";
			//}
			//if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
			//	type = ".ldp";
			//}
			//if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === false && $("#notes").prop('checked') === true) {
			//	type = ".lpn";
			//}
			//if ($("#first").prop('checked') === false && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
			//	type = ".dpn";
			//}
			if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".dln";
			}
			//if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === false) {
			//	type = ".fldp";
			//}
			if ($("#first").prop('checked') === true && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
				type = ".fldn";
			}
			//if ($("#first").prop('checked') === false && $("#last").prop('checked') === true && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
			//	type = ".ldpn";
			//}
			//if ($("#first").prop('checked') === true && $("#last").prop('checked') === false && $("#description").prop('checked') === true && $("#notes").prop('checked') === true) {
			//	type = ".fdpn";
			//}
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

/*
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
		
	});

*/

	// load search date pickers
	$("#datepick1").datepicker();
	$("#datepick2").datepicker();
	
	$("#datepick1").datepicker("option", {
  		onClose: function(dateText, inst){
  			if ($("#datepick1").val() != '' && $("#datepick2").val() != '') {
  				$(".date-pickers").html("Date Range:");
    			$("#search_text_form").submit();
    		}
  		}
	});
	
	$("#datepick2").datepicker("option", {
  		onClose: function(dateText, inst){
  			if ($("#datepick1").val() != '' && $("#datepick2").val() != '') {
  				$(".date-pickers").html("Date Range:");
    			$("#search_text_form").submit();
    		}
  		}
	});

	// load edit window date pickers
	$("#writtendate").datepicker();
	//$("#issueddate").datepicker();
	$("#effectivedate").datepicker();
	$("#canceleddate").datepicker();
	$("#premiumdate").datepicker();
	$("#renew_canceleddate").datepicker();

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