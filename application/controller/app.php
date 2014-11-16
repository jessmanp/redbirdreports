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
		// load jQuery script based on method
		$navScript = 'application.js';
        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }
    
/* /////////////////////////////// BEGIN VIEWS /////////////////////////////// */

	public function dashboard()
    {
		// load jQuery script based on method
		$navScript = 'application.js';
		$dateScript = 'datepicker.js';
        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/sub_header.php';
        require 'application/views/_templates/search.php';
        require 'application/views/dashboard/index.php';
        require 'application/views/_templates/sub_footer.php';
        require 'application/views/_templates/footer.php';
    }

	public function myagency($sub = 'index')
    {
		// load jQuery script based on method
		$navScript = 'application.js';
        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/sub_header.php';
        require 'application/views/myagency/'.$sub.'.php';
        require 'application/views/_templates/sub_footer.php';
        require 'application/views/_templates/footer.php';
    }

	public function policies($sub = 'index')
    {
		// load jQuery script based on method
		$navScript = 'application.js';

		if (isset($_GET['listing'])) {
			$cat = $page = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['listing']);
			switch($cat) {
				case 'auto';
					$category_id = 1;
					break;
				case 'fire';
					$category_id = 9;
					break;
				case 'life';
					$category_id = 26;
					break;
				case 'health';
					$category_id = 40;
					break;
				case 'loan';
					$category_id = 50;
					break;
				case 'deposit';
					$category_id = 58;
					break;
				case 'fund';
					$category_id = 70;
					break;
				default;
					$category_id = 0;
					break;
			}
			// load listing model
			$policy_listing_model = $this->loadModel('PolicyListingModel');
			$dateScript = 'datepicker.js';
			// load views
			require 'application/views/_templates/header.php';
        		require 'application/views/_templates/sub_header.php';
			require 'application/views/_templates/searchpolicies.php';
        		require 'application/views/policies/listing.php';
        		require 'application/views/_templates/sub_footer.php';
        		require 'application/views/_templates/footer.php';
		} elseif (isset($_GET['add']) || isset($_GET['edit'])) {
			$cat = $page = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['add']);
			switch($cat) {
				case 'auto';
					$category_id = 1;
					break;
				case 'fire';
					$category_id = 9;
					break;
				case 'life';
					$category_id = 26;
					break;
				case 'health';
					$category_id = 40;
					break;
				case 'loan';
					$category_id = 50;
					break;
				case 'deposit';
					$category_id = 58;
					break;
				case 'fund';
					$category_id = 70;
					break;
				default;
					$category_id = 0;
					break;
			}
			// load entry (add/edit) model
			$policy_entry_model = $this->loadModel('PolicyEntryModel');
			$agency_id = $policy_entry_model->getAgencyID($_SESSION['user_id']);
			$agency_employees = $policy_entry_model->getAllEmployees($agency_id);
			$policy_categories = $policy_entry_model->getAllCategories($category_id);
			$policy_business_types = $policy_entry_model->getAllBusinessTypes();
			$policy_source_types = $policy_entry_model->getAllSourceTypes();
			$policy_length_types = $policy_entry_model->getAllLengthTypes();
			$dateScript = 'datepicker.js';
			// load views
			require 'application/views/_templates/header.php';
        		require 'application/views/_templates/sub_header.php';
        		require 'application/views/policies/entry.php';
        		require 'application/views/_templates/sub_footer.php';
        		require 'application/views/_templates/footer.php';
		} else {
        		// load views.
        		require 'application/views/_templates/header.php';
        		require 'application/views/_templates/sub_header.php';
        		require 'application/views/policies/'.$sub.'.php';
        		require 'application/views/_templates/sub_footer.php';
        		require 'application/views/_templates/footer.php';
		}

    }

	public function support($sub = 'index')
    {
		// load jQuery script based on method
		$navScript = 'application.js';
        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/sub_header.php';
        require 'application/views/support/'.$sub.'.php';
        require 'application/views/_templates/sub_footer.php';
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
