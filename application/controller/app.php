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

	public function policies($sub = 'index', $param = 'default')
    {
		// load main model
		$main_model = $this->loadModel('MainModel');
		$header_data = $main_model->getHeaderInfo($_SESSION['user_id']);

		// load CSS based on method
		$css = 'app_style.css';
		// load scripts based on method
		$dateScript = 'datepicker.js';
		$sectionScript = 'policy.js';

		// load listing model
		$policy_listing_model = $this->loadModel('PolicyListingModel');

		if ($sub == 'listall' || $sub == 'index') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('all','default','written');
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('all','default','notissued');
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('all','default','renewal');
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('all',$param);
			}
		} else if ($sub == 'listauto') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('auto','default','written');
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('auto','default','notissued');
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('auto','default','renewal');
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('auto',$param);
			}
		} else if ($sub == 'listfire') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('fire','default','written');
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('fire','default','notissued');
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('fire','default','renewal');
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('fire',$param);
			}
		} else if ($sub == 'listlife') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('life','default','written');
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('life','default','notissued');
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('life','default','renewal');
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('life',$param);
			}
		} else if ($sub == 'listhealth') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('health','default','written');
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('health','default','notissued');
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('health','default','renewal');
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('health',$param);
			}
		} else if ($sub == 'listdeposit') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('deposit','default','written');
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('deposit','default','notissued');
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('deposit','default','renewal');
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('deposit',$param);
			}
		} else if ($sub == 'listloan') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('loan','default','written');
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('loan','default','notissued');
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('loan','default','renewal');
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('loan',$param);
			}
		} else if ($sub == 'listfund') {
			if ($param == 'allwritten') {
				$policy_data = $policy_listing_model->getAllPolicies('fund','default','written');
			} else if ($param == 'notissued') {
				$policy_data = $policy_listing_model->getAllPolicies('fund','default','notissued');
			} else if ($param == 'pendingrenewal') {
				$policy_data = $policy_listing_model->getAllPolicies('fund','default','renewal');
			} else {
				$policy_data = $policy_listing_model->getAllPolicies('fund',$param);
			}
		}

		// load entry (add/edit) models
		$policy_entry_model = $this->loadModel('PolicyEntryModel');
		$agency_id = $policy_entry_model->getAgencyID($_SESSION['user_id']);
		$agency_employees = $policy_entry_model->getAllEmployees($agency_id);
		$policy_categories = $policy_entry_model->getAllCategories(str_replace('list','',$sub));
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
