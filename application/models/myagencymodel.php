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
     * Query employee compensation data to populate form
     */
    public function getEmployeeData($employee_id)
    {

		// query to get employee data
		$query_get_employee_compensation = $this->db->prepare('SELECT users.user_level, users.user_first_name, users.user_last_name, users.user_email, users.user_phone, users.user_mobile, users.user_zip_code, users.user_job_title, users.user_hire_date, compensation_plans.* FROM users, compensation_plans WHERE users.user_id = compensation_plans.user_id AND compensation_plans.user_id = :employee_id');
		$query_get_employee_compensation->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_compensation->execute();
		return $query_get_employee_compensation->fetchAll();

	}
	
	/**
     * Update employee compensation data
     */
    public function  saveEmployeeData($employee_id, $employee_first_name, $employee_last_name, $employee_job_title, $employee_email, $employee_phone, $employee_mobile, $employee_zip_code, $employee_type, $employee_hire_date, $employee_auto_new, $employee_auto_added, $employee_auto_reinstated, $employee_auto_transferred, $employee_auto_renewal, $employee_fire_new, $employee_fire_added, $employee_fire_reinstated, $employee_fire_transferred, $employee_fire_renewal, $employee_life_new, $employee_life_increase, $employee_life_policy, $employee_health_new, $employee_health_policy, $employee_bank_deposit_product, $employee_bank_loan_product)
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
		$query_update_compensation_data = $this->db->prepare('UPDATE compensation_plans SET active = 1, effective_date = now(), commission_auto_new = :commission_auto_new, commission_auto_add = :commission_auto_added, commission_auto_reinstate = :commission_auto_reinstated, commission_auto_transfer = :commission_auto_transferred, commission_auto_renew = :commission_auto_renewal, commission_fire_new = :commission_fire_new, commission_fire_add = :commission_fire_added, commission_fire_reinstate = :commission_fire_reinstated, commission_fire_transfer = :commission_fire_transferred, commission_fire_renew = :commission_fire_renewal, commission_life_new = :commission_life_new, commission_life_increase = :commission_life_increase, commission_life_dollar = :commission_life_dollar, commission_health_new = :commission_health_new, commission_health_dollar = :commission_health_dollar, commission_deposit_product = :commission_deposit_product, commission_loan_product = :commission_loan_product WHERE user_id = :employee_id');

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
		$query_update_compensation_data->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		
		$query_update_compensation_data->execute();

		if ($query_update_employee_data && $query_update_compensation_data) {
			return $employee_id;
		}

	}
	
	/**
     * Remove all user info in all tables in the database and erase policies
     */
    public function deleteEmployee($id)
    {
        $sql = "DELETE FROM agencies_users WHERE user_id = :id";
        $query1 = $this->db->prepare($sql);
        $query1->execute(array(':id' => $id));
        
        $sql = "DELETE FROM compensation_plans WHERE user_id = :id";
        $query2 = $this->db->prepare($sql);
        $query2->execute(array(':id' => $id));
        
        $sql = "DELETE FROM users WHERE user_id = :id";
        $query3 = $this->db->prepare($sql);
        $query3->execute(array(':id' => $id));
        
        // ERASE POLICIES WITH THIS USER_ID
        $sql = "UPDATE policies SET active = 0 WHERE user_id = :id";
        $query4 = $this->db->prepare($sql);
        $query4->execute(array(':id' => $id));

		if ($query1 && $query2 && $query3 && $query4) {
			return true;
		}
    }

// EOF
}
