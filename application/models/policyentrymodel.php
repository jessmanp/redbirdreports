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
     * Get Agency ID from database based on Logged in User
     */
    public function getAgencyID($user_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT agency_id FROM agencies_users WHERE agencies_users.user_id = '.$user_id;
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetch()->agency_id;
    }

	/**
     * Get all team members from database
     */
    public function getAllEmployees($agency_id)
    {
        $sql = "SELECT users.user_id, users.user_first_name, users.user_last_name FROM users, agencies_users WHERE users.user_id = agencies_users.user_id AND agencies_users.agency_id = ".$agency_id." ORDER BY users.user_last_name";
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
        			$addedSQL = ' WHERE (policy_categories.id = 58 OR policy_categories.parent_id = 58)';
        			break;
    			case 'loan':
        			$addedSQL = ' WHERE (policy_categories.id = 50 OR policy_categories.parent_id = 50)';
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
        $sql = "SELECT id,name FROM policy_length_types ORDER BY name";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	/**
     * Mark policy as NOT active in the database
     */
    public function addPolicy($first,$last,$desc,$prem,$notes,$catr,$busi,$sold,$srct,$lent,$zip)
    {
		// write new policy data into database
		$sql = "INSERT INTO policies (user_id, first, last, description, category_id, premium, business_type_id, source_type_id, length_type_id, notes, zip_code, date_written) VALUES (:user_id, :first, :last, :description, :category_id, :premium, :business_type_id, :source_type_id, :length_type_id, :notes, :zip_code, now())";
		$query_policy_insert = $this->db->prepare($sql);
		$query_policy_insert->bindValue(':user_id', $sold, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':first', $first, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':last', $last, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':description', $desc, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':category_id', $catr, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':premium', $prem, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':business_type_id', $busi, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':source_type_id', $srct, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':length_type_id', $lent, PDO::PARAM_INT);
		$query_policy_insert->bindValue(':notes', $notes, PDO::PARAM_STR);
		$query_policy_insert->bindValue(':zip_code', $zip, PDO::PARAM_STR);
		$query_policy_insert->execute();

		if ($query_policy_insert) {
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


}
