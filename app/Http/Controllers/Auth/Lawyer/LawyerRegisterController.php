<?php namespace App\Http\Controllers\Auth\Lawyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Lawyer;
use App\Http\Requests\StoreLawyer;
use Input;
use Redirect;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers as BaseRegistersUsers;
use Bestmomo\LaravelEmailConfirmation\Notifications\ConfirmEmail;
use Illuminate\Console\DetectsApplicationNamespace;
use App\VerifyLawyer;
use Mailgun\Mailgun;
use App\Mail\LawyerRegistrationValidation;
use Illuminate\Support\Facades\Mail;


class LawyerRegisterController extends Controller
{
    use BaseRegistersUsers, DetectsApplicationNamespace;

	public function __construct() {
        // dd('abc');
		$this->middleware('guest:lawyer');
	}

    public function showRegisterForm() {
    	return view('auth.lawyer.lawyer-register');
    }

    // public function register(StoreLawyer $request) {
    //     // dd($request);
    //     $data = Input::all();

    //     // $lawyer = Lawyer::create($data);

    // 	$lawyer = Lawyer::create([
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //         'username' => $data['username'],
    //         'lastname' => $data['lastname'],
    //         'firstname' => $data['firstname'],
    //         'phone_mobile' => $data['phone_mobile'],
    //         'street' => $data['street'],
    //         'city' => $data['city'],
    //         'phone_office' => $data['phone_office'],
    //         'fax_office' => $data['fax_office'],
    //     ]);

    //     \Toastr::success('Vous êtes désormais enregistré comme avocat et pouvez transmettre vos disponibilités.', 'Succès');
    //     return Redirect::route('lawyer.login');
    // }

