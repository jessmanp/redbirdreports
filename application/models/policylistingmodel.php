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
    public function getAllPolicies($category = 'all', $orderby = 'default')
    {
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

		// set order by
		switch ($orderby) {
    			case 'default':
        			$orderbySQL = ' policies.date_written, policies.last';
        			break;
    			case 'firstname':
        			$orderbySQL = ' policies.first';
        			break;
    			case 'lastname':
        			$orderbySQL = ' policies.last';
        			break;
    			case 'description':
        			$orderbySQL = ' policies.description';
        			break;
    			case 'category':
        			$orderbySQL = ' policy_categories.name';
        			break;
    			case 'premium':
        			$orderbySQL = ' policies.premium';
        			break;
    			case 'type':
        			$orderbySQL = ' policy_business_types.name';
        			break;
    			case 'soldby':
        			$orderbySQL = ' users.user_last_name';
        			break;
    			case 'source':
        			$orderbySQL = ' policy_source_types.name';
        			break;
    			case 'length':
        			$orderbySQL = ' policy_length_types.name';
        			break;
    			case 'written':
        			$orderbySQL = ' policies.date_written';
        			break;
    			case 'issued':
        			$orderbySQL = ' policies.date_issued';
        			break;
    			case 'effective':
        			$orderbySQL = ' policies.date_effective';
        			break;
		}
		
		$sql = "SELECT policies.id, policies.first, policies.last, policies.description, policy_categories.name AS cat_name, policies.premium, policy_business_types.name AS busi_name, users.user_first_name, users.user_last_name, policy_source_types.name AS src_name, policy_length_types.name AS len_name, policies.notes, policies.date_written, policies.date_issued, policies.date_effective FROM policies, policy_categories, policy_business_types, policy_source_types, policy_length_types, users WHERE policies.active = 1 AND policy_categories.id = policies.category_id AND policy_business_types.id = policies.business_type_id AND users.user_id = policies.user_id AND policy_source_types.id = policies.source_type_id AND policy_length_types.id = policies.length_type_id".$addedSQL." ORDER BY".$orderbySQL;
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

  
    /**
     * Delete a policy in the database
     */
    public function deletePolicy($policy_id)
    {
		$sql = "UPDATE policies SET active = 0 WHERE id = :policy_id";
		$query_delete_policy = $this->db->prepare($sql);
		$query_delete_policy->bindValue(':policy_id', $policy_id, PDO::PARAM_INT);
		$query_delete_policy->execute();
    }

}