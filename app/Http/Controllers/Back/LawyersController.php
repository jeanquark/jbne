<?php namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lawyer;
use Redirect;
use Input;
use View;
use Validator;
use Session;
use Hash;
use App\Http\Requests\StoreLawyerBackend;
use App\Http\Requests\UpdateLawyerBackend;
use App\LawyerOffice;
use Mailgun\Mailgun;

use App\Mail\PermanencesRegistrationPeriod;
use Mail;
use Storage;
use App\Mail\ValiderInscriptionMembres;

class LawyersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lawyers = Lawyer::orderBy('id', 'desc')->get();

        // $lawyers = '';
        // foreach($allLawyers as $lawyer) {
        //     $lawyers = $lawyers . ',' . 
        //         'id': $lawyer['id'],
        //         'email' => $lawyer['email'], 
        //         'firstname' => $lawyer['firstname'],
        //         'lastname' => $lawyer['lastname']
        //     ));
        //     // json_encode(array($lawyer['email'] => json_encode(array(
        //     //     'id' => $lawyer['id'],
        //     //     'email' => $lawyer['email'], 
        //     //     'firstname' => $lawyer['firstname'],
        //     //     'lastname' => $lawyer['lastname']
        //     // )))));
        // }
        // dd(json_encode($lawyers));

        return View::make('back.lawyers.index')
            ->with('lawyers', $lawyers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('back.lawyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLawyerBackend $request)
    {
        $rules = array(
            'firstname' => ['required', 'min:2', 'max:32'],
            'lastname'  => ['required', 'min:2', 'max:32'],
            'email' => ['required', 'email', 'max:64'],
            'username' => ['required', 'string', 'min:6', 'max:24', 'unique:lawyers,username'],
            'password'  => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required']
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();
            if ($request->has('password')) {
                $hashed_passwd = Hash::make($request->password);
                $data['password'] = $hashed_passwd;
            }
            $data['is_confirmed'] = 1;

            // $data +=['lawyer_id' => 1];
            // dd($data);

            Lawyer::create($data);

            Session::flash('success', 'Avocat créé avec succès.');
            return Redirect::route('back.lawyers.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lawyer = Lawyer::findOrFail($id);

        return View::make('back.lawyers.show')
            ->with('lawyer', $lawyer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lawyer = Lawyer::findOrFail($id);

        return View::make('back.lawyers.edit')
            ->with('lawyer', $lawyer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLawyerBackend $request, $id)
    {
        $data = Input::all();
        // dd($data);
        if (isset($data['is_verified'])) {
            $data['is_verified'] = true;
        } else {
            $data['is_verified'] = false;
        };

        $lawyer = Lawyer::findOrFail($id);
        $lawyer->update($data);

        Session::flash('success', 'Avocat modifié avec succès.');
        // \Toastr::success('Informations modifiées<br /> avec succès', 'Succès');
        return Redirect::route('back.lawyers.index');
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
        return redirect::to('back/lawyers');
    }

    public function showEmail($id)
    {
        $lawyer = Lawyer::findOrFail($id);
        return new PermanencesRegistrationPeriod($lawyer);
    }

    public function sendEmail()
    {
        $lawyers = Input::get('lawyers');
        // dd($lawyers);
         
        foreach($lawyers as $lawyer) {
            Mail::to($lawyer['email'])->send(new PermanencesRegistrationPeriod($lawyer));
        }




        // $lawyers = Input::get('lawyers');
        // // dd(json_encode($lawyers));

        // $emails = [];
        // foreach($lawyers as $lawyer) {
        //     array_push($emails, $lawyer['email']);
        // }
        // // dd($emails);

        // $mgClient = new Mailgun(env('MAIL_SECRET'));
        // $domain = "jbne.ch";
 
        // $html = Storage::disk('local')->get('public/permanences_registration_period_mailgun.html');

        // $result = $mgClient->sendMessage($domain, array(
        //     'from'    => 'info@jbne.ch',
        //     'to'      => $emails,
        //     'subject' => 'Ouverture de la période d\'enregistrement des disponibilités pour la permanence',
        //     'text'    => 'Veuillez noter qu\'il vous est désormais possible de nous communiquer vos disponibilités pour la permanence du prochain trimestre. Pour ce faire, veuillez vous rendre sur le site du JBNE en vous connectant avec vos identifiants d\'avocat. N\'hésitez pas à nous contacter en cas de problème.',
        //     'html'    => $html,
        //     'recipient-variables' => json_encode($lawyers)
        // ));
    }
}
