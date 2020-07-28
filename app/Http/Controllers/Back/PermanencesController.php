<?php namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Redirect;
use Input;
use View;
use Validator;
use Session;
use Carbon\Carbon;
use App\Calendar;
use DB;
use App\Lawyer;
use App\Mail\PermanencesRegistrationPeriod;
use App\SiteParameter;
use Mailgun\Mailgun;

use App\Permanence;
use App\PermanenceCopy;
use StdClass;

class PermanencesController extends Controller
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
        $week = Carbon::now()->weekOfYear;

        // Helper function (app\Http\helpers.php)
        $getCalendar = getCalendarData($month, $year);

        $nextQuarter = $getCalendar['nextQuarter'];
        $nextQuarterYear = $getCalendar['nextQuarterYear'];

        // dd($nextQuarter);

        // $calendar = Calendar::where('year', '=', $nextQuarterYear)
        //     ->where('quarter', '=', $nextQuarter)
        //     ->get();
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
        $calendarWholeYear = Calendar::where('year', '=', $year)
            ->get();
        $calendarNextYearQuarter1 = Calendar::where('year', '=', $year+1)
            ->where('quarter', '=', 1)
            ->get()
            ->chunk(3);
        $siteParameters = SiteParameter::where('name', '=', 'display_next_quarter_attributions')->first();
        // dd($siteParameters);
        // dd($calendarQuarter1);
        // dd($calendarWholeYear);
        // dd($calendarNextYearQuarter1);

        // $permanences = Permanence::where('year', '=', $nextQuarterYear)
        //     ->where('quarter', '=', $nextQuarter)
        //     // ->groupBy('lawyer_id')
        //     ->get()
        //     ->chunk(3);
        $quarter1 = Permanence::where('year', '=', $year)
            ->where('quarter', '=', 1)
            ->get()
            ->chunk(3);
        $quarter2 = Permanence::where('year', '=', $year)
            ->where('quarter', '=', 2)
            ->get()
            ->chunk(3);
        $quarter3 = Permanence::where('year', '=', $year)
            ->where('quarter', '=', 3)
            ->get()
            ->chunk(3);
        // dd($quarter3);
        $quarter4 = Permanence::where('year', '=', $year)
            ->where('quarter', '=', 4)
            ->get()
            ->chunk(3);
        $wholeYear = Permanence::where('year', '=', $year)
            ->get()
            ->chunk(12);
        $nextYearQuarter1 = Permanence::where('year', '=', $year+1)
            ->where('quarter', '=', 1)
            ->get()
            ->chunk(3);

            // dd($nextQuarter);
        // dd($year);
        // dd($nextQuarterYear);
            // dd($nextYearQuarter1);

        return View::make('back.permanences.index')
            // ->with('calendar', $calendar)
            ->with('calendarQuarter1', $calendarQuarter1)
            ->with('calendarQuarter2', $calendarQuarter2)
            ->with('calendarQuarter3', $calendarQuarter3)
            ->with('calendarQuarter4', $calendarQuarter4)
            ->with('calendarWholeYear', $calendarWholeYear)
            ->with('calendarNextYearQuarter1', $calendarNextYearQuarter1)
            // ->with('permanences', $permanences)
            ->with('quarter1', $quarter1)
            ->with('quarter2', $quarter2)
            ->with('quarter3', $quarter3)
            ->with('quarter4', $quarter4)
            ->with('wholeYear', $wholeYear)
            ->with('year', $year)
            ->with('nextQuarterYear', $nextQuarterYear)
            ->with('nextQuarter', $nextQuarter)
            ->with('nextYearQuarter1', $nextYearQuarter1)
            ->with('siteParameters', $siteParameters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('back.permanences.create');
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
            // 'firstname' => ['required', 'min:2', 'max:32'],
            // 'lastname'  => ['required', 'min:2', 'max:32'],
            // 'email' => ['required', 'email', 'unique:users'],
            // 'password'  => ['required', 'min:6', 'confirmed'],
            // 'password_confirmation' => ['required']
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();
            $data +=['lawyer_id' => 1];
            // dd($data);

            Permanence::create($data);

            Session::flash('success', 'Permanence créée avec succès.');
            return Redirect::route('back.permanences.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($values)
    {
        $array = explode("-", $values);
        // dd(count($array));
        if (count($array) == 3) {
            $id = $array[0];
            $nextQuarterYear = $array[1];
            $nextQuarter = $array[2];
        } else {
            Session::flash('error', 'Permanence non trouvée.');
            return redirect::back();
        }

        $lawyer = Lawyer::where('id', '=', $id)->firstOrFail();

        $calendar = Calendar::where('year', '=', $nextQuarterYear)->where('quarter', '=', $nextQuarter)->get();

        $permanence = Permanence::where('lawyer_id', '=', $id)
            ->where('year', '=', $nextQuarterYear)
            ->where('quarter', '=', $nextQuarter)
            ->get();
        // dd($permanence);

        return View::make('back.permanences.show')
            ->with('lawyer', $lawyer)
            ->with('nextQuarterYear', $nextQuarterYear)
            ->with('nextQuarter', $nextQuarter)
            ->with('calendar', $calendar)
            ->with('permanence', $permanence);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($values)
    {
        $array = explode("-", $values);
        if (count($array) == 3) {
            $id = $array[0];
            $nextQuarterYear = $array[1];
            $nextQuarter = $array[2];
        } else {
            Session::flash('error', 'Permanence non trouvée.');
            return redirect::back();
        }

        // $id = 1;
        // $nextQuarterYear = 2018;
        // $nextQuarter = 2;

        $lawyer = Lawyer::where('id', '=', $id)->firstOrFail();

        $calendar = Calendar::where('year', '=', $nextQuarterYear)->where('quarter', '=', $nextQuarter)->get();

        $permanence = Permanence::where('lawyer_id', '=', $id)
            ->where('year', '=', $nextQuarterYear)
            ->where('quarter', '=', $nextQuarter)
            ->get();
        // dd($permanence);

        return View::make('back.permanences.edit')
            ->with('lawyer', $lawyer)
            ->with('nextQuarterYear', $nextQuarterYear)
            ->with('nextQuarter', $nextQuarter)
            ->with('calendar', $calendar)
            ->with('permanence', $permanence);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = Input::all();
        // dd($data);

        // $permanence = Permanence::findOrFail($id);
        // $permanence->update($data);

        // Session::flash('success', 'Permanence modifiée avec succès.');
        // // \Toastr::success('Informations modifiées<br /> avec succès', 'Succès');
        // return Redirect::route('back.permanences.index');
        // dd($request);
        // $lawyer = Lawyer::where('id', '=', $)

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
            // dd($data);

            for ($i = 0; $i <= 2; $i++) {
                $data2[$i] = [
                    'lawyer_id' => $data['lawyer_id'],
                    'year' => $data['year'],
                    'quarter' => $data['quarter'],
                    'month' => $data['month' . $i],
                    'week1' => $data['month' . $i . '_week1'],
                    'week1_nb' => $data['month' . $i . '_week1_nb'],
                    'week2' => $data['month' . $i . '_week2'],
                    'week2_nb' => $data['month' . $i . '_week2_nb'],
                    'week3' => $data['month' . $i . '_week3'],
                    'week3_nb' => $data['month' . $i . '_week3_nb'],
                    'week4' => $data['month' . $i . '_week4'],
                    'week4_nb' => $data['month' . $i . '_week4_nb'],
                    'week5' => $data['month' . $i . '_week5'],
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

            Session::flash('success', "Permanence modifiée avec succès.");
            return Redirect::route('back.permanences.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_attribution(Request $request)
    {
        $data = $request;
        // dd($data);
        $id = $request->id;
        $week = $request->week;
        $value = $request->value;

        $permanence = Permanence::where('id', '=', $id)->firstOrFail();
        $permanence->update([$week . '_attr' => $value]);

        return response()->json($permanence[$week . '_nb']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($values)
    {
        // dd($values);
        $array = explode("-", $values);
        if (count($array) == 3) {
            $id = $array[0];
            $nextQuarterYear = $array[1];
            $nextQuarter = $array[2];
        } else {
            Session::flash('error', 'Permanence non trouvée.');
            return redirect::back();
        }

        $months = Permanence::where('lawyer_id', '=', $id)
            ->where('year', '=', $nextQuarterYear)
            ->where('quarter', '=', $nextQuarter)
            ->get();
        // dd($months);

        foreach ($months as $month) {
            $month->delete();
        }

        Session::flash('success', 'Permanence supprimée avec succès!');
        return redirect::route('back.permanences.index');
    }

    public function showEmail($id)
    {
        $lawyer = Lawyer::findOrFail($id);
        // dd($lawyer);
        return new PermanencesRegistrationPeriod($lawyer);
    }

    public function sendEmail() {
        $method = Input::get('method');
        // dd($method);

        if ($method === 'copyAvailabilities') {
            return $this->copyAvailabilities();
        } elseif ($method === 'sendEmail') {
            // dd('abc');
            // return 'def';
            $lawyers = Input::get('lawyers');
            // $lawyers = Lawyer::where('id', '=', 30)->get();
            $emails = [];
            $data = [];

            foreach ($lawyers as $lawyer) {
                array_push($emails, $lawyer['email']);
                $data['lawyers'][$lawyer['email']] = [
                    'id' => $lawyer['id'],
                    'firstname' => $lawyer['firstname'],
                    'lastname' => $lawyer['lastname'],
                    'email' => $lawyer['email']
                ];
            }
            $recipients = json_encode($data['lawyers']);

            # Instantiate the client.
            $mgClient = new Mailgun(env('MAIL_SECRET'));
            $domain = "jbne.ch";

            // $path = resource_path('views/emails/welcome.blade.php');
            $path = resource_path('views/emails/permanences_registration_period_mailgun.blade.php');
            $message = file_get_contents($path);
            # Make the call to the client.
            $result = $mgClient->sendMessage($domain, array(
                'from'    => 'Test message <jm.kleger@gmail.com>',
                // 'to'      => 'jm.kleger@gmail.com',
                'to'      => $emails,
                'subject' => '%recipient.firstname%',
                // 'text'    => 'Testing some Mailgun awesomness!'
                'html'    => $message,
                'recipient-variables' => $recipients
            ));

            if ($result) {
                Session::flash('success', 'E-mails envoyés avec succès.');
            } else {
                Session::flash('error', 'Les e-mails n\'ont pas pu être envoyés.');
            }

            return redirect::back();
        }
    }

    public function copyPermanencesTable() {
        // 1) Retrieve permanences
        $permanences = Permanence::all();

        // 2) Delete current copy of permanences
        $permances_copy = DB::table('permanences_copy')->delete();

        // 3) Make the copy
        $permanences_copy = new PermanenceCopy;
        foreach ($permanences as $permanence) {
            // dd($permanence);
            $permanences_copy->insert([
                'lawyer_id'     => $permanence['lawyer_id'],
                'year'          => $permanence['year'],
                'quarter'       => $permanence['quarter'],
                'month'         => $permanence['month'],
                'week1_dispo'   => $permanence['week1_dispo'],
                'week1_attr'    => $permanence['week1_attr'],
                'week1_nb'      => $permanence['week1_nb'],
                'week2_dispo'   => $permanence['week2_dispo'],
                'week2_attr'    => $permanence['week2_attr'],
                'week2_nb'      => $permanence['week2_nb'],
                'week3_dispo'   => $permanence['week3_dispo'],
                'week3_attr'    => $permanence['week3_attr'],
                'week3_nb'      => $permanence['week3_nb'],
                'week4_dispo'   => $permanence['week4_dispo'],
                'week4_attr'    => $permanence['week4_attr'],
                'week4_nb'      => $permanence['week4_nb'],
                'week5_dispo'   => $permanence['week5_dispo'],
                'week5_attr'    => $permanence['week5_attr'],
                'week5_nb'      => $permanence['week5_nb']
            ]);
        }

        Session::flash('success', 'Copie de la table des permanences effectuée avec succès.');
        return redirect::back();
        

        \App\PermanenceCopy::where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->updateOrCreate([
                'lawyer_id' => $data['lawyer_id'],
                'year'      => $data['year'],
                'quarter'   => $data['quarter'],
                'month'     => $data['month'],
                'week1'     => $data['week1'],
                'week1_nb'  => $data['week1_nb'],
                'week2'     => $data['week2'],
                'week2_nb'  => $data['week2_nb'],
                'week3'     => $data['week3'],
                'week3_nb'  => $data['week3_nb'],
                'week4'     => $data['week4'],
                'week4_nb'  => $data['week4_nb'],
                'week5'     => $data['week5'],
                'week5_nb'  => $data['week5_nb'],
                // 'user_id'   => Auth::user()->id,
                // 'about'     => $request->get('about'),
                // 'sec_email' => $request->get('sec_email'),
                // 'gender'    => $request->get("gender"),
                // 'country'   => $request->get('country'),
                // 'dob'       => $request->get('dob'),
                // 'address'   => $request->get('address'),
                // 'mobile'    => $request->get('cell_no')
            ]);
    }

    // Permancences attribution algorithm. Use var_dump() to debug.
    public function generateAttributions($year, $quarter) {

        $year = intval($year);
        $quarter = intval($quarter);

        // Delete all past attributions
        $this->deletePermanencesAttributions($year, $quarter);

        // Build an array of lawyers availabilities (from least to most)
        $lawyers_availabilities = $this->getLawyersAvailabilities($year, $quarter);

        // Get the total number of lawyers that have at least one week available during the quarter
        $total_lawyers = count($lawyers_availabilities);

        // Build an array of weekly availabilities (from least to most)
        $weekly_availabilities = $this->getWeeklyAvailabilities($year, $quarter);

        // Get the number of weeks in the quarter (could be 12, 13 or 14)
        $total_weeks = $this->getTotalWeeks($year, $quarter);

        // Get the total slots (each week has 4 slots)
        $total_slots = $total_weeks * 4;

        // If there are more lawyers than total slots, remove lawyers with fewer availabilities from the array of lawyer availabilities (lawyers with the least availabilities will not get any attribution)
        if ($total_lawyers > $total_slots) {
            $diff = $total_lawyers - $total_slots;
            $counter = 0;
            foreach ($lawyers_availabilities as $key => $value) {
                if ($counter >= $diff) {
                    break;
                }
                unset($lawyers_availabilities[$key]);
                $counter++;
            }
        }

        // Define lawyers array for the first round
        $first_round_lawyers_array = $lawyers_availabilities;

        // Reverse order for the second round (lawyers with most availabilities come first)
        $second_round_lawyers_array = $lawyers_availabilities;
        arsort($second_round_lawyers_array);
        
        // Set all weekly attributions to 0 before starting the first round and second round
        $weekly_attributions = [];
        foreach ($weekly_availabilities as $key=>$week_nb) {
            $weekly_attributions[$key] = 0;
        }

        // Start the first round of attributions
        // dd($weekly_availabilities);
        // dd($year_week_nb);
        // dd($year);
        // dd($quarter);
        // $a = array($year_week_nb, $year, $quarter);
        // var_dump($a);
        foreach ($weekly_availabilities as $key=>$week) {
            $year_week_nb = $key;            
            $month_week_nb = $this->getMonthWeekNb($year_week_nb, $year, $quarter);
            $counter = 0;
            $lawyer_offices_array = [];

            foreach ($first_round_lawyers_array as $key=>$lawyer) {
                $lawyer_id = $key;

                if ($counter >= 4) {
                    unset($weekly_availabilities[$year_week_nb]);
                    $counter++;
                    break;
                }


                $permanence = Permanence::where('lawyer_id', '=', $lawyer_id)
                    ->where('year', '=', $year)
                    ->where('quarter', '=', $quarter)
                    ->where('week' . $month_week_nb . '_nb', '=', $year_week_nb)
                    ->where('week' . $month_week_nb . '_dispo', '=', 1)
                    ->first();
                if ($permanence) {
                    if (!in_array($permanence->lawyer->lawyer_office_id, $lawyer_offices_array)) {
                        if ($weekly_attributions[$year_week_nb] < 4) {
                            $permanence->update(['week' . $month_week_nb . '_attr' => 1]);
                            $counter++;
                            if ($permanence->lawyer->lawyer_office_id) {
                                array_push($lawyer_offices_array, $permanence->lawyer->lawyer_office_id);
                            } 
                            unset($first_round_lawyers_array[$permanence->lawyer_id]);
                            $weekly_attributions[$year_week_nb] += 1;
                        }    
                    }
                }
            }
        }

        // Start the second round of attributions
        foreach ($weekly_availabilities as $key=>$week) {
            $year_week_nb = $key;
            $month_week_nb = $this->getMonthWeekNb($year_week_nb, $year, $quarter);
            $counter = 0;
            $lawyer_offices_array = [];

            foreach ($second_round_lawyers_array as $key=>$lawyer) {
                $lawyer_id = $key;

                if ($counter >= 4) {
                    unset($weekly_availabilities[$year_week_nb]);
                    $counter++;
                    break;
                }

                $permanence = Permanence::where('lawyer_id', '=', $lawyer_id)
                    ->where('year', '=', $year)
                    ->where('quarter', '=', $quarter)
                    ->where('week' . $month_week_nb . '_nb', '=', $year_week_nb)
                    ->where('week' . $month_week_nb . '_dispo', '=', 1)
                    ->first();
                if ($permanence) {
                    if (!in_array($permanence->lawyer->lawyer_office_id, $lawyer_offices_array)) {
                        if ($weekly_attributions[$year_week_nb] < 4) {
                            $permanence->update(['week' . $month_week_nb . '_attr' => 1]);
                            $counter++;
                            if ($permanence->lawyer->lawyer_office_id) {
                                array_push($lawyer_offices_array, $permanence->lawyer->lawyer_office_id);
                            }
                            unset($second_round_lawyers_array[$permanence->lawyer_id]);
                            $weekly_attributions[$year_week_nb] += 1;
                        }    
                    }
                }
            }
        }
        Session::flash('success', 'Génération de l\'attribution des permanences effectuée avec succès.');
        return redirect::back();
    }

    public function getMonthWeekNb($yearWeekNb, $year, $quarter) {
        $month_week_nb = '';
        if (Calendar::where('year', '=', $year)->where('quarter', '=', $quarter)->where('week1_nb', 'LIKE', $yearWeekNb)->first()) {
            $month_week_nb = 1;
        } elseif (Calendar::where('year', '=', $year)->where('quarter', '=', $quarter)->where('week2_nb', 'LIKE', $yearWeekNb)->first()) {
            $month_week_nb = 2;
        } elseif (Calendar::where('year', '=', $year)->where('quarter', '=', $quarter)->where('week3_nb', 'LIKE', $yearWeekNb)->first()) {
            $month_week_nb = 3;
        } elseif (Calendar::where('year', '=', $year)->where('quarter', '=', $quarter)->where('week4_nb', 'LIKE', $yearWeekNb)->first()) {
            $month_week_nb = 4;
        } elseif (Calendar::where('year', '=', $year)->where('quarter', '=', $quarter)->where('week5_nb', 'LIKE', $yearWeekNb)->first()) {
            $month_week_nb = 5;
        }
        return $month_week_nb;
    }

    public function deletePermanencesAttributions($year, $quarter) {
        $year = intval($year);
        $quarter = intval($quarter);

        for ($i = 1; $i <= 5; $i++) {
            Permanence::where('year', '=', $year)
                ->where('quarter', '=', $quarter)
                ->update(['week' . $i . '_attr' => NULL]);
        }

        Session::flash('success', 'Suppression des attributions effectuée avec succès.');
        return redirect::back();
    }

    public function getLawyersAvailabilities($year, $quarter) {

        $permanences = Permanence::where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->get()
            ->chunk(3);
        $lawyers_availabilities = [];

        foreach ($permanences as $key=>$permanences_lawyer) {
            $total_lawyers_availabilities = 0;
            $lawyer_id = '';
            foreach ($permanences_lawyer as $permanences_lawyer_month) {
                $lawyer_id = $permanences_lawyer_month->lawyer_id;
                $total_lawyers_availabilities += $permanences_lawyer_month->week1_dispo + $permanences_lawyer_month->week2_dispo + $permanences_lawyer_month->week3_dispo + $permanences_lawyer_month->week4_dispo + $permanences_lawyer_month->week4_dispo + $permanences_lawyer_month->week5_dispo;
            }
            $lawyers_availabilities[$lawyer_id] = $total_lawyers_availabilities;
        }

        // Remove lawyers that have no availabilities
        array_filter($lawyers_availabilities);

        // Sort lawyers by least availabilities
        asort($lawyers_availabilities);

        return $lawyers_availabilities;
        /*
            The returned array has the following structure:
            $lawyer_availabilities = [
                9 => 3,
                1 => 4,
                4 => 4,
                6 => 5,
                14 => 6,
                12 => 6,
                10 => 6,
                11 => 6,
                7 => 6,
                8 => 7,
                2 => 7,
                17 => 7,
                13 => 8,
                3 => 8,
                5 => 9,
                16 => 10,
                19 => 10,
                15 => 11,
                20 => 12,
                18 => 13
            ]
            It reads like this: Lawyer 9 has only 3 availabilities, lawyer 1 has 4 etc.
        */
    }

    public function getWeeklyAvailabilities($year, $quarter) {

        $permanences = Permanence::where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->get();
        $weekly_availabilities = [];

        foreach ($permanences as $permanences_lawyer) {
            if ($permanences_lawyer->week1_dispo) {
                if (array_key_exists($permanences_lawyer->week1_nb, $weekly_availabilities)) {
                    $weekly_availabilities[$permanences_lawyer->week1_nb] += 1;
                } else {
                    $weekly_availabilities[$permanences_lawyer->week1_nb] = 1;
                }
            }
            if ($permanences_lawyer->week2_dispo) {
                if (array_key_exists($permanences_lawyer->week2_nb, $weekly_availabilities)) {
                    $weekly_availabilities[$permanences_lawyer->week2_nb] += 1;
                } else {
                    $weekly_availabilities[$permanences_lawyer->week2_nb] = 1;
                }
            }
            if ($permanences_lawyer->week3_dispo) {
                if (array_key_exists($permanences_lawyer->week3_nb, $weekly_availabilities)) {
                    $weekly_availabilities[$permanences_lawyer->week3_nb] += 1;
                } else {
                    $weekly_availabilities[$permanences_lawyer->week3_nb] = 1;
                }
            }
            if ($permanences_lawyer->week4_dispo) {
                if (array_key_exists($permanences_lawyer->week4_nb, $weekly_availabilities)) {
                    $weekly_availabilities[$permanences_lawyer->week4_nb] += 1;
                } else {
                    $weekly_availabilities[$permanences_lawyer->week4_nb] = 1;
                }
            }
            if ($permanences_lawyer->week5_dispo) {
                if (array_key_exists($permanences_lawyer->week5_nb, $weekly_availabilities)) {
                    $weekly_availabilities[$permanences_lawyer->week5_nb] += 1;
                } else {
                    $weekly_availabilities[$permanences_lawyer->week5_nb] = 1;
                }
            }
        }

        // Sort weeks by least lawyer availabilities
        asort($weekly_availabilities);

        return $weekly_availabilities;
        /*
            The returned array has the following structure:
            $weekly_availabilities = [
                35 => 6,
                39 => 8
                28 => 8,
                31 => 9,
                36 => 9,
                37 => 9,
                30 => 9,
                33 => 9,
                38 => 10,
                32 => 10,
                34 => 11,
                27 => 12,
                29 => 25
            ],
            It reads like this: week 35 has the fewest availabilities (6 lawyers), 8 lawyers are available on week 39, etc.
        */
    }

    public function getTotalWeeks($year, $quarter) {

        $calendar = Calendar::where('year', '=', $year)
            ->where('quarter', '=', $quarter)
            ->get();

        $total_weeks = 0;

        foreach ($calendar as $key=>$month) {
            if ($month->week1) {
                $total_weeks++;
            }
            if ($month->week2) {
                $total_weeks++;
            }
            if ($month->week3) {
                $total_weeks++;
            }
            if ($month->week4) {
                $total_weeks++;
            }
            if ($month->week5) {
                $total_weeks++;
            }
        }
        return $total_weeks;
    }

    public function toggleShowAttributions() {
        $isChecked = Input::get('isChecked');
        $displayNextQuarterAttributions = SiteParameter::where('name', '=', 'display_next_quarter_attributions')->firstOrFail();
        
        $displayNextQuarterAttributions->boolean_value = !$displayNextQuarterAttributions->boolean_value;
        $displayNextQuarterAttributions->save();

        // $isChecked = Input::get('isChecked');
        // $envKey = "DISPLAY_NEXT_QUARTER_ATTRIBUTIONS";
        // $newValue = $isChecked;
        // $envFile = app()->environmentFilePath();
        // $str = file_get_contents($envFile);
        // $oldValue = env($envKey);
        // // dd($newValue);
        // dd($oldValue);

        // if ($oldValue === true) {
        //     $oldValue = "true";
        // } else {
        //     $oldValue = "false";
        // }
        // $str1 = str_replace("{$envKey}={$oldValue}", "{$envKey}={$newValue}", $str);

        // $fp = fopen($envFile, 'w');
        // fwrite($fp, $str1);
        // fclose($fp);

        // return response()->json($newValue);
    }
}
