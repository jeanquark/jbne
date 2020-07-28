<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Status;
use App\Task;
// use App\User;
use App\Member;

use Validator;
use Redirect;
use Input;
use View;
use Session;


class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();

        return View::make('back.tasks.index')
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responsables = Member::orderBy('firstname')->pluck('firstname', 'id');
        $status = Status::orderBy('name')->pluck('name', 'id');

        return View::make('back.tasks.create')
            ->with('responsables', $responsables)
            ->with('status', $status);
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
            'description' => ['max:255']
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::to('back/tasks/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();

            $task = new Task;

            $task->status_id = Input::get('statut');
            $task->description = Input::get('description');
            $raw = Input::get('progress');
            $task->progress = intval(preg_replace('/[^0-9]+/', '', $raw), 10);

            $task->save();

            $task->members()->attach(Input::get('members'));

            Session::flash('success', 'Nouvelle tâche créee!');
            return Redirect::route('back.index');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        $responsables = Member::orderBy('firstname')->pluck('firstname', 'id');
        //$responsables = TaskUsers::all();
        //$status = Status::orderBy('name')->pluck('name', 'id');
        $members = Member::all();
        $status = Status::all();
        //$status = Status::orderBy('name')->pluck('name', 'id');

        return View::make('back.tasks.edit')
            ->with('task', $task)
            ->with('members', $members)
            ->with('responsables', $responsables)
            ->with('status', $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'description' => ['max:255']
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', 'Erreur de validation.');
            return Redirect::to('back/tasks/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $task = Task::findOrFail($id);
            //dd($request->get('progress'));

            $task->description = $request->get('description');
            $task->status_id = $request->get('status_id');
            $raw = $request->get('progress');
            $task->progress = intval(preg_replace('/[^0-9]+/', '', $raw), 10);
            $task->members()->sync($request->get('responsables'));

            $task->save();

            Session::flash('Success','Tâche éditée avec succès!');
            return Redirect::to('back/index');
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
        $task = Task::findOrFail($id);

        $task->delete();

        Success::flash('success', 'Tâche supprimée avec succès!');
        return redirect::to('back/tasks');
    }
}