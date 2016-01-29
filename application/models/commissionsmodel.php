<?php

class CommissionsModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

	/**
     * Get Employees from database based on Agency ID
     */
    public function getAllEmployees($agency_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT users.user_id,users.user_level,users.user_first_name,users.user_last_name,users.user_active FROM users, agencies, agencies_users WHERE agencies_users.user_id = users.user_id AND agencies_users.agency_id = agencies.id AND agencies.id = '.$agency_id.' AND users.user_active > 0 AND users.user_level < 3 ORDER BY users.user_active DESC, users.user_last_name';
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetchAll();
    }
    
    /**
     * Query employee commission data to populate table
     */
    public function getEmployeeCommissionHistory($employee_id)
    {

		// query to get employee data
		$query_get_employee_compensation = $this->db->prepare('SELECT users.user_level, users.user_first_name, users.user_last_name, users.user_job_title, users.user_hire_date FROM users WHERE users.user_id = :employee_id');
		$query_get_employee_compensation->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_compensation->execute();
		$emp_query = $query_get_employee_compensation->fetchAll();
		
		$commission_summary = array();
		
		foreach ($emp_query as $emp_info) {
			$commission_summary[0]['user_first_name'] = $emp_info->user_first_name;
			$commission_summary[0]['user_last_name'] = $emp_info->user_last_name;
			$commission_summary[0]['user_job_title'] = $emp_info->user_job_title;
			$commission_summary[0]['user_hire_date'] = $emp_info->user_hire_date;
		}
		
		// calcualte commission summary
		
		
		
		if (!empty($commission_summary)) {
			return $commission_summary;
		}
		
		return false;

	}
	
    /**
     * Update Special Compensation
     */
    public function saveCommissionSpecial($employee_id)
    {

		/*
		update bonus and other here
		*/
		
		return false;

	}

// EOF
}
