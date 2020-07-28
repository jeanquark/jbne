<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Session;
use Auth;
use Input;
use App\File;
use App\Activity;
use App\Agenda;
use App\Team;

class TraineeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the beforeStage page.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeStage()
    {

        return View::make('trainee.beforeStage');
    }

    /**
     * Show the duringStage page.
     *
     * @return \Illuminate\Http\Response
     */
    public function duringStage()
    {
        return View::make('trainee.duringStage');
    }

    /**
     * Show the barExam page.
     *
     * @return \Illuminate\Http\Response
     */
    public function barExam() 
    {
        return View::make('trainee.barExam');
    }
}
