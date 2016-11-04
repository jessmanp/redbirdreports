<?php

/**
 * Class App
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class App extends Controller
{

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }
    
/* /////////////////////////////// BEGIN VIEWS /////////////////////////////// */

	public function dashboard($sub = 'index')
    {
		// load main model
		$main_model = $this->loadModel('MainModel');
		$header_data = $main_model->getHeaderInfo($_SESSION['user_id']);

		// load CSS based on method
		$css = 'app_style.css';
		// load jQuery script based on method
		$sectionScript = 'dashboard.js';
        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/main_header.php';
        require 'application/views/dashboard/'.$sub.'.php';
        require 'application/views/_templates/footer.php';
    }

	public function policies($sub = 'index', $param = 'default', $date = '', $phrase = '')
    {
		// load main model
		$main_model = $this->loadModel('MainModel');
		$header_data = $main_model->getHeaderInfo($_SESSION['user_id']);
		$agency_id = $main_model->getAgencyID($_SESSION['user_id']);

		// load CSS based on method
		$css = 'app_style.css';
		// load scripts based on method
		$dateScript = 'datepicker.js';
		$sectionScript = 'policy.js';

		// load listing model
		$policy_listing_model = $this->loadModel('PolicyListingModel');

	// do add
	if ($sub == 'addrec') {
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			if (@$_POST['policy_premium'] == null) {
				$prem = 0;
			} else {
				$prem = number_format(trim(@$_POST['policy_premium']), 2, '.', '');
			}

			$first = trim(@$_POST['policy_first_name']);
			$last = trim(@$_POST['policy_last_name']);
			$desc = trim(@$_POST['policy_description']);
			$notes = trim(@$_POST['policy_notes']);	
			$pnum = trim(@$_POST['policy_number']);
			$catr = (int) trim(@$_POST['policy_sub_category']);
			$busi = (int) trim(@$_POST['policy_business_type']);
			$sold = (int) trim(@$_POST['policy_team_member']);
			$srct = (int) trim(@$_POST['policy_source_type']);
			$lent = (int) trim(@$_POST['policy_length_type']);
			$zip = trim(@$_POST['policy_zip']);
			$wdate = date('Y-m-d H:i:s', strtotime(trim(@$_POST['writtendate'])));
			if (trim(@$_POST['effectivedate']) != '') {
				$edate = date('Y-m-d H:i:s', strtotime(trim(@$_POST['effectivedate'])));
			} else {
				$edate = '';
			}			

			if (isset($first) && $first != '' && isset($last) && $last != '' && isset($desc) && isset($prem) && $prem != '' && isset($notes) && isset($pnum) && isset($catr) && $catr != 0 && isset($busi) && $busi != 0 && isset($sold) && $sold != 0 && isset($srct) && $srct != 0 && isset($lent) && $lent != 0 && isset($zip) && isset($wdate) && isset($edate)) {

				// load entry model
				$policy_entry_model = $this->loadModel('PolicyEntryModel');
				$policy_added = $policy_entry_model->addPolicy($agency_id,$first,$last,$desc,$prem,$notes,$pnum,$catr,$busi,$sold,$srct,$lent,$zip,$wdate,$edate);
				if ($policy_added) {
					$return['msg'] = '<strong>Success</strong>, Policy Added.';
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Insert Failed.</strong> Policy Was Not Added.';
				}
			} else {
				$return['error'] = true;
				$return['msg'] .= '<strong>Add Policy Failed.</strong> One or More of the Required Fields Was Missing:<br /><br />';
				if ($first == '') {
					$return['msg'] .= '<strong>First Name</strong> Field is Required.<br /><br />';
				}
				if ($last == '') {
					$return['msg'] .= '<strong>Last Name</strong> Field is Required.<br /><br />';
				}
				if ($prem == 0) {
					$return['msg'] .= '<strong>Premium</strong> Field is Required.<br /><br />';
				}
				if ($catr == 0) {
					$return['msg'] .= '<strong>Category</strong> Field is Required.<br /><br />';
				}
				if ($busi == 0) {
					$return['msg'] .= '<strong>Business Type</strong> Field is Required.<br /><br />';
				}
				if ($sold == 0) {
					$return['msg'] .= '<strong>Sold By</strong> Field is Required.<br /><br />';
				}
				if ($srct == 0) {
					$return['msg'] .= '<strong>Lead Source</strong> Field is Required.<br /><br />';
				}
				if ($lent == 0) {
					$return['msg'] .= '<strong>Policy Length</strong> Field is Required.<br /><br />';
				}
				if ($wdate == '') {
					$return['msg'] .= '<strong>Written Date</strong> Field is Required.<br /><br />';
				}
			}
 
			//Return json encoded results
			echo json_encode($return);

	// do edit
	} else if ($sub == 'editrec') {

			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			if (@$_POST['policy_premium'] == null) {
				$prem = 0;
			} else {
				$prem = number_format(trim(@$_POST['policy_premium']), 2, '.', '');
			}

			$premorg = @$_POST['policy_premium_org'];
			
			$id = (int) trim(@$_POST['id']);
			$first = trim(@$_POST['policy_first_name']);
			$last = trim(@$_POST['policy_last_name']);
			$desc = trim(@$_POST['policy_description']);
			$notes = trim(@$_POST['policy_notes']);	
			$pnum = trim(@$_POST['policy_number']);
			$catr = (int) trim(@$_POST['policy_sub_category']);
			$busi = (int) trim(@$_POST['policy_business_type']);
			$sold = (int) trim(@$_POST['policy_team_member']);
			$srct = (int) trim(@$_POST['policy_source_type']);
			$lent = (int) trim(@$_POST['policy_length_type']);
			$zip = trim(@$_POST['policy_zip']);
			$stat = (int) @$_POST['policy_status'];
			$wdate = date('Y-m-d H:i:s', strtotime(trim(@$_POST['writtendate'])));
			if (trim(@$_POST['issueddate']) != '') {
				$idate = date('Y-m-d H:i:s', strtotime(trim(@$_POST['issueddate'])));
			} else {
				$idate = '';
			}
			if (trim(@$_POST['effectivedate']) != '') {
				$edate = date('Y-m-d H:i:s', strtotime(trim(@$_POST['effectivedate'])));
			} else {
				$edate = '';
			}
			if (trim(@$_POST['canceleddate'])!= '') {
				$cdate = date('Y-m-d H:i:s', strtotime(trim(@$_POST['canceleddate'])));
			} else {
				$cdate = '';
			}
			if (trim(@$_POST['premiumdate']) != '') {
				$newpremdate = date('Y-m-d H:i:s', strtotime(trim(@$_POST['premiumdate'])));
			} else {
				$newpremdate = '';
			}
			
			if ($edate == '' && $stat == 2) {
				$return['error'] = true;
				$return['msg'] .= '<strong>Edit Policy Failed.</strong> One or More of the Required Fields Was Missing.<br /><br />';
				$return['msg'] .= '<strong>Effective Date</strong> Field is Required.<br /><br />';
			} else if ($cdate == '' && $stat == 4) {
				$return['error'] = true;
				$return['msg'] .= '<strong>Edit Policy Failed.</strong> One or More of the Required Fields Was Missing.<br /><br />';
				$return['msg'] .= '<strong>Canceled Date</strong> Field is Required.<br /><br />';
			} else if ($prem != $premorg && $newpremdate == '') {
				$return['error'] = true;
				$return['msg'] .= '<strong>Edit Policy Failed.</strong> One or More of the Required Fields Was Missing.<br /><br />';
				$return['msg'] .= '<strong>New Premium Date</strong> Field is Required.<br /><br />';
			} else {

				if (isset($id) && $id != 0 && isset($first) && $first != '' && isset($last) && $last != '' && isset($desc) && isset($prem) && $prem != '' && isset($notes) && isset($catr) && $catr != 0 && isset($busi) && $busi != 0 && isset($sold) && $sold != 0 && isset($srct) && $srct != 0 && isset($lent) && $lent != 0 && isset($zip) && isset($wdate) && isset($idate) && isset($edate) && isset($cdate) && isset($stat)) {
					// load entry model
					$policy_entry_model = $this->loadModel('PolicyEntryModel');
					$policy_updated = $policy_entry_model->updatePolicy($id,$stat,$first,$last,$desc,$prem,$notes,$pnum,$catr,$busi,$sold,$srct,$lent,$zip,$wdate,$idate,$edate,$cdate);
					if ($prem != $premorg && $newpremdate != '') {
						// insert premium history
						$policy_entry_model->updatePremiumHistory($id,$premorg,$newpremdate);
					}
					if ($policy_updated) {
						$return['msg'] = '<strong>Success</strong>, Policy Updated.';
					} else {
						$return['error'] = true;
						$return['msg'] .= '<strong>Update Failed.</strong> Policy Was Not Updated.';
					}
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Edit Policy Failed.</strong> One or More of the Required Fields Was Missing.<br /><br />';
					if ($first == '') {
						$return['msg'] .= '<strong>First Name</strong> Field is Required.<br /><br />';
					}
					if ($last == '') {
						$return['msg'] .= '<strong>Last Name</strong> Field is Required.<br /><br />';
					}
					if ($prem == 0) {
						$return['msg'] .= '<strong>Premium</strong> Field is Required.<br /><br />';
					}
					if ($catr == 0) {
						$return['msg'] .= '<strong>Category</strong> Field is Required.<br /><br />';
					}
					if ($busi == 0) {
						$return['msg'] .= '<strong>Business Type</strong> Field is Required.<br /><br />';
					}
					if ($sold == 0) {
						$return['msg'] .= '<strong>Sold By</strong> Field is Required.<br /><br />';
					}
					if ($srct == 0) {
						$return['msg'] .= '<strong>Lead Source</strong> Field is Required.<br /><br />';
					}
					if ($lent == 0) {
						$return['msg'] .= '<strong>Policy Length</strong> Field is Required.<br /><br />';
					}
					if ($wdate == '') {
						$return['msg'] .= '<strong>Written Date</strong> Field is Required.<br /><br />';
					}
				}
			
			}
 
			//Return json encoded results
			echo json_encode($return);

	// do delete
	} else if ($sub == 'deleterec') {
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			$delID = @$_POST['delid'];
			if (isset($delID) && is_numeric($delID)) {
				// load entry model
				$policy_entry_model = $this->loadModel('PolicyEntryModel');
				$policy_deleted = $policy_entry_model->deletePolicy($delID);
				if ($policy_deleted) {
					$return['msg'] = '<strong>Success</strong>, Policy Erased.';
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Erase Failed.</strong> Policy Was Not Erased.';
				}
			} else {
				$return['error'] = true;
				$return['msg'] .= '<strong>Erase Failed.</strong> Policy ID is empty.';
			}
 
			//Return json encoded results
			echo json_encode($return);

	// do renewal
	} else if ($sub == 'renewrec') {
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			$rnewID = @$_POST['renid'];
			if (isset($rnewID) && is_numeric($rnewID)) {
				// load entry model
				$policy_entry_model = $this->loadModel('PolicyEntryModel');
				$policy_renewed = $policy_entry_model->renewPolicy($rnewID,$agency_id);
				if ($policy_renewed) {
					$return = $policy_renewed;
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Renewal Failed.</strong> Policy Was Not Renewed.';
				}
			} else {
				$return['error'] = true;
				$return['msg'] .= '<strong>Renewal Failed.</strong> Policy ID is empty.';
			}
 
			//Return json encoded results
			echo json_encode($return);

	// do save renewal
	} else if ($sub == 'renewsave') {
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			$rnewpID = @$_POST['renpid'];
			$rnewPrem = @$_POST['renew_premium'];
			if (isset($rnewpID) && is_numeric($rnewpID) && isset($rnewPrem) && is_numeric($rnewPrem)) {
				// load entry model
				$policy_entry_model = $this->loadModel('PolicyEntryModel');
				$policy_renewsaved = $policy_entry_model->renewSavePolicy($rnewpID,$rnewPrem);
				if ($policy_renewsaved) {
					$return['msg'] = '<strong>Success</strong>, Policy Renewal Updated.';
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Renewal Save Failed.</strong> Policy Was Not Updated.';
				}
			} else {
				$return['error'] = true;
				$return['msg'] .= '<strong>Renew Save Failed.</strong> One or More of the Required Fields Was Missing:<br /><br />';
				if ($rnewPrem == '') {
					$return['msg'] .= '<strong>Premium</strong> Field is Required.<br /><br />';
				}
				$return['error'] = true;
			}
 
			//Return json encoded results
			echo json_encode($return);

	// do renew cancel update
	} else if ($sub == 'renewcancelsave') {
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			$rnewcID = @$_POST['rencid'];
			$rnewCancel = @$_POST['renew_canceleddate'];

			if (isset($rnewcID) && is_numeric($rnewcID) && isset($rnewCancel) && $rnewCancel != '') {
				// convert date to SQL format
				$rnewCancel = date('Y-m-d h:m:s',strtotime($rnewCancel));
				// load entry model
				$policy_entry_model = $this->loadModel('PolicyEntryModel');
				$policy_renewcanceled = $policy_entry_model->renewCancelPolicy($rnewcID,$rnewCancel);
				if ($policy_renewcanceled) {
					$return['msg'] = '<strong>Success</strong>, Policy Canceled.';
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Renewal Cancel Failed.</strong> Policy Was Not Updated.';
				}
			} else {
				$return['error'] = true;
				$return['msg'] .= '<strong>Renew Cancel Failed.</strong> One or More of the Required Fields Was Missing:<br /><br />';
				if ($rnewCancel == '') {
					$return['msg'] .= '<strong>Canceled Date</strong> Field is Required.<br /><br />';
				}
				$return['error'] = true;
			}
 
			//Return json encoded results
			echo json_encode($return);

	// do uncancel
	} else if ($sub == 'uncancelrec') {
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			$cnewID = @$_POST['uncid'];
			if (isset($cnewID) && is_numeric($cnewID)) {
				// load entry model
				$policy_entry_model = $this->loadModel('PolicyEntryModel');
				$policy_reinstated = $policy_entry_model->reinstatePolicy($cnewID);
				if ($policy_reinstated) {
					$return = $policy_reinstated;
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Reinstatement Failed.</strong> Policy Was Not Reinstated.';
				}
			} else {
				$return['error'] = true;
				$return['msg'] .= '<strong>Reinstatement Failed.</strong> Policy ID is empty.';
			}
 
			//Return json encoded results
			echo json_encode($return);

	} else {

		if ($sub == 'listall' || $sub == 'index') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('all','default','written',$date,$phrase,$agency_id);
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('all','default','notissued',$date,$phrase,$agency_id);
			} else if ($param == 'allcanceled') {
				$policy_data = $policy_listing_model->getAllPolicies('all','default','canceled',$date,$phrase,$agency_id);
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('all','default','renewal',$date,$phrase,$agency_id);
			} else {
				if ($sub == 'index') {
					$date = $main_model->getDate('this_month').".a"; // current month default
				}
				$policy_data = $policy_listing_model->getAllPolicies('all',$param,'',$date,$phrase,$agency_id);
			}
		} else if ($sub == 'listauto') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('auto','default','written',$date,$phrase,$agency_id);
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('auto','default','notissued',$date,$phrase,$agency_id);
			} else if ($param == 'allcanceled') {
				$policy_data = $policy_listing_model->getAllPolicies('auto','default','canceled',$date,$phrase,$agency_id);
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('auto','default','renewal',$date,$phrase,$agency_id);
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('auto',$param,'',$date,$phrase,$agency_id);
			}
		} else if ($sub == 'listfire') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('fire','default','written',$date,$phrase,$agency_id);
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('fire','default','notissued',$date,$phrase,$agency_id);
			} else if ($param == 'allcanceled') {
				$policy_data = $policy_listing_model->getAllPolicies('fire','default','canceled',$date,$phrase,$agency_id);
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('fire','default','renewal',$date,$phrase,$agency_id);
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('fire',$param,'',$date,$phrase,$agency_id);
			}
		} else if ($sub == 'listlife') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('life','default','written',$date,$phrase,$agency_id);
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('life','default','notissued',$date,$phrase,$agency_id);
			} else if ($param == 'allcanceled') {
				$policy_data = $policy_listing_model->getAllPolicies('life','default','canceled',$date,$phrase,$agency_id);
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('life','default','renewal',$date,$phrase,$agency_id);
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('life',$param,'',$date,$phrase,$agency_id);
			}
		} else if ($sub == 'listhealth') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('health','default','written',$date,$phrase,$agency_id);
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('health','default','notissued',$date,$phrase,$agency_id);
			} else if ($param == 'allcanceled') {
				$policy_data = $policy_listing_model->getAllPolicies('health','default','canceled',$date,$phrase,$agency_id);
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('health','default','renewal',$date,$phrase,$agency_id);
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('health',$param,'',$date,$phrase,$agency_id);
			}
		} else if ($sub == 'listdeposit') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('deposit','default','written',$date,$phrase,$agency_id);
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('deposit','default','notissued',$date,$phrase,$agency_id);
			} else if ($param == 'allcanceled') {
				$policy_data = $policy_listing_model->getAllPolicies('deposit','default','canceled',$date,$phrase,$agency_id);
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('deposit','default','renewal',$date,$phrase,$agency_id);
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('deposit',$param,'',$date,$phrase,$agency_id);
			}
		} else if ($sub == 'listloan') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('loan','default','written',$date,$phrase,$agency_id);
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('loan','default','notissued',$date,$phrase,$agency_id);
			} else if ($param == 'allcanceled') {
				$policy_data = $policy_listing_model->getAllPolicies('loan','default','canceled',$date,$phrase,$agency_id);
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('loan','default','renewal',$date,$phrase,$agency_id);
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('loan',$param,'',$date,$phrase,$agency_id);
			}
		} else if ($sub == 'listfund') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('fund','default','written',$date,$phrase,$agency_id);
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('fund','default','notissued',$date,$phrase,$agency_id);
			} else if ($param == 'allcanceled') {
				$policy_data = $policy_listing_model->getAllPolicies('fund','default','canceled',$date,$phrase,$agency_id);
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('fund','default','renewal',$date,$phrase,$agency_id);
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('fund',$param,'',$date,$phrase,$agency_id);
			}
		}

		// load date model and set dates
		$today = $main_model->getDate('today');
		$this_week = $main_model->getDate('this_week');
		$last_week = $main_model->getDate('last_week');
		$this_month = $main_model->getDate('this_month');
		$last_month = $main_model->getDate('last_month');
		$this_quarter = $main_model->getDate('this_quarter');
		$first_quarter = $main_model->getDate('first_quarter');
		$second_quarter = $main_model->getDate('second_quarter');
		$third_quarter = $main_model->getDate('third_quarter');
		$fourth_quarter = $main_model->getDate('fourth_quarter');
		$last_six_months = $main_model->getDate('last_six_months');
		$this_year = $main_model->getDate('this_year');
		$last_two_years = $main_model->getDate('last_two_years');

		// load entry (add/edit) models
		$policy_entry_model = $this->loadModel('PolicyEntryModel');
		$agency_employees = $policy_entry_model->getAllEmployees($agency_id);
		$policy_categories_main = $policy_entry_model->getAllCategories('main');
		$policy_categories_all = $policy_entry_model->getAllCategories('all');
		$policy_categories_auto = $policy_entry_model->getAllCategories('auto');
		$policy_categories_fire = $policy_entry_model->getAllCategories('fire');
		$policy_categories_life = $policy_entry_model->getAllCategories('life');
		$policy_categories_health = $policy_entry_model->getAllCategories('health');
		$policy_categories_deposit = $policy_entry_model->getAllCategories('deposit');
		$policy_categories_loan = $policy_entry_model->getAllCategories('loan');
		$policy_categories_fund = $policy_entry_model->getAllCategories('fund');
		$policy_business_types = $policy_entry_model->getAllBusinessTypes();
		$policy_source_types = $policy_entry_model->getAllSourceTypes();
		$policy_length_types = $policy_entry_model->getAllLengthTypes();

		if ($sub == 'index') {
        		// load views.
        		require 'application/views/_templates/header.php';
        		require 'application/views/_templates/main_header.php';
				require 'application/views/policies/modal_window.php';
        		require 'application/views/policies/header.php';
        		require 'application/views/policies/index.php';
        		require 'application/views/_templates/footer.php';
		} else {
			// load table view to be refreshed by ajax
        		require 'application/views/policies/listing.php';
		}

	} //end if add/edit/delete

    }

	public function commissions($sub = 'index')
    {
		// load models
		$main_model = $this->loadModel('MainModel');
		$header_data = $main_model->getHeaderInfo($_SESSION['user_id']);
		$myagency_model = $this->loadModel('MyAgencyModel');
		$setup_model = $this->loadModel('SetupModel');
		$commissions_model = $this->loadModel('CommissionsModel');
		
		// check if logged in and set agency ID
		if (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
			// get and set agency ID based on the owner
				$agency_id = $setup_model->getAgencyID($_SESSION['user_id']);
		}

		// get commission freq
		$cfreq = $myagency_model->getAgencySettings($agency_id);
		$frequency = $cfreq[0]->period_frequency;
		
		// get period info
		$open = 1;
		
		if ($sub == 'getEmployeeList') {

			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;
		
			// get agency id based on owner
			$agency_id = $setup_model->getAgencyID($_SESSION['user_id']);

			// get list of employees
			$employees = $commissions_model->getAllEmployees($agency_id);

			if (empty($employees)) {
				$return['error'] = true;
				$return['msg'] .= 'ERROR. No employee(s) found.';
			} else {
				$return = $employees;
			}

			//Return json encoded results
			echo json_encode($return);
			exit();

		}
		
		if ($sub == 'getEmployeeCommissionHistory') {
			// get employee commissions
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			// *POPULATE EMPLOYEE COMPENSATION DATA*
			$employee_id = trim(@$_GET['eid']); // must be an existing ID
			$date_range = trim(@$_GET['date']); // must be a custom range (i.e. 1:1-31:2016 would be Jan 1st thru 31st in 2016)
			
			if (!isset($employee_id) || $employee_id == '' || !is_numeric($employee_id)) {
				$return['error'] = true;
				$return['msg'] .= '<strong>ERROR</strong>, Invalid employee or no employee was selected.';
			}
			
			if (isset($date_range) && $date_range != '') {
				$monthsplit = explode(':',$date_range);
				$daysplit = explode('-',$monthsplit[1]);
				$dmonth = $monthsplit[0];
				$ddayfirst = $daysplit[0];
				$ddaylast = $daysplit[1];
				$dyear = $monthsplit[2];
				if (!is_numeric($dmonth) || !is_numeric($ddayfirst) || !is_numeric($ddaylast)) {
					$return['error'] = true;
					$return['msg'] .= '<strong>ERROR</strong>, Invalid date range was selected.';
				} else {
					$dateA = $dyear.'-'.str_pad($dmonth, 2, '0', STR_PAD_LEFT).'-'.str_pad($ddayfirst, 2, '0', STR_PAD_LEFT).'  00:00:00';
					$dateB = $dyear.'-'.str_pad($dmonth, 2, '0', STR_PAD_LEFT).'-'.str_pad($ddaylast, 2, '0', STR_PAD_LEFT).' 23:59:59';
				}				
			}
			
			// get employees data
			$employee_data = $commissions_model->getEmployeeCommissionHistory($agency_id,$employee_id,$dateA,$dateB,$date_range);

			if (empty($employee_data)) {
				$return['error'] = true;
				$return['msg'] .= '<strong>ERROR</strong>, No employee data found.';
			} else {
				$return = $employee_data;
			}

			//Return json encoded results
			echo json_encode($return);			
			exit();

		}
		
		if ($sub == 'putSpecialBonus') {
			// put commission special bonus
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;
			
			// *UPDATE EMPLOYEE COMPENSATION DATA*
			$employee_id = trim(@$_POST['bonus_employee_id']); // must be an existing ID
			$period = trim(@$_POST['bonus_period']); // must be a custom date range
			$bonus = trim(@$_POST['commissions_bonus']); // must be numeric
			$bonus_desc = trim(@$_POST['com_bonus_description']); // must be a string
			
			// remove all non-numeric except period
			$bonus = preg_replace('/[^0-9.]+/ui', '', $bonus);
			
			// validate update employee special form to make sure the data was entered correctly

			if (!isset($employee_id) || $employee_id == '' || !is_numeric($employee_id)) {
				$return['error'] = true;
				$return['msg'] .= 'No employee was selected. Please select an employee.';
			}
			if (!isset($bonus) || !is_numeric($bonus)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Bonus Amount</strong> Field is Required.<br />';
			}
			if (!isset($bonus_desc) || !filter_var($bonus_desc, FILTER_SANITIZE_STRING)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Bonus Description</strong> Field is Required.<br />';
			}
			
			// submit success functionality
			if ($return['error'] === false) {
			
				// put data
				$commission_special_bonus = $commissions_model->saveCommissionSpecialBonus($employee_id,$bonus,$bonus_desc,$period);

				if (empty($commission_special_bonus)) {
					$return['error'] = true;
					$return['msg'] .= '<strong>ERROR</strong>, Special Bonus commission was not updated.';
				} else {
					$return['msg'] = '<strong>Success</strong>, Special Bonus commission was updated.';
				}
				
			} else {
			
				$return['msg'] = '<strong>Update Special Failed.</strong> One or More of the Required Fields Was Missing:<br /><br />'.$return['msg'];
			
			}

			//Return json encoded results
			echo json_encode($return);			
			exit();
			
		}
		
		if ($sub == 'putSpecialOther') {
			// put commission special other
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;
			
			// *UPDATE EMPLOYEE COMPENSATION DATA*
			$employee_id = trim(@$_POST['other_employee_id']); // must be an existing ID
			$period = trim(@$_POST['other_period']); // must be a custom date range
			$other = trim(@$_POST['commissions_other']); // must be numeric
			$other_desc = trim(@$_POST['com_other_description']); // must be a string
			
			// remove all non-numeric except period
			$other = preg_replace('/[^0-9.]+/ui', '', $other);
			
			// validate update employee special form to make sure the data was entered correctly

			if (!isset($employee_id) || $employee_id == '' || !is_numeric($employee_id)) {
				$return['error'] = true;
				$return['msg'] .= 'No employee was selected. Please select an employee.';
			}
			if (!isset($other) || !is_numeric($other)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Other Amount</strong> Field is Required.<br />';
			}
			if (!isset($other_desc) || !filter_var($other_desc, FILTER_SANITIZE_STRING)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Other Description</strong> Field is Required.<br />';
			}
			
			// submit success functionality
			if ($return['error'] === false) {
			
				// put data
				$commission_special_other = $commissions_model->saveCommissionSpecialOther($employee_id,$other,$other_desc,$period);

				if (empty($commission_special_other)) {
					$return['error'] = true;
					$return['msg'] .= '<strong>ERROR</strong>, Special Other commission was not updated.';
				} else {
					$return['msg'] = '<strong>Success</strong>, Special Other commission was updated.';
				}
				
			} else {
			
				$return['msg'] = '<strong>Update Special Failed.</strong> One or More of the Required Fields Was Missing:<br /><br />'.$return['msg'];
			
			}

			//Return json encoded results
			echo json_encode($return);			
			exit();
			
		}
		
		if ($sub == 'closePeriod') {
			// put commission data into commission history
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;
			
			// *UPDATE COMMISSISION HISTORY DATA*
			$employee_id = trim(@$_POST['user_id']); // must be an existing ID
			$period = trim(@$_POST['period']); // must be a custom date range
			$lifetime = trim(@$_POST['lifetime']); // must be numeric
			$last_year = trim(@$_POST['last_year']); // must be numeric
			$last_ytd = trim(@$_POST['last_ytd']); // must be numeric
			$current_ytd = trim(@$_POST['current_ytd']); // must be numeric
			$last_month = trim(@$_POST['last_month']); // must be numeric
			$new_policies = trim(@$_POST['new_policies']); // must be numeric
			$renewals = trim(@$_POST['renewals']); // must be numeric
			$charge_backs = trim(@$_POST['charge_backs']); // must be numeric
			$auto_policies_issued = trim(@$_POST['auto_policies_issued']); // must be numeric
			$fire_policies_issued = trim(@$_POST['fire_policies_issued']); // must be numeric
			$life_policies_issued = trim(@$_POST['life_policies_issued']); // must be numeric
			$health_policies_issued = trim(@$_POST['health_policies_issued']); // must be numeric
			$bank_policies_issued = trim(@$_POST['bank_policies_issued']); // must be numeric
			$auto_issued_premiums = trim(@$_POST['auto_issued_premiums']); // must be numeric
			$fire_issued_premiums = trim(@$_POST['fire_issued_premiums']); // must be numeric
			$life_issued_premiums = trim(@$_POST['life_issued_premiums']); // must be numeric
			$health_issued_premiums = trim(@$_POST['health_issued_premiums']); // must be numeric
			$bank_issued_premiums = trim(@$_POST['bank_issued_premiums']); // must be numeric
			$auto_commissions = trim(@$_POST['auto_commissions']); // must be numeric
			$fire_commissions = trim(@$_POST['fire_commissions']); // must be numeric
			$life_commissions = trim(@$_POST['life_commissions']); // must be numeric
			$health_commissions = trim(@$_POST['health_commissions']); // must be numeric
			$bank_commissions = trim(@$_POST['bank_commissions']); // must be numeric
			$auto_policies_renewed = trim(@$_POST['auto_policies_renewed']); // must be numeric
			$fire_policies_renewed = trim(@$_POST['fire_policies_renewed']); // must be numeric
			$auto_renewal_premiums = trim(@$_POST['auto_renewal_premiums']); // must be numeric
			$fire_renewal_premiums = trim(@$_POST['fire_renewal_premiums']); // must be numeric
			$auto_renewal_commissions = trim(@$_POST['auto_renewal_commissions']); // must be numeric
			$fire_renewal_commissions = trim(@$_POST['fire_renewal_commissions']); // must be numeric
			$trailing_chart_totals = @$_POST['trailing_chart_totals']; // must be a list
			$trailing_chart_extra_month = trim(@$_POST['trailing_chart_extra_month']); // must be numeric
			
			// validate close period form to make sure the data was not altered

			if (!isset($employee_id) || $employee_id == '' || !is_numeric($employee_id)) {
				$return['error'] = true;
				$return['msg'] .= 'No employee was selected. Please select an employee.';
			}
			if (!isset($period) || !filter_var($period, FILTER_SANITIZE_STRING)){
				$return['error'] = true;
				$return['msg'] .= '<strong>ERROR</strong>, Period is Invalid or Missing.<br />';
			}
			if (!isset($lifetime) || !is_numeric($lifetime)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Lifetime</strong> Total is Required.<br />';
			}
			if (!isset($last_year) || !is_numeric($last_year)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Last Year</strong> Total is Required.<br />';
			}
			if (!isset($last_ytd) || !is_numeric($last_ytd)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Last YTD</strong> Total is Required.<br />';
			}
			if (!isset($current_ytd) || !is_numeric($current_ytd)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Current YTD</strong> Total is Required.<br />';
			}
			if (!isset($last_month) || !is_numeric($last_month)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Last Month</strong> Total is Required.<br />';
			}
			if (!isset($new_policies) || !is_numeric($new_policies)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Policies</strong> Total is Required.<br />';
			}
			if (!isset($charge_backs) || !is_numeric($charge_backs)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Charge Backs</strong> Total is Required.<br />';
			}
			if (!isset($auto_policies_issued) || !is_numeric($auto_policies_issued)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Auto Policies Issued</strong> Amount is Required.<br />';
			}
			if (!isset($fire_policies_issued) || !is_numeric($fire_policies_issued)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Fire Policies Issued</strong> Amount is Required.<br />';
			}
			if (!isset($life_policies_issued) || !is_numeric($life_policies_issued)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Life Policies Issued</strong> Amount is Required.<br />';
			}
			if (!isset($health_policies_issued) || !is_numeric($health_policies_issued)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Health Policies Issued</strong> Amount is Required.<br />';
			}
			if (!isset($bank_policies_issued) || !is_numeric($bank_policies_issued)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Bank Policies Issued</strong> Amount is Required.<br />';
			}
			if (!isset($auto_policies_issued) || !is_numeric($auto_policies_issued)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Auto Policies Issued</strong> Amount is Required.<br />';
			}
			if (!isset($auto_issued_premiums) || !is_numeric($auto_issued_premiums)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Auto Issued Premiums</strong> Total is Required.<br />';
			}
			if (!isset($fire_issued_premiums) || !is_numeric($fire_issued_premiums)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Fire Issued Premiums</strong> Total is Required.<br />';
			}
			if (!isset($life_issued_premiums) || !is_numeric($life_issued_premiums)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Life Issued Premiums</strong> Total is Required.<br />';
			}
			if (!isset($health_issued_premiums) || !is_numeric($health_issued_premiums)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Health Issued Premiums</strong> Total is Required.<br />';
			}
			if (!isset($bank_issued_premiums) || !is_numeric($bank_issued_premiums)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Bank Issued Premiums</strong> Total is Required.<br />';
			}
			if (!isset($auto_commissions) || !is_numeric($auto_commissions)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Auto Commissions</strong> Total is Required.<br />';
			}
			if (!isset($fire_commissions) || !is_numeric($fire_commissions)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Fire Commissions</strong> Total is Required.<br />';
			}
			if (!isset($life_commissions) || !is_numeric($life_commissions)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Life Commissions</strong> Total is Required.<br />';
			}
			if (!isset($health_commissions) || !is_numeric($health_commissions)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Health Commissions</strong> Total is Required.<br />';
			}
			if (!isset($bank_commissions) || !is_numeric($bank_commissions)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Bank Commissions</strong> Total is Required.<br />';
			}
			if (!isset($auto_policies_renewed) || !is_numeric($auto_policies_renewed)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Auto Policies Renewed</strong> Amount is Required.<br />';
			}
			if (!isset($fire_policies_renewed) || !is_numeric($fire_policies_renewed)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Fire Policies Renewed</strong> Amount is Required.<br />';
			}
			if (!isset($auto_renewal_premiums) || !is_numeric($auto_renewal_premiums)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Auto Renewal Premiums</strong> Total is Required.<br />';
			}
			if (!isset($fire_renewal_premiums) || !is_numeric($fire_renewal_premiums)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Fire Renewal Premiums</strong> Total is Required.<br />';
			}
			if (!isset($auto_renewal_commissions) || !is_numeric($auto_renewal_commissions)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Auto Renewal Commissions</strong> Total is Required.<br />';
			}
			if (!isset($fire_renewal_commissions) || !is_numeric($fire_renewal_commissions)){
				$return['error'] = true;
				$return['msg'] .= '<strong>New Fire Renewal Commissions</strong> Total is Required.<br />';
			}
			if (!isset($trailing_chart_totals) || !is_array($trailing_chart_totals)){
				$return['error'] = true;
				$return['msg'] .= '<strong>ERROR</strong>, Trailing 12 Months is Invalid or Missing.<br />';
			}	
			if (!isset($trailing_chart_extra_month) || !is_numeric($trailing_chart_extra_month)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Trailing Current Month</strong> Total is Required.<br />';
			}
			
			// submit success functionality
			if ($return['error'] === false) {
			
				// put data
				$commission_close_period = $commissions_model->saveClosePeriodData($employee_id,$period,$lifetime,$last_year,$last_ytd,$current_ytd,$last_month,$new_policies,$renewals,$charge_backs,$auto_policies_issued,$fire_policies_issued,$life_policies_issued,$health_policies_issued,$bank_policies_issued,$auto_issued_premiums,$fire_issued_premiums,$life_issued_premiums,$health_issued_premiums,$bank_issued_premiums,$auto_commissions,$fire_commissions,$life_commissions,$health_commissions,$bank_commissions,$auto_policies_renewed,$fire_policies_renewed,$auto_renewal_premiums,$fire_renewal_premiums,$auto_renewal_commissions,$fire_renewal_commissions,$trailing_chart_totals,$trailing_chart_extra_month);

				if (empty($commission_close_period)) {
					$return['error'] = true;
					$return['msg'] .= '<strong>ERROR</strong>, Commission Period was not closed.';
				} else {
					$return['msg'] = '<strong>Success</strong>, Commission Period was closed.';
				}
				
			} else {
			
				$return['msg'] = '<strong>Close Period Failed.</strong> One or More of the Required Fields Was Missing:<br /><br />'.$return['msg'];
			
			}

			//Return json encoded results
			echo json_encode($return);			
			exit();
			
		}
		
		// load CSS based on method
		$css = 'app_style.css';
		// load jQuery script based on method
		$sectionScript = 'commissions.js';

        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/main_header.php';
        require 'application/views/commissions/modal_window.php';
        require 'application/views/commissions/header.php';
        require 'application/views/commissions/'.$sub.'.php';
        require 'application/views/_templates/footer.php';
    }

	public function myagency($sub = 'index', $param = 'default')
    {
		// load main model
		$main_model = $this->loadModel('MainModel');
		$header_data = $main_model->getHeaderInfo($_SESSION['user_id']);
		
		// load models
		$setup_model = $this->loadModel('SetupModel');
		$myagency_model = $this->loadModel('MyAgencyModel');
		
		// check if logged in and set agency ID
		if (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
			// get and set agency ID based on the owner
				$agency_id = $setup_model->getAgencyID($_SESSION['user_id']);
		}
		
		if ($sub == 'getSettings') {
			// get commission frequency
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;
			
			// get data
			$commission_freq = $myagency_model->getAgencySettings($agency_id);

			if (empty($commission_freq)) {
				$return['error'] = true;
				$return['msg'] .= '<strong>ERROR</strong>, No agency settings found.';
			} else {
				$return = $commission_freq;
			}

			//Return json encoded results
			echo json_encode($return);			
			exit();
			
		}
		
		if ($sub == 'saveSettings') {

			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;
			
			$agency_frequency = @$_POST['agency_frequency'];
		
			// get agency id based on owner
			$agency_id = $setup_model->getAgencyID($_SESSION['user_id']);

			if (isset($agency_frequency) && is_numeric($agency_frequency)) {
				// put settings
				$savesettings = $myagency_model->saveAgencySettings($agency_id,$agency_frequency);
			}

			if (empty($savesettings)) {
				$return['error'] = true;
				$return['msg'] .= 'ERROR. Settings Not Saved.';
			} else {
				$return['msg'] = '<strong>Success</strong>, your settings have been updated.';
			}

			//Return json encoded results
			echo json_encode($return);
			exit();

		}
		
		if ($sub == 'getEmployeeList') {

			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;
		
			// get agency id based on owner
			$agency_id = $setup_model->getAgencyID($_SESSION['user_id']);

			// get list of employees
			$employees = $myagency_model->getAllEmployees($agency_id);

			if (empty($employees)) {
				$return['error'] = true;
				$return['msg'] .= 'ERROR. No employee(s) found.';
			} else {
				$return = $employees;
			}

			//Return json encoded results
			echo json_encode($return);
			exit();

		}
		
		if ($sub == 'getEmployeeTransferList') {

			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;
		
			// get agency id based on owner
			$agency_id = $setup_model->getAgencyID($_SESSION['user_id']);

			// get list of employees
			$employees = $myagency_model->getTransferEmployees($agency_id);

			if (empty($employees)) {
				$return['error'] = true;
				$return['msg'] .= 'ERROR. No employee(s) found.';
			} else {
				$return = $employees;
			}

			//Return json encoded results
			echo json_encode($return);
			exit();

		}
		
		if ($sub == 'getEmployeeData') {
			// get employee data
			
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			// *POPULATE EMPLOYEE COMPENSATION DATA*
			$employee_id = trim(@$_GET['eid']); // must be an existing ID

			if (!isset($employee_id) || $employee_id == '' || !is_numeric($employee_id)) {
				$return['error'] = true;
				$return['msg'] .= '<strong>ERROR</strong>, Invalid employee or no employee was selected.';
			}
			
			// get employees data
			$employee_data = $myagency_model->getEmployeeData($employee_id);

			if (empty($employee_data)) {
				$return['error'] = true;
				$return['msg'] .= '<strong>ERROR</strong>, No employee data found.';
			} else {
				$return = $employee_data;
			}

			//Return json encoded results
			echo json_encode($return);			
			exit();

		}
		
		
		if ($sub == 'putEmployeeData') {
			// update employee data
 
			// array values that will be returned via ajax
			$return = array();
			$return['msg'] = '';
			$return['error'] = false;

			// *UPDATE EMPLOYEE COMPENSATION*
			$employee_id = trim(@$_POST['employee_id']); // must be an existing ID
			$employee_first_name = trim(@$_POST['employee_first_name']); // must be a string
			$employee_last_name = trim(@$_POST['employee_last_name']); // must be a string
			$employee_job_title = trim(@$_POST['employee_job_title']); // must be a string
			$employee_email = trim(@$_POST['employee_email']); // must be an email
			$employee_email_verify = trim(@$_POST['employee_email_verify']); // must be an email
			$employee_phone = trim(@$_POST['employee_phone']); // must be a string
			$employee_mobile = trim(@$_POST['employee_mobile']); // must be a string
			$employee_zip_code = trim(@$_POST['employee_zip_code']); // must be a string
			$employee_username = trim(@$_POST['employee_username']); // must be a string
			$employee_type = trim(@$_POST['employee_type']); // must be numeric
			if (trim(@$_POST['employee_hire_date']) != '') {
				$the_hire_date = trim(@$_POST['employee_hire_date']);
				if (strpos($the_hire_date,"/") !== false) {
					$date_parts = explode("/",$the_hire_date);
					if (count($date_parts) == 3 && checkdate($date_parts[0],$date_parts[1],$date_parts[2])) {
						$employee_hire_date = date('Y-m-d H:i:s', strtotime($the_hire_date)); // must be a date
					} else {
						$employee_hire_date = 'bad';
					}
				} else {
					$employee_hire_date = 'bad';
				}
			} else {
				$employee_hire_date = null;
			}
			
			$employee_auto_new = @$_POST['employee_auto_new']; // must be decimal percent
			$employee_auto_added = @$_POST['employee_auto_added']; // must be decimal percent
			$employee_auto_reinstated = @$_POST['employee_auto_reinstated']; // must be decimal percent
			$employee_auto_transferred = @$_POST['employee_auto_transferred']; // must be decimal percent
			$employee_auto_renewal = @$_POST['employee_auto_renewal']; // must be decimal percent
			
			$employee_fire_new = @$_POST['employee_fire_new']; // must be decimal percent
			$employee_fire_added = @$_POST['employee_fire_added']; // must be decimal percent
			$employee_fire_reinstated = @$_POST['employee_fire_reinstated']; // must be decimal percent
			$employee_fire_transferred = @$_POST['employee_fire_transferred']; // must be decimal percent
			$employee_fire_renewal = @$_POST['employee_fire_renewal']; // must be decimal percent
			
			$employee_life_new = @$_POST['employee_life_new']; // must be decimal percent
			//$employee_life_increase = @$_POST['employee_life_increase']; // must be decimal percent
			$employee_life_increase = 0; // REMOVED
			$employee_life_policy = @$_POST['employee_life_policy']; // must be dollar amount
			
			$employee_health_new = @$_POST['employee_health_new']; // must be decimal percent
			$employee_health_policy = @$_POST['employee_health_policy']; // must be dollar amount
			
			$employee_bank_deposit_product = @$_POST['employee_bank_deposit_product']; // must be dollar amount
			$employee_bank_loan_product = @$_POST['employee_bank_loan_product']; // must be dollar amount
			$employee_bank_fund_product = @$_POST['employee_bank_fund_product']; // must be dollar amount

			// validate update employee compensation form to make sure the data was entered correctly

			if (!isset($employee_id) || $employee_id == '' || !is_numeric($employee_id)) {
				$return['error'] = true;
				$return['msg'] .= 'No employee was selected. Please select an employee.';
			}
			if (!isset($employee_first_name) || empty($employee_first_name) || !filter_var($employee_first_name, FILTER_SANITIZE_STRING)){
				$return['error'] = true;
				$return['msg'] .= '<strong>First Name</strong> Field is Required.<br />';
			}
			if (!isset($employee_last_name) || empty($employee_first_name) || !filter_var($employee_first_name, FILTER_SANITIZE_STRING)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Last Name</strong> Field is Required.<br />';
			}
			if (!isset($employee_email) || empty($employee_email) || !filter_var($employee_email, FILTER_VALIDATE_EMAIL)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Invalid Email</strong> Field is Required.<br />';
			}
			if ($employee_email != $employee_email_verify){
				$return['error'] = true;
				$return['msg'] .= '<strong>Email Does Not Match</strong> Field is Required.<br />';
			}
			if (!isset($employee_type) || !is_numeric($employee_type)){
				$return['error'] = true;
				$return['msg'] .= '<strong>User Type</strong> Field is Required.<br /><br />';
			}
			if (!isset($employee_username) || empty($employee_username)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Username</strong> Field is Required.<br />';
			} else {
				if (!filter_var($employee_email, FILTER_VALIDATE_EMAIL) === false) {
					// check if username exists
					$username_taken = $myagency_model->isUsernameTaken($employee_username,$employee_email);
					if ($username_taken) {
						$return['error'] = true;
						$return['msg'] .= '<strong>That Username is Already Taken.</strong> Try again.<br />';
					}
				}
			}
			
			if ($employee_hire_date == 'bad') {
				$return['error'] = true;
				$return['msg'] .= '<strong>Hire Date Invalid.</strong> Try again. (i.e. 1/1/2001)<br />';
			}
			
			if (!isset($employee_auto_new) || !is_numeric($employee_auto_new)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Auto New Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_auto_added) || !is_numeric($employee_auto_added)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Auto Added Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_auto_reinstated) || !is_numeric($employee_auto_reinstated)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Auto Reinstated Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_auto_transferred) || !is_numeric($employee_auto_transferred)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Auto Transferred Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_auto_renewal) || !is_numeric($employee_auto_renewal)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Auto Renewal Commission</strong> Field is Required.<br /><br />';
			}
			
			if (!isset($employee_fire_new) || !is_numeric($employee_fire_new)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Fire New Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_fire_added) || !is_numeric($employee_fire_added)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Fire Added Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_fire_reinstated) || !is_numeric($employee_fire_reinstated)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Fire Reinstated Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_fire_transferred) || !is_numeric($employee_fire_transferred)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Fire Transferred Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_fire_renewal) || !is_numeric($employee_fire_renewal)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Fire Renewal Commission</strong> Field is Required.<br /><br />';
			}
			
			if (!isset($employee_life_new) || !is_numeric($employee_life_new)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Life New Commission</strong> Field is Required.<br />';
			}
			/*
			if (!isset($employee_life_increase) || !is_numeric($employee_life_increase)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Life Increase Commission</strong> Field is Required.<br />';
			}
			*/
			if (!isset($employee_life_policy) || !is_numeric($employee_life_policy)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Life $ / Policy Commission</strong> Field is Required.<br /><br />';
			}
			
			if (!isset($employee_health_new) || !is_numeric($employee_health_new)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Health New Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_health_policy) || !is_numeric($employee_health_policy)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Health $ / Policy Commission</strong> Field is Required.<br /><br />';
			}
			
			if (!isset($employee_bank_deposit_product) || !is_numeric($employee_bank_deposit_product)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Bank Deposit $ / Product Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_bank_loan_product) || !is_numeric($employee_bank_loan_product)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Bank Loan $ / Product Commission</strong> Field is Required.<br />';
			}
			if (!isset($employee_bank_fund_product) || !is_numeric($employee_bank_fund_product)){
				$return['error'] = true;
				$return['msg'] .= '<strong>Bank Fund $ / Product Commission</strong> Field is Required.<br />';
			}

			// submit success functionality
			if ($return['error'] === false) {
			
				// execute update employee compensation functions
				$updated_employee_id = $myagency_model->saveEmployeeData($employee_id, $employee_first_name, $employee_last_name, $employee_username, $employee_job_title, $employee_email, $employee_phone, $employee_mobile, $employee_zip_code, $employee_type, $employee_hire_date, $employee_auto_new, $employee_auto_added, $employee_auto_reinstated, $employee_auto_transferred, $employee_auto_renewal, $employee_fire_new, $employee_fire_added, $employee_fire_reinstated, $employee_fire_transferred, $employee_fire_renewal, $employee_life_new, $employee_life_increase, $employee_life_policy, $employee_health_new, $employee_health_policy, $employee_bank_deposit_product, $employee_bank_loan_product, $employee_bank_fund_product);
				$return['msg'] = '<strong>Success</strong>, the employee&rsquo;s information has been updated.';
				
				if (!isset($updated_employee_id) || empty($updated_employee_id)) {
					$return['error'] = true;
					$return['msg'] = '<strong>ERROR</strong>, Employee information was NOT updated.';
				}
				
			} else {
			
				$return['msg'] = '<strong>Update Employee Failed.</strong> One or More of the Required Fields Was Missing:<br /><br />'.$return['msg'];
			
			}
 
			//Return json encoded results
			echo json_encode($return);
			exit();

		}

		if ($sub == 'deleteEmployee') {
			
				// array values that will be returned via ajax
				$return = array();
				$return['msg'] = '';
				$return['error'] = false;

				$newID = @$_POST['swapid'];
				$delID = @$_POST['delid'];
				
				if (isset($delID) && is_numeric($delID) && isset($newID) && is_numeric($newID)) {
					$employee_deleted = $myagency_model->deleteEmployee($delID,$newID);
					if ($employee_deleted) {
						$return['msg'] = '<strong>Success</strong>, Employee Deactivated.';
					} else {
						$return['error'] = true;
						$return['msg'] .= '<strong>Deactivate Failed.</strong> Employee Was Not Deactivated.';
					}
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Employee Deactivation Failed.</strong> Transfer Employee is Missing.';
				}
 
				//Return json encoded results
				echo json_encode($return);
				exit();

		}
		
		if ($sub == 'undeleteEmployee') {
			
				// array values that will be returned via ajax
				$return = array();
				$return['msg'] = '';
				$return['error'] = false;

				$delID = @$_POST['udelid'];
				if (isset($delID) && is_numeric($delID)) {
					$employee_undeleted = $myagency_model->undeleteEmployee($delID);
					if ($employee_undeleted) {
						$return['msg'] = '<strong>Success</strong>, Employee Reactivated.';
					} else {
						$return['error'] = true;
						$return['msg'] .= '<strong>Reactivate Failed.</strong> Employee Was Not Reactivated.';
					}
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Employee Reactivate Failed.</strong> Employee ID is empty.';
				}
 
				//Return json encoded results
				echo json_encode($return);
				exit();

		}
		
		if ($sub == 'removeEmployee') {
			
				// array values that will be returned via ajax
				$return = array();
				$return['msg'] = '';
				$return['error'] = false;

				$rmID = @$_POST['remove_employee_id'];
				
				if (isset($rmID) && is_numeric($rmID)) {
					$employee_removed = $myagency_model->removeEmployee($rmID);
					if ($employee_removed) {
						$return['msg'] = '<strong>Success</strong>, Employee Removed.';
					} else {
						$return['error'] = true;
						$return['msg'] .= '<strong>Remove Failed.</strong> Employee Was Not Removed.';
					}
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Employee Removal Failed.</strong> Remove Employee is Missing.';
				}
 
				//Return json encoded results
				echo json_encode($return);
				exit();

		}
		
		if ($sub == 'index') {
			// get agency info
			$agency_data = $setup_model->getAgencyInfo($agency_id);
		}

		// load CSS based on method
		$css = 'app_style.css';
		// load scripts based on method
		$dateScript = 'datepicker.js';
		$sectionScript = 'myagency.js';

        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/main_header.php';
        require 'application/views/myagency/header.php';
        if ($sub == 'employees') {
        	require 'application/views/myagency/modal_window.php';
        }
        require 'application/views/myagency/'.$sub.'.php';
        require 'application/views/_templates/footer.php';
    }

	public function support($sub = 'index')
    {
		// load main model
		$main_model = $this->loadModel('MainModel');
		$header_data = $main_model->getHeaderInfo($_SESSION['user_id']);

		// load CSS based on method
		$css = 'app_style.css';
		// load jQuery script based on method
		$sectionScript = 'support.js';

        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/main_header.php';
        require 'application/views/support/'.$sub.'.php';
        require 'application/views/_templates/footer.php';
    }
    
