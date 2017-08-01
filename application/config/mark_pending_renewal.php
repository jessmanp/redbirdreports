#!/usr/bin/php -f
<?php

try {
	/*** connect to the database ***/
	$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
	$dbh = new PDO('mysql:host=127.0.0.1;dbname=redbirdreports', 'redbird-app', 'r3db1rdR3ports', $options);

	$sql = "SELECT id, date_effective, length_type_id FROM policies WHERE category_id <= 25 AND status = 2 AND renewal = 0 AND date_effective IS NOT NULL;";
	$query = $dbh->prepare($sql);
	$query->execute();
	$result = $query->fetchAll();
	
	// setup array to hold ids that will be updated
	$ids = array();
	
	// mark renewals based on length and date anniversary (10 days prior)
	foreach ($result as $renewal_info) {
	
		if ($renewal_info->length_type_id == 1) {
			// if semi-annual set expire date
			$expire_date = strtotime($renewal_info->date_effective.'+6 months');
		} else if ($renewal_info->length_type_id == 2) {
			// if annual set expire date
			$expire_date = strtotime($renewal_info->date_effective.'+1 year');
		}
		// set prior 10 days from today
		$today = strtotime('today -10 days');
		// only update issued/expired
		if ($expire_date <= $today) {
			// update query to mark pending renewal
			$query_pending_renewal = $dbh->prepare("UPDATE policies SET renewal = 1, date_effective = '".date("Y-m-d h:m:s",$expire_date)."' WHERE id = ".$renewal_info->id.";");
			$query_pending_renewal->execute();
		}
		
	}
	
	echo "--- SUCCESS: RENEWALS MARKED ---\n\n";
	
}
catch(PDOException $e) {
	echo $e->getMessage();
}
catch(Exception $e) {
	echo $e->getMessage();
}

?>