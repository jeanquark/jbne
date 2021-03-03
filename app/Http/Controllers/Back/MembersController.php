<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\Member;

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
// use App\Http\Requests\StoreUser;
use App\Http\Requests\StoreMember;
// use App\Http\Requests\UpdateUser;
use App\Http\Requests\UpdateMember;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->get();

        return View::make('back.members.index')
            ->with('members', $members);
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
        return View::make('back.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMember $request)
    {
        // dd('abc');
        $data = Input::only('firstname', 'lastname', 'email');

        if ($request->has('password')) {
            $hashed_passwd = Hash::make($request->password);
            $data += ['password' => $hashed_passwd];
        }

        $member = Member::create($data);

        $memberRole = Role::where('slug', '=', 'user')->firstOrFail();
        // Attach user role to new user
        $member->roles()->attach($memberRole->id);

        Session::flash('success', 'Membre créé avec succès.');
        return redirect::to('back/members');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);

        return View::make('back.members.show')
            ->with('member', $member);
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
        $member = Member::findOrFail($id);
        $roles = Role::pluck('name', 'id');

        return View::make('back.members.edit')
            ->with('member', $member)
            ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMember $request, $id)
    {
        $data = Input::all();

        $member = Member::findOrFail($id);
        $member->update($data);

        $member->roles()->sync(Input::get('roles'));

        Session::flash('success', 'Utilisateur modifié avec succès.');
        return Redirect::to('back/members');
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
        $member = Member::findOrFail($id);

        $member->delete();

        Session::flash('success', 'Utilisateur supprimé avec succès!');
        return redirect::to('back/members');
    }

    public function profile()
    {
        $member = Auth::guard('member')->user();

        return View::make('back/profile')
            ->with('member', $member);
    }

    public function changeStatus()
    {
        $id = Input::get('id');

        $member = Member::findOrFail($id);

        $member->is_active = !$member->is_active;
        $member->save();

        return response()->json($member);
    }

    public function showEmail($id)
    {
        // dd('abc');
        $member = Member::findOrFail($id);
        return new ValiderInscriptionMembres($member);
    }

    public function sendEmail()
    {
        $id = Input::get('id');
        $member = Member::findOrFail($id);

        Mail::to($member->email)->send(new ValiderInscriptionMembres($member));

        if (!count(Mail::failures()) > 0) {
            $member->increment('emails_sent');
        }
    }
}
