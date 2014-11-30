<?php

class MainModel
{

	// setup date functions
		function todays($date) {
		  return array(date('m-d-Y', strtotime($date)), date('m-d-Y', strtotime($date)));
		}

		function this_week($date) {
		  $ts = strtotime($date);
		  $start = strtotime('last monday', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('next sunday', $start)));
		}

		function last_week($date) {
		  $ts = strtotime($date);
		  $start = strtotime('monday 1 week ago', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+6 days', $start)));
		}

		function this_month($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of this month', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('last day of this month', $start)));
		}

		function last_month($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of previous month', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('last day of this month', $start)));
		}

		function this_quarter($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of last month', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+3 months -1 day', $start)));
		}

		function first_quarter($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of january', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+3 months -1 day', $start)));
		}

		function second_quarter($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of april', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+3 months -1 day', $start)));
		}

		function third_quarter($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of july', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+3 months -1 day', $start)));
		}

		function fourth_quarter($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of october', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+3 months -1 day', $start)));
		}

		function last_six_months($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of -5 months', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+6 months -1 day', $start)));
		}

		function this_year($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of january', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+12 months -1 day', $start)));
		}

		function last_two_years($date) {
		  $ts = strtotime($date);
		  $start = strtotime('first day of -2 years', $ts);
		  return array(date('m-d-Y', $start), date('m-d-Y', strtotime('+25 months -1 day', $start)));
		}

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

    /**
     * Generate dates
     */
    public function getDate($preset)
    {		
		// run based on preset and format date for searching
		if ($preset == 'today') {
			$theFormattedDate = $this->todays(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'this_week') {
			$theFormattedDate = $this->this_week(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'last_week') {
			$theFormattedDate = $this->last_week(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'this_month') {
			$theFormattedDate = $this->this_month(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'last_month') {
			$theFormattedDate = $this->last_month(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'this_quarter') {
			$theFormattedDate = $this->this_quarter(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'first_quarter') {
			$theFormattedDate = $this->first_quarter(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'second_quarter') {
			$theFormattedDate = $this->second_quarter(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'third_quarter') {
			$theFormattedDate = $this->third_quarter(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'fourth_quarter') {
			$theFormattedDate = $this->fourth_quarter(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'last_six_months') {
			$theFormattedDate = $this->last_six_months(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'this_year') {
			$theFormattedDate = $this->this_year(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		} else if ($preset == 'last_two_years') {
			$theFormattedDate = $this->last_two_years(date('Y-m-d',time()));
			$theStartDate = $theFormattedDate[0];
			$theEndDate = $theFormattedDate[1];
			// format date into single phrase
			$readyDate = $theStartDate.".".$theEndDate;
			return $readyDate;
		}
		
    }


}