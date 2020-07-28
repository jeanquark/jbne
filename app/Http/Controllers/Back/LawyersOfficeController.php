<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LawyerOffice;
use View;
use Input;
use Redirect;
use Session;

use App\Http\Requests\StoreLawyerOffice;
use App\Http\Requests\UpdateLawyerOffice;

class LawyersOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = LawyerOffice::orderBy('name', 'asc')->get();
        // dd($offices);

        return View::make('back.lawyers-office.index')
            ->with('offices', $offices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('back.lawyers-office.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLawyerOffice $request)
    {
        $data = Input::all();

        LawyerOffice::create($data);

        Session::flash('success', 'Étude créée avec succès.');
        return Redirect::route('back.lawyers-office.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $office = LawyerOffice::findOrFail($id);

        return View::make('back.lawyers-office.show')
            ->with('office', $office);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $office = LawyerOffice::findOrFail($id);

        return View::make('back.lawyers-office.edit')
            ->with('office', $office);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLawyerOffice $request, $id)
    {
        $data = Input::all();

        $office = LawyerOffice::findOrFail($id);
        $office->update($data);

        Session::flash('success', 'Étude modifiée avec succès.');
        return Redirect::to('back/lawyers-office');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = LawyerOffice::findOrFail($id);

        $office->delete();

        Session::flash('success', 'Étude supprimée avec succès!');
        return redirect::to('back/lawyers-office');
    }
}
