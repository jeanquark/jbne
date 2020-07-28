<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Trainee;

use File;
use View;
use Input;
use Session;
use Redirect;
use Validator;

// use App\Http\Requests\UpdateActivity;
use App\Http\Requests\StoreTrainee;

class TraineesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainees = Trainee::all();

        return View::make('back.trainees.index')
        ->with('trainees', $trainees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('back.trainees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainee $request)
    {
        $data = Input::all();

        // $path = $request->photo->store('images/activities');

        $image = $request->file('image');
        $file = $request->file('file');
        // dd($file->getClientOriginalName());

        if ($image) {
            // Has image file
            $imageName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $data['image_path'] = '/images/trainees/' . $imageName . '_'  . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/images/trainees');

            $image->move($destinationPath, $data['image_path']);
        }

        if ($file) {
            // Has file
            $fileName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
            $data['file_path'] = '/documents/trainees/' . $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('/documents/trainees');

            $file->move($destinationPath, $data['file_path']);
        }

        $trainee = Trainee::create($data);

        Session::flash('success', 'Contenu créé avec succès.');
        return Redirect::route('back.trainees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trainee = Trainee::findOrFail($id);

        return View::make('back.trainees.show')
        ->with('trainee', $trainee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainee = Trainee::findOrFail($id);

        return View::make('back.trainees.edit')
        ->with('trainee', $trainee);
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
        // dd($request);
        // dd($request->hasFile('image'));
        if ($request->hasFile('new_image') && $request->hasFile('new_file')) {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'new_image' => ['required' ,'image', 'dimensions:min_width=300,min_height=200,ratio=3/2'],
                'new_file' => ['file', 'mimes:pdf', 'max:5000'], // max size is in kilobytes
                'content' => [],
                'order_of_appearance' => ['required']
                );
        } else if ($request->hasFile('new_image')) {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'new_image' => ['required' ,'image', 'dimensions:min_width=300,min_height=200,ratio=3/2'],
                'content' => [],
                'order_of_appearance' => ['required']
                );
        } else if ($request->hasFile('new_file')) {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'new_file' => ['file', 'mimes:pdf', 'max:5000'], // max size is in kilobytes
                'content' => [],
                'order_of_appearance' => ['required']
                );
        } else {
            $rules = array(
                'title' => ['required', 'min:2', 'max:128'],
                'content' => [],
                'order_of_appearance' => ['required']
                );
        }
        
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('back/trainees/' . $id . '/edit')
            ->withErrors($validator)
            ->withInput();
        } else {

            $data = Input::all();

            if ($request->has('deleteImage')) {
                $old_image_path = Trainee::findOrFail($id)->image_path;

                if (file_exists(public_path() . '/' . $old_image_path)) {
                    @unlink(public_path() . '/' . $old_image_path);
                }
                $data['image_path'] = null;
            }
            // Check if upload new image
            if ($request->hasFile('new_image')) {
                // Delete old image
                $old_image_path = Trainee::findOrFail($id)->image_path;

                if (file_exists(public_path() . '/' . $old_image_path)) {
                    @unlink(public_path() . '/' . $old_image_path);
                }

                // Store new image
                $image = $request->file('new_image');
                $imageName = pathinfo($request->file('new_image')->getClientOriginalName(), PATHINFO_FILENAME);
                $data['image_path'] = '/images/trainees/' . $imageName . '_'  . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/trainees');
                $image->move($destinationPath, $data['image_path']); 
            }

            // Check if upload new file
            if ($request->hasFile('new_file')) {
                // Delete old file
                $old_file_path = Trainee::findOrFail($id)->file_path;

                if (file_exists(public_path() . '/' . $old_file_path)) {
                    @unlink(public_path() . '/' . $old_file_path);
                }

                // Store new file
                $file = $request->file('new_file');
                $fileName = pathinfo($request->file('new_file')->getClientOriginalName(), PATHINFO_FILENAME);
                $data['file_path'] = '/documents/trainees/' . $fileName . '_'  . time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/documents/trainees');
                $file->move($destinationPath, $data['file_path']); 
            }

            $trainee = Trainee::findOrFail($id);
            $trainee->update($data);

            Session::flash('success', 'Page modifiée avec succès.');
            return Redirect::to('back/trainees');
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
        $image_path = Trainee::findOrFail($id)->image_path;
        $file_path = Trainee::findOrFail($id)->file_path;

        $trainee = Trainee::findOrFail($id);
        $trainee->delete();

        if (file_exists(public_path() . '/' . $image_path)) {
            @unlink(public_path() . '/' . $image_path);
        }
        if (file_exists(public_path() . '/' . $file_path)) {
            @unlink(public_path() . '/' . $file_path);
        }

        Session::flash('success', 'Elément supprimé avec succès.');
        return redirect::to('back/trainees');
    }

    public function changeStatus()
    {
        $id = Input::get('id');

        $trainee = Trainee::findOrFail($id);

        $trainee->is_published = !$trainee->is_published;
        $trainee->save();

        return response()->json($trainee);
    }
}
