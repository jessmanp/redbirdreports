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

			if (isset($first) && $first != '' && isset($last) && $last != '' && isset($desc) && isset($prem) && $prem != '' && isset($notes) && isset($catr) && $catr != 0 && isset($busi) && $busi != 0 && isset($sold) && $sold != 0 && isset($srct) && $srct != 0 && isset($lent) && $lent != 0 && isset($zip) && isset($wdate) && isset($edate)) {

				// load entry model
				$policy_entry_model = $this->loadModel('PolicyEntryModel');
				$policy_added = $policy_entry_model->addPolicy($agency_id,$first,$last,$desc,$prem,$notes,$catr,$busi,$sold,$srct,$lent,$zip,$wdate,$edate);
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

			$id = (int) trim(@$_POST['id']);
			$first = trim(@$_POST['policy_first_name']);
			$last = trim(@$_POST['policy_last_name']);
			$desc = trim(@$_POST['policy_description']);
			$notes = trim(@$_POST['policy_notes']);	
			$catr = (int) trim(@$_POST['policy_sub_category']);
			$busi = (int) trim(@$_POST['policy_business_type']);
			$sold = (int) trim(@$_POST['policy_team_member']);
			$srct = (int) trim(@$_POST['policy_source_type']);
			$lent = (int) trim(@$_POST['policy_length_type']);
			$zip = trim(@$_POST['policy_zip']);
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

			if (isset($id) && $id != 0 && isset($first) && $first != '' && isset($last) && $last != '' && isset($desc) && isset($prem) && $prem != '' && isset($notes) && isset($catr) && $catr != 0 && isset($busi) && $busi != 0 && isset($sold) && $sold != 0 && isset($srct) && $srct != 0 && isset($lent) && $lent != 0 && isset($zip) && isset($wdate) && isset($idate) && isset($edate) && isset($cdate)) {
				// load entry model
				$policy_entry_model = $this->loadModel('PolicyEntryModel');
				$policy_updated = $policy_entry_model->updatePolicy($id,$first,$last,$desc,$prem,$notes,$catr,$busi,$sold,$srct,$lent,$zip,$wdate,$idate,$edate,$cdate);
				if ($policy_updated) {
					$return['msg'] = '<strong>Success</strong>, Policy Updated.';
				} else {
					$return['error'] = true;
					$return['msg'] .= '<strong>Update Failed.</strong> Policy Was Not Updated.';
				}
			} else {
				$return['error'] = true;
				$return['msg'] .= '<strong>Edit Policy Failed.</strong> One or More of the Required Fields Was Missing.';
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
				$policy_renewed = $policy_entry_model->renewPolicy($rnewID);
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

	public function payroll($sub = 'index')
    {
		// load main model
		$main_model = $this->loadModel('MainModel');
		$header_data = $main_model->getHeaderInfo($_SESSION['user_id']);

		// load CSS based on method
		$css = 'app_style.css';
		// load jQuery script based on method
		$sectionScript = 'payroll.js';

        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/main_header.php';
        require 'application/views/payroll/'.$sub.'.php';
        require 'application/views/_templates/footer.php';
    }

	public function myagency($sub = 'index')
    {
		// load main model
		$main_model = $this->loadModel('MainModel');
		$header_data = $main_model->getHeaderInfo($_SESSION['user_id']);

		// load CSS based on method
		$css = 'app_style.css';
		// load jQuery script based on method
		$sectionScript = 'myagency.js';

        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/main_header.php';
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
