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
			$rows = array_map("str_getcsv", preg_split('/\R/',trim($filestr)));
			$header = array_shift($rows);
			if ($header == $fields) {
				$importDate = date("Y-m-d H:i:s", time());
				array_unshift($header,'user_id');
				array_unshift($header,'agency_id');
				array_push($header,'date_imported');
				$csv = array();
				foreach($rows as $row) {
					array_unshift($row,$emp_id);
					array_unshift($row,$agency_id);
					array_push($row,$importDate);
					$csv[] = array_combine($header,$row);
				}
			}
			// make sure there are rows to import
			if (count($csv) > 0) {
				// loop over array and insert records using agency id and employee id
				foreach ($csv as $info) {
					// make sure row is not blank
					if (count($info) > 0) {
						$stmt = $this->db->prepare('INSERT INTO policies (user_id,agency_id,status,renewal,reinstate,old_user_id,first,last,description,category_id,premium,business_type_id,source_type_id,length_type_id,notes,policy_number,zip_code,date_written,date_issued,date_effective,date_canceled,date_imported) VALUES (:user_id,:agency_id,:status,:renewal,:reinstate,:old_user_id,:first,:last,:description,:category_id,:premium,:business_type_id,:source_type_id,:length_type_id,:notes,:policy_number,:zip_code,:date_written,:date_issued,:date_effective,:date_canceled,:date_imported)');
						foreach ($info as $col=>$val) {
							if ($val == '') {
								$stmt->bindValue(':'.$col,null,PDO::PARAM_NULL);
							} else if (ctype_digit($val)) {
								$stmt->bindValue(':'.$col,$val,PDO::PARAM_INT);
							} else {
								$stmt->bindValue(':'.$col,$val,PDO::PARAM_STR);
							}
						}
						$stmt->execute();
					}
				}
			} else {
				return false;
			}
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








