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
		
		// query lifetime commissions
		$query_get_policies_lifetime = $this->db->prepare('SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS id, policies.premium, policies.business_type_id, policies.renewal FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND policies.agency_id = :agency_id AND policies.user_id = :user_id AND (policies.status = 1 OR policies.status = 2);');
		$query_get_policies_lifetime->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_policies_lifetime->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_policies_lifetime->execute();
		$lifetime_policies_query = $query_get_policies_lifetime->fetchAll();
		
		// query last year commissions
		$ts = time();
		$start = strtotime('first day of -1 years', $ts);
		$last_year = array(date('m-d-Y', $start), date('m-d-Y', strtotime('+13 months -1 day', $start)));
		$date_last_yearA = $last_year[0]." 00:00:00";
		$date_last_yearB = $last_year[1]." 23:59:59";
		$query_get_policies_lastyear = $this->db->prepare('SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS id, policies.premium, policies.business_type_id, policies.renewal FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND policies.agency_id = :agency_id AND policies.user_id = :user_id AND (policies.status = 1 OR policies.status = 2) AND (policies.date_written >= :date_a AND policies.date_written <= :date_b);');
		$query_get_policies_lastyear->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_policies_lastyear->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_policies_lastyear->bindValue(':date_a', $date_last_yearA, PDO::PARAM_STR);
		$query_get_policies_lastyear->bindValue(':date_b', $date_last_yearB, PDO::PARAM_STR);
		$query_get_policies_lastyear->execute();
		$lastyear_policies_query = $query_get_policies_lastyear->fetchAll();
		
		// query last year to date
		$ts = time();
		$start = strtotime('-2 years', $ts);
		$last_ytd = array(date('m-d-Y', $start), date('m-d-Y', strtotime('+12 months', $start)));
		$date_last_year_to_dateA = $last_ytd[0]." 00:00:00";
		$date_last_year_to_dateB = $last_ytd[1]." 23:59:59";
		$query_get_policies_last_ytd = $this->db->prepare('SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS id, policies.premium, policies.business_type_id, policies.renewal FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND policies.agency_id = :agency_id AND policies.user_id = :user_id AND (policies.status = 1 OR policies.status = 2) AND (policies.date_written >= :date_a AND policies.date_written <= :date_b);');
		$query_get_policies_last_ytd->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_policies_last_ytd->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_policies_last_ytd->bindValue(':date_a', $date_last_year_to_dateA, PDO::PARAM_STR);
		$query_get_policies_last_ytd->bindValue(':date_b', $date_last_year_to_dateB, PDO::PARAM_STR);
		$query_get_policies_last_ytd->execute();
		$last_ytd_policies_query = $query_get_policies_last_ytd->fetchAll();
		
		// query current year to date
		$ts = time();
		$start = strtotime('-1 years', $ts);
		$current_ytd = array(date('m-d-Y', $start), date('m-d-Y', strtotime('+12 months', $start)));
		$date_current_year_to_dateA = $current_ytd[0]." 00:00:00";
		$date_current_year_to_dateB = $current_ytd[1]." 23:59:59";
		$query_get_policies_current_ytd = $this->db->prepare('SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS id, policies.premium, policies.business_type_id, policies.renewal FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND policies.agency_id = :agency_id AND policies.user_id = :user_id AND (policies.status = 1 OR policies.status = 2) AND (policies.date_written >= :date_a AND policies.date_written <= :date_b);');
		$query_get_policies_current_ytd->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_policies_current_ytd->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_policies_current_ytd->bindValue(':date_a', $date_current_year_to_dateA, PDO::PARAM_STR);
		$query_get_policies_current_ytd->bindValue(':date_b', $date_current_year_to_dateB, PDO::PARAM_STR);
		$query_get_policies_current_ytd->execute();
		$current_ytd_policies_query = $query_get_policies_current_ytd->fetchAll();
		
		// query last months commissions
		$ts = time();
	  	$start = strtotime('first day of previous month', $ts);
	  	$last_month = array(date('m-d-Y', $start), date('m-d-Y', strtotime('last day of this month', $start)));
	  	$date_last_monthA = $last_month[0]." 00:00:00";
		$date_last_monthB = $last_month[1]." 23:59:59";
		$query_get_policies_lastmonth = $this->db->prepare('SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS id, policies.premium, policies.business_type_id, policies.renewal FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND policies.agency_id = :agency_id AND policies.user_id = :user_id AND (policies.status = 1 OR policies.status = 2) AND (policies.date_written >= :date_a AND policies.date_written <= :date_b);');
		$query_get_policies_lastmonth->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_policies_lastmonth->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_policies_lastmonth->bindValue(':date_a', $date_last_monthA, PDO::PARAM_STR);
		$query_get_policies_lastmonth->bindValue(':date_b', $date_last_monthB, PDO::PARAM_STR);
		$query_get_policies_lastmonth->execute();
		$lastmonth_policies_query = $query_get_policies_lastmonth->fetchAll();

		// query all policies
		$query_get_policies_new = $this->db->prepare('SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS id, policies.premium, policies.business_type_id, policies.renewal FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND policies.agency_id = :agency_id AND policies.user_id = :user_id AND (policies.status = 1 OR policies.status = 2) AND (policies.date_written >= :date_a AND policies.date_written <= :date_b);');
		$query_get_policies_new->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_policies_new->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_policies_new->bindValue(':date_a', $dateA, PDO::PARAM_STR);
		$query_get_policies_new->bindValue(':date_b', $dateB, PDO::PARAM_STR);
		$query_get_policies_new->execute();
		$new_policies_query = $query_get_policies_new->fetchAll();
		
		/*
		// query all renewal policies
		$query_get_policies_renewal = $this->db->prepare('SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS id, policies.premium, policies.business_type_id FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND policies.agency_id = :agency_id AND policies.user_id = :user_id AND policies.renewal = 1 AND (policies.status = 1 OR policies.status = 2) AND (policies.date_written >= :date_a AND policies.date_written <= :date_b);');
		$query_get_policies_renewal->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_get_policies_renewal->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
		$query_get_policies_renewal->bindValue(':date_a', $dateA, PDO::PARAM_STR);
		$query_get_policies_renewal->bindValue(':date_b', $dateB, PDO::PARAM_STR);
		$query_get_policies_renewal->execute();
		$renewal_policies_query = $query_get_policies_renewal->fetchAll();
		*/
		
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
			$commission_summary[0]['user_bonus'] = (float) $comp_info->bonus;
			$commission_summary[0]['user_bonus_desc'] = $comp_info->bonus_description;
			$commission_summary[0]['user_other'] = (float) $comp_info->other;
			$commission_summary[0]['user_other_desc'] = $comp_info->other_description;
			// set new compensation percentages
			$auto_policy_compensation_new = $comp_info->commission_auto_new;
			$fire_policy_compensation_new = $comp_info->commission_fire_new;
			$life_policy_compensation_new = $comp_info->commission_life_new;
			$health_policy_compensation_new = $comp_info->commission_health_new;
			// set add compensation percentages
			$auto_policy_compensation_add = $comp_info->commission_auto_add;
			$fire_policy_compensation_add = $comp_info->commission_fire_add;
			// set reinstate compensation percentages
			$auto_policy_compensation_reinstate = $comp_info->commission_auto_reinstate;
			$fire_policy_compensation_reinstate = $comp_info->commission_fire_reinstate;
			// set transfer compensation percentages
			$auto_policy_compensation_transfer = $comp_info->commission_auto_transfer;
			$fire_policy_compensation_transfer = $comp_info->commission_fire_transfer;
			// set renew compensation percentages
			$auto_policy_compensation_renew = $comp_info->commission_auto_renew;
			$fire_policy_compensation_renew = $comp_info->commission_fire_renew;
			// set dollar compensation percentages
			$life_policy_compensation_dollar = $comp_info->commission_life_dollar;
			$health_policy_compensation_dollar = $comp_info->commission_health_dollar;
			// set product compensation percentages
			$deposit_policy_compensation_product = $comp_info->commission_deposit_product;
			$loan_policy_compensation_product = $comp_info->commission_loan_product;
			$fund_policy_compensation_product = $comp_info->commission_fund_product;
		}
		
		// setup default count values
		$auto_policy_count = 0;
		$fire_policy_count = 0;
		$auto_renewal_count = 0;
		$fire_renewal_count = 0;
		$life_policy_count = 0;
		$health_policy_count = 0;
		$bank_policy_count = 0;
		// setup default premiums values
		$auto_policy_premium_total = 0;
		$fire_policy_premium_total = 0;
		$auto_renewal_premium_total = 0;
		$fire_renewal_premium_total = 0;
		$life_policy_premium_total = 0;
		$health_policy_premium_total = 0;
		$bank_policy_premium_total = 0;
		// setup default commission values
		$auto_policy_commission_total = 0;
		$fire_policy_commission_total = 0;
		$auto_renewal_commission_total = 0;
		$fire_renewal_commission_total = 0;
		$life_policy_commission_total = 0;
		$health_policy_commission_total = 0;
		$bank_policy_commission_total = 0;
		
		foreach ($new_policies_query as $new_policy_info) {
		
			if  ($new_policy_info->id == 1) {
				if  ($new_policy_info->renewal == 0) {
					// calculate auto issued count
					$auto_policy_count++;
					// calculate auto premiums
					$auto_policy_premium_total = ($auto_policy_premium_total+$new_policy_info->premium);
					// calculate auto commissions based on compensation plans
					if ($new_policy_info->business_type_id == 1) {
						$auto_policy_commission_total = ($auto_policy_commission_total+(($auto_policy_compensation_new/100)*$new_policy_info->premium));
					} else if ($new_policy_info->business_type_id == 2) {
						$auto_policy_commission_total = ($auto_policy_commission_total+(($auto_policy_compensation_add/100)*$new_policy_info->premium));
					} else if ($new_policy_info->business_type_id == 3) {
						$auto_policy_commission_total = ($auto_policy_commission_total+(($auto_policy_compensation_reinstate/100)*$new_policy_info->premium));
					} else if ($new_policy_info->business_type_id == 4) {
						$auto_policy_commission_total = ($auto_policy_commission_total+(($auto_policy_compensation_transfer/100)*$new_policy_info->premium));
					}
				} else if ($new_policy_info->renewal == 1) {
					// calculate auto renewal count
					$auto_renewal_count++;
					// calculate auto renewal premiums
					$auto_renewal_premium_total = ($auto_renewal_premium_total+$new_policy_info->premium);
					// calculate auto renewal commissions based on compensation plans
					if ($new_policy_info->business_type_id == 5) {
						$auto_renewal_commission_total = ($auto_renewal_commission_total+(($auto_policy_compensation_renew/100)*$new_policy_info->premium));
					}
				}
			}
			if  ($new_policy_info->id == 9) {
				if  ($new_policy_info->renewal == 0) {
					// calculate fire issued count
					$fire_policy_count++;
					// calculate fire premiums
					$fire_policy_premium_total = ($fire_policy_premium_total+$new_policy_info->premium);
					// calculate fire commissions based on compensation plans
					if ($new_policy_info->business_type_id == 1) {
						$fire_policy_commission_total = ($fire_policy_commission_total+(($fire_policy_compensation_new/100)*$new_policy_info->premium));
					} else if ($new_policy_info->business_type_id == 2) {
						$fire_policy_commission_total = ($fire_policy_commission_total+(($fire_policy_compensation_add/100)*$new_policy_info->premium));
					} else if ($new_policy_info->business_type_id == 3) {
						$fire_policy_commission_total = ($fire_policy_commission_total+(($fire_policy_compensation_reinstate/100)*$new_policy_info->premium));
					} else if ($new_policy_info->business_type_id == 4) {
						$fire_policy_commission_total = ($fire_policy_commission_total+(($fire_policy_compensation_transfer/100)*$new_policy_info->premium));
					}
				} else if ($new_policy_info->renewal == 1) {
					// calculate fire renewal count
					$fire_renewal_count++;
					// calculate fire renewal premiums
					$fire_renewal_premium_total = ($fire_renewal_premium_total+$new_policy_info->premium);
					// calculate fire renewal commissions based on compensation plans
					if ($new_policy_info->business_type_id == 5) {
						$fire_renewal_commission_total = ($fire_renewal_commission_total+(($fire_policy_compensation_renew/100)*$new_policy_info->premium));
					}
				}
			}
			if  ($new_policy_info->id == 26) {
				// calculate life issued count
				$life_policy_count++;
				$life_policy_premium_total = ($life_policy_premium_total+$new_policy_info->premium);
				// calculate life commission
				$life_policy_commission_total = ($life_policy_commission_total+(($life_policy_compensation_new/100)*$new_policy_info->premium));
				$life_policy_commission_total = ($life_policy_commission_total+$new_policy_info->premium);
			}
			if  ($new_policy_info->id == 40) {
				// calculate health issued count
				$health_policy_count++;
				$health_policy_premium_total = ($health_policy_premium_total+$new_policy_info->premium);
				// calculate health commission
				$health_policy_commission_total = ($health_policy_commission_total+(($health_policy_compensation_new/100)*$new_policy_info->premium));
				$health_policy_commission_total = ($health_policy_commission_total+$new_policy_info->premium);
			}
			if  ($new_policy_info->id == 50 || $new_policy_info->id == 58 || $new_policy_info->id == 70) {
				// calculate bank issued count
				$bank_policy_count++;
				$bank_policy_premium_total = ($bank_policy_premium_total+$new_policy_info->premium);
				// calculate bank commission
				$bank_policy_commission_total = ($bank_policy_commission_total+$new_policy_info->premium);
				$bank_policy_commission_total = ($bank_policy_commission_total+$new_policy_info->premium);
				$bank_policy_commission_total = ($bank_policy_commission_total+$new_policy_info->premium);
			}
			
		}
		
		$commission_summary[0]['user_new_policy_count_auto'] = $auto_policy_count;
		$commission_summary[0]['user_new_policy_count_fire'] = $fire_policy_count;
		$commission_summary[0]['user_renewal_policy_count_auto'] = $auto_renewal_count;
		$commission_summary[0]['user_renewal_policy_count_fire'] = $fire_renewal_count;
		$commission_summary[0]['user_new_policy_count_life'] = $life_policy_count;
		$commission_summary[0]['user_new_policy_count_health'] = $health_policy_count;
		$commission_summary[0]['user_new_policy_count_bank'] = $bank_policy_count;
		
		$commission_summary[0]['user_new_policy_premium_auto'] = $auto_policy_premium_total;
		$commission_summary[0]['user_new_policy_premium_fire'] = $fire_policy_premium_total;
		$commission_summary[0]['user_renewal_policy_premium_auto'] = $auto_renewal_premium_total;
		$commission_summary[0]['user_renewal_policy_premium_fire'] = $fire_renewal_premium_total;
		$commission_summary[0]['user_new_policy_premium_life'] = $life_policy_premium_total;
		$commission_summary[0]['user_new_policy_premium_health'] = $health_policy_premium_total;
		$commission_summary[0]['user_new_policy_premium_bank'] = $bank_policy_premium_total;
		
		$commission_summary[0]['user_new_policy_commission_auto'] = $auto_policy_commission_total;
		$commission_summary[0]['user_new_policy_commission_fire'] = $fire_policy_commission_total;
		$commission_summary[0]['user_renewal_policy_commission_auto'] = $auto_renewal_commission_total;
		$commission_summary[0]['user_renewal_policy_commission_fire'] = $fire_renewal_commission_total;
		$commission_summary[0]['user_new_policy_commission_life'] = $life_policy_commission_total;
		$commission_summary[0]['user_new_policy_commission_health'] = $health_policy_commission_total;
		$commission_summary[0]['user_new_policy_commission_bank'] = $bank_policy_commission_total;
		
		foreach ($new_premium_query as $new_premium_info) {
			$commission_summary[0]['user_new_policies'] = (float) $new_premium_info->premium;
		}
		
		foreach ($new_renewal_query as $new_renewal_info) {
			$commission_summary[0]['user_renewals'] = (float) $new_renewal_info->premium;
		}
		
		foreach ($new_chargeback_query as $new_chargeback_info) {
			// calculate chargebacks for all policies *within date range
			
			$commission_summary[0]['user_chargebacks'] = (float) $new_chargeback_info->premium;
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
