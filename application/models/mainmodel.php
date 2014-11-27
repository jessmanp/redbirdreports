<?php

class MainModel
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
     * Get Agency ID from database based on Owner ID
     */
    public function getHeaderInfo($user_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT agencies.agency_name, users.user_first_name, users.user_last_name FROM agencies, agencies_users, users WHERE agencies.id = agencies_users.agency_id AND agencies_users.user_id = users.user_id AND agencies_users.user_id = '.$user_id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

}