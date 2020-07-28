<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Task;
use App\Log;

use View;


class BackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // dd(\Auth::guard('member')->user()->id);
        // dd(auth('guard')->member()->user()->id);

    	$tasks = Task::orderBy('id', 'desc')->get();

        $logs = Log::orderBy('id', 'desc')->get();

        return View::make('back.index')
        	->with('tasks', $tasks)
            ->with('logs', $logs);
    }

    public function timeline() {
        return View::make('back.timeline');
    }

    public function timeline2() {
        return View::make('back.timeline2');
    }

}
