<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Session;
use App\Permanence;
use Redirect;
use Validator;
use Input;
use Carbon\Carbon;
use Auth;
use App\Calendar;
use App\PermanenceAttribution;
use App\SiteParameter;

class PermanencesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:lawyer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lawyer_id = Auth::guard('lawyer')->user()->id;

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $week = Carbon::now()->weekOfYear;

        $getCalendar = getCalendarData($month, $year);
        $thisQuarter = $getCalendar['thisQuarter'];
        $thisYear = $getCalendar['thisYear'];
        $nextQuarter = $getCalendar['nextQuarter'];
        $nextQuarterYear = $getCalendar['nextQuarterYear'];

        $calendar = Calendar::where('year', '=', $getCalendar['nextQuarterYear'])
            ->where('quarter', '=', $getCalendar['nextQuarter'])
            ->get();
        $permanence = Permanence::where('lawyer_id', '=', $lawyer_id)
            ->where('year', '=', $nextQuarterYear)
            ->where('quarter', '=', $nextQuarter)
            ->get();

        $calendarCurrentQuarter = Calendar::where('year', '=', $thisYear)
            ->where('quarter', '=', $thisQuarter)
            ->get();
        $permanenceCurrentQuarter = Permanence::where('lawyer_id', '=', $lawyer_id)
            ->where('year', '=', $thisYear)
            ->where('quarter', '=', $thisQuarter)
            ->get();

        $nextQuarter = integerToRoman($nextQuarter);
        $siteParameters = SiteParameter::where('name', '=', 'display_next_quarter_attributions')->first();

        return View::make('lawyer.permanences-index')
            ->with('permanence', $permanence)
            ->with('calendar', $calendar)
            ->with('year', $year)
            ->with('week', $week)
            ->with('nextQuarter', $nextQuarter)
            ->with('nextQuarterYear', $nextQuarterYear)
            ->with('calendarCurrentQuarter', $calendarCurrentQuarter)
            ->with('permanenceCurrentQuarter', $permanenceCurrentQuarter)
            ->with('siteParameters', $siteParameters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (false) {
        if (date('j') > 20 || (date('n') != 3 && date('n') != 6 && date('n') != 9 && date('n') != 12)) {
            Session::flash('warning', 'Veuillez attendre l\'ouverture de la période d\'enregistrement avant de pouvoir nous transmettre vos disponibilités. La période d\'enregistrement court du 1<sup>er</sup> au 10 du mois précédent le prochain trimestre (par exemple du 1<sup>er</sup> au 10 mars pour le 2<sup>ème</sup> trimestre).');

            return redirect::back();
        }

        $lawyer = Auth::guard('lawyer')->user()->id;

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $week = Carbon::now()->weekOfYear;

        $getCalendar = getCalendarData($month, $year);
        $nextQuarter = $getCalendar['nextQuarter'];
        $nextQuarterYear = $getCalendar['nextQuarterYear'];

        // Check if lawyer already has database entries
        if (Permanence::where('lawyer_id', '=', $lawyer)
            ->where('year', '=', $nextQuarterYear)
            ->where('quarter', '=', $nextQuarter)
            ->exists()) {
            return back();
        }

        $calendar = Calendar::where('year', '=', $getCalendar['nextQuarterYear'])
            ->where('quarter', '=', $getCalendar['nextQuarter'])
            ->get();

        return View::make('lawyer.permanence-create')
            ->with('lawyer', $lawyer)
            ->with('calendar', $calendar)
            ->with('nextQuarter', $nextQuarter)
            ->with('nextQuarterYear', $nextQuarterYear);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::except(['_method', '_token']);

            for ($i = 0; $i <= 2; $i++) { // For each month
                $data2[$i] = [
                    'lawyer_id' => $data['lawyer_id'],
                    'year' => $data['year'],
                    'quarter' => $data['quarter'],
                    'month' => $data['month' . $i],
                    'week1_dispo' => $data['month' . $i . '_week1'],
                    'week1_nb' => $data['month' . $i . '_week1_nb'],
                    'week2_dispo' => $data['month' . $i . '_week2'],
                    'week2_nb' => $data['month' . $i . '_week2_nb'],
                    'week3_dispo' => $data['month' . $i . '_week3'],
                    'week3_nb' => $data['month' . $i . '_week3_nb'],
                    'week4_dispo' => $data['month' . $i . '_week4'],
                    'week4_nb' => $data['month' . $i . '_week4_nb'],
                    'week5_dispo' => $data['month' . $i . '_week5'],
                    'week5_nb' => $data['month' . $i .'_week5_nb'],
                ];
                Permanence::create($data2[$i]);
            };

            Session::flash('success', 'Permanence créée avec succès.');
            return Redirect::route('lawyer.permanences.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd(env('PERMANENCES_AVAILABILITIES_CLOSING_DAY'));
        if (date('j') > env('PERMANENCES_AVAILABILITIES_CLOSING_DAY') || (date('n') != 3 && date('n') != 6 && date('n') != 9 && date('n') != 12)) {
            Session::flash('warning', 'Il n\'est plus possible de modifier vos disponibilités. La période d\'enregistrement court du 1<sup>er</sup> au ' . env("PERMANENCES_AVAILABILITIES_CLOSING_DAY") . ' du mois précédent le prochain trimestre (par exemple du 1<sup>er</sup> au ' . env("PERMANENCES_AVAILABILITIES_CLOSING_DAY") . ' mars pour le 2<sup>ème</sup> trimestre). Veuillez nous contacter en cas de changement de vos disponibilités après la fermeture de la période d\'enregistrement.');

            return redirect::back();
        }

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $week = Carbon::now()->weekOfYear;

        $getCalendar = getCalendarData($month, $year);
        $nextQuarter = $getCalendar['nextQuarter'];
        $nextQuarterYear = $getCalendar['nextQuarterYear'];

        $calendar = Calendar::where('year', '=', $getCalendar['nextQuarterYear'])
            ->where('quarter', '=', $getCalendar['nextQuarter'])
            ->get();

        $permanence = Permanence::where('lawyer_id', '=', $id)
            ->where('year', '=', $getCalendar['nextQuarterYear'])
            ->where('quarter', '=', $getCalendar['nextQuarter'])
            ->get();

        return View::make('lawyer.permanence-edit')
            ->with('permanence', $permanence)
            ->with('calendar', $calendar)
            ->with('nextQuarter', $nextQuarter)
            ->with('nextQuarterYear', $nextQuarterYear);
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
        $rules = array(
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {            
            $data = Input::except(['_method', '_token']);

            for ($i = 0; $i <= 2; $i++) {
                $data2[$i] = [
                    'lawyer_id' => $data['lawyer_id'],
                    'year' => $data['year'],
                    'quarter' => $data['quarter'],
                    'month' => $data['month' . $i],
                    'week1_dispo' => $data['month' . $i . '_week1'],
                    'week1_nb' => $data['month' . $i . '_week1_nb'],
                    'week2_dispo' => $data['month' . $i . '_week2'],
                    'week2_nb' => $data['month' . $i . '_week2_nb'],
                    'week3_dispo' => $data['month' . $i . '_week3'],
                    'week3_nb' => $data['month' . $i . '_week3_nb'],
                    'week4_dispo' => $data['month' . $i . '_week4'],
                    'week4_nb' => $data['month' . $i . '_week4_nb'],
                    'week5_dispo' => $data['month' . $i . '_week5'],
                    'week5_nb' => $data['month' . $i .'_week5_nb'],
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ];
            };

            for ($i = 0; $i <= 2; $i++) {
                $permanence[$i] = Permanence::where('lawyer_id', '=', $data['lawyer_id'])
                    ->where('year', '=', $data['year'])
                    ->where('month', '=', $data['month' . $i])
                    ->firstOrFail();
                $permanence[$i]->update($data2[$i]);
            }
            
            Session::flash('success', 'Disponibilités modifiées avec succès.');
            return Redirect::route('lawyer.permanences.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permanence = Lawyer::findOrFail($id);

        $permanence->delete();

        Session::flash('success', 'Permanence supprimée avec succès!');
        // return redirect::to('permanences');
        return Redirect::route('lawyer.permanences.index');
    }

    public function conditions()
    {
        // dd('abc');
        return View::make('lawyer.conditions');
    }
}