    public function register(StoreLawyer $request) {
        $data = Input::all();

        if (isset($data['languages'])) {
            $languages = $data['languages'];
        } else {
            $languages = [];
        }

        array_push($languages, 'français');
        if (array_key_exists('other_languages_input', $data)) {
            array_push($languages, $data['other_languages_input']);
        }

        $languages_as_string = implode(',', array_values($languages));

        $lawyer = Lawyer::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'username' => $data['username'],
            'lastname' => $request->has('lastname') ? $data['lastname'] : '',
            'firstname' => $request->has('firstname') ? $data['firstname'] : '',
            'phone_mobile' => $request->has('phone_mobile') ? $data['phone_mobile'] : '',
            'languages' => $languages_as_string,
            // 'confirmation_code' => str_random(30)
        ]);

        // event(new Registered($lawyer));
        // $this->notifyUser($lawyer);

        $verifyLawyer = VerifyLawyer::create([
            'lawyer_id' => $lawyer->id,
            'token' => str_random(40)
        ]);

        try {
            Mail::to($lawyer->email)->send(new LawyerRegistrationValidation($lawyer));
            // dd('Success');
            \Toastr::success('Vous êtes désormais enregistré comme avocat et pourrez transmettre vos disponibilités une fois votre compte validé.', 'Succès', ['timeout' => 10000]);
            

            // return Redirect::route('lawyer.login')->with('confirmation-success', trans('confirmation::confirmation.message'));
            return Redirect::route('lawyer.login')->with('success', 'Merci pour votre enregistrement ! Nous allons vous envoyer un e-mail de confirmation à l\'adresse que vous nous avez transmise dans le formulaire. Veuillez ouvrir cet e-mail et cliquer sur le bouton "Valider votre compte". Vous pourrez ensuite vous connecter.');
        }
        catch (Exception $e) {
            \Toastr::error('Oups, une erreur est survenue lors de la procédure d\'inscription. Veuillez réessayer et nous <a href="/home#contact" target="_blank"><b>contacter</b></a> en cas de nouvel échec.', 'Erreur', ['timeout' => 10000]);
        }

        // Send Email
        // Instantiate the client
        // $mgClient = new Mailgun(env('MAIL_SECRET'));
        // $domain = "jbne.ch";

        // $recipients = json_encode($lawyer);
        // dd($recipients);
        // // $path = resource_path('views/emails/welcome.blade.php');
        // $path = resource_path('views/emails/mailgun/lawyer_registration_verification.html');
        // $message = file_get_contents($path);
        // # Make the call to the client.
        // $result = $mgClient->sendMessage($domain, array(
        //     'from'    => 'Test message <jm.kleger@gmail.com>',
        //     'to'      => 'jm.kleger@gmail.com',
        //     // 'to'      => $emails,
        //     // 'subject' => '%recipient.firstname%',
        //     'subject' => 'Test verification of the registration',
        //     // 'text'    => 'Testing some Mailgun awesomness!'
        //     'html'    => $message,
        //     'recipient-variables' => $recipients
        // ));

        // dd($result);

        // Mail::to($user->email)->send(new VerifyMail($user));

        \Toastr::success('Vous êtes désormais enregistré comme avocat et pourrez transmettre vos disponibilités une fois votre compte confirmé.', 'Succès', ['timeout' => 10000]);
        // return back()->withInput($request->only('email'))->with('confirmation-success', trans('confirmation::confirmation.message'));
        return Redirect::route('lawyer.login')->with('confirmation-success', trans('confirmation::confirmation.message'));
    }


    public function verifyLawyer($token)
    {
        $verifyLawyer = VerifyLawyer::where('token', $token)->first();

        if (isset($verifyLawyer)) {
            // dd($verifyLawyer);
            $lawyer = $verifyLawyer->lawyer;
            // dd($lawyer);
            if (!$lawyer->is_verified) {
                $verifyLawyer->lawyer->is_verified = 1;
                $verifyLawyer->lawyer->save();
                $status = "Votre adresse e-mail a été vérifiée. Vous pouvez désormais vous connecter depuis cette page.";
            } else {
                $status = "Votre adresse e-mail a déjà été vérifiée. Vous pouvez vous connecter depuis cette page.";
            }
        } else {
            // return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
            $error = "Une erreur est survenue et votre adresse e-mail n'a pas pu être identifiée. Veuillez nous <a href='/home#contact' target='_blank'>contacter</a> si le problème persiste.";
            return Redirect::route('lawyer.login')->with('error', $error);
        }

        // return redirect('/login')->with('status', $status);
        return Redirect::route('lawyer.login')->with('success', $status);
        // $success = "Une erreur est survenue et votre adresse e-mail n'a pas pu être identifiée. Veuillez nous <a href='/home#contact' target='_blank'>contacter</a> si le problème persiste.";
        // return Redirect::route('lawyer.login')->with('success', $success);
    }


    public function resendVerificationEmail(Request $request)
    {
        if ($request->session()->has('lawyer_id')) {
            $lawyer = Lawyer::where('id', '=', $request->session()->get('lawyer_id'))->firstOrFail();
            // dd($lawyer);
            try {
                Mail::to($lawyer->email)->send(new LawyerRegistrationValidation($lawyer));
                // return Redirect::route('lawyer.login')->with('confirmation-success', trans('confirmation::confirmation.message'));
                return Redirect::route('lawyer.login')->with('success', 'Nous allons vous renvoyer un e-mail de confirmation à l\'adresse que vous nous avez transmise dans le formulaire d\'enregistrement. Il s\'agit de l\'adresse suivante: ' . $lawyer->email . '. Veuillez ouvrir cet e-mail et cliquer sur le bouton "Valider votre compte". Vous pourrez ensuite vous connecter.');
            }
            catch (Exception $e) {
                \Toastr::error('Oups, une erreur est survenue lors de la procédure d\'inscription. Veuillez réessayer et nous <a href="/home#contact" target="_blank"><b>contacter</b></a> en cas de nouvel échec.', 'Erreur', ['timeout' => 10000]);
            }
            // return redirect(route('lawyer.login'))->with('confirmation-success', trans('confirmation::confirmation.resend'));
        }
    }






    /**
     * Handle a confirmation request
     *
     * @param  integer $id
     * @param  string  $confirmation_code
     * @return \Illuminate\Http\Response
     */
    public function confirm($id, $confirmation_code)
    {
        // dd('def');
        $lawyer = Lawyer::where('id', '=', $id)->where('confirmation_code', '=', $confirmation_code)->firstOrFail();
        $lawyer->confirmation_code = null;
        $lawyer->is_confirmed = true;
        $lawyer->save();
        return redirect(route('lawyer.login'))->with('confirmation-success', trans('confirmation::confirmation.success'));

        // $model = config('auth.providers.users.model');
        // $user = $model::whereId($id)->whereConfirmationCode($confirmation_code)->firstOrFail();
        // $user->confirmation_code = null;
        // $user->confirmed = true;
        // $user->save();
        // return redirect(route('login'))->with('confirmation-success', trans('confirmation::confirmation.success'));
    }

    /**
     * Handle a resend request
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        // if ($request->session()->has('user_id')) {
        //     $model = config('auth.providers.users.model');
        //     $user = $model::findOrFail($request->session()->get('user_id'));
        //     $this->notifyUser($user);
            
        //     return redirect(route('lawyer.login'))->with('confirmation-success', trans('confirmation::confirmation.resend'));
        // }
        // dd($request->session()->get('lawyer_id'));
        // dd($request->session());
        if ($request->session()->has('lawyer_id')) {
            $lawyer = Lawyer::where('id', '=', $request->session()->get('lawyer_id'))->firstOrFail();
            // dd($lawyer);
            $this->notifyUser($lawyer);
            
            return redirect(route('lawyer.login'))->with('confirmation-success', trans('confirmation::confirmation.resend'));
        }
        return redirect('/');
    }

    /**
     * Notify user with email
     *
     * @param  Model $user
     * @return void
     */
    protected function notifyUser($user)
    {
        $class = $this->getAppNamespace() . 'Notifications\ConfirmEmail';
        if (!class_exists($class)) {
            $class = ConfirmEmail::class;
        }
        $user->notify(new $class);
    }
}
