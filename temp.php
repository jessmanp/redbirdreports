<?php
//header('Location: /'); exit();

/* CONNECT TO DATABASE */
$dbh = new PDO("mysql:host=127.0.0.1;dbname=redbirdreports", "redbird-app", "r3db1rdR3ports", array(PDO::ATTR_PERSISTENT => true,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		$fields = array('curDate','policyID','status','pendingRenewal','agencyID','userID','oldUserID','firstName','secondName','description','premium','categoryID','businessTypeID','sourceTypeID','lenghtTypeID','notes','policyNumber','zipCode','dateWritten','dateIssued','dateEffective','dateCanceled','dateModified','oldPremiumAmount','dateRenewed');
		$filename = "cdb9a7ae37c4d2027ed31ac940a57b00.csv";
		$pickup_dir = "/var/www/html/dev.redbirdreports.com/files/";
		/* Map Rows and Loop Through Them */
		$rows = array_map('str_getcsv', file($pickup_dir.$filename));
		$header = array_shift($rows);
		if ($header == $fields) {
			$csv = array();
			foreach($rows as $row) {
				$csv[] = array_combine($header,$row);
			}
		}
		
		
echo "@@@<pre>";
print_r($header);
print_r($csv);
echo "</pre>";		


exit();





$sql = "SELECT * FROM users ORDER BY user_id DESC;";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$allusers = $stmt->fetchAll();



echo '<h1>DEVELOPMENT SERVER USERS</h1>';
echo '<table cellpadding="5" cellspacing="5" border="1">';
echo '<tr><td><strong>USERNAME</strong></td><td><strong>FIRST</strong></td><td><strong>LAST</strong></td><td><strong>EMAIL</strong></td><td>&nbsp;</td></tr>';


foreach ($allusers as $user) {

	echo "<tr><td>".$user['user_name']."</td><td>".$user['user_first_name']."</td><td>".$user['user_last_name']."</td><td>".$user['user_email'].'</td><td><input type="button" value="DELETE" onclick="javascript:location.href=\'temp.php?id='.$user['user_id'].'\';" /></td></tr>';

}

echo '</table><br /><br /><br /><br />';

?>