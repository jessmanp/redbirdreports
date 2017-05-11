<?php

class PolicyEntryModel
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
     * Get all team members from database
     */
    public function getAllEmployees($agency_id)
    {
        $sql = "SELECT users.user_id, users.user_first_name, users.user_last_name FROM users, agencies_users WHERE users.user_active = 1 AND users.user_id = agencies_users.user_id AND agencies_users.agency_id = ".$agency_id." ORDER BY users.user_last_name";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    /**
     * Get Employee from database based on User ID
     */
    public function getEmployee($agency_id,$user_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT users.user_id,users.user_level,users.user_first_name,users.user_last_name,users.user_active FROM users, agencies, agencies_users WHERE agencies_users.user_id = users.user_id AND agencies_users.agency_id = agencies.id AND agencies.id = '.$agency_id.' AND users.user_active > 0 AND users.user_id = '.$user_id.' ORDER BY users.user_active DESC, users.user_last_name';
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetchAll();
    }

	/**
     * Get all policy categories from database
     */
    public function getAllCategories($category)
    {
		// set category
		switch ($category) {
    			case 'index':
        			$addedSQL = '';
        			break;
    			case 'all':
        			$addedSQL = '';
        			break;
    			case 'main':
        			$addedSQL = ' WHERE policy_categories.parent_id = 0';
        			break;
    			case 'auto':
        			$addedSQL = ' WHERE (policy_categories.id = 1 OR policy_categories.parent_id = 1)';
        			break;
    			case 'fire':
        			$addedSQL = ' WHERE (policy_categories.id = 9 OR policy_categories.parent_id = 9)';
        			break;
    			case 'life':
        			$addedSQL = ' WHERE (policy_categories.id = 26 OR policy_categories.parent_id = 26)';
        			break;
    			case 'health':
        			$addedSQL = ' WHERE (policy_categories.id = 40 OR policy_categories.parent_id = 40)';
        			break;
    			case 'deposit':
        			$addedSQL = ' WHERE (policy_categories.id = 50 OR policy_categories.parent_id = 50)';
        			break;
    			case 'loan':
        			$addedSQL = ' WHERE (policy_categories.id = 58 OR policy_categories.parent_id = 58)';
        			break;
    			case 'fund':
        			$addedSQL = ' WHERE (policy_categories.id = 70 OR policy_categories.parent_id = 70)';
        			break;
		}

        $sql = "SELECT policy_categories.id,policy_categories.parent_id,policy_categories.name FROM policy_categories".$addedSQL." ORDER BY policy_categories.id,policy_categories.parent_id,policy_categories.name";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	/**
     * Get all policy business types from database
     */
    public function getAllBusinessTypes()
    {
        $sql = "SELECT id,name FROM policy_business_types ORDER BY name";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	/**
     * Get all policy source types from database
     */
    public function getAllSourceTypes()
    {
        $sql = "SELECT id,name FROM policy_source_types ORDER BY name";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	/**
     * Get all policy length types from database
     */
    public function getAllLengthTypes()
    {
        $sql = "SELECT id,name FROM policy_length_types ORDER BY id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	/**
     * Add NEW policy in the database
     */
    public function addPolicy($agency_id,$first,$last,$desc,$prem,$notes,$pnum,$catr,$busi,$sold,$srct,$lent,$zip,$wdate,$edate)
    {
		// write new policy data into database
		$sql = "INSERT INTO policies (user_id, agency_id, first, last, description, category_id, premium, business_type_id, source_type_id, length_type_id, notes, policy_number, zip_code, date_written, date_effective) VALUES (:user_id, :agency_id, :first, :last, :description, :category_id, :premium, :business_type_id, :source_type_id, :length_type_id, :notes, :policy_number, :zip_code, :written_date, :effective_date)";
		$query_policy_insert = $this->db->prepare($sql);
		$query_policy_insert->bindValue(':user_id', $sold, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':first', $first, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':last', $last, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':description', $desc, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':category_id', $catr, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':premium', $prem, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':business_type_id', $busi, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':source_type_id', $srct, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':length_type_id', $lent, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':notes', $notes, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':policy_number', $pnum, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':zip_code', $zip, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':written_date', $wdate, PDO::PARAM_STR);
		if ($edate == '') {
			$query_policy_insert->bindValue(':effective_date', null, PDO::PARAM_NULL);
		} else {
			$query_policy_insert->bindValue(':effective_date', $edate, PDO::PARAM_STR);
		}
		$query_policy_insert->execute();

		if ($query_policy_insert) {
			return true;
		}
	}


	/**
     * Edit EXISTING policy in the database
     */
    public function updatePolicy($id,$stat,$first,$last,$desc,$prem,$notes,$pnum,$catr,$busi,$sold,$srct,$lent,$zip,$wdate,$idate,$edate,$cdate)
    {
		// write new policy data into database
		$sql = "UPDATE policies SET status = :status, user_id = :user_id, first = :first, last = :last, description = :description, category_id = :category_id, premium = :premium, business_type_id = :business_type_id, source_type_id = :source_type_id, length_type_id = :length_type_id, notes = :notes, policy_number = :policy_number, zip_code = :zip_code, date_written = :written_date, date_issued = :issued_date, date_effective = :effective_date, date_canceled = :canceled_date WHERE id = :id";
		$query_policy_update = $this->db->prepare($sql);
		$query_policy_update->bindValue(':id', $id, PDO::PARAM_INT);
		$query_policy_update->bindValue(':status', $stat, PDO::PARAM_INT);
		$query_policy_update->bindValue(':user_id', $sold, PDO::PARAM_INT);
		$query_policy_update->bindValue(':first', $first, PDO::PARAM_STR);
		$query_policy_update->bindValue(':last', $last, PDO::PARAM_STR);
		$query_policy_update->bindValue(':description', $desc, PDO::PARAM_STR);
		$query_policy_update->bindValue(':category_id', $catr, PDO::PARAM_INT);
		$query_policy_update->bindValue(':premium', $prem, PDO::PARAM_STR);
		$query_policy_update->bindValue(':business_type_id', $busi, PDO::PARAM_INT);
		$query_policy_update->bindValue(':source_type_id', $srct, PDO::PARAM_INT);
		$query_policy_update->bindValue(':length_type_id', $lent, PDO::PARAM_INT);
		$query_policy_update->bindValue(':notes', $notes, PDO::PARAM_STR);
		$query_policy_update->bindValue(':policy_number', $pnum, PDO::PARAM_STR);
		$query_policy_update->bindValue(':zip_code', $zip, PDO::PARAM_STR);
		$query_policy_update->bindValue(':written_date', $wdate, PDO::PARAM_STR);
		if ($idate == '') {
			$query_policy_update->bindValue(':issued_date', null, PDO::PARAM_NULL);
		} else {
			$query_policy_update->bindValue(':issued_date', $idate, PDO::PARAM_STR);
		}
		if ($edate == '') {
			$query_policy_update->bindValue(':effective_date', null, PDO::PARAM_NULL);
		} else {
			$query_policy_update->bindValue(':effective_date', $edate, PDO::PARAM_STR);
		}
		if ($cdate == '') {
			$query_policy_update->bindValue(':canceled_date', null, PDO::PARAM_NULL);
		} else {
			$query_policy_update->bindValue(':canceled_date', $cdate, PDO::PARAM_STR);
		}
		$query_policy_update->execute();

		if ($query_policy_update) {
			return true;
		}
	}
	
	/**
     * Insert history of premium change in the database
     */
    public function updatePremiumHistory($id,$premorg,$newpremdate)
    {
        $sql = "INSERT INTO policies_history (policy_id,oldpremium,newpremdate) VALUES (:id,:oldprem,:npremdate)";
        $query_insert_policy_history = $this->db->prepare($sql);
		$query_insert_policy_history->bindValue(':id', $id, PDO::PARAM_INT);
		$query_insert_policy_history->bindValue(':oldprem', $premorg, PDO::PARAM_STR);
		$query_insert_policy_history->bindValue(':npremdate', $newpremdate, PDO::PARAM_STR);
        $query_insert_policy_history->execute();

		if ($query_insert_policy_history) {
			return true;
		}
    }


    /**
     * Mark policy as NOT active in the database
     */
    public function deletePolicy($id)
    {
        $sql = "UPDATE policies SET active = 0 WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

		if ($query) {
			return true;
		}
    }

	 /**
     * Do Rewnewal Process, Add new record and Erase old one
     */
    public function renewPolicy($oldid,$agency_id)
    {
		// query old info and make a new policy
		$sql = "SELECT * FROM policies WHERE id = ".$oldid;
		$getoldquery = $this->db->prepare($sql);
		$getoldquery->execute();
		$olddata = $getoldquery->fetchAll();

	foreach ($olddata as $data) {
		$sold = $data->user_id;
		$first = $data->first;
		$last = $data->last;
		$desc = $data->description;
		$catr = $data->category_id;
		$prem = $data->premium;
		$busi = $data->business_type_id;
		$srct = $data->source_type_id;
		$lent = $data->length_type_id;
		$notes = $data->notes;
		$zip = $data->zip_code;
		$wdate = $data->date_written;
		$idate = $data->date_issued;
	}

		// write new policy data into database based on old info
		$sql = "INSERT INTO policies (agency_id, user_id, first, last, description, category_id, premium, business_type_id, source_type_id, length_type_id, notes, zip_code, date_written, date_issued) VALUES (:agency_id, :user_id, :first, :last, :description, :category_id, :premium, :business_type_id, :source_type_id, :length_type_id, :notes, :zip_code, :written_date, :issued_date)";
		$query_new_policy_insert = $this->db->prepare($sql);
		$query_new_policy_insert->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_new_policy_insert->bindValue(':user_id', $sold, PDO::PARAM_INT);
		$query_new_policy_insert->bindValue(':first', $first, PDO::PARAM_STR);
		$query_new_policy_insert->bindValue(':last', $last, PDO::PARAM_STR);
		$query_new_policy_insert->bindValue(':description', $desc, PDO::PARAM_STR);
		$query_new_policy_insert->bindValue(':category_id', $catr, PDO::PARAM_INT);
		$query_new_policy_insert->bindValue(':premium', $prem, PDO::PARAM_STR);
		$query_new_policy_insert->bindValue(':business_type_id', $busi, PDO::PARAM_INT);
		$query_new_policy_insert->bindValue(':source_type_id', $srct, PDO::PARAM_INT);
		$query_new_policy_insert->bindValue(':length_type_id', $lent, PDO::PARAM_INT);
		$query_new_policy_insert->bindValue(':notes', $notes, PDO::PARAM_STR);
		$query_new_policy_insert->bindValue(':zip_code', $zip, PDO::PARAM_STR);
		$query_new_policy_insert->bindValue(':written_date', $wdate, PDO::PARAM_STR);
		$query_new_policy_insert->bindValue(':issued_date', $idate, PDO::PARAM_STR);
		$query_new_policy_insert->execute();
		
		if ($query_new_policy_insert) {

			// id of new policy
			$newpid = $this->db->lastInsertId();

			// delete old policy
			$sql = "UPDATE policies SET active = 0 WHERE id = ".$oldid;
			$query = $this->db->prepare($sql);
			$query->execute();

			// put data into an array to pass back to ajax
			// query to get new policy data
			$query_get_renewal = $this->db->prepare("SELECT * FROM policies WHERE id = ".$newpid);
			$query_get_renewal->execute();
			return $query_get_renewal->fetchAll();
		}


    }

	 /**
     * Do Reinstatement Process, clear canceled date
     */
    public function reinstatePolicy($oldid)
    {

		// set old policy to normal by clearing the cancel date, change status to issued
		$sql = "UPDATE policies SET status = 2, date_canceled = null WHERE id = ".$oldid;
		$query = $this->db->prepare($sql);
		$query->execute();

		// query old info
		$sql = "SELECT policies.*, policy_categories.parent_id AS cat_pid FROM policies, policy_categories WHERE policy_categories.id = policies.category_id AND policies.id = ".$oldid;
		$getoldquery = $this->db->prepare($sql);
		$getoldquery->execute();
		return $getoldquery->fetchAll();

    }
    
    /**
     * Update new premium on renewal policy
     */
    public function renewSavePolicy($id,$prem)
    {
    	// get issued date
    	$presql = 'SELECT length_type_id,date_issued FROM policies WHERE id = '.$id;
        $prequery = $this->db->prepare($presql);
       	$prequery->execute();
       	$getli = $prequery->fetchAll();
       	
       	$policyLength = $getli[0]->length_type_id;
       	$issuedDate = $getli[0]->date_issued;
       	
    	// update effective date = issued date + policy length (anniversary date), then update the canceled date
    	if ($issuedDate) {
    		// calculate end date
    		if ($policyLength == 1) {
    			$effectiveDate = date('Y-m-d h:m:s', strtotime('+6 months', strtotime($issuedDate)));
    		} else if ($policyLength == 2) {
    			$effectiveDate = date('Y-m-d h:m:s', strtotime('+12 months', strtotime($issuedDate)));
    		}
    	}
    	
    	if (isset($effectiveDate)) {
    	
    		// update business_type_id = 5 (Renewal), then update the premium
			$sql = "UPDATE policies SET premium = :premium, business_type_id = :business_type_id, date_effective = :date_effective WHERE id = :id";
			$query = $this->db->prepare($sql);
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			$query->bindValue(':business_type_id', 5, PDO::PARAM_INT);
			$query->bindValue(':premium', $prem, PDO::PARAM_STR);
			$query->bindValue(':date_effective', $effectiveDate, PDO::PARAM_STR);
			$query->execute();
			
    	} else {
    	
			// update business_type_id = 5 (Renewal), then update the premium
			$sql = "UPDATE policies SET premium = :premium, business_type_id = :business_type_id WHERE id = :id";
			$query = $this->db->prepare($sql);
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			$query->bindValue(':business_type_id', 5, PDO::PARAM_INT);
			$query->bindValue(':premium', $prem, PDO::PARAM_STR);
			$query->execute();
        
        }
        
		if ($query) {
			return true;
		}
    }
    
    /**
     * Update new cancel date on renewal policy
     */
    public function renewCancelPolicy($id,$canceldate)
    {
    	// update canceled date to cancel policy and set renewal = 0
        $sql = "UPDATE policies SET status = :status, renewal = :renewal, date_canceled = :date_canceled WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':renewal', 0, PDO::PARAM_INT);
        $query->bindValue(':status', 4, PDO::PARAM_INT);
		$query->bindValue(':date_canceled', $canceldate, PDO::PARAM_STR);
        $query->execute();
        
		if ($query) {
			return true;
		}
    }


}
