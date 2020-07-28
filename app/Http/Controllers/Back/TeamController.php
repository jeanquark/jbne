<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Team;

use File;
use View;
use Input;
use Session;
use Redirect;
use Validator;

use App\Http\Requests\StoreTeamMember;
// use App\Http\Requests\UpdateActivity;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_members = Team::all();

        return View::make('back.team.index')
            ->with('team_members', $team_members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('back.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamMember $request)
    {
        $data = Input::all();

        $image = $request->file('image');

        if ($image) {
            // Has image file
            $data['image_path'] = '/images/team/' . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/images/team');

            $image->move($destinationPath, $data['image_path']);
        }

        $team = Team::create($data);

        Session::flash('success', 'Membre créé avec succès.');
        return Redirect::route('back.team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team_member = Team::findOrFail($id);

        return View::make('back.team.show')
            ->with('team_member', $team_member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team_member = Team::findOrFail($id);

        return View::make('back.team.edit')
            ->with('team_member', $team_member);
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
            'title' => ['required', 'min:2', 'max:128'],
            'firstname' => ['required', 'min:2', 'max:128'],
            'lastname' => ['required', 'min:2', 'max:128'],
            'status' => ['required', 'min:2', 'max:128'],
            'email' => ['nullable', 'email'],
            'website' => ['nullable', 'url'],
            'linkedIn' => ['nullable', 'url'],
            'new_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'dimensions:min_width=300,min_height=300', 'dimensions:ratio=1/1'],
            'order_of_appearance' => ['required', 'integer']
        );
        
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('back/team/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {

            $data = Input::all();

            // Check if upload new image
            if ($request->hasFile('new_image')) {
                // Delete old image
                $old_image = Team::findOrFail($id)->image_path;
                $old_image_path = public_path() . $old_image;

                if ($old_image_path && File::exists($old_image_path)) {
                    unlink($old_image_path);
                }

                // Store new image
                $image = $request->file('new_image');
                $data['image_path'] = '/images/team/' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/team');
                $image->move($destinationPath, $data['image_path']); 
            }

            $team = Team::findOrFail($id);
            $team->update($data);

            Session::flash('success', 'Membre du comité modifié avec succès.');
            return Redirect::to('back/team');
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
        $team_member = Team::findOrFail($id);

        // Delete old image
        $old_path = public_path() . $team_member->image_path;
        if ($team_member->image_path && File::exists($old_path)) {
            unlink($old_path);
        }

        $team_member->delete();

        Session::flash('success', 'Membre du comité supprimé avec succès.');
        return redirect::to('back/team');
    }

    public function changeStatus()
    {
        $id = Input::get('id');

        $team_member = Team::findOrFail($id);

        $team_member->is_published = !$team_member->is_published;
        $team_member->save();

        return response()->json($team_member);
    }
}
