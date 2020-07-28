<?php namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Permanence;
use Redirect;
use Input;
use View;
use Validator;
use Session;
use Carbon\Carbon;
use App\Calendar;
use DB;
use App\PermanenceAttribution;
use App\Lawyer;


class PermanencesAttributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $getCalendar = getCalendarData($month, $year);
        $nextQuarter = $getCalendar['nextQuarter'];
        $nextQuarterYear = $getCalendar['nextQuarterYear'];
        // $nextQuarter = 2;

        // $calendarQuarter = Calendar::where('year', '=', $nextQuarterYear)
        //     ->where('quarter', '=', $nextQuarter)
        //     ->get()
        //     ->chunk(3);

        // How many quarters do actually have permanences?
        $quartersWithPermanences = PermanenceAttribution::where('year', '=', $year)->groupBy('quarter')->get();
        $quartersWithPermanencesArray = [null, null, null, null];
        foreach ($quartersWithPermanences as $a) {
            if ($a->quarter == 1) {
                $quartersWithPermanencesArray[0] = 1;
            }
            if ($a->quarter == 2) {
                $quartersWithPermanencesArray[1] = 2;
            }
            if ($a->quarter == 3) {
                $quartersWithPermanencesArray[2] = 3;
            }
            if ($a->quarter == 4) {
                $quartersWithPermanencesArray[3] = 4;
            }
        }
        // dd($quartersWithPermanencesArray);
        // dd($quartersWithPermanences);

        $calendarQuarter1 = Calendar::where('year', '=', $year)
            ->where('quarter', '=', 1)
            ->get()
            ->chunk(3);
        $calendarQuarter2 = Calendar::where('year', '=', $year)
            ->where('quarter', '=', 2)
            ->get()
            ->chunk(3);
        $calendarQuarter3 = Calendar::where('year', '=', $year)
            ->where('quarter', '=', 3)
            ->get()
            ->chunk(3);
        $calendarQuarter4 = Calendar::where('year', '=', $year)
            ->where('quarter', '=', 4)
            ->get()
            ->chunk(3);
        $calendarWholeYear = Calendar::where('quarter', '=', $quartersWithPermanencesArray[0])
            ->where('year', '=', $year)
            ->Orwhere('quarter', '=', $quartersWithPermanencesArray[1])
            ->where('year', '=', $year)
            ->Orwhere('quarter', '=', $quartersWithPermanencesArray[2])
            ->where('year', '=', $year)
            ->Orwhere('quarter', '=', $quartersWithPermanencesArray[3])
            ->where('year', '=', $year)
            ->get()
            ->chunk(3);
        // $calendarWholeYear = new Object();
        // dd($calendarWholeYear->merge($calendarQuarter1));
        $calendarNextYearQuarter1 = Calendar::where('year', '=', $year+1)
            ->where('quarter', '=', 1)
            ->get()
            ->chunk(3);
        // dd($calendarWholeYear);

        // How many months do have permanences?
        $monthsWithPermanences = PermanenceAttribution::where('year', '=', $year)->groupBy('month')->get()->count();

        // $permanenceQuarter = PermanenceAttribution::where('year', '=', $nextQuarterYear)
        //     ->where('quarter', '=', $nextQuarter)
        //     ->get()
        //     ->chunk(3);
        $permanenceQuarter1 = PermanenceAttribution::where('year', '=', $year)
            ->where('quarter', '=', 1)
            ->get()
            ->chunk(3);
        $permanenceQuarter2 = PermanenceAttribution::where('year', '=', $year)
            ->where('quarter', '=', 2)
            ->get()
            ->chunk(3);
        $permanenceQuarter3 = PermanenceAttribution::where('year', '=', $year)
            ->where('quarter', '=', 3)
            ->get()
            ->chunk(3);
        $permanenceQuarter4 = PermanenceAttribution::where('year', '=', $year)
            ->where('quarter', '=', 4)
            ->get()
            ->chunk(3);
        $permanenceWholeYear = PermanenceAttribution::where('year', '=', $year)
            // ->groupBy('month')
            ->orderBy('lawyer_id')
            ->get()
            ->chunk($monthsWithPermanences);
        // dd($permanenceWholeYear);
        $permanenceNextYearQuarter1 = PermanenceAttribution::where('year', '=', $year+1)
            ->where('quarter', '=', 1)
            ->get()
            ->chunk(3);
        // dd($calendarQuarter);
        // dd($permanenceQuarter);

