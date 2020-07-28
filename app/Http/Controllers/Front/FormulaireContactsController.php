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
    public function store(Request $request)
    {
    	$rules = array(
            'nom' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'prenom' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
        	'email' => ['required', 'email'],
            'message' => ['required','max:2048', "regex:/^[a-zàâçéèêëîïôûùüÿñæœ0-9?$@#()'!,+\-=_:.&€£*%\s]+$/i"],
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#contact")
                ->withErrors($validator)
                ->withInput();
        } else {
	        // $data = Input::all();
         //    // dd($data);

	        // FormulaireContact::create($data);

	        // $receiverAddress = [env('MAIL_CONTACT_RECEIVER')];
         //    dd($receiverAddress);
	        // //Mail::to($receiverAddress)->queue(new Contact($data));
	        // dd(Mail::to($receiverAddress)->send(new Contact($data)));

	        // // Session::flash('success', 'Votre message nous a bien été envoyé.');
         //    \Toastr::success('Votre message nous a bien <br/>été envoyé.', 'Succès', ['timeOut' => 0]);
         //    $url = URL::route('home', array('#contact'));

         //    return Redirect::to($url);

            $data = Input::all();
            $receiverAddress = env('MAIL_CONTACT_RECEIVER');
            $content = array($receiverAddress => array('prenom' => $data['prenom'], 'nom' => $data['nom'], 'email' => $data['email'], 'message' => $data['message']));
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
                \Toastr::success('Votre message nous a bien <br/>été envoyé.', 'Succès', ['timeOut' => 0]);
                $url = URL::route('home', array('#contact'));
                return Redirect::to($url);
            } else {
                \Toastr::error('Une erreur est survenue et votre message <br/> n\'a pas pu être envoyé.', 'Erreur', ['timeOut' => 0]);
                $url = URL::route('home', array('#contact'));
                return Redirect::to($url);
            }
	    }
    }

    /*public function store(StoreContact $request)
    {
        $data = Input::all();

        FormulaireContact::create($data);

        $receiverAddress = [env('MAIL_ALL_RECEIVER'), env('MAIL_CONTACT_RECEIVER')];
        //Mail::to($receiverAddress)->send(new Contact($data));

        \Toastr::success('Votre message nous a bien <br/>été envoyé.', 'Succès', ['timeOut' => 0]);
        //return Redirect::to('formulaire-contact');
        return Redirect::to(URL::previous() . "#contact");
        
    }*/
}
