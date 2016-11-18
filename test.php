<?php
$bonus = '$1,200.00abcd%^&*()';
$bonus = preg_replace('/[^0-9.]+/ui', '', $bonus);

//echo $bonus."<hr />";

		// query last year commissions
		$ts = time();
		$start = strtotime('first day of January last year', $ts);
		$last_year = array(date('Y-m-d', $start), date('Y-m-d', strtotime('+12 months -1 day', $start)));
		
		// query last year to date
		$ts = time();
		$start = strtotime('first day of January last year', $ts);
		$last_ytd = array(date('Y-m-d', $start), date('Y-m-d', strtotime('today last year', $ts)));
		
		// query current year to date
		$ts = time();
		$start = strtotime('first day of January this year', $ts);
		$current_ytd = array(date('Y-m-d', $start), date('Y-m-d', strtotime('today', $ts)));
		
		// query last months commissions
		$ts = time();
	  	$start = strtotime('first day of previous month', $ts);
	  	$last_month = array(date('Y-m-d', $start), date('Y-m-d', strtotime('last day of this month', $start)));
	  	
	  	// query trailing 12 months
		$ts = time();
		$start = strtotime('today -1 year', $ts);
		$trailing_year = array(date('Y-m-d', $start), date('Y-m-d', strtotime('last day of +11 months', $start)));
		
		// query this month
		$ts = time();
	  	$start = strtotime('first day of this month', $ts);
	  	$this_month = array(date('Y-m-d', $start), date('Y-m-d', $start));
		

echo "last year =".print_r($last_year)."<br />";

echo "last YTD =".print_r($last_ytd)."<br />";

echo "current YTD =".print_r($current_ytd)."<br />";

echo "last month =".print_r($last_month)."<br />";	

echo "trailing 12 months =".print_r($trailing_year)."<br />";

echo "this month =".print_r($this_month)."<br />";


/*
$date_lastA = $last_year[0]." 00:00:00";
$date_lastB = $last_year[1]." 23:59:59";

echo "SELECT CASE policy_categories.parent_id WHEN 0 THEN policy_categories.id ELSE policy_categories.parent_id END AS id, policies.premium, policies.business_type_id, policies.renewal FROM policies, policy_categories WHERE policies.category_id = policy_categories.id AND policies.agency_id = 54 AND policies.user_id = 199 AND (policies.status = 1 OR policies.status = 2) AND (policies.date_written >= '".$date_lastA."' AND policies.date_written <= '".$date_lastB."');";
*/	  	
?>