<?php namespace App\Http\Controllers\Auth\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\User;

use Validator;
use Redirect;
use Session;
use Input;
use View;
use Auth;
use Hash;
use File;
use URL;

use App\Http\Requests\UpdateProfile;
use App\Member;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Member::findOrFail($id);
        // dd($profile);

        return View::make('auth.member.profile.show')
            ->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Member::findOrFail($id);

        return View::make('auth.member.profile.edit')
            ->with('profile', $profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request, $id)
    {
        // $data = Input::only('firstname', 'lastname', 'rue', 'localite');
        // $profile = Member::findOrFail($id);
        
        // $profile->update($data);

        // Session::flash('success', 'Profil modifié avec succès.');
        // return Redirect::route('member.profile.show', ['profile' => $id]);

        $data = Input::all();
        $profile = Member::findOrFail($id);

        if ($data['statut'] == 'Avocat au Barreau') {
            $profile->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'rue' => $data['rue'],
                'localite' => $data['localite'],
                'statut' => $data['statut'],
                'date_inscription_barreau' => $data['date_inscription_barreau'],
            ]);
        }

        if($data['statut'] == 'Avocat breveté') {
            $profile->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'rue' => $data['rue'],
                'localite' => $data['localite'],
                'statut' => $data['statut'],
            ]);
        }
        if($data['statut'] == 'Avocat stagiaire') {
            $profile->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'rue' => $data['rue'],
                'localite' => $data['localite'],
                'statut' => $data['statut'],
                'date_debut_stage' => $data['date_debut_stage'],
                'date_fin_stage' => $data['date_fin_stage'],
            ]);
        }

        Session::flash('success', 'Profil modifié avec succès.');
        return Redirect::route('member.profile.show', ['profile' => $id]);

    }


    public function changePassword(Request $request, $id)
    {
        $rules = array(
            'new_password'  => ['required', 'min:6', 'confirmed'],
            'new_password_confirmation' => ['required']
        );

        $validator = Validator::make(Input::all(), $rules);

        // check if new password format is valid
        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#password")
                ->withErrors($validator);
        } else { // valid format, check if old password is correct            
            $current_password = Auth::guard('member')->user()->password;           
            if (Hash::check($request->old_password, $current_password)) {
                $member_id = Auth::guard('member')->user()->id;
                $member = Member::findOrFail($member_id);

                $member->password = Hash::make($request->new_password);
                $member->save();
            } else {
                Session::flash('error', 'Vous ne pouvez pas modifier ce mot de passe.');
                return Redirect::back();
            }
            Session::flash('success', 'Mot de passe modifié avec succès.');
            return Redirect::route('member.profile.show', ['profile' => $id]);
        }
    }
}