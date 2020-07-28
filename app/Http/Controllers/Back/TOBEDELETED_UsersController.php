<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Role;

use Validator;
use Redirect;
use Session;
use Input;
use View;
use Hash;
use File;
use Auth;
use Mail;

use App\Mail\ValiderInscriptionMembres;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return View::make('back.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!\Entrust::can('create-user')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        return View::make('back.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $data = Input::only('firstname', 'lastname', 'email');

        if ($request->has('password')) {
            $hashed_passwd = Hash::make($request->password);
            $data +=['password' => $hashed_passwd];
        }

        $user = User::create($data);

        $userRole = Role::where('slug', '=', 'user')->firstOrFail();
        // Attach user role to new user
        $user->roles()->attach($userRole->id);

        Session::flash('success', 'Utilisateur créé avec succès.');
        return Redirect::route('back.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return View::make('back.users.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        /*if (!\Entrust::can('edit-user')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id');

        return View::make('back.users.edit')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $rules = array(
            'firstname' => ['required', 'min:2', 'max:32'],
            'lastname'  => ['required', 'min:2', 'max:32']
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();

            $user = User::findOrFail($id);
            $user->update($data);

            $user->roles()->sync(Input::get('roles'));

            Session::flash('success', 'Utilisateur modifié avec succès.');
            return Redirect::to('back/users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (!\Entrust::can('delete-user')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('success', 'Utilisateur supprimé avec succès!');
        return redirect::to('back/users');
    }

    public function profile()
    {
        $user = Auth::user();

        return View::make('back/profile')
            ->with('user', $user);
    }

    public function changeStatus()
    {
        $id = Input::get('id');

        $user = User::findOrFail($id);
        
        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json($user);
    }

    public function showEmail($id)
    {
        // dd('abc');
        $user = User::findOrFail($id);
        return new ValiderInscriptionMembres($user);
    }

    public function sendEmail()
    {
        $id = Input::get('id');
        $user = User::findOrFail($id);
        // $user['pathToImage'] = 'https://dummyimage.com/600x400/000/fff';
        $user['pathToImage'] = 'https://jbne.ch/images/logo.png';

        // dd($data);
        $receiverAddress = Input::get('email');
        $when = \Carbon\Carbon::now()->addMinutes(2);

        // Mail::to($receiverAddress)->queue(new ValiderInscriptionMembres($user));
        Mail::to($receiverAddress)->later($when, new ValiderInscriptionMembres($user));
        // Mail::to($receiverAddress)->send(new ValiderInscriptionMembres($user));
        if (!count(Mail::failures()) > 0) {
            // $data->emails_sent += 1;
            // $data->save();
            $user->increment('emails_sent');
        }
        // return response()->json(['return' => 'some data']);
        return response()->json($user);
        // return View::make('back/users');
        // return redirect::to('back/users');
    }
}