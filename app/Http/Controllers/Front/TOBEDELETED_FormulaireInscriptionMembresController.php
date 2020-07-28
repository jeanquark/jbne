<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\FormulaireInscriptionMembres;

use App\Http\Requests\StoreInscriptionMembres;
use App\Mail\ValidationMembres;
use Validator;
use Redirect;
use Session;
use Input;
use View;
use Mail;
use App\User;
use App\Role;

class FormulaireInscriptionMembresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('formulaire-inscription-membres');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInscriptionMembres $request)
    {
        $data = Input::all();

        if ($data['statut'] == 'Avocat au Barreau') {
            $user = User::create([
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

        if($data['statut'] == 'Avocat stagiaire') {
            $user = User::create([
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

        $admin = Role::where('slug', '=', 'user')->firstOrFail();
        $user->attachRole($admin);

        \Toastr::success('Merci, votre inscription a bien<br/>été enregistrée!', 'Succès', ['timeOut' => 0]);
        return Redirect::to('home');
    }
}
