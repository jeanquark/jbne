<?php namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\FormulaireContact;
use Redirect;
use Input;
use View;
use Session;


class FormulaireContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = FormulaireContact::all();

        return View::make('back.formulaire_contacts.index')
            ->with('contacts', $contacts);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = FormulaireContact::findOrFail($id);

        return View::make('back.formulaire_contacts.show')
            ->with('contact', $contact);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = FormulaireContact::findOrFail($id);

        $contact->delete();

        Session::flash('success', 'Contact supprimé avec succès!');
        return redirect::to('back/formulaire-contacts');
    }


    public function changeStatus()
    {
        $id = Input::get('id');

        $contact = FormulaireContact::findOrFail($id);
        
        $contact->is_read = !$contact->is_read;
        $contact->save();

        return response()->json($contact);
    }
}
