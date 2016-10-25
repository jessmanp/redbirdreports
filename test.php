<?php

		// query last year commissions
		$ts = time();
		$start = strtotime('first day of -1 years', $ts);
		$last_year = array(date('m-d-Y', $start), date('m-d-Y', strtotime('+13 months -1 day', $start)));
		
		// query last year to date
		$ts = time();
		$start = strtotime('-2 years', $ts);
		$last_ytd = array(date('m-d-Y', $start), date('m-d-Y', strtotime('+12 months', $start)));
		
		// query current year to date
		$ts = time();
		$start = strtotime('-1 years', $ts);
		$current_ytd = array(date('m-d-Y', $start), date('m-d-Y', strtotime('+12 months', $start)));
		
		// query last months commissions
		$ts = time();
	  	$start = strtotime('first day of previous month', $ts);
	  	$last_month = array(date('m-d-Y', $start), date('m-d-Y', strtotime('last day of this month', $start)));

echo "last year =".print_r($last_year)."<br />";

echo "last YTD =".print_r($last_ytd)."<br />";

echo "current YTD =".print_r($current_ytd)."<br />";

echo "last month =".print_r($last_month)."<br />";	  	
	  	
?>