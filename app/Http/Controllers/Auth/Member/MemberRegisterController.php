<?php namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Lawyer;
use App\Http\Requests\StoreRegistrationMembers;
use Input;
use Redirect;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers as BaseRegistersUsers;
use Bestmomo\LaravelEmailConfirmation\Notifications\ConfirmEmail;
use Illuminate\Console\DetectsApplicationNamespace;

use App\Member;
use App\Role;


class MemberRegisterController extends Controller
{
    use BaseRegistersUsers, DetectsApplicationNamespace;

	public function __construct() {
        // dd('abc');
		$this->middleware('guest:member');
	}

    public function showRegisterForm() {
    	return view('auth.member.member-register');
    }


    public function register(StoreRegistrationMembers $request) {
        $data = Input::all();
        // dd($data);

        if ($data['statut'] == 'Avocat au Barreau') {
            $user = Member::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'rue' => $data['rue'],
                'localite' => $data['localite'],
                'type' => $data['type'],
                'statut' => $data['statut'],
                'date_inscription_barreau' => $data['date_inscription_barreau'],
                'is_active' => false
            ]);
        }

        if($data['statut'] == 'Avocat breveté') {
            $user = Member::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'rue' => $data['rue'],
                'localite' => $data['localite'],
                'type' => $data['type'],
                'statut' => $data['statut'],
                'is_active' => false
            ]);
        }
        if($data['statut'] == 'Avocat stagiaire') {
            $user = Member::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'rue' => $data['rue'],
                'localite' => $data['localite'],
                'type' => $data['type'],
                'statut' => $data['statut'],
                'date_debut_stage' => $data['date_debut_stage'],
                'date_fin_stage' => $data['date_fin_stage'],
                'is_active' => false
            ]);
        }

        $role = Role::where('slug', '=', 'user')->firstOrFail();
        $user->attachRole($role);

        \Toastr::success('Merci, votre inscription a bien<br/>été enregistrée! Vous pouvez désormais vous connecter à votre compte', 'Succès', ['timeOut' => 5000]);
        return Redirect::to('home#login');

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

    }

    /**
     * Handle a resend request
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {

    }

    /**
     * Notify user with email
     *
     * @param  Model $user
     * @return void
     */
    protected function notifyUser($user)
    {

    }
}
