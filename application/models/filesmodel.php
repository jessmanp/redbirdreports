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
     * Insert File(s)
     */
    public function insertFiles($agency_id, $title, $filename)
    {
    	// validate file for policy import
    	$pickup_dir = FILE_UPLOAD_PATH;
		// map field names
		$fields = array('status','renewal','reinstate','old_user_id','first','last','description','category_id','premium','business_type_id','source_type_id','length_type_id','notes','policy_number','zip_code','date_written','date_issued','date_effective','date_canceled');
		$filestr = file_get_contents($pickup_dir.$filename);
		$rows = array_map("str_getcsv", preg_split('/\R/',$filestr));
		$header = array_shift($rows);
		if ($header == $fields) {
			$policy = 1;
		} else {
    		$policy = 0;
    	}
		// write new files data into database
    	$query_insert_file = $this->db->prepare('INSERT INTO files (agency_id, title, filename, policy, upload_datetime) VALUES(:agency_id, :title, :filename, :policy, now())');
		$query_insert_file->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_insert_file->bindValue(':title', $title, PDO::PARAM_STR);
		$query_insert_file->bindValue(':filename', $filename, PDO::PARAM_STR);
		$query_insert_file->bindValue(':policy', $policy, PDO::PARAM_INT);
		$query_insert_file->execute();
	}
	
	/**
     * Delete File
     */
    public function deleteFile($agency_id, $file_id)
    {
    	// GET FILENAME
        $query = $this->db->prepare('SELECT filename FROM files WHERE agency_id = :agency_id AND id = :id');
        $query->bindValue(':id', $file_id, PDO::PARAM_INT);
        $query->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query->execute();
		$filename = $query->fetch()->filename;
    	$pickup_dir = FILE_UPLOAD_PATH;
    	// delete actual file on server
		unlink($pickup_dir.$filename);
		// remove file record from database
    	$query_delete_file = $this->db->prepare('DELETE FROM files WHERE agency_id = :agency_id AND id = :id');
		$query_delete_file->bindValue(':id', $file_id, PDO::PARAM_INT);
		$query_delete_file->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_delete_file->execute();
	}
	
	/**
     * Import File
     */
    public function importFile($agency_id, $file_id, $emp_id)
    {
    	if (is_numeric($file_id) && is_numeric($emp_id)) {
			// VALIDATE FIELDS
			$fields = array('status','renewal','reinstate','old_user_id','first','last','description','category_id','premium','business_type_id','source_type_id','length_type_id','notes','policy_number','zip_code','date_written','date_issued','date_effective','date_canceled');
			// GET FILENAME
			$query = $this->db->prepare('SELECT filename FROM files WHERE agency_id = :agency_id AND id = :id');
			$query->bindValue(':id', $file_id, PDO::PARAM_INT);
			$query->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
			$query->execute();
			$filename = $query->fetch()->filename;
			$pickup_dir = FILE_UPLOAD_PATH;
			// load actual file on server into array
			$filestr = file_get_contents($pickup_dir.$filename);
			$rows = array_map("str_getcsv", preg_split('/\R/',$filestr));
			$header = array_shift($rows);
			if ($header == $fields) {
				$csv = array();
				foreach($rows as $row) {
					$csv[] = array_combine($header,$row);
				}
			}
			// loop over array and insert records using agency id and employee id
			return false;
			
			// delete actual file on server
			unlink($pickup_dir.$filename);
			// remove file record from database
			$query_delete_file = $this->db->prepare('DELETE FROM files WHERE agency_id = :agency_id AND id = :id');
			$query_delete_file->bindValue(':id', $file_id, PDO::PARAM_INT);
			$query_delete_file->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
			$query_delete_file->execute();
			return true;
		}
		
		return false;
	}
	

// EOF
}








