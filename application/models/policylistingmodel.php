<?php

class PolicyListingModel
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
     * Get ALL policies from database
     */
    public function getAllPolicies($category = 'all', $orderby = 'default', $status = '', $date = '', $phrase = '')
    {

//echo "category=[".$category."] orderby=[".$orderby."] status=[".$status."] date=[".$date."] phrase=[".$phrase."]\n<hr />";

		// set category
		switch ($category) {
    			case 'all':
        			$addedSQL = '';
        			break;
    			case 'auto':
        			$addedSQL = ' AND (policy_categories.id = 1 OR policy_categories.parent_id = 1)';
        			break;
    			case 'fire':
        			$addedSQL = ' AND (policy_categories.id = 9 OR policy_categories.parent_id = 9)';
        			break;
    			case 'life':
        			$addedSQL = ' AND (policy_categories.id = 26 OR policy_categories.parent_id = 26)';
        			break;
    			case 'health':
        			$addedSQL = ' AND (policy_categories.id = 40 OR policy_categories.parent_id = 40)';
        			break;
    			case 'deposit':
        			$addedSQL = ' AND (policy_categories.id = 58 OR policy_categories.parent_id = 58)';
        			break;
    			case 'loan':
        			$addedSQL = ' AND (policy_categories.id = 50 OR policy_categories.parent_id = 50)';
        			break;
    			case 'fund':
        			$addedSQL = ' AND (policy_categories.id = 70 OR policy_categories.parent_id = 70)';
        			break;
		}

		if ($status != '') {
			// set status filter
			switch ($status) {
    				case 'written':
        				$addedSQL .= ' AND policies.renewal = 0 AND policies.date_written IS NOT null';
        				break;
    				case 'notissued':
        				$addedSQL .= ' AND policies.renewal = 0 AND policies.date_issued IS null';
        				break;
    				case 'renewal':
        				$addedSQL .= ' AND policies.renewal = 1';
        				break;
			}
		}

		if ($date != '' && $date != 'any') {
			// break out and validate date range
			$drange = explode('.',$date);

			$sdate = $drange[0];
			$edate = $drange[1];
			$single = $drange[2];
			
			$test_sdate = explode('-',$sdate);
			$test_edate = explode('-',$edate);
			if (checkdate($test_sdate[0], $test_sdate[1], $test_sdate[2]) && checkdate($test_edate[0], $test_edate[1], $test_edate[2])) {
				// date range is valid, set date filter
				$startDate = $test_sdate[2]."-".$test_sdate[0]."-".$test_sdate[1]." 00:00:00";
				$endDate = $test_edate[2]."-".$test_edate[0]."-".$test_edate[1]." 23:59:59";
				if ($single == 'w') {
					$addedSQL .= " AND (policies.date_written >= '".$startDate."' AND policies.date_written <= '".$endDate."')";
				} else if ($single == 'i') {
					$addedSQL .= " AND (policies.date_issued >= '".$startDate."' AND policies.date_issued <= '".$endDate."')";
				} else if ($single == 'e') {
					$addedSQL .= " AND (policies.date_effective >= '".$startDate."' AND policies.date_effective <= '".$endDate."')";
				} else {
					$addedSQL .= " AND (policies.date_written >= '".$startDate."' AND policies.date_written <= '".$endDate."' OR policies.date_issued >= '".$startDate."' AND policies.date_issued <= '".$endDate."' OR policies.date_effective >= '".$startDate."' AND policies.date_effective <= '".$endDate."')";
				}
			}
		}

		if ($phrase != '') {
			// search based on keywords
			$addedSQL .= " AND (policies.first LIKE '%".$phrase."%' OR policies.last LIKE '%".$phrase."%' OR policies.description LIKE '%".$phrase."%' OR policies.notes LIKE '%".$phrase."%')";
		}

		// set order by
		switch ($orderby) {
    			case 'default':
        			$orderbySQL = ' policies.date_written, policies.last';
        			break;
    			case 'firstname':
        			$orderbySQL = ' policies.first ASC';
        			break;
			case 'firstnamedesc':
        			$orderbySQL = ' policies.first DESC';
        			break;
    			case 'lastname':
        			$orderbySQL = ' policies.last ASC';
        			break;
    			case 'lastnamedesc':
        			$orderbySQL = ' policies.last DESC';
        			break;
    			case 'description':
        			$orderbySQL = ' policies.description ASC';
        			break;
    			case 'descriptiondesc':
        			$orderbySQL = ' policies.description DESC';
        			break;
    			case 'category':
        			$orderbySQL = ' policy_categories.name ASC';
        			break;
    			case 'categorydesc':
        			$orderbySQL = ' policy_categories.name DESC';
        			break;
    			case 'premium':
        			$orderbySQL = ' policies.premium ASC';
        			break;
    			case 'premiumdesc':
        			$orderbySQL = ' policies.premium DESC';
        			break;
    			case 'type':
        			$orderbySQL = ' policy_business_types.name ASC';
        			break;
    			case 'typedesc':
        			$orderbySQL = ' policy_business_types.name DESC';
        			break;
    			case 'soldby':
        			$orderbySQL = ' users.user_last_name ASC';
        			break;
    			case 'soldbydesc':
        			$orderbySQL = ' users.user_last_name DESC';
        			break;
    			case 'source':
        			$orderbySQL = ' policy_source_types.name ASC';
        			break;
    			case 'sourcedesc':
        			$orderbySQL = ' policy_source_types.name DESC';
        			break;
    			case 'length':
        			$orderbySQL = ' policy_length_types.name ASC';
        			break;
    			case 'lengthdesc':
        			$orderbySQL = ' policy_length_types.name DESC';
        			break;
    			case 'written':
        			$orderbySQL = ' policies.date_written ASC';
        			break;
    			case 'writtendesc':
        			$orderbySQL = ' policies.date_written DESC';
        			break;
    			case 'issued':
        			$orderbySQL = ' policies.date_issued ASC';
        			break;
    			case 'issueddesc':
        			$orderbySQL = ' policies.date_issued DESC';
        			break;
    			case 'effective':
        			$orderbySQL = ' policies.date_effective ASC';
        			break;
    			case 'effectivedesc':
        			$orderbySQL = ' policies.date_effective DESC';
        			break;
		}

//echo "add=[".$addedSQL."] sort=[".$orderbySQL."]";
		
		$sql = "SELECT policies.id, policies.renewal, policies.first, policies.last, policies.description, policies.category_id, policy_categories.name AS cat_name, policies.premium, policies.business_type_id, policy_business_types.name AS busi_name, policies.user_id, users.user_first_name, users.user_last_name, policies.source_type_id, policy_source_types.name AS src_name, policies.length_type_id, policy_length_types.name AS len_name, policies.notes, policies.date_written, policies.date_issued, policies.date_effective, policies.zip_code FROM policies, policy_categories, policy_business_types, policy_source_types, policy_length_types, users WHERE policies.active = 1 AND policy_categories.id = policies.category_id AND policy_business_types.id = policies.business_type_id AND users.user_id = policies.user_id AND policy_source_types.id = policies.source_type_id AND policy_length_types.id = policies.length_type_id".$addedSQL." ORDER BY".$orderbySQL;
//echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

}