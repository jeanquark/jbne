<?php namespace App\Http\Controllers\Auth\Member;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class MemberLoginController extends Controller
{
    use AuthenticatesUsers;

	public function __construct() {
		$this->middleware('guest:member')->except('logout');
	}

    public function showLoginForm() {
    	return view('auth.member.member-login');
    }

    public function login(Request $request) {
    	// Validate the form data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

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

        $member = Auth::guard('member')->getLastAttempted();
        // dd($member);
        $request->session()->put('member_id', $member->id);

        if ($request->session()->has('member_id')) {
            $request->session()->forget('member_id');
        }

        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->put('member_id', $member->id);
            // return redirect()->intended(route('member.files'));
            return redirect()->route('member.files');

        }
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', trans('auth.failed'));
    }

    protected function checkCredential($request)
    {
        // dd('def');
        // dd(Auth::guard('lawyer')->validate($this->credentials($request)));
        return Auth::guard('member')->validate($this->credentials($request));
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
            'email' => [trans('auth.failed')],
        ]);
    }

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        $field = 'email'; // Because only usernames are accepted
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
            'email' => 'required|email|min:6',
            'password' => 'required|string|min:6',
        ]);
    }

    public function logout(Request $request) {
        Auth::guard('member')->logout();

        // $request->session()->invalidate();
        $request->session()->forget('member_id');

        return redirect('/');
    }
}
