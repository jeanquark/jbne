<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Permission;

use Redirect;
use Validator;
use Input;
use View;
use Session;


class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return View::make('back.permissions.index')
            ->with('permissions', $permissions);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!\Entrust::can('create-permission')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        return View::make('back.permissions.create');
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

            Permission::create($data);

            Session::flash('success', 'Permission créée avec succès.');
            return Redirect::route('back.permissions.index');
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
        $permission = Permission::findOrFail($id);

        return View::make('back.permissions.show')
            ->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*if (!\Entrust::can('edit-permission')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        $permission = Permission::findOrFail($id);

        return View::make('back.permissions.edit')
            ->with('permission', $permission);
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

            $permission = Permission::findOrFail($id);
            $permission->update($data);

            Session::flash('success', 'Permission modifiée avec <br/>succès.');
            return Redirect::to('back/permissions');
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
        $permission = Permission::findOrFail($id);

        $permission->delete();

        Session::flash('success', 'Permission supprimée avec succès!');
        return redirect::to('back/permissions');
    }
}