/* /////////////////////////////// END VIEWS /////////////////////////////// */

    /*
     * This method handles the file upload
     */
    public function fileUpload()
    {
    
		// load a models
        $setup_model = $this->loadModel('SetupModel');
        $files_model = $this->loadModel('FilesModel');
        
		// check if logged in and set agency ID
		if (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
			// get and set agency ID based on the owner
	    		$agency_id = $setup_model->getOwnerAgencyID($_SESSION['user_id']);
		}

		// upload file to server
		$output_dir = FILE_UPLOAD_PATH;
		if(isset($_FILES['myfile']))
		{
			$ret = array();
			$files = array();
			
			$error = $_FILES['myfile']['error'];
			// andle both cases of single/multi files
			// in case any browser does not support serializing of multiple files using FormData() 
			if(!is_array($_FILES['myfile']['name'])) {
				// handle single file
				$fileName = $_FILES['myfile']['name'];
				// make sure file is plain text and set extension
				switch($_FILES['myfile']['type']) {
					case 'text/plain': $ext = 'txt'; break;
					default: $ext = null; break;
				}
				if ($ext) {
					// set filename to random
					$fname = md5(rand()).'.'.$ext;
				} else {
					$error = "ERROR: Wrong File Type or Missing File Extension.";
				}
				// copy renamed file to folder and pass back org file name
				move_uploaded_file($_FILES['myfile']['tmp_name'],$output_dir.$fname);
				$ret[] = $fileName;
				$files[] = array('aid'=>$agency_id,'title'=>$fileName,'filename'=>$fname);
			} else {
				// handle multiple files
			  $fileCount = count($_FILES['myfile']['name']);
			  for($i=0; $i < $fileCount; $i++) {
				$fileName = $_FILES['myfile']['name'][$i];
				// make sure file is plain text and set extension
				switch($_FILES['myfile']['type'][$i]) {
					case 'text/plain': $ext = 'txt'; break;
					default: $ext = null; break;
				}
				if ($ext) {
					// set filename to random
					$fname = md5(rand()).'.'.$ext;
				} else {
					$error = "ERROR: Wrong File Type or Missing File Extension.";
				}
				// copy renamed file to folder and pass back org file name
				move_uploaded_file($_FILES['myfile']['tmp_name'][$i],$output_dir.$fname);
				$ret[]= $fileName;
				$files[] = array('aid'=>$agency_id,'title'=>$fileName,'filename'=>$fname);
			  }
	
			}
			
			// insert file(s) into database
			foreach ($files as $file) {
				$files_model->insertFiles($file['aid'],$file['title'],$file['filename']);
			}
			
			echo json_encode($ret);
		 }
		 
		 
		 
	}
	
	
	
	
	
// EOF	

}
