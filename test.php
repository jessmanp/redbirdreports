<?

function today($date) {
  return array(date('m/d/Y', strtotime($date)), date('m/d/Y', strtotime($date)));
}

function this_week($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('next sunday', $start)));
}

function last_week($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('monday last week', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('last sunday', $start)));
}

function this_month($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of this month', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('last day of this month', $start)));
}

function last_month($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of previous month', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('last day of this month', $start)));
}

function this_quarter($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of last month', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('+3 months -1 day', $start)));
}

function first_quarter($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of january', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('+3 months -1 day', $start)));
}

function second_quarter($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of april', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('+3 months -1 day', $start)));
}

function third_quarter($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of july', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('+3 months -1 day', $start)));
}

function fourth_quarter($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of october', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('+3 months -1 day', $start)));
}

function last_six_months($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of -5 months', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('+6 months -1 day', $start)));
}

function this_year($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of january', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('+12 months -1 day', $start)));
}

function last_two_years($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('first day of -2 years', $ts);
  return array(date('m/d/Y', $start), date('m/d/Y', strtotime('+25 months -1 day', $start)));
}


echo "today = "; print_r(today('11/29/2014'));
echo "<hr />";

echo "this week = "; print_r(this_week('2014-11-29 02:53:53'));
echo "<hr />";

echo "last week = "; print_r(last_week('2014-11-29 02:53:53'));
echo "<hr />";

echo "this month = "; print_r(this_month('2014-11-29 02:53:53'));
echo "<hr />";

echo "last month = "; print_r(last_month('2014-11-29 02:53:53'));
echo "<hr />";

echo "this quarter = "; print_r(this_quarter('2014-11-29 02:53:53'));
echo "<hr />";

echo "first quarter = "; print_r(first_quarter('2014-11-29 02:53:53'));
echo "<hr />";

echo "second quarter = "; print_r(second_quarter('2014-11-29 02:53:53'));
echo "<hr />";

echo "third quarter = "; print_r(third_quarter('2014-11-29 02:53:53'));
echo "<hr />";

echo "fourth quarter = "; print_r(fourth_quarter('2014-11-29 02:53:53'));
echo "<hr />";

echo "last 6 months = "; print_r(last_six_months('2014-11-29 02:53:53'));
echo "<hr />";

echo "this year = "; print_r(this_year('2014-11-29 02:53:53'));
echo "<hr />";

echo "last 2 years = "; print_r(last_two_years('2014-11-29 02:53:53'));
echo "<hr />";



?>