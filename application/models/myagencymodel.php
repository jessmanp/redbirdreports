<?php

class MyAgencyModel
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
        $sql = 'SELECT users.user_id,users.user_level,users.user_first_name,users.user_last_name,users.user_active FROM users, agencies, agencies_users WHERE agencies_users.user_id = users.user_id AND agencies_users.agency_id = agencies.id AND agencies.id = '.$agency_id.' AND users.user_level < 3 ORDER BY users.user_active DESC, users.user_last_name';
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetchAll();
    }
    
    /**
     * Get Employees to Transfer to from database based on Agency ID
     */
    public function getTransferEmployees($agency_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT users.user_id,users.user_level,users.user_first_name,users.user_last_name,users.user_active FROM users, agencies, agencies_users WHERE agencies_users.user_id = users.user_id AND agencies_users.agency_id = agencies.id AND agencies.id = '.$agency_id.' AND users.user_active = 1 ORDER BY users.user_last_name';
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetchAll();
    }
    
    /**
     * Query agency settings
     */
    public function getAgencySettings($agency_id)
    {

		// query to get employee data
		$query_get_agency_settings = $this->db->prepare('SELECT * FROM agencies_settings WHERE agency_id = :agency_id');
		$query_get_agency_settings->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_agency_settings->execute();
		return $query_get_agency_settings->fetchAll();

	}
	
	/**
     * Update employee compensation data
     */
    public function saveAgencySettings($agency_id,$period_frequency)
    {
		// query to update user data
		$query_update_agency_settings = $this->db->prepare('UPDATE agencies_settings SET period_frequency = :period_frequency WHERE agency_id = :agency_id');
		$query_update_agency_settings->bindValue(':period_frequency', $period_frequency, PDO::PARAM_INT);
		$query_update_agency_settings->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_update_agency_settings->execute();
		
		if ($query_update_agency_settings) {
			return true;
		}
		
		return false;
	}

	/**
     * Query employee compensation data to populate form
     */
    public function getEmployeeData($employee_id)
    {

		// query to get employee data
		$query_get_employee_compensation = $this->db->prepare('SELECT users.user_level, users.user_first_name, users.user_last_name, users.user_email, users.user_phone, users.user_mobile, users.user_zip_code, users.user_job_title, users.user_hire_date, users.user_active, compensation_plans.* FROM users, compensation_plans WHERE users.user_id = compensation_plans.user_id AND compensation_plans.user_id = :employee_id');
		$query_get_employee_compensation->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_compensation->execute();
		return $query_get_employee_compensation->fetchAll();

	}
	
	/**
     * Update employee compensation data
     */
    public function saveEmployeeData($employee_id, $employee_first_name, $employee_last_name, $employee_job_title, $employee_email, $employee_phone, $employee_mobile, $employee_zip_code, $employee_type, $employee_hire_date, $employee_auto_new, $employee_auto_added, $employee_auto_reinstated, $employee_auto_transferred, $employee_auto_renewal, $employee_fire_new, $employee_fire_added, $employee_fire_reinstated, $employee_fire_transferred, $employee_fire_renewal, $employee_life_new, $employee_life_increase, $employee_life_policy, $employee_health_new, $employee_health_policy, $employee_bank_deposit_product, $employee_bank_loan_product, $employee_bank_fund_product)
    {
		// query to update user data
		$query_update_employee_data = $this->db->prepare('UPDATE users SET user_first_name = :employee_first_name, user_last_name = :employee_last_name, user_job_title = :employee_job_title, user_email = :employee_email, user_phone = :employee_phone, user_mobile = :employee_mobile, user_zip_code = :employee_zip_code, user_level = :employee_type, user_hire_date = :employee_hire_date WHERE user_id = :employee_id');
		
		$query_update_employee_data->bindValue(':employee_first_name', $employee_first_name, PDO::PARAM_STR);
		$query_update_employee_data->bindValue(':employee_last_name', $employee_last_name, PDO::PARAM_STR);
		$query_update_employee_data->bindValue(':employee_job_title', $employee_job_title, PDO::PARAM_STR);
		$query_update_employee_data->bindValue(':employee_email', $employee_email, PDO::PARAM_STR);
		$query_update_employee_data->bindValue(':employee_phone', $employee_phone, PDO::PARAM_STR);
		$query_update_employee_data->bindValue(':employee_mobile', $employee_mobile, PDO::PARAM_STR);
		$query_update_employee_data->bindValue(':employee_zip_code', $employee_zip_code, PDO::PARAM_STR);
		$query_update_employee_data->bindValue(':employee_type', $employee_type, PDO::PARAM_INT);
		$query_update_employee_data->bindValue(':employee_hire_date', $employee_hire_date, PDO::PARAM_STR);
		$query_update_employee_data->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		
		$query_update_employee_data->execute();
		
		// query to update compensation data
		$query_update_compensation_data = $this->db->prepare('UPDATE compensation_plans SET active = 1, effective_date = now(), commission_auto_new = :commission_auto_new, commission_auto_add = :commission_auto_added, commission_auto_reinstate = :commission_auto_reinstated, commission_auto_transfer = :commission_auto_transferred, commission_auto_renew = :commission_auto_renewal, commission_fire_new = :commission_fire_new, commission_fire_add = :commission_fire_added, commission_fire_reinstate = :commission_fire_reinstated, commission_fire_transfer = :commission_fire_transferred, commission_fire_renew = :commission_fire_renewal, commission_life_new = :commission_life_new, commission_life_increase = :commission_life_increase, commission_life_dollar = :commission_life_dollar, commission_health_new = :commission_health_new, commission_health_dollar = :commission_health_dollar, commission_deposit_product = :commission_deposit_product, commission_loan_product = :commission_loan_product, commission_fund_product = :commission_fund_product WHERE user_id = :employee_id');

 		$query_update_compensation_data->bindValue(':commission_auto_new', $employee_auto_new, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_auto_added', $employee_auto_added, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_auto_reinstated', $employee_auto_reinstated, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_auto_transferred', $employee_auto_transferred, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_auto_renewal', $employee_auto_renewal, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_fire_new', $employee_fire_new, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_fire_added', $employee_fire_added, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_fire_reinstated', $employee_fire_reinstated, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_fire_transferred', $employee_fire_transferred, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_fire_renewal', $employee_fire_renewal, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_life_new', $employee_life_new, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_life_increase', $employee_life_increase, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_life_dollar', $employee_life_policy, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_health_new', $employee_health_new, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_health_dollar', $employee_health_policy, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_deposit_product', $employee_bank_deposit_product, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_loan_product', $employee_bank_loan_product, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':commission_fund_product', $employee_bank_fund_product, PDO::PARAM_INT);
		$query_update_compensation_data->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		
		$query_update_compensation_data->execute();

		if ($query_update_employee_data && $query_update_compensation_data) {
			return $employee_id;
		}

	}
	
	/**
     * deactivate user
     */
    public function deleteEmployee($id,$newid)
    {
    
    	/*
        $sql = "DELETE FROM agencies_users WHERE user_id = :id";
        $query1 = $this->db->prepare($sql);
        $query1->execute(array(':id' => $id));
        
        $sql = "DELETE FROM compensation_plans WHERE user_id = :id";
        $query2 = $this->db->prepare($sql);
        $query2->execute(array(':id' => $id));
        
        $sql = "DELETE FROM users WHERE user_id = :id";
        $query3 = $this->db->prepare($sql);
        $query3->execute(array(':id' => $id));
        */
        
        // SWITCH USER ID ON POLICIES
        
        
        // GET ACTIVE TYPE (0=invited,1=active,2=deactive)
        $sql = "SELECT user_active FROM users WHERE user_id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
		$query->execute(array(':id' => $id));
		$active_type = $query->fetch()->user_active;
        
        
        if ($active_type == 1) {
                 
			// DEACTIVATE THIS USER_ID
			$sql = "UPDATE users SET user_active = 2 WHERE user_id = :id";
			$query5 = $this->db->prepare($sql);
			$query5->execute(array(':id' => $id));
		
			// SWITCH USER ID ON POLICIES AND BACKUP OLD ID
			$sql = "UPDATE policies SET user_id = :new_id, old_user_id = :old_id WHERE user_id = :old_id";
			$query4 = $this->db->prepare($sql);
			$query4->execute(array(':old_id' => $id,':new_id' => $newid));

			if ($query4 && $query5) {
				return true;
			}
		
		}
		
		return false;
		
    }
    
	/**
     * Activate employee
     */
    public function undeleteEmployee($id)
    {
        
        // REACTIVATE THIS USER_ID
        $sql = "UPDATE users SET user_active = 1 WHERE user_id = :id";
        $query5 = $this->db->prepare($sql);
        $query5->execute(array(':id' => $id));
        
        // PUT BACK POLICIES WITH THIS USER_ID
        $sql = "UPDATE policies SET active = 1 WHERE user_id = :id";
        $query4 = $this->db->prepare($sql);
        $query4->execute(array(':id' => $id));

		if ($query4 && $query5) {
			return true;
		}
    }
    
    /**
     * remove invited employee
     */
    public function removeEmployee($id)
    {
    
    	// delete all data for invited employee
        $sql = "DELETE FROM agencies_users WHERE user_id = :id";
        $query1 = $this->db->prepare($sql);
        $query1->execute(array(':id' => $id));
        
        $sql = "DELETE FROM compensation_plans WHERE user_id = :id";
        $query2 = $this->db->prepare($sql);
        $query2->execute(array(':id' => $id));
        
        $sql = "DELETE FROM users WHERE user_id = :id";
        $query3 = $this->db->prepare($sql);
        $query3->execute(array(':id' => $id));

		if ($query1 && $query2 && $query3) {
			return true;
		}
		
		return false;
		
    }

// EOF
}
