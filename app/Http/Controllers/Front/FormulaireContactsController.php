<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\FormulaireContact;

use App\Http\Requests\StoreContact;
use App\Mail\Contact;
use Mailgun\Mailgun;
use Validator;
use Redirect;
use Storage;
use Session;
use Input;
use View;
use Mail;

use Illuminate\Support\Facades\URL;

class FormulaireContactsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Redirect::to('/#contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreContact $request) // Does not redirect to anchor
    public function store(Request $request)
    {
        // dd('abc');
        $rules = array(
            'nom' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'prenom' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
        	'email' => ['required', 'email'],
            'message' => ['required','max:2048', "regex:/^[a-zàâçéèêëîïôûùüÿñæœ0-9?$@#()'!,+\-=_:.&€£*%\s]+$/i"],
            'g-recaptcha-response' => 'required|captcha'
        );

        $validator = Validator::make(Input::all(), $rules);
        // dd($validator);
        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#contact")
                ->withErrors($validator)
                ->withInput();
        } else {

            $data = Input::all();

            FormulaireContact::create($data);

            $receiverAddress = [env('MAIL_ALL_RECEIVER'), env('MAIL_CONTACT_RECEIVER')];
            Mail::to($receiverAddress)->send(new Contact($data));

            \Toastr::success('Votre message nous a bien <br/>été envoyé.', 'Succès', ['timeOut' => 0]);
            //return Redirect::to('formulaire-contact');
            return Redirect::to(URL::previous() . "#contact");
        }
        
    }
}
