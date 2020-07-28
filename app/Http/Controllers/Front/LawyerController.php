<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Session;
use App\Lawyer;
use Redirect;
use Validator;
use Input;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\StoreLawyer;
use App\Http\Requests\UpdateLawyer;
use App\Permanence;
use App\FormulaireContact;
use App\Mail\Contact;
use Mail;
use App\LawyerOffice;
use App\Http\Requests\StoreLawyerOffice;
use App\Calendar;
use Hash;
use URL;
use Mailgun\Mailgun;
use Storage;

class LawyerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:lawyer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lawyer_id = Auth::guard('lawyer')->user()->id;
        $lawyer = Lawyer::where('id', '=', $lawyer_id)->firstOrFail();

        return View::make('lawyer.index')
            ->with('lawyer', $lawyer);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lawyer = Lawyer::findOrFail($id);
        $lawyer_offices = LawyerOffice::orderBy('name', 'asc')->get();
        $showForm = false;
        if ($request->query('showForm')) {
            $showForm = true;
        }

        return View::make('lawyer.edit')
            ->with('lawyer', $lawyer)
            ->with('lawyer_offices', $lawyer_offices)
            ->with('showForm', $showForm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLawyer $request, $id)
    {
        $data = Input::all();
        $lawyer = Lawyer::findOrFail($id);
        $lawyer->update($data);

        \Toastr::success('Informations modifiées<br /> avec succès', 'Succès');
        return Redirect::to('avocat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lawyer = Lawyer::findOrFail($id);

        $lawyer->delete();

        Session::flash('success', 'Avocat supprimé avec succès!');
        return redirect::to('lawyers');
    }

    public function changePassword(Request $request, $id)
    {
        $rules = array(
            'new_password'  => ['required', 'min:6', 'confirmed'],
            'new_password_confirmation' => ['required']
        );

        $validator = Validator::make(Input::all(), $rules);

        // check if new password format is valid
        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#password")
            // return Redirect::back()
                ->withErrors($validator);
        } else { // valid format, check if old password is correct            
            $current_password = Auth::User()->password;           
            if (Hash::check($request->old_password, $current_password)) {
                $lawyer_id = Auth::guard('lawyer')->user()->id;
                $lawyer = Lawyer::findOrFail($lawyer_id);

                $lawyer->password = Hash::make($request->new_password);
                $lawyer->save();
            } else {
                Session::flash('error', 'Le mot de passe actuel n\'est pas correct');
                // \Toastr::error('Vous ne pouvez pas <br/>modifier ce mot de passe', 'Erreur');
                \Toastr::error('Le mot de passe actuel n\'est pas correct.', 'Erreur', ['timeOut' => 0]);

                return Redirect::back();
            }
            Session::flash('success', 'e mot de passe a été modifié avec succès');
            // \Toastr::success('Mot de passe modifié', 'Succès');
            return Redirect::back();
        }
    }

    public function lawyerAvailability(Request $request)
    {
        $year = date('Y');
        // $month = date('n');
        $date = date('j');

        $week_nb = intVal(ltrim(date('W'), '0'));

        // $permanences = Permanence::where('year', '=', $year)->where($week, '=', 1)->inRandomOrder()->get();
        $calendar = Calendar::where('year', '=', $year)
            ->where('week1_nb', '=', $week_nb)
            ->orWhere('week2_nb', '=', $week_nb)
            ->orWhere('week3_nb', '=', $week_nb)
            ->orWhere('week4_nb', '=', $week_nb)
            ->orWhere('week5_nb', '=', $week_nb)
            ->first();

        switch ($calendar) {
            case $calendar->week1_nb === $week_nb:
                $weekInMonth = 1;
                break;
            case $calendar->week2_nb === $week_nb:
                $weekInMonth = 2;
                break;
            case $calendar->week3_nb === $week_nb:
                $weekInMonth = 3;
                break;
            case $calendar->week4_nb === $week_nb:
                $weekInMonth = 4;
                break;
            case $calendar->week5_nb === $week_nb:
                $weekInMonth = 5;
                break;

        }

        $week_name = 'week' . $weekInMonth;
        $week = $calendar->$week_name;

        $allPermanences = Permanence::where('year', '=', $year)
            ->where('week1_nb', '=', $week_nb)
            ->orWhere('week2_nb', '=', $week_nb)
            ->orWhere('week3_nb', '=', $week_nb)
            ->orWhere('week4_nb', '=', $week_nb)
            ->orWhere('week5_nb', '=', $week_nb)
            ->inRandomOrder()
            ->get();
        $permanences = $allPermanences->where('week' . $weekInMonth . '_attr', '=', 1);

        return View::make('lawyer.availability')
            ->with('week', $week)
            ->with('permanences', $permanences);
    }

    public function submitQuestion(Request $request)
    {
        // dd('abc');
        $rules = array(
            'message' => ['required','max:2048', "regex:/^[a-zàâçéèêëîïôûùüÿñæœ0-9?$@#()'!,+\-=_:.&€£*%\s]+$/i"],
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->with('error_code', 'modal')
                ->withErrors($validator)
                ->withInput();
        } else {
            // $data = Input::all();

            // $lawyer = Auth::guard('lawyer')->user();
            // $data['nom'] = $lawyer->lastname;
            // $data['prenom'] = $lawyer->firstname;
            // $data['email'] = $lawyer->email;

            // FormulaireContact::create($data);

            // $receiverAddress = [env('MAIL_ALL_RECEIVER'), env('MAIL_CONTACT_RECEIVER')];
            
            // Mail::to($receiverAddress)->send(new Contact($data));

            // \Toastr::success('Votre question nous a bien <br/>été envoyée.', 'Succès', ['timeOut' => 0]);
            // return Redirect::back();

            $data = Input::all();
            // dd($data);
            $lawyer = Auth::guard('lawyer')->user();
            $receiverAddress = env('MAIL_CONTACT_RECEIVER');
            $content = array($receiverAddress => array('prenom' => $lawyer->firstname, 'nom' => $lawyer->lastname, 'email' => $lawyer->email, 'message' => $data['message']));
            $mgClient = new Mailgun(env('MAIL_SECRET'));
            $domain = "jbne.ch";
            $html = Storage::disk('local')->get('public/contact_mailgun.html');

            $result = $mgClient->sendMessage($domain, array(
                'from'    => 'info@jbne.ch',
                'to'      => $receiverAddress,
                'subject' => 'Message envoyé depuis le formulaire de contact du site www.jbne.ch',
                'html'    => $html,
                'recipient-variables' => json_encode($content)
            ));

            if ($result->http_response_code = 200) {
                \Toastr::success('Votre question nous a bien <br/>été envoyée.', 'Succès', ['timeOut' => 0]);
                return Redirect::back();
            } else {
                \Toastr::error('Une erreur est survenue et votre question n\'a pas pu nous être envoyée.', 'Erreur', ['timeOut' => 0]);
                return Redirect::back();
            }
        }
    }

    public function addNewLawyerOffice(Request $request) {
        $lawyer_id = Auth::guard('lawyer')->user()->id;
        $rules = array(
            'lawyer_office_name' => ['required', 'min:2', 'max:128', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'lawyer_office_street'  => ['required', 'min:2', 'max:128', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.()\'-]+$/i'],
            'lawyer_office_city' => ['required', 'min:2', 'max:128', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.()\'-]+$/i'],
            'phone_office' => ['sometimes', 'nullable', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],

            'fax_office' => ['required', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
        );
        // dd($request);
        // $inputs = Input::all();
        // $inputs['username'] = 'abc';
        // $inputs['email'] = 'abc';
        // dd($inputs);
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('lawyer.edit', ['id'=> $lawyer_id, 'showAddForm'=> true])
                ->withErrors($validator)
                ->withInput();
        }

        $data = Input::all();

        $lawyerOffice = LawyerOffice::create([
            'updated_by' => $lawyer_id,
            'name' => $data['lawyer_office_name'],
            'street' => $data['lawyer_office_street'],
            'city' => $data['lawyer_office_city'],
            'phone_office' => $data['phone_office'],
            'fax_office' => $data['fax_office'],
        ]);

        \Toastr::success('Étude ajoutée avec succès', 'Succès');
        // return back()->withInput();
        return back();
    }

    public function getLawyerOfficeData () {
        // $abc = Input::get('lawyer_office_id');
        $lawyer_office_id = Input::get('lawyer_office_id');

        $lawyer_office_data = LawyerOffice::where('id', '=', $lawyer_office_id)->firstOrFail();

        return response()->json($lawyer_office_data);
    }

    public function updateLawyerOffice () {
        $lawyer_id = Auth::guard('lawyer')->user()->id;
        $rules = array(
            'new_lawyer_office_name' => ['required', 'min:2', 'max:128', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'new_lawyer_office_street'  => ['required', 'min:2', 'max:128', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.()\'-]+$/i'],
            'new_lawyer_office_city' => ['required', 'min:2', 'max:128', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.()\'-]+$/i'],
            'new_phone_office' => ['sometimes', 'nullable', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
            'new_fax_office' => ['required', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
        );
            // return redirect()->route('home');


        $validator = Validator::make(Input::all(), $rules);
        $lawyer = Lawyer::findOrFail($lawyer_id);

        if ($validator->fails()) {
            // return redirect()->back();
            // return redirect()->back()->withErrors($validator)->withInput()->with('lawyer', $lawyer);
            return redirect()->route('lawyer.edit', ['id'=> $lawyer_id, 'showUpdateForm'=> true])
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();
            $lawyer_office_id = $data['new_lawyer_office_id'];
            $lawyer_office = LawyerOffice::findOrFail($lawyer_office_id);

            $lawyerOffice = LawyerOffice::where('id', '=', $lawyer_office->id)->update([
                'updated_by' => $lawyer_id,
                'name' => $data['new_lawyer_office_name'],
                'street' => $data['new_lawyer_office_street'],
                'city' => $data['new_lawyer_office_city'],
                'phone_office' => $data['new_phone_office'],
                'fax_office' => $data['new_fax_office'],
            ]);

            \Toastr::success('Étude modifiée avec succès', 'Succès');
            return back();
        }

        
    }
}
