<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Permission;
use App\Role;

use Validator;
use Redirect;
use Input;
use View;
use Session;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return View::make('back.roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!\Entrust::can('create-role')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        return View::make('back.roles.create');
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
            'name' => ['required', 'min:2', 'max:32'],
            'slug'  => ['required', 'min:2', 'max:32'],
            'description' => ['required', 'min:2', 'max:128'],
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();

            Role::create($data);

            Session::flash('success', 'Role créé avec succès.');
            return Redirect::route('back.roles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return View::make('back.roles.show')
            ->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*if (!\Entrust::can('edit-role')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        $role = Role::findOrFail($id);
        $permissions = Permission::pluck('name', 'id');

        return View::make('back.roles.edit')
            ->with('role', $role)
            ->with('permissions', $permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => ['required', 'min:2', 'max:32'],
            'slug'  => ['required', 'min:2', 'max:32'],
            'description' => ['required', 'min:2', 'max:128']
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();

            $role = Role::findOrFail($id);
            $role->update($data);

            $role->permissions()->sync(Input::get('permissions'));

            Session::flash('success', 'Role modifié avec succès.');
            return Redirect::to('back/roles');
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
        /*if (!\Entrust::can('delete-role')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        $role = Role::findOrFail($id);

        $role->delete();

        Session::flash('success', 'Role supprimé avec succès!');
        return redirect::to('back/roles');
    }
}