$permanenceQuarter1_2 = PermanenceAttribution::where('year', '=', $year)
    ->where('quarter', '=', 1)
    // ->where('month', '=', 1)
    // ->where('week1', '=', 1)
    // ->orWhere('week2', '=', 1)
    // ->orWhere('week3', '=', 1)
    // ->orWhere('week4', '=', 1)
    ->get();

$permanenceQuarter2_2 = PermanenceAttribution::where('year', '=', $year)
    ->where('quarter', '=', 2)
    ->get();

// dd($permanenceQuarter1_2);

        $permanencesAvailabilityQuarter1 = Permanence::where('year', '=', $year)->where('quarter', '=', 1)->get();
        $permanencesAvailabilityQuarter2 = Permanence::where('year', '=', $year)->where('quarter', '=', 2)->get();
        $permanencesAvailabilityQuarter3 = Permanence::where('year', '=', $year)->where('quarter', '=', 3)->get();
        $permanencesAvailabilityQuarter4 = Permanence::where('year', '=', $year)->where('quarter', '=', 4)->get();
        $permanencesAvailabilityWholeYear = Permanence::where('year', '=', $year)->get();
        $permanencesAvailabilityNextYearQuarter1 = Permanence::where('year', '=', $year+1)->where('quarter', '=', 1)->get();

        // $availabilities = [];
        // array_push($availabilities, $permanencesAvailabilityQuarter2->where('lawyer_id', '=', 2)->where('week1', '=', 1)->count());
        // array_push($availabilities, $permanencesAvailabilityQuarter2->where('lawyer_id', '=', 2)->where('week2', '=', 1)->count());
        // array_push($availabilities, $permanencesAvailabilityQuarter2->where('lawyer_id', '=', 2)->where('week3', '=', 1)->count());
        // array_push($availabilities, $permanencesAvailabilityQuarter2->where('lawyer_id', '=', 2)->where('week4', '=', 1)->count());
        // array_push($availabilities, $permanencesAvailabilityQuarter2->where('lawyer_id', '=', 2)->where('week5', '=', 1)->count());
        // dd($permanencesAvailabilityQuarter2);
        // dd(array_sum($availabilities));

        return View::make('back.permanences-attribution.index')
            ->with('nextQuarter', $nextQuarter)
            ->with('nextQuarterYear', $nextQuarterYear)
            ->with('calendarQuarter1', $calendarQuarter1)
            ->with('calendarQuarter2', $calendarQuarter2)
            ->with('calendarQuarter3', $calendarQuarter3)
            ->with('calendarQuarter4', $calendarQuarter4)
            ->with('calendarWholeYear', $calendarWholeYear)
            ->with('calendarNextYearQuarter1', $calendarNextYearQuarter1)
            ->with('permanenceQuarter1', $permanenceQuarter1)
            ->with('permanenceQuarter2', $permanenceQuarter2)
            ->with('permanenceQuarter3', $permanenceQuarter3)
            ->with('permanenceQuarter4', $permanenceQuarter4)
            ->with('permanenceWholeYear', $permanenceWholeYear)
            ->with('permanenceNextYearQuarter1', $permanenceNextYearQuarter1)
            ->with('permanencesAvailabilityQuarter1', $permanencesAvailabilityQuarter1)
            ->with('permanencesAvailabilityQuarter2', $permanencesAvailabilityQuarter2)
            ->with('permanencesAvailabilityQuarter3', $permanencesAvailabilityQuarter3)
            ->with('permanencesAvailabilityQuarter4', $permanencesAvailabilityQuarter4)
            ->with('permanencesAvailabilityWholeYear', $permanencesAvailabilityWholeYear)
            ->with('permanencesAvailabilityNextYearQuarter1', $permanencesAvailabilityNextYearQuarter1)
            ->with('permanenceQuarter1_2', $permanenceQuarter1_2)
            ->with('permanenceQuarter2_2', $permanenceQuarter2_2);

        // $firstWeek = $nextQuarter[0][0]['week1_nb'];
        // if ($nextQuarter[0][2]['week5_nb']) {
        //     $lastWeek = $nextQuarter[0][2]['week5_nb'];
        // } else {
        //     $lastWeek = $nextQuarter[0][2]['week4_nb'];
        // }

        // $list = [];
        // for ($i = 1; $i <= 3; $i++) { // months nb in quarter
        //     for ($j = 1; $j <= 5; $j++) { // week1 to week5
        //         $current_week = 'week' . $j;
        //         $monthlyAvailability = Permanence::where('year', '=', $year)
        //             ->where('month', '=', $i)
        //             ->where($current_week, '=', 1)
        //             ->inRandomOrder()
        //             ->take(4)
        //             ->get();
        //         array_push($list, $monthlyAvailability);
        //     }
        // }
        // dd($list);

        
        // PermanenceAttribution::where('year', '=', 2018)
        //     ->where('month', '=', 1)
        //     ->where('lawyer_id', '=', $availability[0]['lawyer_id'])
        //     ->update(['week1' => $availability[0]['week1']]);

        // dd($availability);

        // $list = [];
        // for ($i = 1; $i <= 3; $i++) { // months nb in quarter
        //     for ($j = 1; $j <= 5; $j++) { // week1 to week5
        //         $current_week = 'week' . $j;
        //         $monthlyAvailability = Permanence::where('year', '=', $year)
        //             ->where('month', '=', $i)
        //             ->where($current_week, '=', 1)
        //             ->inRandomOrder()
        //             ->take(4)
        //             ->get();
        //         // if ($monthlyAvailability) {
        //             array_push($list, $monthlyAvailability);
        //         // }
        //     }
        // }
        // dd($list);

        // return View::make('back.permanences-attribution.index')
        //     ->with('nextQuarter', $nextQuarter)
        //     ->with('calendarQuarter', $calendarQuarter)
        //     ->with('nextQuarter', $nextQuarter)
        //     ->with('nextQuarterYear', $nextQuarterYear);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd($id);
        // $allLawyers = Lawyer::pluck('id');
        // // dd($allLawyers);
        // $lawyersWithAttribution = PermanenceAttribution::groupBy('lawyer_id')->pluck('lawyer_id');
        // // dd($lawyersWithAttribution);
        // $diff = $allLawyers->diff($lawyersWithAttribution)->all();
        // // dd($diff);
        // $lawyersWithoutAttribution = [];
        // foreach ($diff as $d) {
        //     $lawyersWithoutAttribution[] = Lawyer::where('id', '=', $d)->firstOrFail();
        // }
        // // dd($lawyersWithoutAttribution);
        // return View::make('back.permanences-attribution.create')
        //     ->with('lawyersWithoutAttribution', $lawyersWithoutAttribution);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd($request->input('quarter'));
        // dd(Input::all());
        $year = Carbon::now()->year;
        
        $nextQuarterYear = $request->input('year');
        $nextQuarter = $request->input('quarter');

        switch ($nextQuarter) {
            case 1:
                $startMonth = 1;
                break;
            case 2:
                $startMonth = 4;
                break;
            case 3:
                $startMonth = 7;
                break;
            case 4:
                $startMonth = 10;
                break;
            default:
                echo 'No quarter found!';
                break;
        }

        // 1) First create an empty row for each quarter of each lawyer
        $permanences = Permanence::where('year', '=', $nextQuarterYear)
            ->where('quarter', '=', $nextQuarter)
            ->get();

        $count = $permanences->count();

        for ($i = 0; $i < $count; $i++) { // For each lawyers
            $month[$i] = [
                'lawyer_id' => $permanences[$i]['lawyer_id'],
                'year' => $permanences[$i]['year'],
                'quarter' => $permanences[$i]['quarter'],
                'month' => $permanences[$i]['month'],
                'week1' => 0,
                'week1_nb' => $permanences[$i]['week1_nb'],
                'week2' => 0,
                'week2_nb' => $permanences[$i]['week2_nb'],
                'week3' => 0,
                'week3_nb' => $permanences[$i]['week3_nb'],
                'week4' => 0,
                'week4_nb' => $permanences[$i]['week4_nb'],
                'week5' => $permanences[$i]['week5_nb'] ? 0 : NULL,
                // 'week5' => 0,
                'week5_nb' => $permanences[$i]['week5_nb'],
            ];
            PermanenceAttribution::updateOrCreate($month[$i]);
            // PermanenceAttribution::create($month[$i]);
        }

        // Magical function
        // 2) Second fill in table with randomly selected available lawyers
        for ($i = $startMonth; $i <= $startMonth + 2; $i++) { // For each month
            for ($j = 1; $j <= 5; $j++) { // For each week
                $week[$i][$j] = Permanence::where('year', '=', $nextQuarterYear)
                    ->where('quarter', '=', $nextQuarter)
                    ->where('month', '=', $i)
                    ->where('week' . $j, '=', 1)
                    ->inRandomOrder()
                    ->take(4)
                    ->get(['lawyer_id', 'year', 'quarter', 'month', 'week' . $j]);
                foreach ($week[$i][$j] as $value) { // For each one of the 4 lawyers
                    if ($value) {
                        PermanenceAttribution::where('year', '=', $nextQuarterYear)
                            ->where('quarter', '=', $nextQuarter)
                            ->where('month', '=', $i)
                            ->where('lawyer_id', '=', $value['lawyer_id'])
                            ->update(['week' . $j => $value['week' . $j]]);
                    }
                }
            }
        }
        // dd($week2);

        // $calendarQuarter = Calendar::where('year', '=', $nextQuarterYear)
        //     ->where('quarter', '=', $nextQuarter)
        //     ->get()
        //     ->chunk(3);

        // $permanenceQuarter = PermanenceAttribution::where('year', '=', $nextQuarterYear)
        //     ->where('quarter', '=', $nextQuarter)
        //     ->get()
        //     ->chunk(3);

        // How many quarters do actually have permanences?
        // $quartersWithPermanences = PermanenceAttribution::where('year', '=', $year)->groupBy('quarter')->get();
        // $quartersWithPermanencesArray = [null, null, null, null];
        // foreach ($quartersWithPermanences as $a) {
        //     if ($a->quarter == 1) {
        //         $quartersWithPermanencesArray[0] = 1;
        //     }
        //     if ($a->quarter == 2) {
        //         $quartersWithPermanencesArray[1] = 2;
        //     }
        //     if ($a->quarter == 3) {
        //         $quartersWithPermanencesArray[2] = 3;
        //     }
        //     if ($a->quarter == 4) {
        //         $quartersWithPermanencesArray[3] = 4;
        //     }
        // }


        // $calendarQuarter1 = Calendar::where('year', '=', $year)
        //     ->where('quarter', '=', 1)
        //     ->get()
        //     ->chunk(3);
        // $calendarQuarter2 = Calendar::where('year', '=', $year)
        //     ->where('quarter', '=', 2)
        //     ->get()
        //     ->chunk(3);
        // $calendarQuarter3 = Calendar::where('year', '=', $year)
        //     ->where('quarter', '=', 3)
        //     ->get()
        //     ->chunk(3);
        // $calendarQuarter4 = Calendar::where('year', '=', $year)
        //     ->where('quarter', '=', 4)
        //     ->get()
        //     ->chunk(3);
        // $calendarWholeYear = Calendar::where('quarter', '=', $quartersWithPermanencesArray[0])
        //     ->where('year', '=', $year)
        //     ->Orwhere('quarter', '=', $quartersWithPermanencesArray[1])
        //     ->where('year', '=', $year)
        //     ->Orwhere('quarter', '=', $quartersWithPermanencesArray[2])
        //     ->where('year', '=', $year)
        //     ->Orwhere('quarter', '=', $quartersWithPermanencesArray[3])
        //     ->where('year', '=', $year)
        //     ->get()
        //     ->chunk(3);
        // $calendarNextYearQuarter1 = Calendar::where('year', '=', $year+1)
        //     ->where('quarter', '=', 1)
        //     ->get()
        //     ->chunk(3);

        // // How many months do have permanences?
        // $monthsWithPermanences = PermanenceAttribution::where('year', '=', $year)->groupBy('month')->get()->count();

        // $permanenceQuarter1 = PermanenceAttribution::where('year', '=', $year)
        //     ->where('quarter', '=', 1)
        //     ->get()
        //     ->chunk(3);
        // $permanenceQuarter2 = PermanenceAttribution::where('year', '=', $year)
        //     ->where('quarter', '=', 2)
        //     ->get()
        //     ->chunk(3);
        // $permanenceQuarter3 = PermanenceAttribution::where('year', '=', $year)
        //     ->where('quarter', '=', 3)
        //     ->get()
        //     ->chunk(3);
        // $permanenceQuarter4 = PermanenceAttribution::where('year', '=', $year)
        //     ->where('quarter', '=', 4)
        //     ->get()
        //     ->chunk(3);
        // $permanenceWholeYear = PermanenceAttribution::where('year', '=', $year)
        //     // ->groupBy('month')
        //     ->orderBy('lawyer_id')
        //     ->get()
        //     ->chunk($monthsWithPermanences);

        // $permanenceNextYearQuarter1 = PermanenceAttribution::where('year', '=', $year+1)
        //     ->where('quarter', '=', 1)
        //     ->get()
        //     ->chunk(3);

        Session::flash('success', 'Attribution des permanences générée avec succès.');
        return redirect::back();
        // return View::make('back.permanences-attribution.index')
        //     ->with('nextQuarter', $nextQuarter)
        //     ->with('nextQuarterYear', $nextQuarterYear)
        //     // ->with('calendarQuarter', $calendarQuarter)
        //     // ->with('permanenceQuarter', $permanenceQuarter)
        //     ->with('calendarQuarter1', $calendarQuarter1)
        //     ->with('calendarQuarter2', $calendarQuarter2)
        //     ->with('calendarQuarter3', $calendarQuarter3)
        //     ->with('calendarQuarter4', $calendarQuarter4)
        //     ->with('calendarWholeYear', $calendarWholeYear)
        //     ->with('calendarNextYearQuarter1', $calendarNextYearQuarter1)
        //     ->with('permanenceQuarter1', $permanenceQuarter1)
        //     ->with('permanenceQuarter2', $permanenceQuarter2)
        //     ->with('permanenceQuarter3', $permanenceQuarter3)
        //     ->with('permanenceQuarter4', $permanenceQuarter4)
        //     ->with('permanenceWholeYear', $permanenceWholeYear)
        //     ->with('permanenceNextYearQuarter1', $permanenceNextYearQuarter1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($timeInfo)
    {
        /*if (!\Entrust::can('edit-permission')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        // dd($timeInfo);
        $values = explode('-', $timeInfo);
        // dd($values);
        $year = filter_var($values[0], FILTER_SANITIZE_NUMBER_INT);
        $month = filter_var($values[1], FILTER_SANITIZE_NUMBER_INT);
        $week = filter_var($values[2], FILTER_SANITIZE_NUMBER_INT);
        // dd($week);
        // $year = $timeInfo;
        // $month = $timeInfo;
        // $week = $timeInfo;
        $calendar = Calendar::where('year', '=', $year)
            ->where('month', '=', $month)
            ->firstOrFail();
        // dd($calendar);

        $lawyersWithAttribution = DB::table('permanences_attribution')->where('year', '=', $year)
            // ->where('quarter', '=', 2)
            ->where('month', '=', $month)
            ->where('week' . $week, '=', 1)
            ->join('lawyers', 'lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.*', 'lawyers.id', 'lawyers.firstname', 'lawyers.lastname')
            ->orderBy('lastname', 'asc')
            ->get();
        // dd($lawyersWithAttribution);

        $lawyersWithoutAttribution = DB::table('permanences')->where('permanences.year', '=', $year)
            ->where('permanences.month', '=', $month)
            ->where('permanences.week' . $week, '=', 1)
            ->join('lawyers', 'lawyer_id', '=', 'lawyers.id')
            ->leftJoin('permanences_attribution', 'permanences.lawyer_id', '=', 'permanences_attribution.lawyer_id')
            ->where('permanences_attribution.year', '=', $year)
            ->where('permanences_attribution.month', '=', $month)
            ->where('permanences_attribution.week' . $week, '=', 0)
            ->select('permanences.*', 'lawyers.id', 'lawyers.firstname', 'lawyers.lastname')
            ->orderBy('lastname', 'asc')
            ->get();
        // dd($lawyersWithoutAttribution);

        // $diff = array_diff($lawyersWithAttribution, $lawyersAvailable);
        // dd($diff);

        // $lawyersAvailable = DB::table('permanences')->where('year', '=', $year)
        //     ->where('month', '=', $month)
        //     ->where('week' . $week, '=', 1)
        //     ->join('lawyers', 'lawyer_id', '=', 'lawyers.id')
        //     ->select('permanences.*', 'lawyers.id', 'lawyers.firstname', 'lawyers.lastname')
        //     ->orderBy('lastname', 'asc')
        //     ->get();
        // dd($lawyersAvailable);

        return View::make('back.permanences-attribution.edit')
            ->with('lawyersWithAttribution', $lawyersWithAttribution)
            ->with('lawyersWithoutAttribution', $lawyersWithoutAttribution)
            ->with('calendar', $calendar)
            ->with('year', $year)
            ->with('month', $month)
            ->with('week', $week);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $year = Input::get('year');
        $month = Input::get('month');
        $week = Input::get('week');
        $ids = Input::get('ids');

        // return response()->json($year);

        $permanences = PermanenceAttribution::where('year', '=', $year)
            ->where('month', '=', $month)
            ->update(['week' . $week => 0]);
        // return response()->json($permanences);
        if ($ids) {
            foreach ($ids as $id) {
                $permanences = PermanenceAttribution::where('year', '=', $year)
                    ->where('month', '=', $month)
                    ->where('lawyer_id', '=', $id)
                    ->update(['week' . $week => 1]);
            }
        }
        return response()->json($ids);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = FormulaireContact::findOrFail($id);

        $contact->delete();

        Session::flash('success', 'Contact supprimé avec succès!');
        return redirect::to('back/formulaire-contacts');
    }


    public function reGeneratePermanencesList(Request $request)
    {
        $nextQuarterYear = $request->input('year');
        $nextQuarter = $request->input('quarter');

        // 1) First create an empty row for each quarter of each lawyer
        $permanences = PermanenceAttribution::where('year', '=', $nextQuarterYear)
            ->where('quarter', '=', $nextQuarter)
            ->delete();

        // 2) Second, call store method
        return $this->store($request);
    }

    public function showAddLawyerToPermanencesAttributionForm($year, $quarter)
    {
        // dd($year);
        // dd($quarter);
        $allLawyers = Lawyer::pluck('id');
        // dd($allLawyers);
        $lawyersWithAttribution = PermanenceAttribution::where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->groupBy('lawyer_id')
            ->pluck('lawyer_id');
        // dd($lawyersWithAttribution);
        $diff = $allLawyers->diff($lawyersWithAttribution)->all();
        // dd($diff);
        $lawyersWithoutAttribution = [];
        foreach ($diff as $d) {
            $lawyersWithoutAttribution[] = Lawyer::where('id', '=', $d)->firstOrFail();
        }
        // dd($lawyersWithoutAttribution);
        return View::make('back.permanences-attribution.create')
            ->with('year', $year)
            ->with('quarter', $quarter)
            ->with('lawyersWithoutAttribution', $lawyersWithoutAttribution);
    }

    public function addLawyerToPermanencesAttribution($year, $quarter, $lawyer)
    {
        // dd('abc');
        // dd($quarter);
        // dd($lawyer);
        switch ($quarter) {
            case 1:
                $startMonth = 1;
                break;
            case 2:
                $startMonth = 4;
                break;
            case 3:
                $startMonth = 7;
                break;
            case 4:
                $startMonth = 10;
                break;
            default:
                echo 'No quarter found!';
                break;
        }

        $months = Calendar::where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->get();
        // dd($calendar);

        // 1) Create table with empty values
        for ($i = 0; $i < $months->count(); $i++) { // For each lawyers
            $month[$i] = [
                'lawyer_id' => $lawyer,
                'year' => $year,
                'quarter' => $quarter,
                'month' => $months[$i]['month'],
                'week1' => 0,
                'week1_nb' => $months[$i]['week1_nb'],
                'week2' => 0,
                'week2_nb' => $months[$i]['week2_nb'],
                'week3' => 0,
                'week3_nb' => $months[$i]['week3_nb'],
                'week4' => 0,
                'week4_nb' => $months[$i]['week4_nb'],
                'week5' => $months[$i]['week5_nb'] ? 0 : NULL,
                'week5_nb' => $months[$i]['week5_nb'],
            ];
            PermanenceAttribution::updateOrCreate($month[$i]);
        }

        Session::flash('success', 'Avocat ajouté à la liste des permanences avec succès.');
        return redirect::back();
    }

    public function generateAttributionsTable() {

        $year = Input::get('year');
        $quarter = Input::get('quarter');
        // dd($year);
        // dd($quarter);
        switch ($quarter) {
            case 1:
                $month = 1;
                break;
            case 2:
                $month = 4;
                break;
            case 3:
                $month = 7;
                break;
            case 4:
                $month = 10;
                break;
            default:
                echo "Invalid quarter number provided";
        }
        // dd($quarter);

        // Month 1
        $month1_week1 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month)
            ->where('week1', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        // dd($month1_week1);

        $month1_week2 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month)
            ->where('week2', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month1_week3 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month)
            ->where('week3', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month1_week4 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month)
            ->where('week4', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month1_week5 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month)
            ->where('week5', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        // Month 2
        $month2_week1 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 1)
            ->where('week1', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month2_week2 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 1)
            ->where('week2', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month2_week3 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 1)
            ->where('week3', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month2_week4 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 1)
            ->where('week4', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month2_week5 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 1)
            ->where('week5', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        // Week 3
        $month3_week1 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 2)
            ->where('week1', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month3_week2 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 2)
            ->where('week2', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month3_week3 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 2)
            ->where('week3', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month3_week4 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 2)
            ->where('week4', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $month3_week5 = DB::table('permanences_attribution')
            ->where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->where('month', '=', $month + 2)
            ->where('week5', '=', 1)
            ->leftJoin('lawyers', 'permanences_attribution.lawyer_id', '=', 'lawyers.id')
            ->select('permanences_attribution.lawyer_id', 'lawyers.firstname', 'lawyers.lastname')
            ->get();

        $data = [];

        for ($i = 1; $i < 4; $i++) {
            array_push($data, ${'month' . $i . '_week1'});
            array_push($data, ${'month' . $i . '_week2'});
            array_push($data, ${'month' . $i . '_week3'});
            array_push($data, ${'month' . $i . '_week4'});
            if (count(${'month' . $i . '_week5'}) > 0) {
                array_push($data, ${'month' . $i . '_week5'});
            }
        }
        return response()->json($data);
    }

    /* AJAX requests */
    // public function generatePermanenceList()
    // {
    //     $year = 2018;
    //     // $year = Input::get('year');
    //     // $quarter = Input::get('quarter');
    //     $quarter = 2;
    //     // // $number = Input::get('number');
    //     $number = 4;

    //     // $starting_week = 14;
    //     // $ending_week = 26;
    //     // $nextQuarter = Permanence::where('year', '=', $year)
    //     //     ->where('quarter', '=', $quarter)
    //     //     ->get()
    //     //     ->chunk(3);
    //     $calendarQuarter = Calendar::where('year', '=', $year)
    //         ->where('quarter', '=', 1)
    //         ->get()
    //         ->chunk(3);

    //     $list = [];
    //     for ($i = 1; $i <= 3; $i++) { // months nb in quarter
    //         for ($j = 1; $j <= 5; $j++) { // week1 to week5
    //             $current_week = 'week' . $j;
    //             $monthlyAvailability = Permanence::where('year', '=', $year)
    //                 ->where('month', '=', $i)
    //                 ->where($current_week, '=', 1)
    //                 ->inRandomOrder()
    //                 ->take(4)
    //                 ->get();
    //             // if ($monthlyAvailability) {
    //                 array_push($list, $monthlyAvailability);
    //             // }
    //         }
    //     }
    //     // dd($list);

    //     $data = [$calendarQuarter, $list];
    //     return response()->json($data);
    //     // return redirect()->back();
    // }
}
