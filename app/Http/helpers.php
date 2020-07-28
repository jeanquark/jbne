<?php
	function getCalendarData ($thisMonth, $thisYear) {
		switch($thisMonth)
	    {
	        // January
	        case 1:
	            $quarter = 1;
	            $year = $thisYear;
	            $nextQuarter = 2;
	            $nextQuarterYear = $thisYear;
	            break;

	        // February
	        case 2:
	            $quarter = 1;
	            $year = $thisYear;
	            $nextQuarter = 2;
	            $nextQuarterYear = $thisYear;
	            break;

	        // March
	        case 3:
	            $quarter = 1;
	            $year = $thisYear;
	            $nextQuarter = 2;
	            $nextQuarterYear = $thisYear;
	            break;

	        // April
	        case 4:
	            $quarter = 2;
	            $year = $thisYear;
	            $nextQuarter = 3;
	            $nextQuarterYear = $thisYear;
	            break;

	        // May
	        case 5:
	            $quarter = 2;
	            $year = $thisYear;
	            $nextQuarter = 3;
	            $nextQuarterYear = $thisYear;
	            break;

	        // June
	        case 6:
	            $quarter = 2;
	            $year = $thisYear;
	            $nextQuarter = 3;
	            $nextQuarterYear = $thisYear;
	            break;

	        // July
	        case 7:
	            $quarter = 3;
	            $year = $thisYear;
	            $nextQuarter = 4;
	            $nextQuarterYear = $thisYear;
	            break;

	        // August
	        case 8:
	            $quarter = 3;
	            $year = $thisYear;
	            $nextQuarter = 4;
	            $nextQuarterYear = $thisYear;
	            break;

	        // September
	        case 9:
	            $quarter = 3; 
	            $year = $thisYear;
	            $nextQuarter = 4;
	            $nextQuarterYear = $thisYear;
	            break;

	        // October
	        case 10:
	            $quarter = 4;
	            $year = $thisYear;
	            $nextQuarter = 1;
	            $nextQuarterYear = $thisYear + 1;
	            break;

	        // November
	        case 11:
	            $quarter = 4;
	            $year = $thisYear;
	            $nextQuarter = 1;
	            $nextQuarterYear = $thisYear + 1;
	            break;

	        // December
	        case 12:
	            $quarter = 4;
	            $year = $thisYear;
	            $nextQuarter = 1;
	            $nextQuarterYear = $thisYear + 1;
	            break;
	        default:
	            echo "Valeur introuvable pour le mois en cours";
	            break;
	    }
	    // dd('abc');
	    // $data = [$quarter, $year, $nextQuarter, $nextQuarterYear];
	    $data = [
	    	'thisQuarter' => $quarter, 
	    	'thisYear' => $year, 
	    	'nextQuarter' => $nextQuarter, 
	    	'nextQuarterYear' => $nextQuarterYear
	    ];
	    // dd($data);
	    return $data;
	}

	function integerToRoman($integer) {
		switch($integer) 
		{
			case 1:
				$integer = 'I';
				break;
			case 2:
				$integer = 'II';
				break;
			case 3:
				$integer = 'III';
				break;
			case 4:
				$integer = 'IV';
				break;
			default:
				$integer = $integer;
				break;
		}
		return $integer;
	}

	function getMonthName ($thisMonth) {
		switch($thisMonth)
	    {
	        // Janvier
	        case 1:
	            $month = 'Janvier';
	            break;

	        // Février
	        case 2:
	            $month = 'Février';
	            break;

	        // Mars
	        case 3:
	            $month = 'Mars';
	            break;

	        // Avril
	        case 4:
	            $month = 'Avril';
	            break;

	        // Mai
	        case 5:
	            $month = 'Mai';
	            break;

	        // Juin
	        case 6:
	            $month = 'Juin';
	            break;

	        // Juillet
	        case 7:
	            $month = 'Juillet';
	            break;

	        // Août
	        case 8:
	            $month = 'Août';
	            break;

	        // Septembre
	        case 9:
	            $month = 'Septembre'; 
	            break;

	        // Octobre
	        case 10:
	            $month = 'Octobre';
	            break;

	        // Novembre
	        case 11:
	            $month = 'Novembre';
	            break;

	        // Décembre
	        case 12:
	            $month = 'Décembre';
	            break;
	        default:
	            echo "Valeur introuvable pour le mois en cours";
	            break;
	    }
	    return $month;
	}