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
        $sql = "SELECT users.user_id, users.user_first_name, users.user_last_name FROM users, agencies_users WHERE users.user_id = agencies_users.user_id AND agencies_users.agency_id = ".$agency_id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


	/**
     * Get all policy categories from database
     */
    public function getAllCategories($category_id)
    {
        $sql = "SELECT id,name FROM policy_categories WHERE id = ".$category_id." OR parent_id = ".$category_id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	/**
     * Get all policy business types from database
     */
    public function getAllBusinessTypes()
    {
        $sql = "SELECT id,name FROM policy_business_types";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	/**
     * Get all policy source types from database
     */
    public function getAllSourceTypes()
    {
        $sql = "SELECT id,name FROM policy_source_types";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	/**
     * Get all policy length types from database
     */
    public function getAllLengthTypes()
    {
        $sql = "SELECT id,name FROM policy_length_types";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }








    /**
     * Add a song to database
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        // clean the input from javascript code for example
        $artist = strip_tags($artist);
        $track = strip_tags($track);
        $link = strip_tags($link);

        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':artist' => $artist, ':track' => $track, ':link' => $link));
    }


}
