<?php

class FilesModel
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
     * Insert Files
     */
    public function insertFiles($agency_id, $title, $filename)
    {
		// write new files data into database
    		$query_insert_file = $this->db->prepare('INSERT INTO files (agency_id, title, filename, upload_datetime) VALUES(:agency_id, :title, :filename, now())');
		$query_insert_file->bindValue(':agency_id', $agency_id, PDO::PARAM_STR);
		$query_insert_file->bindValue(':title', $title, PDO::PARAM_STR);
		$query_insert_file->bindValue(':filename', $filename, PDO::PARAM_STR);
		$query_insert_file->execute();
	}

// EOF
}
