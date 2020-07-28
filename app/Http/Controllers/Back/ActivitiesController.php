<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Activity;

use File;
use View;
use Input;
use Session;
use Redirect;
use Validator;

use App\Http\Requests\StoreActivity;
// use App\Http\Requests\UpdateActivity;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();

        return View::make('back.activities.index')
            ->with('activities', $activities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('back.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivity $request)
    {
        $data = Input::all();

        // $path = $request->photo->store('images/activities');

        $image = $request->file('image');
        $file = $request->file('file');
        // dd($file->getClientOriginalName());

        if ($image) {
            // Has image file
            $imageName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $data['image_path'] = '/images/activities/' . $imageName . '_'  . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/images/activities');

            $image->move($destinationPath, $data['image_path']);
        }

        if ($file) {
            // Has file
            $fileName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
            $data['file_path'] = '/documents/activities/' . $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('/documents/activities');

            $file->move($destinationPath, $data['file_path']);
        }

        $activity = Activity::create($data);

        Session::flash('success', 'Activité créée avec succès.');
        return Redirect::route('back.activities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return View::make('back.activities.show')
            ->with('activity', $activity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);

        return View::make('back.activities.edit')
            ->with('activity', $activity);
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
        if ($request->hasFile('new_image') && $request->hasFile('new_file')) {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'new_image' => ['required' ,'image', 'dimensions:min_width=300,min_height=200,ratio=3/2'],
                'new_file' => ['file', 'mimes:pdf', 'max:5000'], // max size is in kilobytes
                'content' => []
            );
        } else if ($request->hasFile('new_image')) {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'new_image' => ['required' ,'image', 'dimensions:min_width=300,min_height=200,ratio=3/2'],
                'content' => []
            );
        } else if ($request->hasFile('new_file')) {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'new_file' => ['file', 'mimes:pdf', 'max:5000'], // max size is in kilobytes
                'content' => []
            );
        } else {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'content' => []
            );
        }
        
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('back/activities/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {

            $data = Input::all();

            // Check if upload new image
            if ($request->hasFile('new_image')) {
                // Delete old image
                $old_image_path = Activity::findOrFail($id)->image_path;

                if (file_exists(public_path() . '/' . $old_image_path)) {
                    unlink(public_path() . '/' . $old_image_path);
                }

                // Store new image
                $image = $request->file('new_image');
                $imageName = pathinfo($request->file('new_image')->getClientOriginalName(), PATHINFO_FILENAME);
                $data['image_path'] = '/images/activities/' . $imageName . '_'  . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/activities');
                $image->move($destinationPath, $data['image_path']); 
            }

            // Check if upload new file
            if ($request->hasFile('new_file')) {
                // Delete old file
                $old_file_path = Activity::findOrFail($id)->file_path;

                if (file_exists(public_path() . '/' . $old_file_path)) {
                    unlink(public_path() . '/' . $old_file_path);
                }

                // Store new file
                $file = $request->file('new_file');
                $fileName = pathinfo($request->file('new_file')->getClientOriginalName(), PATHINFO_FILENAME);
                $data['file_path'] = '/documents/activities/' . $fileName . '_'  . time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/documents/activities');
                $file->move($destinationPath, $data['file_path']); 
            }

            $activity = Activity::findOrFail($id);
            $activity->update($data);

            Session::flash('success', 'Activité modifiée avec succès.');
            return Redirect::to('back/activities');
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
        // Delete image in storage
        $image_path = Activity::findOrFail($id)->image_path;
        $file_path = Activity::findOrFail($id)->file_path;

        $activity = Activity::findOrFail($id);
        $activity->delete();

        if (file_exists(public_path() . '/' . $image_path)) {
            unlink(public_path() . '/' . $image_path);
        }
        if (file_exists(public_path() . '/' . $file_path)) {
            unlink(public_path() . '/' . $file_path);
        }

        Session::flash('success', 'Activité supprimée avec succès.');
        return redirect::to('back/activities');
    }

    public function changeStatus()
    {
        $id = Input::get('id');

        $activity = Activity::findOrFail($id);

        $activity->is_published = !$activity->is_published;
        $activity->save();

        return response()->json($activity);
    }
}
