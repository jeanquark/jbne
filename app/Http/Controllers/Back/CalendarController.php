<?php namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use View;
use App\Calendar;
use Validator;
use Session;
use Redirect;
use Input;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendar = Calendar::all();
        // dd($calendar);
        return View::make('back.calendar.index')
            ->with('calendar', $calendar);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('back.calendar.create');
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
            // 'firstname' => ['required', 'min:2', 'max:32'],
            // 'lastname'  => ['required', 'min:2', 'max:32'],
            // 'email' => ['required', 'email', 'unique:users'],
            // 'password'  => ['required', 'min:6', 'confirmed'],
            // 'password_confirmation' => ['required']
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();
            // dd($data);

            Calendar::create($data);

            Session::flash('success', 'Mois créé avec succès.');
            return Redirect::route('back.calendar.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $month = calendar::findOrFail($id);

        return View::make('back.calendar.edit')
            ->with('month', $month);
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
        $data = Input::all();
        // dd($data);

        $calendar = Calendar::findOrFail($id);
        $calendar->update($data);

        \Toastr::success('Calendrier modifié avec succès', 'Succès');
        return Redirect::route('back.calendar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
