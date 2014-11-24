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
     * Get all policies from database
     */
    public function getAllPolicies()
    {
        $sql = "SELECT policies.id, policies.first, policies.last, policies.description, policy_categories.name AS cat_name, policies.premium, policy_business_types.name AS busi_name, users.user_first_name, users.user_last_name, policy_source_types.name AS src_name, policy_length_types.name AS len_name, policies.notes, policies.date_written, policies.date_issued, policies.date_effective FROM policies, policy_categories, policy_business_types, policy_source_types, policy_length_types, users WHERE policies.active = 1 AND policy_categories.id = policies.category_id AND policy_business_types.id = policies.business_type_id AND users.user_id = policies.user_id AND policy_source_types.id = policies.source_type_id AND policy_length_types.id = policies.length_type_id ORDER BY policies.date_written, policies.last";
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
