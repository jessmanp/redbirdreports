<?php

class DashboardModel
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
     * Query dashboard data to populate charts
     */
    public function getDashChartInfo($agency_id,$employee_id,$dateA,$dateB,$dateC,$dateD,$date_range)
    {
    	// setup default array
    	$all_policies = array();
    	
    	if ($dateC == 0 && $dateD == 0 ) {
			// get policies based on month
			if ($employee_id != 0) {
				$query_get_policies_month = $this->db->prepare("SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS category_id, policies.source_type_id AS source_id, policies.premium FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND active = 1 AND agency_id = :agency_id AND user_id = :user_id AND (date_written >= :date_a AND date_written <= :date_b);");
			} else {
				$query_get_policies_month = $this->db->prepare("SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS category_id, policies.source_type_id AS source_id, policies.premium FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND active = 1 AND agency_id = :agency_id AND (date_written >= :date_a AND date_written <= :date_b);");
			}
			$query_get_policies_month->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
			if ($employee_id != 0) {
				$query_get_policies_month->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
			}
			$query_get_policies_month->bindValue(':date_a', $dateA, PDO::PARAM_STR);
			$query_get_policies_month->bindValue(':date_b', $dateB, PDO::PARAM_STR);
			$query_get_policies_month->execute();
			$month_policies_query = $query_get_policies_month->fetchAll();
			$policy_month_count = $query_get_policies_month->rowCount();
			$all_policies = array();
			if ($policy_month_count > 0) {
				foreach($month_policies_query as $mp) {
					$all_policies[] = $mp;
				}
			}
		} else {
			// get policies based on year
			if ($employee_id != 0) {
				$query_get_policies_year = $this->db->prepare("SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS category_id, policies.source_type_id AS source_id, policies.premium FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND active = 1 AND agency_id = :agency_id AND user_id = :user_id AND (date_written >= :date_a AND date_written <= :date_d);");
			} else {
				$query_get_policies_year = $this->db->prepare("SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS category_id, policies.source_type_id AS source_id, policies.premium FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND active = 1 AND agency_id = :agency_id AND (date_written >= :date_a AND date_written <= :date_d);");
			}
			$query_get_policies_year->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
			if ($employee_id != 0) {
				$query_get_policies_year->bindValue(':user_id', $employee_id, PDO::PARAM_INT);
			}
			$query_get_policies_year->bindValue(':date_a', $dateA, PDO::PARAM_STR);
			$query_get_policies_year->bindValue(':date_d', $dateD, PDO::PARAM_STR);
			$query_get_policies_year->execute();
			$year_policies_query = $query_get_policies_year->fetchAll();
			$policy_year_count = $query_get_policies_year->rowCount();
			if ($policy_year_count > 0) {
				foreach($year_policies_query as $yp) {
					$all_policies[] = $yp;
				}
			}
		}	
		
		/*
		Auto = [0] 		Fire = [1] 		Life = [2] 		Health = [3] 		Loan = [4] 		Deposit = [5] 		Mutual Fund = [6]
 		*/
 		$policy_chart = array();
		$policy_chart[0] = 0;
		$policy_chart[1] = 0;
		$policy_chart[2] = 0;
		$policy_chart[3] = 0;
		$policy_chart[4] = 0;
		$policy_chart[5] = 0;
		$policy_chart[6] = 0;
		
		// setup policy count array
		foreach ($all_policies as $policy_info) {
			// count auto policy
			if ($policy_info->category_id == 1) {
				$policy_chart[0] = (float) $policy_chart[0]+1;
			}
			// count fire policy
			if ($policy_info->category_id == 9) {
				$policy_chart[1] = (float) $policy_chart[1]+1;
			}
			// count life policy
			if ($policy_info->category_id == 26) {
				$policy_chart[2] = (float) $policy_chart[2]+1;
			}
			// count health policy
			if ($policy_info->category_id == 40) {
				$policy_chart[3] = (float) $policy_chart[3]+1;
			}
			// count loan policy
			if ($policy_info->category_id == 50) {
				$policy_chart[4] = (float) $policy_chart[4]+1;
			}
			// count deposit policy
			if ($policy_info->category_id == 58) {
				$policy_chart[5] = (float) $policy_chart[5]+1;
			}
			// count fund policy
			if ($policy_info->category_id == 70) {
				$policy_chart[6] = (float) $policy_chart[6]+1;
			}
		}
		
		$policy_chart_premium = array();
		$policy_chart_premium[0] = 0;
		$policy_chart_premium[1] = 0;
		$policy_chart_premium[2] = 0;
		$policy_chart_premium[3] = 0;
		$policy_chart_premium[4] = 0;
		$policy_chart_premium[5] = 0;
		$policy_chart_premium[6] = 0;
		
		// setup policy premium array
		foreach ($all_policies as $policy_info) {
			// calculate auto policy
			if ($policy_info->category_id == 1) {
				$policy_chart_premium[0] = (float) $policy_chart_premium[0]+$policy_info->premium;
			}
			// calculate fire policy
			if ($policy_info->category_id == 9) {
				$policy_chart_premium[1] = (float) $policy_chart_premium[1]+$policy_info->premium;
			}
			// calculate life policy
			if ($policy_info->category_id == 26) {
				$policy_chart_premium[2] = (float) $policy_chart_premium[2]+$policy_info->premium;
			}
			// calculate health policy
			if ($policy_info->category_id == 40) {
				$policy_chart_premium[3] = (float) $policy_chart_premium[3]+$policy_info->premium;
			}
			// calculate loan policy
			if ($policy_info->category_id == 50) {
				$policy_chart_premium[4] = (float) $policy_chart_premium[4]+$policy_info->premium;
			}
			// calculate deposit policy
			if ($policy_info->category_id == 58) {
				$policy_chart_premium[5] = (float) $policy_chart_premium[5]+$policy_info->premium;
			}
			// calculate fund policy
			if ($policy_info->category_id == 70) {
				$policy_chart_premium[6] = (float) $policy_chart_premium[6]+$policy_info->premium;
			}
		}
		
 		
 		/*
		Internet,=,[0],		Referral,=,[1],		Call,In,=,[2],		Walk,In,=,[3],		Direct,Mail,=,[4],		Networking,=,[5],		Cold,Call,=,[6],		Other,=,[7]
 		*/
		$source_chart = array();
		$source_chart[0] = 0;
		$source_chart[1] = 0;
		$source_chart[2] = 0;
		$source_chart[3] = 0;
		$source_chart[4] = 0;
		$source_chart[5] = 0;
		$source_chart[6] = 0;
		$source_chart[7] = 0;
		
		// setup source count array
		foreach ($all_policies as $source_info) {
			// count internet source
			if ($source_info->source_id == 1) {
				$source_chart[0] = (float) $source_chart[0]+1;
			}
			// count referral source
			if ($source_info->source_id == 2) {
				$source_chart[1] = (float) $source_chart[1]+1;
			}
			// count call in source
			if ($source_info->source_id == 3) {
				$source_chart[2] = (float) $source_chart[2]+1;
			}
			// count walk in source
			if ($source_info->source_id == 4) {
				$source_chart[3] = (float) $source_chart[3]+1;
			}
			// count direct mail source
			if ($source_info->source_id == 5) {
				$source_chart[4] = (float) $source_chart[4]+1;
			}
			// count networking source
			if ($source_info->source_id == 6) {
				$source_chart[5] = (float) $source_chart[5]+1;
			}
			// count cold call source
			if ($source_info->source_id == 8) {
				$source_chart[6] = (float) $source_chart[6]+1;
			}
			// count other source
			if ($source_info->source_id == 9) {
				$source_chart[7] = (float) $source_chart[7]+1;
			}
		}
		
		$source_chart_premium = array();
		$source_chart_premium[0] = 0;
		$source_chart_premium[1] = 0;
		$source_chart_premium[2] = 0;
		$source_chart_premium[3] = 0;
		$source_chart_premium[4] = 0;
		$source_chart_premium[5] = 0;
		$source_chart_premium[6] = 0;
		$source_chart_premium[7] = 0;

		// setup source count array
		foreach ($all_policies as $source_info) {
			// count internet source
			if ($source_info->source_id == 1) {
				$source_chart_premium[0] = (float) $source_chart_premium[0]+$source_info->premium;
			}
			// count referral source
			if ($source_info->source_id == 2) {
				$source_chart_premium[1] = (float) $source_chart_premium[1]+$source_info->premium;
			}
			// count call in source
			if ($source_info->source_id == 3) {
				$source_chart_premium[2] = (float) $source_chart_premium[2]+$source_info->premium;
			}
			// count walk in source
			if ($source_info->source_id == 4) {
				$source_chart_premium[3] = (float) $source_chart_premium[3]+$source_info->premium;
			}
			// count direct mail source
			if ($source_info->source_id == 5) {
				$source_chart_premium[4] = (float) $source_chart_premium[4]+$source_info->premium;
			}
			// count networking source
			if ($source_info->source_id == 6) {
				$source_chart_premium[5] = (float) $source_chart_premium[5]+$source_info->premium;
			}
			// count cold call source
			if ($source_info->source_id == 8) {
				$source_chart_premium[6] = (float) $source_chart_premium[6]+$source_info->premium;
			}
			// count other source
			if ($source_info->source_id == 9) {
				$source_chart_premium[7] = (float) $source_chart_premium[7]+$source_info->premium;
			}
		}
		
		$dash_summary[0]['ppolicy_chart'] = $policy_chart;
		$dash_summary[0]['psource_chart'] = $source_chart;
		$dash_summary[0]['mpolicy_chart'] = $policy_chart_premium;
		$dash_summary[0]['msource_chart'] = $source_chart_premium;
		
		if (!empty($dash_summary)) {
			return $dash_summary;
		}
		
		return false;
		
    }
	

// EOF
}