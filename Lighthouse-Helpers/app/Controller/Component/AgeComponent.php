<?php

/**
 * Calculates age in years from dob to refdate
 * (this is a work around because DateTime::diff isn't in PHP 5.2)
 * @param DateTime $dob
 * @param DateTime $refdate
 * @return number
 * @author mark
 *
 */
class AgeComponent extends Component {

	function getage(DateTime $dob = null, Datetime $refdate = null) {
		$year_diff  = $refdate->format('Y') - $dob->format('Y');
		$month_diff = $refdate->format('m') - $dob->format('m');
		$day_diff   = $refdate->format('d') - $dob->format('d');
		if ($month_diff < 0) $year_diff--;
		elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
		return $year_diff;
	}
}