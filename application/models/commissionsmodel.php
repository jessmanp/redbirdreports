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
        $sql = 'SELECT users.user_id,users.user_level,users.user_first_name,users.user_last_name,users.user_active FROM users, agencies, agencies_users WHERE agencies_users.user_id = users.user_id AND agencies_users.agency_id = agencies.id AND agencies.id = '.$agency_id.' AND users.user_active > 0 ORDER BY users.user_active DESC, users.user_last_name';
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetchAll();
    }
    
    /**
     * Query employee commission data to populate table
     */
    public function getEmployeeCommissionHistory($agency_id,$employee_id,$dateA,$dateB)
    {

		// query to get employee data
		$query_get_employee_info = $this->db->prepare('SELECT users.user_level, users.user_first_name, users.user_last_name, users.user_job_title, users.user_hire_date FROM users WHERE users.user_id = :employee_id');
		$query_get_employee_info->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_info->execute();
		$emp_query = $query_get_employee_info->fetchAll();
		
		// query to get employee compensation
		$query_get_employee_compensation = $this->db->prepare('SELECT * FROM compensation_plans WHERE user_id = :employee_id');
		$query_get_employee_compensation->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_compensation->execute();
		$comp_query = $query_get_employee_compensation->fetchAll();
		
		$query_get_employee_premium_new = $this->db->prepare('SELECT SUM(premium) as premium FROM policies WHERE agency_id = :agency_id AND user_id = :user_id AND renewal = 0 AND (status = 1 OR status = 2) AND (date_written >= :date_a AND date_written <= :date_b);');
		$query_get_employee_premium_new->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_employee_premium_new->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_premium_new->bindValue(':date_a', $dateA, PDO::PARAM_STR);
		$query_get_employee_premium_new->bindValue(':date_b', $dateB, PDO::PARAM_STR);
		$query_get_employee_premium_new->execute();
		$new_premium_query = $query_get_employee_premium_new->fetchAll();
		
		$query_get_employee_renewal = $this->db->prepare('SELECT SUM(premium) as premium FROM policies WHERE agency_id = :agency_id AND user_id = :user_id AND renewal = 1 AND (status = 1 OR status = 2) AND (date_written >= :date_a AND date_written <= :date_b);');
		$query_get_employee_renewal->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_employee_renewal->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_renewal->bindValue(':date_a', $dateA, PDO::PARAM_STR);
		$query_get_employee_renewal->bindValue(':date_b', $dateB, PDO::PARAM_STR);
		$query_get_employee_renewal->execute();
		$new_renewal_query = $query_get_employee_renewal->fetchAll();
		
		$query_get_employee_charge_backs = $this->db->prepare('SELECT SUM(premium) as premium FROM policies WHERE agency_id = :agency_id AND user_id = :user_id AND (status = 3 OR status = 4) AND (date_written >= :date_a AND date_written <= :date_b);');
		$query_get_employee_charge_backs->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_employee_charge_backs->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_charge_backs->bindValue(':date_a', $dateA, PDO::PARAM_STR);
		$query_get_employee_charge_backs->bindValue(':date_b', $dateB, PDO::PARAM_STR);
		$query_get_employee_charge_backs->execute();
		$new_chargeback_query = $query_get_employee_charge_backs->fetchAll();
		
		$commission_summary = array();
		
		foreach ($emp_query as $emp_info) {
			$commission_summary[0]['user_first_name'] = $emp_info->user_first_name;
			$commission_summary[0]['user_last_name'] = $emp_info->user_last_name;
			$commission_summary[0]['user_job_title'] = $emp_info->user_job_title;
			$commission_summary[0]['user_hire_date'] = $emp_info->user_hire_date;
		}
		
		foreach ($comp_query as $comp_info) {
			$commission_summary[0]['user_bonus'] = $comp_info->bonus;
			$commission_summary[0]['user_bonus_desc'] = $comp_info->bonus_description;
			$commission_summary[0]['user_other'] = $comp_info->other;
			$commission_summary[0]['user_other_desc'] = $comp_info->other_description;
		}
		
		foreach ($new_premium_query as $new_premium_info) {
			$commission_summary[0]['user_new_policies'] = $new_premium_info->premium;
		}
		
		foreach ($new_renewal_query as $new_renewal_info) {
			$commission_summary[0]['user_renewals'] = $new_renewal_info->premium;
		}
		
		foreach ($new_chargeback_query as $new_chargeback_info) {
			$commission_summary[0]['user_chargebacks'] = $new_chargeback_info->premium;
		}
		
		if (!empty($commission_summary)) {
			return $commission_summary;
		}
		
		return false;

	}
	
    /**
     * Update Special Compensation BONUS
     */
    public function saveCommissionSpecialBonus($employee_id,$bonus,$bonus_desc)
    {

		// query to update user data
		$query_update_bonus = $this->db->prepare('UPDATE compensation_plans SET bonus = :bonus, bonus_description = :bonus_desc WHERE user_id = :employee_id');
		$query_update_bonus->bindValue(':bonus', $bonus, PDO::PARAM_INT);
		$query_update_bonus->bindValue(':bonus_desc', $bonus_desc, PDO::PARAM_STR);
		$query_update_bonus->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_update_bonus->execute();
		
		if ($query_update_bonus) {
			return true;
		}
		
		return false;

	}
	
	/**
     * Update Special Compensation Other
     */
    public function saveCommissionSpecialOther($employee_id,$other,$other_desc)
    {

		// query to update user data
		$query_update_other = $this->db->prepare('UPDATE compensation_plans SET other = :other, other_description = :other_desc WHERE user_id = :employee_id');
		$query_update_other->bindValue(':other', $other, PDO::PARAM_INT);
		$query_update_other->bindValue(':other_desc', $other_desc, PDO::PARAM_STR);
		$query_update_other->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_update_other->execute();
		
		if ($query_update_other) {
			return true;
		}
		
		return false;

	}

// EOF
}
