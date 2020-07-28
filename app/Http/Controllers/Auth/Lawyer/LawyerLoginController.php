<?php namespace App\Http\Controllers\Auth\Lawyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Bestmomo\LaravelEmailConfirmation\Traits\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;


class LawyerLoginController extends Controller
{
    use AuthenticatesUsers;

	public function __construct() {
		$this->middleware('guest:lawyer')->except('logout');
	}

    public function showLoginForm() {
    	return view('auth.lawyer.lawyer-login');
    }

    public function login(Request $request) {
    	// Validate the form data
        // dd('abc');
        $this->validateLogin($request);
    	// $this->validate($request, [
    	// 	'username' => 'required|string|min:6',
    	// 	'password' => 'required|string|min:6'
    	// ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if (!$this->checkCredential($request)) {
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            // dd('abc');
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }

        // If user wants to sign in via email (which may not be unique, as opposed to username)
        // if ($this->username() === 'email') {
        //     // dd('email');
        //     dd(Auth::guard('lawyer')->attempt(['email' => $request->email, 'password' => $request->password, 'confirmed' => 0]));
        // }

        // $lawyer = Auth::guard('lawyer')->attempt(['username' => $request->username, 'password' => $request->password]);
        // dd($lawyer);
        $lawyer = Auth::guard('lawyer')->getLastAttempted();
        // dd($lawyer);
        $request->session()->put('lawyer_id', $lawyer->id);

        // if ($lawyer->is_confirmed) {
        if ($lawyer->is_verified) {
            // dd('confirmed');
            if ($request->session()->has('lawyer_id')) {
                $request->session()->forget('lawyer_id');
            }
            // dd('abc');
            // Attempt to log the lawyer in with email
            // if (Auth::guard('lawyer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            //     $request->session()->put('lawyer_id', $lawyer->id);
            //     return redirect()->route('lawyer.permanences.index');
            // }
            // Attempt to log the lawyer in with username
            if (Auth::guard('lawyer')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {

                $request->session()->put('lawyer_id', $lawyer->id);
                return redirect()->route('lawyer.permanences.index');
            }
            return redirect()->back()->withInput($request->only('username', 'remember'))->with('error', trans('auth.failed'));



            // if (Auth::guard('lawyer')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            //     // If successful, then redirect to their intended location
            //     // return redirect()->intented(route('lawyer.dashboard'));
            //     return redirect()->route('lawyer.permanences.index');
            // } else {
            //     // If unsuccessful, then redirect them back with the form data
            //     return redirect()->back()->withInput($request->only('username', 'remember'))->with('error', trans('auth.failed'));
            // }
        }
        // return redirect()->back()->with('confirmation-danger', __('confirmation::confirmation.again'));
        return redirect()->back()->with('error', 'Votre compte n\'a pas encore été validé. Veuillez consulter vos emails pour procéder à la validation ou exiger un nouvel <a href="/avocat/resend"><b>e-mail de validation</b></a>.');
    }

    protected function checkCredential($request)
    {
        // dd('def');
        // dd(Auth::guard('lawyer')->validate($this->credentials($request)));
        return Auth::guard('lawyer')->validate($this->credentials($request));
    }

    // protected function credentials(Request $request)
    // {
    //     // dd('def2');
    //     return $request->only($this->username(), 'password');
    // }

    protected function sendFailedLoginResponse(Request $request)
    {
        // dd($this->username());
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        $field = 'username'; // Because only usernames are accepted
        // dd($field);
        return $field;
    }

    protected function validateLogin(Request $request)
    {
        // $this->validate($request, [
        //     $this->username() => 'required|string|min:6',
        //     'password' => 'required|string|min:6',
        // ]);
        $this->validate($request, [
            'username' => 'required|string|min:6',
            'password' => 'required|string|min:6',
        ]);
    }

    public function logout(Request $request) {
        Auth::guard('lawyer')->logout();

        // $request->session()->invalidate();
        $request->session()->forget('lawyer_id');

        return redirect('/');
    }
}
