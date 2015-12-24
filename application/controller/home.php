<?php

// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('login/libraries/password_compatibility_library.php');
}

// include the PHPMailer library
require_once('login/libraries/PHPMailer.php');

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // this method handles the login
		// check if logged in
		if (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
			// pass on to main page
			header("location: /app/dashboard");
		}
		// load CSS based on method
		$css = 'setup_style.css';
        // load jQuery script based on method
		$navScript = 'login.js';
        require 'application/views/_templates/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
		// clear out any error popups so they don't keep showing since we use sessions vars
		unset($_SESSION['login_errors']);
		unset($_SESSION['login_messages']);
    }

    /**
     * PAGE: setup
     * This method handles what happens when you move to http://yourproject/home/setup
     * The camelCase writing is just for better readability. The method name is case insensitive.
     */
    public function setup()
    {
		// load CSS based on method
		$css = 'setup_style.css';

		// load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $setup_model = $this->loadModel('SetupModel');
		// check if logged in
		if (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
			// get and set agency ID based on the owner
	    		$agency_id = $setup_model->getOwnerAgencyID($_SESSION['user_id']);
		}

		// if new owner exists and is logged in, but is not assigned as agency owner cancel setup and logout
		if (empty($agency_id)) {
			header("location: /login/?logout");
		}

        // load jQuery script based on method
		$navScript = 'settings.js';
        require 'application/views/_templates/header.php';
        require 'application/views/home/setup.php';
        require 'application/views/_templates/footer.php';

	}

	/*
     * This method handles what happens when the setup page saves Agency Info
     */
    	public function saveAgencySetup()
    	{

		// load model, to perform all setup actions
		$setup_model = $this->loadModel('SetupModel');
 
		// array values that will be returned via ajax
		$return = array();
		$return['msg'] = '';
		$return['error'] = false;

		// *AGENCY INFO*
		$agency_name = trim(@$_POST['agency_name']);
		$agency_address = trim(@$_POST['agency_address']);
		$agency_city = trim(@$_POST['agency_city']);
		$agency_state = trim(@$_POST['agency_state']);
		$agency_zip_code = trim(@$_POST['agency_zip_code']);
		$agency_phone = trim(@$_POST['agency_phone']);

		// validate agency info form to make sure the agency name was entered
		if (!isset($agency_name) || empty($agency_name)){
			$return['error'] = true;
			$return['msg'] .= '<strong>Agency name is empty.</strong> Please enter your agency&rsquo;s name.';
		} else if (!preg_match('/[0-9]/', $agency_zip_code)) {
			$return['error'] = true;
			$return['msg'] .= '<strong>Agency zip code invalid.</strong> Please enter your agency&rsquo;s zip code.';
		//} else if (!preg_match('/[0-9]/', $agency_phone)) {
		//	$return['error'] = true;
		//	$return['msg'] .= 'Agency phone is invalid. Please enter your agency&rsquo;s phone.';
		} else {
			// update agency info in DB
			$agency_id = $setup_model->getOwnerAgencyID($_SESSION['user_id']);
			$setup_model->updateAgencyInfo($agency_name, $agency_address, $agency_city, $agency_state, $agency_zip_code, $agency_phone, $agency_id);
		}
 
		// submit success functionality
		if ($return['error'] === false){
			$return['msg'] = '<strong>Success</strong>, Agency Information Updated.';
		}
 
		//Return json encoded results
		echo json_encode($return);

	}

	/*
     * This method handles what happens when the setup page invites an Employee
     */
    	public function inviteEmployeeSetup()
    	{

		// load model, to perform all setup actions
		$setup_model = $this->loadModel('SetupModel');
 
		// array values that will be returned via ajax
		$return = array();
		$return['msg'] = '';
		$return['error'] = false;

		// *INVITE EMPLOYEE*
		$employee_first_name = trim(@$_POST['employee_first_name']);
		$employee_last_name = trim(@$_POST['employee_last_name']);
		$employee_email = trim(@$_POST['employee_email']);
		$employee_email_verify = trim(@$_POST['employee_email_verify']);
		$employee_type = @$_POST['employee_type'];

		// validate invite employee form to make sure the email was entered
		if (!isset($employee_email) || empty($employee_email) || !filter_var($employee_email, FILTER_VALIDATE_EMAIL)){
			$return['error'] = true;
			$return['msg'] .= 'Employee email is empty or invalid. Please enter the employee&rsquo;s email address.';
		} elseif ($employee_email != $employee_email_verify){
			$return['error'] = true;
			$return['msg'] .= 'Employee email does not match. Please enter the employee&rsquo;s email address again.';
		} elseif (!isset($employee_first_name) || empty($employee_first_name)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee first name is not valid. Please enter the employee&rsquo;s first name.';
		} elseif (!isset($employee_last_name) || empty($employee_last_name)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee last name is not valid. Please enter the employee&rsquo;s last name.';
		} elseif (!isset($employee_type) || $employee_type == '') {
			$return['error'] = true;
			$return['msg'] .= 'Employee type is not valid. Please select the employee&rsquo;s type.';
		} else {
			// execute add employee/user functions
			$agency_id = $setup_model->getOwnerAgencyID($_SESSION['user_id']);
			$invited_user_id = $setup_model->inviteEmployee($employee_first_name, $employee_last_name, $employee_email, $employee_type, $agency_id);

			if (!isset($invited_user_id) || empty($invited_user_id)) {
				$return['error'] = true;
				$return['msg'] .= 'Employee email is not valid or already in use. Please enter the employee&rsquo;s email address.';
			}
		}
 
		if ($employee_type == 0) {
			$employee_type = 'Employee';
		} elseif ($employee_type == 1) {
			$employee_type = 'Manager';
		} elseif ($employee_type == 2) {
			$employee_type = 'Admin';
		} else {
			$employee_type = 'General';
		}
	
		// submit success functionality
		if ($return['error'] === false){
			$return['msg'] = 'Success, the new employee has been added to the system and the invitation email has been sent.';
			$return['type'] = $employee_type;
		}
 
		//Return json encoded results
		echo json_encode($return);

	}

	/*
     * This method handles what happens when the Employees are invited
	 */
    public function updateEmployeeList()
    {

		// array values that will be returned via ajax
		$return = array();
		$return['msg'] = '';
		$return['error'] = false;

		// load model, to perform all setup actions
		$setup_model = $this->loadModel('SetupModel');
        
		// get agency id based on owner
		$agency_id = $setup_model->getOwnerAgencyID($_SESSION['user_id']);

		// get list of employees
		$employees = $setup_model->getInvitedEmployees($agency_id);

		if (empty($employees)) {
			$return['error'] = true;
			$return['msg'] .= 'ERROR. No employee(s) found.';
		} else {
			$return = $employees;
		}

		//Return json encoded results
		echo json_encode($return);

	}

	/*
     * This method handles what happens when the setup page updates an Employee compensation
     */
    	public function updateEmployeeCompensation()
    	{

		// load model, to perform all setup actions
		$setup_model = $this->loadModel('SetupModel');
 
		// array values that will be returned via ajax
		$return = array();
		$return['msg'] = '';
		$return['error'] = false;

		// *UPDATE EMPLOYEE COMPENSATION*
		$employee_id = trim(@$_POST['employees_compensation']); // must be an existing ID
		$compensation_type = trim(@$_POST['compensation_type']); // will be either 1 = hourly or 2 = salary
		$compensation_rate = trim(@$_POST['compensation_rate']); // must be decimal money
		$compensation_other = @$_POST['compensation_other']; // must be decimal money
		$compensation_draw = @$_POST['compensation_draw']; // optional
		$commission_auto_new = @$_POST['commission_auto_new']; // must be decimal percent
		$commission_auto_renew = @$_POST['commission_auto_renew']; // must be decimal percent
		$commission_fire_new = @$_POST['commission_fire_new']; // must be decimal percent
		$commission_fire_renew = @$_POST['commission_fire_renew']; // must be decimal percent
		$commission_life = @$_POST['commission_life']; // must be decimal percent
		$commission_life_renew = @$_POST['commission_life_renew']; // must be decimal percent
		$commission_health = @$_POST['commission_health']; // must be decimal percent
		$commission_health_renew = @$_POST['commission_health_renew']; // must be decimal percent

		// validate update employee compensation form to make sure the data was entered correctly

		if (isset($compensation_draw)) {
			$comp_draw = 1;
		} else {
			$comp_draw = 0;
		}

		if (!isset($employee_id) || $employee_id == '' || !is_numeric($employee_id)) {
			$return['error'] = true;
			$return['msg'] .= 'No employee was selected. Please select an employee.';
		} elseif (!isset($compensation_type) || !is_numeric($compensation_type)){
			$return['error'] = true;
			$return['msg'] .= 'Employee rate type is empty or invalid. Please enter the employee&rsquo;s rate type.';
		} elseif (!isset($compensation_rate) || empty($compensation_rate) || !is_numeric($compensation_rate)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee rate is empty or not valid. Please enter the employee&rsquo;s rate in dollars.';
		} elseif (isset($compensation_other) && $compensation_other != '' && !is_numeric($compensation_other)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee other compensation is empty or not valid. Please enter the employee&rsquo;s other compensation in dollars.';
		} elseif (!isset($commission_auto_new) || !is_numeric($commission_auto_new)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee Auto New percentage is blank or not valid. Please enter the employee&rsquo;s Auto New percentage.';
		} elseif (!isset($commission_auto_renew) || !is_numeric($commission_auto_renew)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee Auto Renew percentage is blank or not valid. Please enter the employee&rsquo;s Auto Renew percentage.';
		} elseif (!isset($commission_fire_new) || !is_numeric($commission_fire_new)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee Fire New percentage is blank or not valid. Please enter the employee&rsquo;s Fire New percentage.';
		} elseif (!isset($commission_fire_renew) || !is_numeric($commission_fire_renew)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee Fire Renew percentage is blank or not valid. Please enter the employee&rsquo;s Fire Renew percentage.';
		} elseif (!isset($commission_life) || !is_numeric($commission_life)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee Life percentage is blank or not valid. Please enter the employee&rsquo;s Life percentage.';
		} elseif (!isset($commission_life_renew) || !is_numeric($commission_life_renew)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee Life Renew percentage is blank or not valid. Please enter the employee&rsquo;s Life Renew percentage.';
		} elseif (!isset($commission_health) || !is_numeric($commission_health)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee Health percentage is blank or not valid. Please enter the employee&rsquo;s Health percentage.';
		} elseif (!isset($commission_health_renew) || !is_numeric($commission_health_renew)) {
			$return['error'] = true;
			$return['msg'] .= 'Employee Health Renew percentage is blank or not valid. Please enter the employee&rsquo;s Health Renew percentage.';
		} else {

			// execute update employee compensation functions
			$updated_employee_id = $setup_model->saveEmployeeCompensation($employee_id, $compensation_type, $compensation_rate, $compensation_other, $comp_draw, $commission_auto_new, $commission_auto_renew, $commission_fire_new, $commission_fire_renew, $commission_life, $commission_life_renew, $commission_health, $commission_health_renew);

			if (!isset($updated_employee_id) || empty($updated_employee_id)) {
				$return['error'] = true;
				$return['msg'] = 'ERROR. Employee compensation was NOT updated.';
			}
		}
 
		// submit success functionality
		if ($return['error'] === false){
			$return['msg'] = 'Success, the employee&rsquo;s compensation has been added to the system.';
		}
 
		//Return json encoded results
		echo json_encode($return);

	}


	/*
     * This method handles what happens when the Employees are selected
	 */
    public function getEmployeeCompensation()
    {

		// array values that will be returned via ajax
		$return = array();
		$return['msg'] = '';
		$return['error'] = false;

		// *POPULATE EMPLOYEE COMPENSATION DATA*
		$employee_id = trim(@$_GET['eid']); // must be an existing ID

		if (!isset($employee_id) || $employee_id == '' || !is_numeric($employee_id)) {
			$return['error'] = true;
			$return['msg'] .= 'ERROR. Invalid employee or no employee was selected.';
		}

		// load model, to perform all setup actions
		$setup_model = $this->loadModel('SetupModel');
		// get employees data
		$employee_data = $setup_model->getEmployeeCompensationData($employee_id);

		if (empty($employee_data)) {
			$return['error'] = true;
			$return['msg'] .= 'ERROR. No employee data found.';
		} else {
			$return = $employee_data;
		}

		//Return json encoded results
		echo json_encode($return);

	}

	/*
     * This method handles what happens when the Employee setup is checked
	 */
    public function checkEmployeeSetup()
    {

		// array values that will be returned via ajax
		$return = array();
		$return['msg'] = '';
		$return['error'] = false;

		// load model, to perform all setup actions
		$setup_model = $this->loadModel('SetupModel');
        
		// get agency id based on owner
		$agency_id = $setup_model->getOwnerAgencyID($_SESSION['user_id']);

		// get list of employees
		$employees = $setup_model->checkEmployeeCompensation($agency_id);

		if (empty($employees)) {
			$return['error'] = true;
			$return['msg'] .= 'ERROR. No employee(s) found.';
		} else {
			$return = $employees;
		}

		//Return json encoded results
		echo json_encode($return);

	}


	/*
     * This method grabs the agency info *if any
	 */
    public function preloadAgencyInfo()
    {

		// array values that will be returned via ajax
		$return = array();
		$return['msg'] = '';
		$return['error'] = false;

		// load model, to perform all setup actions
		$setup_model = $this->loadModel('SetupModel');
        
		// get agency id based on owner
		$agency_id = $setup_model->getOwnerAgencyID($_SESSION['user_id']);

		// get list of employees
		$info = $setup_model->getAgencyInfo($agency_id);
        
		if (empty($info)) {
			$return['error'] = true;
			$return['msg'] .= 'ERROR. No agency info found.';
		} else {
			$return = $info;
		}

		//Return json encoded results
		echo json_encode($return);

	}

	/*
     * This method handles what happens when progress is updated
	 */
    public function preUpdateProgress()
    {

		// array values that will be returned via ajax
		$return = array();
		$return['msg'] = '';
		$return['error'] = false;
        
		// get email based on session variable
		$the_email = $_SESSION['user_email'];

		if (empty($the_email)) {
			$return['error'] = true;
			$return['msg'] .= 'ERROR. No employee(s) found.';
		} else {
			$return = '<div class="progress-rule"></div><span class="progress-info"><strong>Email Confirmed:</strong><br />'.$the_email.'&nbsp;</span><br />';
		}

		//Return json encoded results
		echo json_encode($return);

	}

}

