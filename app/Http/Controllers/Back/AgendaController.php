<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Agenda;

use View;
use Input;
use Session;
use Redirect;
use Storage;
use File;
use Validator;

use App\Http\Requests\StoreAgenda;
// use App\Http\Requests\UpdateAgenda;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::all();

        return View::make('back.agenda.index')
            ->with('agendas', $agendas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('back.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgenda $request)
    {
        $data = Input::all();

        $image = $request->file('image');

        if ($image) {
            // Has image file
            $data['image_path'] = '/images/agenda/' . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/images/agenda');

            $image->move($destinationPath, $data['image_path']);
        }

        $agenda = Agenda::create($data);

        Session::flash('success', 'Agenda créée avec succès.');
        return Redirect::route('back.agenda.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);

        return View::make('back.agenda.show')
            ->with('agenda', $agenda);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);

        return View::make('back.agenda.edit')
            ->with('agenda', $agenda);
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
        // dd($request->hasFile('image'));
        if ($request->hasFile('new_image')) {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'new_image' => ['required' ,'image', 'dimensions:min_width=200,min_height=200,ratio=1/1'],
                'content' => ['required']
            );
        } else {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'content' => ['required']
            );
        }
        
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('back/agenda/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();

            // Check if upload new image
            if ($request->hasFile('new_image')) {
                // Delete old image
                $old_image_path = Agenda::findOrFail($id)->image_path;

                File::delete($old_image_path);

                // Store new image
                $image = $request->file('new_image');
                $data['image_path'] = '/images/agenda/' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/agenda');
                $image->move($destinationPath, $data['image_path']); 
            }

            $agenda = Agenda::findOrFail($id);
            $agenda->update($data);

            Session::flash('success', 'Agenda modifié avec succès.');
            return Redirect::to('back/agenda');
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
        $agenda = Agenda::findOrFail($id);

        $agenda->delete();

        Session::flash('success', 'Agenda supprimé avec succès.');
        return redirect::to('back/agenda');
    }

    public function changeStatus()
    {
        $id = Input::get('id');

        $agenda = Agenda::findOrFail($id);

        $agenda->is_published = !$agenda->is_published;
        $agenda->save();

        return response()->json($agenda);
    }
}
