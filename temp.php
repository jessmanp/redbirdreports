<?php
//header('Location: /'); exit();

/* CONNECT TO DATABASE */
$dbh = new PDO("mysql:host=127.0.0.1;dbname=redbirdreports", "redbird-app", "r3db1rdR3ports", array(PDO::ATTR_PERSISTENT => true,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$emp_id = 10001;
		$fields = array('status','renewal','reinstate','old_user_id','first','last','description','category_id','premium','business_type_id','source_type_id','length_type_id','notes','policy_number','zip_code','date_written','date_issued','date_effective','date_canceled');
		$filename = "73b1ee9adcb5fa02f228fb8456559a28.csv";
		$pickup_dir = "/var/www/html/dev.redbirdreports.com/files/";
		/* Map Rows and Loop Through Them */
		$rows = array_map('str_getcsv', file($pickup_dir.$filename));
		$header = array_shift($rows);
		if ($header == $fields) {
			$importDate = date("Y-m-d H:i:s", time());
			array_unshift($header,'user_id');
			array_push($header,'date_imported');
			$csv = array();
			foreach($rows as $row) {
				array_unshift($row,$emp_id);
				array_push($row,$importDate);
				$csv[] = array_combine($header,$row);
			}
		}

foreach ($csv as $info) {
	echo "{".count($info)."}<br />\n";
	foreach ($info as $col=>$val) {
		echo ":".$col.",".$val."<br />\n";
	}
	echo "<hr />\n";
}
		
echo "@@@<br /><pre>";
print_r($fields);
echo "\n\n----------------------------------------------------------\n\n";
print_r($header);
echo "\n\n----------------------------------------------------------\n\n";
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